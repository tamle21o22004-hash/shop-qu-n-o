<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Đơn Hàng - Admin</title>
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
    <aside class="w-64 bg-gray-900 text-white min-h-screen p-6 hidden md:block">
        <div class="flex items-center gap-2 mb-8">
            <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center font-black">S</div>
            <span class="text-xl font-extrabold">ADMIN<span class="text-brand-500">PANEL</span></span>
        </div>
        <nav class="space-y-2 text-sm font-semibold">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 text-gray-400 hover:bg-gray-800 hover:text-white rounded-xl transition">
                <i class="fas fa-chart-line mr-2"></i> Tổng Quan
            </a>
            <a href="{{ route('admin.products.index') }}" class="block px-4 py-2.5 text-gray-400 hover:bg-gray-800 hover:text-white rounded-xl transition">
                <i class="fas fa-box mr-2"></i> Quản Lý Sản Phẩm
            </a>
            <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2.5 bg-brand-600 text-white rounded-xl">
                <i class="fas fa-shopping-cart mr-2"></i> Quản Lý Đơn Hàng
            </a>
            <a href="/" class="block px-4 py-2.5 text-gray-400 hover:bg-gray-800 hover:text-white rounded-xl transition mt-8 border-t border-gray-800 pt-4">
                <i class="fas fa-globe mr-2"></i> Xem Website Shop
            </a>
        </nav>
    </aside>

    <div class="flex-grow flex flex-col">
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center">
            <h1 class="text-xl font-extrabold text-gray-900">Quản Lý Đơn Hàng ({{ $orders->total() }})</h1>
        </header>

        <main class="p-8 space-y-6 flex-grow">
            @if(session('success'))
                <div class="bg-emerald-100 text-emerald-800 px-4 py-3 rounded-xl text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 space-y-4">
                <form action="{{ route('admin.orders.index') }}" method="GET" class="flex gap-4 items-center">
                    <label class="text-xs font-bold text-gray-600">Lọc theo trạng thái:</label>
                    <select name="status" onchange="this.form.submit()" class="bg-gray-50 border border-gray-200 rounded-xl px-3 py-1.5 text-xs font-semibold focus:ring-2 focus:ring-brand-600">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Chờ xử lý (Pending)</option>
                        <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Đã thanh toán (Paid)</option>
                        <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Đã giao hàng (Shipped)</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Đã hủy (Cancelled)</option>
                    </select>
                </form>

                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-gray-400 uppercase border-b border-gray-100">
                            <th class="pb-3">Mã đơn</th>
                            <th class="pb-3">Người nhận</th>
                            <th class="pb-3">Điện thoại</th>
                            <th class="pb-3">Tổng tiền</th>
                            <th class="pb-3">Trạng thái</th>
                            <th class="pb-3 text-right">Cập nhật nhanh</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($orders as $order)
                            <tr>
                                <td class="py-3 font-bold text-brand-600">
                                    <a href="{{ route('admin.orders.show', $order->id) }}">{{ $order->order_number }}</a>
                                </td>
                                <td class="py-3 font-bold text-gray-900">{{ $order->shipping_name }}</td>
                                <td class="py-3 font-semibold text-gray-600">{{ $order->shipping_phone }}</td>
                                <td class="py-3 font-extrabold text-gray-900">{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
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
                                <td class="py-3 text-right">
                                    <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="bg-gray-100 border-none text-[11px] font-bold rounded-lg px-2 py-1 focus:ring-2 focus:ring-brand-600">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                            <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Đã giao hàng</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Hủy đơn</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </main>
    </div>
</body>
</html>
