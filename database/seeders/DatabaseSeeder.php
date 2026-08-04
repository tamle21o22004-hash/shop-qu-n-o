<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. USERS (21 Users: 1 Admin + 20 Customers)
        $admin = User::create([
            'name' => 'Admin System',
            'email' => 'admin@shop.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'phone' => '0901234567',
            'address' => '123 Đường Nguyễn Trãi, Quận 1, TP. Hồ Chí Minh',
        ]);

        $users = [];
        for ($i = 1; $i <= 20; $i++) {
            $users[] = User::create([
                'name' => "Khách Hàng {$i}",
                'email' => "user{$i}@shop.com",
                'password' => bcrypt('password'),
                'role' => 'user',
                'phone' => '0987' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'address' => "Số {$i} Đường Lê Lợi, Quận " . (($i % 10) + 1) . ", TP. HCM",
            ]);
        }

        // 2. CATEGORIES (6 Main Categories)
        $categoriesData = [
            ['name' => 'Áo Thun Nam Nữ', 'slug' => 'ao-thun', 'description' => 'Áo thun cotton thoáng mát, form rộng unisex, tank top & crop top'],
            ['name' => 'Áo Sơ Mi Công Sở', 'slug' => 'ao-so-mi', 'description' => 'Áo sơ mi cao cấp tay dài & tay ngắn công sở lịch lãm sang trọng'],
            ['name' => 'Quần Jeans & Denim', 'slug' => 'quan-jeans', 'description' => 'Quần jeans slimfit nam, quần cạp cao ống rộng nữ, denim rách gối'],
            ['name' => 'Quần Short Năng Động', 'slug' => 'quan-short', 'description' => 'Quần short kaki, quần short thể thao nỉ mặc nhà & đi chơi'],
            ['name' => 'Váy & Đầm Nữ', 'slug' => 'vay-dam', 'description' => 'Váy đầm công sở, đầm hoa nhí, đầm body dự tiệc & chân váy nữ'],
            ['name' => 'Áo Khoác & Blazer', 'slug' => 'ao-khoac', 'description' => 'Áo khoác dù 2 lớp, blazer Hàn Quốc, cardigan len & áo khoác da'],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[] = Category::create($cat);
        }

        // 3. PRODUCTS (35 Perfectly Matched Clothing Products)
        $productsData = [
            // --- ÁO THUN (Category 0) ---
            [
                'category_id' => $categories[0]->id,
                'name' => 'Áo Thun Cotton Oversize Basic Black',
                'price' => 250000,
                'sale_price' => 189000,
                'stock' => 50,
                'image' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?w=600&auto=format&fit=crop',
                'is_featured' => true
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Áo Thun Polo Nam Thể Thao Co Giãn',
                'price' => 290000,
                'sale_price' => 229000,
                'stock' => 35,
                'image' => 'https://images.unsplash.com/photo-1625910513413-562624f115fa?w=600&auto=format&fit=crop',
                'is_featured' => true
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Áo Thun Unisex In Họa Tiết Streetwear',
                'price' => 220000,
                'sale_price' => null,
                'stock' => 40,
                'image' => 'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Áo Thun Nữ Cotton Organic Form Rộng',
                'price' => 180000,
                'sale_price' => 149000,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Áo Thun Tay Dài Thu Đông Unisex',
                'price' => 310000,
                'sale_price' => 269000,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1618354691373-d851c5c3a990?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Áo Thun Ba Lỗ Nam Tập Gym Thể Thao',
                'price' => 150000,
                'sale_price' => 120000,
                'stock' => 45,
                'image' => 'https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Áo Crop Top Nữ Ôm Body Quyến Rũ',
                'price' => 195000,
                'sale_price' => 159000,
                'stock' => 28,
                'image' => 'https://images.unsplash.com/photo-1503341455253-bfe234f19374?w=600&auto=format&fit=crop',
                'is_featured' => true
            ],

            // --- ÁO SƠ MI (Category 1) ---
            [
                'category_id' => $categories[1]->id,
                'name' => 'Áo Sơ Mi Trắng Kháng Khuẩn Công Sở',
                'price' => 380000,
                'sale_price' => 319000,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1620012253295-c15cc3e65df4?w=600&auto=format&fit=crop',
                'is_featured' => true
            ],
            [
                'category_id' => $categories[1]->id,
                'name' => 'Áo Sơ Mi Linen Dài Tay Phong Cách Hàn Quốc',
                'price' => 420000,
                'sale_price' => 349000,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=600&auto=format&fit=crop',
                'is_featured' => true
            ],
            [
                'category_id' => $categories[1]->id,
                'name' => 'Áo Sơ Mi Caro Flannel Oversize Nam Nữ',
                'price' => 310000,
                'sale_price' => null,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[1]->id,
                'name' => 'Áo Sơ Mi Nữ Lụa Satin Sang Trọng',
                'price' => 450000,
                'sale_price' => 389000,
                'stock' => 18,
                'image' => 'https://images.unsplash.com/photo-1598554747436-c9293d6a588f?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[1]->id,
                'name' => 'Áo Sơ Mi Oxford Kẻ Sọc Xanh Thanh Lịch',
                'price' => 390000,
                'sale_price' => 329000,
                'stock' => 22,
                'image' => 'https://images.unsplash.com/photo-1598033129183-c4f50c736f10?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[1]->id,
                'name' => 'Áo Sơ Mi Cổ Tàu Khóa Nút Gỗ Vintage',
                'price' => 360000,
                'sale_price' => 299000,
                'stock' => 19,
                'image' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[1]->id,
                'name' => 'Áo Sơ Mi Nữ Tay Phồng Nữ Tính',
                'price' => 410000,
                'sale_price' => 349000,
                'stock' => 14,
                'image' => 'https://images.unsplash.com/photo-1564257631407-4deb1f99d992?w=600&auto=format&fit=crop',
                'is_featured' => true
            ],

            // --- QUẦN JEANS (Category 2) ---
            [
                'category_id' => $categories[2]->id,
                'name' => 'Quần Jeans Nam Slimfit Co Giãn Xanh Đậm',
                'price' => 550000,
                'sale_price' => 449000,
                'stock' => 40,
                'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=600&auto=format&fit=crop',
                'is_featured' => true
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Quần Jeans Nữ Cạp Cao Ống Rộng Vintage',
                'price' => 480000,
                'sale_price' => 389000,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1582552938357-32b906df40cb?w=600&auto=format&fit=crop',
                'is_featured' => true
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Quần Jeans Black Denim Rách Gối Cá Tính',
                'price' => 520000,
                'sale_price' => 429000,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1542272604-780c36856d67?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Quần Jeans Baggy Unisex Dáng Rộng',
                'price' => 460000,
                'sale_price' => 380000,
                'stock' => 22,
                'image' => 'https://images.unsplash.com/photo-1560243563-062bfc001d68?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Quần Jeans Nam Dáng Straight Leg Cổ Điển',
                'price' => 590000,
                'sale_price' => 499000,
                'stock' => 16,
                'image' => 'https://images.unsplash.com/photo-1604176354204-9268737828e4?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'Quần Kaki Chino Nam Suông Công Sở',
                'price' => 430000,
                'sale_price' => 369000,
                'stock' => 32,
                'image' => 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],

            // --- QUẦN SHORT (Category 3) ---
            [
                'category_id' => $categories[3]->id,
                'name' => 'Quần Short Kaki Nam Khóa Kéo Cao Cấp',
                'price' => 280000,
                'sale_price' => 219000,
                'stock' => 45,
                'image' => 'https://images.unsplash.com/photo-1591195853828-11db59a44f6b?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Quần Short Thể Thao Gym Nam Nữ',
                'price' => 190000,
                'sale_price' => 149000,
                'stock' => 60,
                'image' => 'https://images.unsplash.com/photo-1562157873-818bc0726f68?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Quần Short Nữ Nỉ Mềm Thể Thao',
                'price' => 210000,
                'sale_price' => 169000,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[3]->id,
                'name' => 'Quần Short Jeans Nữ Cạp Cao Xắn Gấu',
                'price' => 320000,
                'sale_price' => 269000,
                'stock' => 28,
                'image' => 'https://images.unsplash.com/photo-1548883354-7622d03aca27?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],

            // --- VÁY & ĐẦM NỮ (Category 4) ---
            [
                'category_id' => $categories[4]->id,
                'name' => 'Váy Đầm Dáng Xoè Hoa Nhí Mùa Hè',
                'price' => 490000,
                'sale_price' => 389000,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=600&auto=format&fit=crop',
                'is_featured' => true
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Đầm Ôm Body Nữ Dự Tiệc Quyến Rũ',
                'price' => 650000,
                'sale_price' => 549000,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1566174053879-31528523f8ae?w=600&auto=format&fit=crop',
                'is_featured' => true
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Váy Suông Trắng Xếp Li Tiểu Thư',
                'price' => 520000,
                'sale_price' => 439000,
                'stock' => 18,
                'image' => 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Đầm Yếm Jeans Nữ Cá Tính Trẻ Trung',
                'price' => 430000,
                'sale_price' => 359000,
                'stock' => 22,
                'image' => 'https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Chân Váy Nữ Tennis Xếp Li Hàn Quốc',
                'price' => 270000,
                'sale_price' => 219000,
                'stock' => 35,
                'image' => 'https://images.unsplash.com/photo-1583496661160-fb5886a0aaaa?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[4]->id,
                'name' => 'Đầm Maxi Dài Đi Biển Cổ V Nữ',
                'price' => 580000,
                'sale_price' => 479000,
                'stock' => 14,
                'image' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=600&auto=format&fit=crop',
                'is_featured' => true
            ],

            // --- ÁO KHOÁC & BLAZER (Category 5) ---
            [
                'category_id' => $categories[5]->id,
                'name' => 'Áo Khoác Bomber Dù 2 Lớp Chống Nước',
                'price' => 590000,
                'sale_price' => 489000,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=600&auto=format&fit=crop',
                'is_featured' => true
            ],
            [
                'category_id' => $categories[5]->id,
                'name' => 'Áo Blazer Nam Form Rộng Hàn Quốc',
                'price' => 790000,
                'sale_price' => 679000,
                'stock' => 12,
                'image' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=600&auto=format&fit=crop',
                'is_featured' => true
            ],
            [
                'category_id' => $categories[5]->id,
                'name' => 'Áo Khoác Denim Unisex Rách Bụi Bặm',
                'price' => 620000,
                'sale_price' => 529000,
                'stock' => 16,
                'image' => 'https://images.unsplash.com/photo-1578932750294-f5075e85f44a?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[5]->id,
                'name' => 'Áo Cardigan Len Mỏng Nữ Thu Đông',
                'price' => 350000,
                'sale_price' => 289000,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1434389677669-e08b4cac3105?w=600&auto=format&fit=crop',
                'is_featured' => false
            ],
            [
                'category_id' => $categories[5]->id,
                'name' => 'Áo Khoác Da Biker Nam Cá Tính',
                'price' => 950000,
                'sale_price' => 849000,
                'stock' => 10,
                'image' => 'https://images.unsplash.com/photo-1520975954732-35dd22299614?w=600&auto=format&fit=crop',
                'is_featured' => true
            ],
        ];

        $products = [];
        foreach ($productsData as $p) {
            $p['slug'] = Str::slug($p['name']);
            $p['description'] = "Sản phẩm {$p['name']} được chế tác tỉ mỉ với chất liệu êm ái, thoáng khí. Kiểu dáng chuẩn thời trang giúp tôn vóc dáng và dễ phối đồ cho mọi dịp đi chơi, đi làm hay đi học.";
            $products[] = Product::create($p);
        }

        // 4. ORDERS (20 Orders)
        $statuses = ['pending', 'paid', 'shipped', 'cancelled'];

        for ($i = 1; $i <= 20; $i++) {
            $user = $users[($i - 1) % count($users)];
            $status = $statuses[$i % count($statuses)];
            $orderNumber = 'ORD-' . date('Ymd') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT);

            $orderProducts = collect($products)->random(rand(1, 3));
            $totalAmount = 0;

            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => $orderNumber,
                'total_amount' => 0,
                'status' => $status,
                'shipping_name' => $user->name,
                'shipping_phone' => $user->phone,
                'shipping_address' => $user->address,
                'note' => "Giao hàng cho khách {$i}",
            ]);

            foreach ($orderProducts as $prod) {
                $qty = rand(1, 2);
                $itemPrice = $prod->effective_price;
                $lineTotal = $itemPrice * $qty;
                $totalAmount += $lineTotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $prod->id,
                    'product_name' => $prod->name,
                    'price' => $itemPrice,
                    'quantity' => $qty,
                ]);
            }

            $order->update(['total_amount' => $totalAmount]);
        }
    }
}
