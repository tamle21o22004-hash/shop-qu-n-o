<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán - SHOP FASHION</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: { brand: { 600: '#be123c', 700: '#9f1239' } }
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
            <a href="{{ route('cart.index') }}" class="text-xs font-bold text-gray-600 hover:text-brand-600"><i class="fas fa-arrow-left"></i> Quay lại giỏ hàng</a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-12 flex-grow w-full">
        <h1 class="text-2xl font-extrabold text-gray-900 mb-8 flex items-center gap-2">
            <i class="fas fa-truck text-brand-600"></i> Thông Tin Giao Hàng & Thanh Toán
        </h1>

        <form action="{{ route('checkout.process') }}" method="POST" class="grid md:grid-cols-2 gap-8">
            @csrf
            
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
                <h3 class="font-bold text-base text-gray-900 border-b border-gray-100 pb-3">Địa Chỉ Nhận Hàng</h3>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Họ và Tên người nhận</label>
                    <input type="text" name="shipping_name" value="{{ auth()->check() ? auth()->user()->name : old('shipping_name') }}" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-600">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Số điện thoại liên hệ</label>
                    <input type="text" name="shipping_phone" value="{{ auth()->check() ? auth()->user()->phone : old('shipping_phone') }}" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-600">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Địa chỉ nhận hàng chi tiết</label>
                    <textarea name="shipping_address" rows="3" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-600">{{ auth()->check() ? auth()->user()->address : old('shipping_address') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Ghi chú đơn hàng (không bắt buộc)</label>
                    <input type="text" name="note" placeholder="VD: Giao giờ hành chính..." class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-600">
                </div>
            </div>

            <!-- Order Confirmation Summary -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4 h-fit">
                <h3 class="font-bold text-base text-gray-900 border-b border-gray-100 pb-3">Sản Phẩm Đặt Mua</h3>

                <div class="space-y-3 max-h-60 overflow-y-auto pr-2">
                    @foreach($cart as $item)
                        <div class="flex justify-between items-center text-xs">
                            <div class="flex items-center gap-2">
                                <img src="{{ $item['image'] }}" class="w-10 h-10 object-cover rounded-lg">
                                <div>
                                    <p class="font-bold text-gray-900 line-clamp-1">{{ $item['name'] }}</p>
                                    <p class="text-gray-400">x{{ $item['quantity'] }}</p>
                                </div>
                            </div>
                            <span class="font-bold text-gray-900">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</span>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-100 pt-3 flex justify-between text-base font-extrabold text-gray-900">
                    <span>Tổng cần thanh toán:</span>
                    <span class="text-brand-600">{{ number_format($total, 0, ',', '.') }}đ</span>
                </div>

                <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-3.5 rounded-xl shadow-lg transition flex items-center justify-center gap-2">
                    <i class="fas fa-check-circle"></i> XÁC NHẬN ĐẶT HÀNG
                </button>
            </div>
        </form>
    </main>
</body>
</html>
