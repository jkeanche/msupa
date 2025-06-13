<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supermarket;

class SupermarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Only run if supermarkets table exists
        if (!\Schema::hasTable('supermarkets')) {
            echo "Supermarkets table does not exist. Skipping SupermarketSeeder.\n";
            return;
        }
        
        $supermarkets = [
            [
                'name' => 'Naivas Supermarket',
                'slug' => 'naivas-supermarket',
                'description' => 'Naivas is a leading Kenyan supermarket chain offering a wide range of products.',
                'logo' => 'https://i.imgur.com/rLxq1Qd.png',
                'banner' => 'https://i.imgur.com/DYjqxBq.jpg',
                'address' => 'Nairobi CBD, Moi Avenue',
                'city' => 'Nairobi',
                'state' => 'Nairobi County',
                'postal_code' => '00100',
                'country' => 'Kenya',
                'email' => 'info@naivas.com',
                'phone' => '+254 700 123 456',
                'is_active' => true,
            ],
            [
                'name' => 'Carrefour Kenya',
                'slug' => 'carrefour-kenya',
                'description' => 'Carrefour is a multinational retailer operating in Kenya, offering quality products at competitive prices.',
                'logo' => 'https://i.imgur.com/L5mKRqn.png',
                'banner' => 'https://i.imgur.com/PZtyZVK.jpg',
                'address' => 'The Hub, Karen',
                'city' => 'Nairobi',
                'state' => 'Nairobi County',
                'postal_code' => '00200',
                'country' => 'Kenya',
                'email' => 'info@carrefour.co.ke',
                'phone' => '+254 700 789 012',
                'is_active' => true,
            ],
            [
                'name' => 'QuickMart',
                'slug' => 'quickmart',
                'description' => 'QuickMart is a growing Kenyan supermarket chain focused on fresh groceries and household items.',
                'logo' => 'https://i.imgur.com/H1Rzdxn.png',
                'banner' => 'https://i.imgur.com/mDQHwAU.jpg',
                'address' => 'Westlands, Nairobi',
                'city' => 'Nairobi',
                'state' => 'Nairobi County',
                'postal_code' => '00800',
                'country' => 'Kenya',
                'email' => 'info@quickmart.co.ke',
                'phone' => '+254 700 345 678',
                'is_active' => true,
            ],
        ];

        foreach ($supermarkets as $data) {
            Supermarket::create($data);
        }
    }
}
