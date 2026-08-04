<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Sản Phẩm - Admin</title>
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
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-3xl border border-gray-200 shadow-sm space-y-6">
        <div class="flex justify-between items-center border-b border-gray-100 pb-4">
            <h1 class="text-xl font-extrabold text-gray-900">Sửa Sản Phẩm: {{ $product->name }}</h1>
            <a href="{{ route('admin.products.index') }}" class="text-xs font-bold text-gray-500 hover:text-brand-600">Quay lại</a>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Tên sản phẩm</label>
                <input type="text" name="name" value="{{ $product->name }}" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-600">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Danh mục</label>
                    <select name="category_id" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-600">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Số lượng tồn kho</label>
                    <input type="number" name="stock" value="{{ $product->stock }}" required min="0" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-600">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Giá gốc (VNĐ)</label>
                    <input type="number" name="price" value="{{ $product->price }}" required min="0" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-600">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Giá khuyến mãi</label>
                    <input type="number" name="sale_price" value="{{ $product->sale_price }}" min="0" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-600">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">URL Hình ảnh</label>
                <input type="text" name="image" value="{{ $product->image }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-600">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Mô tả sản phẩm</label>
                <textarea name="description" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-600">{{ $product->description }}</textarea>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_featured" value="1" id="featured" {{ $product->is_featured ? 'checked' : '' }} class="rounded text-brand-600 focus:ring-brand-600">
                <label for="featured" class="text-xs font-bold text-gray-700">Đánh dấu là Sản phẩm Nổi bật (Featured)</label>
            </div>

            <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-3 rounded-xl shadow-md transition">Cập Nhật Sản Phẩm</button>
        </form>
    </div>
</body>
</html>
