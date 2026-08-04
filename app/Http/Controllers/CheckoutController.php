<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        try {
            DB::beginTransaction();

            $totalAmount = 0;

            // Stock re-validation
            foreach ($cart as $productId => $item) {
                $product = Product::lockForUpdate()->find($productId);
                if (!$product || $product->stock < $item['quantity']) {
                    DB::rollBack();
                    return redirect()->route('cart.index')->with('error', "Sản phẩm {$item['name']} không đủ số lượng trong kho.");
                }
                $totalAmount += $item['price'] * $item['quantity'];
            }

            // Create Order
            $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => $orderNumber,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'shipping_name' => $request->shipping_name,
                'shipping_phone' => $request->shipping_phone,
                'shipping_address' => $request->shipping_address,
                'note' => $request->note,
            ]);

            // Create OrderItems & deduct stock
            foreach ($cart as $productId => $item) {
                $product = Product::find($productId);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);

                // Deduct stock
                $product->decrement('stock', $item['quantity']);
            }

            DB::commit();

            // Clear session cart
            session()->forget('cart');

            return redirect()->route('orders.show', $order->id)->with('success', 'Đặt hàng thành công! Mã đơn hàng của bạn là: ' . $order->order_number);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra trong quá trình đặt hàng: ' . $e->getMessage());
        }
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function showOrder($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        // Gate / Policy check for resource ownership
        \Illuminate\Support\Facades\Gate::authorize('view', $order);

        return view('orders.show', compact('order'));
    }
}
