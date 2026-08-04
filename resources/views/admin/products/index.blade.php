<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm - Admin</title>
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
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white min-h-screen p-6 hidden md:block">
        <div class="flex items-center gap-2 mb-8">
            <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center font-black">S</div>
            <span class="text-xl font-extrabold">ADMIN<span class="text-brand-500">PANEL</span></span>
        </div>
        <nav class="space-y-2 text-sm font-semibold">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 text-gray-400 hover:bg-gray-800 hover:text-white rounded-xl transition">
                <i class="fas fa-chart-line mr-2"></i> Tổng Quan
            </a>
            <a href="{{ route('admin.products.index') }}" class="block px-4 py-2.5 bg-brand-600 text-white rounded-xl">
                <i class="fas fa-box mr-2"></i> Quản Lý Sản Phẩm
            </a>
            <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2.5 text-gray-400 hover:bg-gray-800 hover:text-white rounded-xl transition">
                <i class="fas fa-shopping-cart mr-2"></i> Quản Lý Đơn Hàng
            </a>
            <a href="/" class="block px-4 py-2.5 text-gray-400 hover:bg-gray-800 hover:text-white rounded-xl transition mt-8 border-t border-gray-800 pt-4">
                <i class="fas fa-globe mr-2"></i> Xem Website Shop
            </a>
        </nav>
    </aside>

    <div class="flex-grow flex flex-col">
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center">
            <h1 class="text-xl font-extrabold text-gray-900">Danh Sách Sản Phẩm ({{ $products->total() }})</h1>
            <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl text-xs flex items-center gap-2 shadow-md">
                <i class="fas fa-plus"></i> Thêm Sản Phẩm Mới
            </a>
        </header>

        <main class="p-8 space-y-6 flex-grow">
            @if(session('success'))
                <div class="bg-emerald-100 text-emerald-800 px-4 py-3 rounded-xl text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 space-y-4">
                <form action="{{ route('admin.products.index') }}" method="GET" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm tên sản phẩm..." class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-xs font-semibold focus:ring-2 focus:ring-brand-600 w-64">
                    <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-xl text-xs font-bold">Tìm kiếm</button>
                </form>

                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-gray-400 uppercase border-b border-gray-100">
                            <th class="pb-3">Hình ảnh</th>
                            <th class="pb-3">Tên sản phẩm</th>
                            <th class="pb-3">Danh mục</th>
                            <th class="pb-3">Giá bán</th>
                            <th class="pb-3">Tồn kho</th>
                            <th class="pb-3 text-right">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($products as $product)
                            <tr>
                                <td class="py-3">
                                    <img src="{{ $product->image }}" class="w-12 h-12 object-cover rounded-lg bg-gray-100">
                                </td>
                                <td class="py-3 font-bold text-gray-900 max-w-xs truncate">{{ $product->name }}</td>
                                <td class="py-3 font-semibold text-gray-600">{{ $product->category->name }}</td>
                                <td class="py-3 font-bold text-brand-600">{{ number_format($product->effective_price, 0, ',', '.') }}đ</td>
                                <td class="py-3 font-bold {{ $product->stock > 0 ? 'text-emerald-600' : 'text-rose-600' }}">{{ $product->stock }}</td>
                                <td class="py-3 text-right space-x-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="px-3 py-1 bg-amber-100 text-amber-800 rounded-lg font-bold hover:bg-amber-200">Sửa</a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-rose-100 text-rose-800 rounded-lg font-bold hover:bg-rose-200">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </main>
    </div>
</body>
</html>
