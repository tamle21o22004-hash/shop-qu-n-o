<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        $currentQty = isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0;
        $newQty = $currentQty + $request->quantity;

        // Check stock
        if ($newQty > $product->stock) {
            return redirect()->back()->with('error', "Rất tiếc! Sản phẩm {$product->name} chỉ còn {$product->stock} sản phẩm trong kho.");
        }

        $cart[$product->id] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->effective_price,
            'quantity' => $newQty,
            'image' => $product->image,
            'stock' => $product->stock,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', "Đã thêm sản phẩm {$product->name} vào giỏ hàng!");
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->quantity > $product->stock) {
            return redirect()->back()->with('error', "Số lượng yêu cầu vượt quá tồn kho hiện tại ({$product->stock}).");
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Đã cập nhật số lượng sản phẩm!');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }
}
