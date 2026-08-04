<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Sử Đơn Hàng - SHOP FASHION</title>
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
            <a href="/" class="text-xs font-bold text-gray-600 hover:text-brand-600"><i class="fas fa-arrow-left"></i> Quay lại trang chủ</a>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-12 flex-grow w-full">
        <h1 class="text-2xl font-extrabold text-gray-900 mb-8 flex items-center gap-2">
            <i class="fas fa-history text-brand-600"></i> Đơn Hàng Của Tôi
        </h1>

        @if($orders->count() > 0)
            <div class="space-y-4">
                @foreach($orders as $order)
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <span class="text-xs font-extrabold text-brand-600">{{ $order->order_number }}</span>
                            <p class="text-xs text-gray-400 mt-1">Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                            <p class="text-sm font-bold text-gray-900 mt-2">Tổng tiền: {{ number_format($order->total_amount, 0, ',', '.') }}đ</p>
                        </div>

                        <div class="flex items-center gap-4">
                            @if($order->status === 'pending')
                                <span class="px-3 py-1 bg-amber-100 text-amber-800 text-xs font-extrabold rounded-full">Chờ xử lý</span>
                            @elseif($order->status === 'paid')
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-extrabold rounded-full">Đã thanh toán</span>
                            @elseif($order->status === 'shipped')
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-extrabold rounded-full">Đã giao hàng</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-extrabold rounded-full">Đã hủy</span>
                            @endif

                            <a href="{{ route('orders.show', $order->id) }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold rounded-xl text-xs">
                                Chi tiết <i class="fas fa-chevron-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @else
            <div class="bg-white text-center py-16 rounded-3xl border border-gray-100">
                <i class="fas fa-box-open text-4xl text-gray-300 mb-3"></i>
                <p class="text-gray-500 font-medium">Bạn chưa có đơn hàng nào.</p>
            </div>
        @endif
    </main>
</body>
</html>
