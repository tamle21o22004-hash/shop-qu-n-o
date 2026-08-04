<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng - SHOP FASHION</title>
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
    <!-- Header -->
    <header class="bg-white border-b border-gray-100 py-4">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <a href="/" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center text-white font-black text-lg">S</div>
                <span class="text-xl font-extrabold text-gray-900">SHOP<span class="text-brand-600">FASHION</span></span>
            </a>
            <a href="/" class="text-xs font-bold text-gray-600 hover:text-brand-600"><i class="fas fa-arrow-left"></i> Tiếp tục mua sắm</a>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-12 flex-grow w-full">
        <h1 class="text-2xl font-extrabold text-gray-900 mb-8 flex items-center gap-2">
            <i class="fas fa-shopping-cart text-brand-600"></i> Giỏ Hàng Của Bạn
        </h1>

        @if(session('success'))
            <div class="mb-4 bg-emerald-100 text-emerald-800 px-4 py-3 rounded-xl text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 bg-rose-100 text-rose-800 px-4 py-3 rounded-xl text-sm font-semibold">
                {{ session('error') }}
            </div>
        @endif

        @if(!empty($cart) && count($cart) > 0)
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Cart Items Table -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cart as $id => $item)
                        <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between gap-4">
                            <img src="{{ $item['image'] }}" class="w-20 h-20 object-cover rounded-xl bg-gray-100">
                            
                            <div class="flex-grow">
                                <h3 class="font-bold text-sm text-gray-900">{{ $item['name'] }}</h3>
                                <p class="text-xs text-brand-600 font-extrabold mt-1">{{ number_format($item['price'], 0, ',', '.') }}đ</p>
                            </div>

                            <form action="{{ route('cart.update') }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="{{ $item['stock'] }}" class="w-16 bg-gray-100 border-none rounded-lg text-center text-xs font-bold py-1.5" onchange="this.form.submit()">
                            </form>

                            <div class="text-right font-extrabold text-sm text-gray-900 w-24">
                                {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ
                            </div>

                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                                <button type="submit" class="text-gray-400 hover:text-rose-600 p-2 text-xs">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <!-- Order Summary Card -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4 h-fit">
                    <h3 class="font-bold text-base text-gray-900 border-b border-gray-100 pb-3">Tóm Tắt Đơn Hàng</h3>
                    
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Tạm tính:</span>
                        <span class="font-bold text-gray-900">{{ number_format($total, 0, ',', '.') }}đ</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Phí vận chuyển:</span>
                        <span class="font-bold text-emerald-600">Miễn phí</span>
                    </div>

                    <div class="border-t border-gray-100 pt-3 flex justify-between text-lg font-extrabold text-gray-900">
                        <span>Tổng tiền:</span>
                        <span class="text-brand-600">{{ number_format($total, 0, ',', '.') }}đ</span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="w-full block text-center bg-brand-600 hover:bg-brand-700 text-white font-bold py-3 rounded-xl shadow-md transition">
                        Tiến Hành Đặt Hàng <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        @else
            <div class="bg-white text-center py-16 rounded-3xl border border-gray-100 shadow-sm space-y-4">
                <i class="fas fa-shopping-bag text-5xl text-gray-300"></i>
                <p class="text-gray-500 font-medium">Giỏ hàng của bạn đang trống.</p>
                <a href="/" class="inline-block px-6 py-2.5 bg-brand-600 text-white rounded-full text-xs font-bold">Khám phá sản phẩm ngay</a>
            </div>
        @endif
    </main>
</body>
</html>
