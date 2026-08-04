<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - SHOP FASHION</title>
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
<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen flex flex-col">
    <!-- Navigation -->
    <header class="bg-white border-b border-gray-100 shadow-sm py-4">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <a href="/" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center text-white font-black text-lg">S</div>
                <span class="text-xl font-extrabold text-gray-900">SHOP<span class="text-brand-600">FASHION</span></span>
            </a>
            <a href="/" class="text-xs font-bold text-gray-600 hover:text-brand-600"><i class="fas fa-arrow-left"></i> Quay lại trang chủ</a>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-12 flex-grow">
        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-lg grid md:grid-cols-2 gap-12 items-center">
            <div class="bg-gray-100 rounded-2xl overflow-hidden aspect-square">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            </div>

            <div class="space-y-6">
                <span class="px-3 py-1 bg-brand-50 text-brand-600 text-xs font-bold rounded-full uppercase">
                    {{ $product->category->name }}
                </span>
                
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 leading-snug">{{ $product->name }}</h1>

                <div class="flex items-baseline gap-4">
                    <span class="text-3xl font-extrabold text-brand-600">{{ number_format($product->effective_price, 0, ',', '.') }}đ</span>
                    @if($product->sale_price)
                        <span class="text-lg text-gray-400 line-through">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                    @endif
                </div>

                <div class="text-xs font-semibold text-gray-500">
                    Trạng thái: 
                    @if($product->stock > 0)
                        <span class="text-emerald-600 font-bold"><i class="fas fa-check-circle"></i> Còn hàng ({{ $product->stock }} sp trong kho)</span>
                    @else
                        <span class="text-rose-600 font-bold"><i class="fas fa-times-circle"></i> Hết hàng</span>
                    @endif
                </div>

                <p class="text-sm text-gray-600 leading-relaxed border-t border-b border-gray-100 py-4">
                    {{ $product->description }}
                </p>

                @if($product->stock > 0)
                    <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="flex items-center gap-4">
                            <label class="text-xs font-bold text-gray-700">Số lượng:</label>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-20 bg-gray-100 border-none rounded-xl py-2 px-3 text-center text-sm font-bold focus:ring-2 focus:ring-brand-600">
                        </div>

                        <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-3.5 rounded-xl shadow-lg transition flex items-center justify-center gap-2">
                            <i class="fas fa-shopping-bag"></i> Thêm Vào Giỏ Hàng
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </main>
</body>
</html>
