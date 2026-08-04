<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOP FASHION - Thời Trang Quần Áo Nam Nữ Cao Cấp</title>

    <!-- Google Fonts & FontAwesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS & AlpineJS for Carousel -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: {
                        brand: {
                            50: '#fdf4f5', 100: '#fbe8eb', 500: '#e11d48', 600: '#be123c', 700: '#9f1239', 900: '#4c0519'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased flex flex-col min-h-screen">

    <!-- Flash Notifications -->
    @if (session('success'))
        <div class="bg-emerald-600 text-white px-4 py-3 text-center text-sm font-bold shadow-md sticky top-0 z-50 flex items-center justify-center gap-2">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-rose-600 text-white px-4 py-3 text-center text-sm font-bold shadow-md sticky top-0 z-50 flex items-center justify-center gap-2">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
        </div>
    @endif

    <!-- 1. FULL-WIDTH ANNOUNCEMENT TOP BAR (CẢI TIẾN TRÀN MÀN HÌNH CHUẨN ĐẸP) -->
    <div class="w-full bg-gray-900 text-white text-xs py-2.5 px-4 sm:px-8 border-b border-gray-800">
        <div class="w-full max-w-[1920px] mx-auto flex flex-wrap justify-between items-center gap-2">
            <div class="flex items-center gap-2 font-medium">
                <span class="bg-brand-600/30 text-brand-300 px-2 py-0.5 rounded-full font-bold">ƯU ĐÃI</span>
                <span>🔥 Miễn phí vận chuyển toàn quốc cho đơn hàng từ <strong>500.000đ</strong></span>
            </div>
            
            <div class="flex items-center gap-6 font-medium ml-auto sm:ml-0">
                <div class="flex items-center gap-2">
                    <i class="fas fa-phone-alt text-brand-500"></i>
                    <span>Hotline hỗ trợ: <a href="tel:0901234567" class="font-extrabold underline hover:text-brand-400">0901 234 567</a></span>
                </div>
                <div class="hidden md:flex items-center gap-3 border-l border-gray-800 pl-6">
                    <a href="#" class="hover:text-brand-400 transition" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="hover:text-brand-400 transition" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-brand-400 transition" title="TikTok"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Navigation -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-2">
                    <a href="/" class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-brand-600 rounded-xl flex items-center justify-center text-white font-black text-xl shadow-lg shadow-brand-500/30">S</div>
                        <span class="text-2xl font-extrabold tracking-tight text-gray-900">SHOP<span class="text-brand-600">FASHION</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="hidden md:flex space-x-6 font-semibold text-gray-700 text-sm">
                    <a href="/" class="{{ !request('category') ? 'text-brand-600 font-bold border-b-2 border-brand-600 pb-1' : 'hover:text-brand-600 transition' }}">Tất Cả</a>
                    @foreach($categories as $cat)
                        <a href="/?category={{ $cat->slug }}" class="{{ request('category') === $cat->slug ? 'text-brand-600 font-bold border-b-2 border-brand-600 pb-1' : 'hover:text-brand-600 transition' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </nav>

                <!-- Search & User Actions -->
                <div class="flex items-center gap-4">
                    <!-- Search Form -->
                    <form action="/" method="GET" class="relative hidden lg:block w-64">
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm quần áo, đầm, áo sơ mi..." class="w-full bg-gray-100 border-none rounded-full py-2 pl-4 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/50">
                        <button type="submit" class="absolute right-3 top-2.5 text-gray-400 hover:text-brand-600">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                    <!-- Cart -->
                    @php $cartCount = count(session('cart', [])); @endphp
                    <a href="{{ route('cart.index') }}" class="relative p-2.5 bg-gray-100 text-gray-700 hover:text-brand-600 rounded-full transition flex items-center justify-center">
                        <i class="fas fa-shopping-bag text-lg"></i>
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 bg-brand-600 text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center border-2 border-white shadow-sm">{{ $cartCount }}</span>
                        @endif
                    </a>

                    <!-- User Actions -->
                    @if (Route::has('login'))
                        @auth
                            <div class="flex items-center gap-2">
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="px-3.5 py-2 bg-brand-600 text-white rounded-full text-xs font-bold hover:bg-brand-700 transition flex items-center gap-1.5 shadow-md">
                                        <i class="fas fa-user-shield"></i> Admin Panel
                                    </a>
                                @else
                                    <a href="{{ route('orders.index') }}" class="px-3.5 py-2 bg-gray-900 text-white rounded-full text-xs font-bold hover:bg-gray-800 transition flex items-center gap-1.5 shadow-md">
                                        <i class="fas fa-box"></i> Đơn Hàng
                                    </a>
                                @endif

                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="p-2 text-gray-400 hover:text-rose-600 text-sm transition" title="Đăng xuất">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-brand-600 px-3 py-2">Đăng nhập</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-full text-xs font-bold shadow-md transition">Đăng ký</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- 2. AUTOMATIC IMAGE CAROUSEL / SLIDESHOW HERO SECTION (CHUYỂN ẢNH TỰ ĐỘNG THỜI TRANG CỰC ĐẸP) -->
    <section class="relative bg-gray-900 text-white overflow-hidden" 
             x-data="{ 
                activeSlide: 0, 
                slides: [
                    { 
                        title: 'Bộ Sưu Tập Mùa Hè 2026', 
                        subtitle: 'Phong Cách Thời Trang Cá Tính & Hiện Đại', 
                        desc: 'Khám phá 40+ mẫu quần áo hot nhất hè này. Chất liệu mát lạnh, chuẩn form giúp bạn tự tin tuyệt đối.',
                        img: 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1200',
                        badge: 'XU HƯỚNG HOT 🔥',
                        btnText: 'Khám Phá Ngay',
                        link: '#products'
                    },
                    { 
                        title: 'Áo Thun & Polo Unisex', 
                        subtitle: 'Ưu Đãi Giảm Giá Lên Tới 40%', 
                        desc: 'Form rộng cá tính, vải Cotton 100% thoáng khí. Thoải mái vận động cả ngày dài.',
                        img: 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1200',
                        badge: 'SALE KHUYẾN MÃI 💥',
                        btnText: 'Mua Ngay Áo Thun',
                        link: '/?category=ao-thun'
                    },
                    { 
                        title: 'Áo Sơ Mi & Blazer Hàn Quốc', 
                        subtitle: 'Lịch Lãm - Sang Trọng - Công Sở', 
                        desc: 'Bộ sưu tập áo sơ mi linen & blazer thời trang công sở tôn dáng hiện đại.',
                        img: 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=1200',
                        badge: 'BỘ SƯU TẬP CAO CẤP 👔',
                        btnText: 'Xem BST Sơ Mi',
                        link: '/?category=ao-so-mi'
                    },
                    { 
                        title: 'Váy & Đầm Nữ Quyến Rũ', 
                        subtitle: 'Dịu Dàng Dự Tiệc & Mùa Hè', 
                        desc: 'Đầm hoa nhí, đầm dáng xòe & chân váy nữ xếp li tôn vẻ đẹp quý phái quyến rũ.',
                        img: 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=1200',
                        badge: 'THỜI TRANG NỮ ✨',
                        btnText: 'Xem Bộ Sưu Tập Váy',
                        link: '/?category=vay-dam'
                    }
                ],
                timer: null,
                init() {
                    this.timer = setInterval(() => {
                        this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                    }, 4000);
                }
             }">

        <!-- Slides Container -->
        <div class="relative min-h-[480px] lg:min-h-[540px] flex items-center">
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="activeSlide === index" 
                     x-transition:enter="transition ease-out duration-700 opacity-0 transform scale-95"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-500 opacity-100"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0 w-full h-full flex items-center">
                    
                    <!-- Background Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-r from-gray-950 via-gray-900/80 to-transparent z-10"></div>
                    <img :src="slide.img" :alt="slide.title" class="absolute inset-0 w-full h-full object-cover object-center opacity-60">

                    <!-- Slide Content -->
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 w-full grid lg:grid-cols-2 gap-8 items-center py-12">
                        <div class="space-y-4 max-w-xl">
                            <span class="inline-block px-3 py-1 bg-brand-600 text-white rounded-full text-xs font-black uppercase tracking-wider shadow-lg shadow-brand-600/30" x-text="slide.badge"></span>
                            
                            <h2 class="text-3xl sm:text-5xl font-extrabold text-white leading-tight" x-text="slide.subtitle"></h2>
                            
                            <p class="text-gray-200 text-sm sm:text-base leading-relaxed" x-text="slide.desc"></p>
                            
                            <div class="pt-2">
                                <a :href="slide.link" class="inline-flex items-center gap-2 px-8 py-3.5 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow-xl shadow-brand-600/40 transition">
                                    <span x-text="slide.btnText"></span>
                                    <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Navigation Arrows -->
        <button @click="activeSlide = (activeSlide - 1 + slides.length) % slides.length" class="absolute left-4 top-1/2 -translate-y-1/2 z-30 w-11 h-11 bg-black/40 hover:bg-brand-600 text-white rounded-full flex items-center justify-center backdrop-blur-md border border-white/10 transition">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button @click="activeSlide = (activeSlide + 1) % slides.length" class="absolute right-4 top-1/2 -translate-y-1/2 z-30 w-11 h-11 bg-black/40 hover:bg-brand-600 text-white rounded-full flex items-center justify-center backdrop-blur-md border border-white/10 transition">
            <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Carousel Indicators (Dots) -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-30 flex items-center gap-2">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index" 
                        class="h-2.5 rounded-full transition-all duration-300"
                        :class="activeSlide === index ? 'w-8 bg-brand-600' : 'w-2.5 bg-white/50 hover:bg-white'"></button>
            </template>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex-grow">
        
        <!-- Section Title & Preserved Sort Form -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900">
                    @if(request('category'))
                        Mẫu: {{ optional($categories->firstWhere('slug', request('category')))->name }}
                    @elseif(request('search'))
                        Tìm kiếm: "{{ request('search') }}"
                    @else
                        Tất Cả Mẫu Quần Áo Mới Nhất
                    @endif
                </h2>
                <p class="text-xs text-gray-500 mt-1">Hiển thị {{ $products->total() }} mẫu thời trang chuẩn đẹp</p>
            </div>

            <!-- SẮP XẾP HOÀN CHỈNH GIỮ NGUYÊN SEARCH & CATEGORY -->
            <form action="/" method="GET" class="flex items-center gap-2 w-full md:w-auto">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif

                <label class="text-xs font-bold text-gray-600 whitespace-nowrap">Sắp xếp:</label>
                <select name="sort" onchange="this.form.submit()" class="bg-white border border-gray-200 text-xs font-bold rounded-xl px-3 py-2 focus:ring-2 focus:ring-brand-600 shadow-sm cursor-pointer">
                    <option value="">Mặc định (Mới nhất)</option>
                    <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Giá: Thấp đến Cao ⬆️</option>
                    <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Giá: Cao đến Thấp ⬇️</option>
                    <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Sản phẩm mới về 🔥</option>
                </select>
            </form>
        </div>

        <!-- Product Grid -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition duration-300 flex flex-col group">
                        <div class="relative bg-gray-100 aspect-square overflow-hidden">
                            @if($product->sale_price)
                                <span class="absolute top-3 left-3 z-10 bg-brand-600 text-white text-[10px] font-extrabold px-2.5 py-1 rounded-md uppercase">
                                    -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                                </span>
                            @endif
                            
                            <a href="{{ route('products.show', $product->id) }}">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            </a>
                        </div>

                        <div class="p-5 flex flex-col justify-between flex-grow space-y-3">
                            <div>
                                <span class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">{{ $product->category->name }}</span>
                                <h3 class="font-bold text-gray-900 text-sm mt-1 line-clamp-2 hover:text-brand-600 leading-snug">
                                    <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                                </h3>
                            </div>
                            
                            <div class="pt-3 border-t border-gray-50 flex items-center justify-between">
                                <div>
                                    <span class="text-base font-extrabold text-brand-600">{{ number_format($product->effective_price, 0, ',', '.') }}đ</span>
                                    @if($product->sale_price)
                                        <span class="text-xs text-gray-400 line-through ml-1">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                                    @endif
                                </div>

                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="bg-gray-100 hover:bg-brand-600 hover:text-white text-gray-800 w-9 h-9 rounded-full flex items-center justify-center transition shadow-sm" title="Thêm vào giỏ hàng">
                                        <i class="fas fa-cart-plus text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="mt-10">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-3xl border border-gray-100 shadow-sm space-y-3">
                <i class="fas fa-tshirt text-5xl text-gray-300"></i>
                <p class="text-gray-500 font-medium">Không tìm thấy mẫu quần áo phù hợp.</p>
                <a href="/" class="inline-block px-5 py-2.5 bg-brand-600 text-white rounded-full text-xs font-bold">Xem tất cả các mẫu</a>
            </div>
        @endif

    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-xs border-t border-gray-800 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <span class="font-extrabold text-white">SHOP FASHION</span> &copy; 2026. Xây dựng trên Laravel 12 MVC framework.
            </div>
            <div class="flex gap-6">
                <a href="#" class="hover:text-white">Chính sách đổi trả</a>
                <a href="#" class="hover:text-white">Hướng dẫn chọn size</a>
                <a href="#" class="hover:text-white">Liên hệ cửa hàng</a>
            </div>
        </div>
    </footer>

</body>
</html>
