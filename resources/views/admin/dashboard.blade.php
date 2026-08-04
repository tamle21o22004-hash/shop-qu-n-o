<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SHOP FASHION</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
   <span/>
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
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white min-h-screen p-6 hidden md:block">
        <div class="flex items-center gap-2 mb-8">
            <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center font-black">S</div>
            <span class="text-xl font-extrabold">ADMIN<span class="text-brand-500">PANEL</span></span>
        </div>

        <nav class="space-y-2 text-sm font-semibold">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 bg-brand-600 text-white rounded-xl">
                <i class="fas fa-chart-line mr-2"></i> Tổng Quan
            </a>
            <a href="{{ route('admin.products.index') }}" class="block px-4 py-2.5 text-gray-400 hover:bg-gray-800 hover:text-white rounded-xl transition">
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

    <!-- Main Admin Content -->
    <div class="flex-grow flex flex-col">
        <!-- Topbar -->
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center">
            <h1 class="text-xl font-extrabold text-gray-900">Bảng Điều Khiển Admin</h1>
            <div class="flex items-center gap-4">
                <span class="text-xs font-bold text-gray-600"><i class="fas fa-user-circle"></i> {{ auth()->user()->name }} (Admin)</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-xs font-bold text-rose-600 hover:underline">Đăng xuất</button>
                </form>
            </div>
        </header>

        <main class="p-8 space-y-8 flex-grow">
            <!-- Metric Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex justify-between items-center">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase">Tổng Doanh Thu</p>
                        <h3 class="text-2xl font-extrabold text-brand-600 mt-1">{{ number_format($totalRevenue, 0, ',', '.') }}đ</h3>
                    </div>
                    <div class="w-12 h-12 bg-brand-50 text-brand-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-coins"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex justify-between items-center">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase">Tổng Đơn Hàng</p>
                        <h3 class="text-2xl font-extrabold text-gray-900 mt-1">{{ $totalOrders }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex justify-between items-center">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase">Sản Phẩm Trong Kho</p>
                        <h3 class="text-2xl font-extrabold text-gray-900 mt-1">{{ $totalProducts }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-tshirt"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex justify-between items-center">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase">Khách Hàng</p>
                        <h3 class="text-2xl font-extrabold text-gray-900 mt-1">{{ $totalUsers }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 space-y-4">
                <div class="flex justify-between items-center border-b border-gray-100 pb-4">
                    <h3 class="font-extrabold text-lg text-gray-900">Đơn Hàng Gần Đây</h3>
                    <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-brand-600 hover:underline">Xem tất cả</a>
                </div>

                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-gray-400 uppercase border-b border-gray-100">
                            <th class="pb-3">Mã đơn</th>
                            <th class="pb-3">Khách hàng</th>
                            <th class="pb-3">Tổng tiền</th>
                            <th class="pb-3">Trạng thái</th>
                            <th class="pb-3">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($recentOrders as $order)
                            <tr>
                                <td class="py-3 font-bold text-brand-600">{{ $order->order_number }}</td>
                                <td class="py-3 font-semibold text-gray-800">{{ $order->shipping_name }}</td>
                                <td class="py-3 font-bold text-gray-900">{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                                <td class="py-3">
                                    @if($order->status === 'pending')
                                        <span class="px-2.5 py-1 bg-amber-100 text-amber-800 rounded-full font-bold">Chờ xử lý</span>
                                    @elseif($order->status === 'paid')
                                        <span class="px-2.5 py-1 bg-blue-100 text-blue-800 rounded-full font-bold">Đã thanh toán</span>
                                    @elseif($order->status === 'shipped')
                                        <span class="px-2.5 py-1 bg-emerald-100 text-emerald-800 rounded-full font-bold">Đã giao</span>
                                    @else
                                        <span class="px-2.5 py-1 bg-gray-100 text-gray-600 rounded-full font-bold">Đã hủy</span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="text-gray-600 hover:text-brand-600 font-bold">
                                        Chi tiết
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
