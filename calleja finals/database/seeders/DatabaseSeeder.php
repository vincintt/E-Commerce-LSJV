<?php

namespace Database\Seeders;

use App\Models\CartItem;
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
        OrderItem::query()->delete();
        Order::query()->delete();
        CartItem::query()->delete();
        Product::query()->delete();
        User::query()->whereIn('email', ['seller@callejacoir.test', 'buyer@callejacoir.test'])->delete();

        User::create([
            'name' => 'Calleja Coir Seller',
            'email' => 'seller@callejacoir.test',
            'password' => 'password',
            'address' => 'Davao City, Philippines',
            'mobile_number' => '09181234567',
            'role' => 'seller',
        ]);

        User::create([
            'name' => 'Sample Buyer',
            'email' => 'buyer@callejacoir.test',
            'password' => 'password',
            'address' => 'Quezon City, Metro Manila, Philippines',
            'mobile_number' => '09987654321',
            'role' => 'buyer',
        ]);

        $items = [
            [
                'name' => 'Loose Coir Fiber (Golden)',
                'description' => 'Premium coconut coir fiber for erosion control, potting mixes, and handicrafts. Sustainably sourced.',
                'price' => 189.50,
                'stock' => 120,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/a/a2/Coir_fibery.jpg',
                'featured_new' => true,
                'featured_trending' => true,
                'featured_bestseller' => false,
            ],
            [
                'name' => 'Bulk Coir Fiber (Transport Grade)',
                'description' => 'High-volume coir fiber bundles ideal for growers and manufacturers.',
                'price' => 145.00,
                'stock' => 200,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/7/7b/Coir_fibers_transported.jpg',
                'featured_new' => false,
                'featured_trending' => true,
                'featured_bestseller' => true,
            ],
            [
                'name' => 'Handwoven Coir Door Mat',
                'description' => 'Durable natural coir mat for entryways; traps dirt and is biodegradable at end of life.',
                'price' => 459.99,
                'stock' => 45,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/9/9f/Coir_fiber_mats_2023.jpg',
                'featured_new' => true,
                'featured_trending' => false,
                'featured_bestseller' => true,
            ],
            [
                'name' => 'Coir Rope (Twisted, 10m)',
                'description' => 'Strong natural rope for gardening trellises, crafts, and light marine use.',
                'price' => 249.00,
                'stock' => 80,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/9/9e/Traditional_worker_with_coconut_rope_%28edited%29.jpg',
                'featured_new' => false,
                'featured_trending' => true,
                'featured_bestseller' => true,
            ],
            [
                'name' => 'Coir Processing Fiber (Kerala Grade)',
                'description' => 'Cleaned coir fiber ready for spinning or substrate blending.',
                'price' => 175.25,
                'stock' => 90,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/0/03/Coir_fiber_for_processing_in_Cherthala%2C_Kerala.jpg',
                'featured_new' => true,
                'featured_trending' => true,
                'featured_bestseller' => false,
            ],
            [
                'name' => 'Community Coir Craft Kit Bundle',
                'description' => 'Mixed coir materials supporting local coir livelihood programs—great for schools and workshops.',
                'price' => 520.00,
                'stock' => 30,
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/b/b1/Tamilnadu_coconut_coir_business_culture.jpg',
                'featured_new' => false,
                'featured_trending' => false,
                'featured_bestseller' => true,
            ],
        ];

        foreach ($items as $row) {
            Product::create([
                ...$row,
                'slug' => Str::slug($row['name']).'-'.Str::lower(Str::random(5)),
            ]);
        }
    }
}
