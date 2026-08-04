<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng #{{ $order->order_number }}</title>
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
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col">
    <header class="bg-white border-b border-gray-100 py-4">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <a href="/" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center text-white font-black text-lg">S</div>
                <span class="text-xl font-extrabold text-gray-900">SHOP<span class="text-brand-600">FASHION</span></span>
            </a>
            <a href="{{ route('orders.index') }}" class="text-xs font-bold text-gray-600 hover:text-brand-600"><i class="fas fa-arrow-left"></i> Danh sách đơn hàng</a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-12 flex-grow w-full space-y-6">
        @if(session('success'))
            <div class="bg-emerald-100 text-emerald-800 px-4 py-3 rounded-xl text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900">Đơn Hàng #{{ $order->order_number }}</h1>
                <p class="text-xs text-gray-400 mt-1">Khởi tạo lúc: {{ $order->created_at->format('d/m/Y H:i:s') }}</p>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold text-gray-500">Trạng thái:</span>
                @if($order->status === 'pending')
                    <span class="px-3 py-1 bg-amber-100 text-amber-800 text-xs font-extrabold rounded-full">Chờ xử lý</span>
                @elseif($order->status === 'paid')
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-extrabold rounded-full">Đã thanh toán</span>
                @elseif($order->status === 'shipped')
                    <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-extrabold rounded-full">Đã giao hàng</span>
                @else
                    <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-extrabold rounded-full">Đã hủy</span>
                @endif
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Shipping Info -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-2">
                <h3 class="font-bold text-sm text-gray-900 border-b border-gray-100 pb-2">Thông Tin Giao Hàng</h3>
                <p class="text-xs text-gray-700"><strong>Người nhận:</strong> {{ $order->shipping_name }}</p>
                <p class="text-xs text-gray-700"><strong>Điện thoại:</strong> {{ $order->shipping_phone }}</p>
                <p class="text-xs text-gray-700"><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
                @if($order->note)
                    <p class="text-xs text-gray-500 italic"><strong>Ghi chú:</strong> {{ $order->note }}</p>
                @endif
            </div>

            <!-- Items -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-3">
                <h3 class="font-bold text-sm text-gray-900 border-b border-gray-100 pb-2">Chi Tiết Sản Phẩm</h3>
                @foreach($order->items as $item)
                    <div class="flex justify-between items-center text-xs border-b border-gray-50 pb-2">
                        <div>
                            <p class="font-bold text-gray-900">{{ $item->product_name }}</p>
                            <p class="text-gray-400">{{ number_format($item->price, 0, ',', '.') }}đ x {{ $item->quantity }}</p>
                        </div>
                        <span class="font-bold text-gray-900">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</span>
                    </div>
                @endforeach
                <div class="flex justify-between text-sm font-extrabold text-brand-600 pt-2">
                    <span>Tổng tiền:</span>
                    <span>{{ number_format($order->total_amount, 0, ',', '.') }}đ</span>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
