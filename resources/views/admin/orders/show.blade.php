<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng Admin #{{ $order->order_number }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: { brand: { 600: '#be123c' } }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen p-8">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-3xl border border-gray-200 shadow-sm space-y-6">
        <div class="flex justify-between items-center border-b border-gray-100 pb-4">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900">Chi Tiết Đơn Hàng: {{ $order->order_number }}</h1>
                <p class="text-xs text-gray-400">Khởi tạo: {{ $order->created_at->format('d/m/Y H:i:s') }}</p>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-gray-500 hover:text-brand-600">Quay lại danh sách</a>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-2 bg-gray-50 p-4 rounded-2xl">
                <h3 class="font-bold text-xs uppercase text-gray-400">Thông Tin Khách Hàng</h3>
                <p class="text-sm font-bold text-gray-900">{{ $order->shipping_name }}</p>
                <p class="text-xs text-gray-700"><strong>Điện thoại:</strong> {{ $order->shipping_phone }}</p>
                <p class="text-xs text-gray-700"><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
                @if($order->note)
                    <p class="text-xs text-gray-500 italic"><strong>Ghi chú:</strong> {{ $order->note }}</p>
                @endif
            </div>

            <div class="space-y-2 bg-gray-50 p-4 rounded-2xl">
                <h3 class="font-bold text-xs uppercase text-gray-400">Trạng Thái Đơn Hàng</h3>
                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="space-y-3">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="w-full bg-white border border-gray-200 text-xs font-bold rounded-xl px-3 py-2 focus:ring-2 focus:ring-brand-600">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Chờ xử lý (Pending)</option>
                        <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Đã thanh toán (Paid)</option>
                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Đã giao hàng (Shipped)</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Hủy đơn (Cancelled)</option>
                    </select>
                    <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs py-2 rounded-xl">Cập nhật trạng thái</button>
                </form>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-4 space-y-3">
            <h3 class="font-bold text-sm text-gray-900">Danh Sách Sản Phẩm Đặt Mua</h3>
            @foreach($order->items as $item)
                <div class="flex justify-between items-center text-xs py-2 border-b border-gray-50">
                    <div>
                        <p class="font-bold text-gray-900">{{ $item->product_name }}</p>
                        <p class="text-gray-400">{{ number_format($item->price, 0, ',', '.') }}đ x {{ $item->quantity }}</p>
                    </div>
                    <span class="font-bold text-gray-900">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</span>
                </div>
            @endforeach

            <div class="flex justify-between text-base font-extrabold text-brand-600 pt-2">
                <span>TỔNG TIỀN ĐƠN HÀNG:</span>
                <span>{{ number_format($order->total_amount, 0, ',', '.') }}đ</span>
            </div>
        </div>
    </div>
</body>
</html>
