<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = [
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
                'status' => 'active',
                'commission_rate' => 5.0,
                'social_links' => json_encode([
                    'facebook' => 'https://facebook.com/naivas',
                    'instagram' => 'https://instagram.com/naivas',
                    'twitter' => 'https://twitter.com/naivas'
                ]),
                'is_active' => true,
                'featured_until' => Carbon::now()->addMonths(3),
                'user_email' => 'manager@naivas.com'
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
                'status' => 'active',
                'commission_rate' => 4.5,
                'social_links' => json_encode([
                    'facebook' => 'https://facebook.com/carrefourkenya',
                    'instagram' => 'https://instagram.com/carrefourkenya',
                    'twitter' => 'https://twitter.com/carrefourkenya'
                ]),
                'is_active' => true,
                'featured_until' => Carbon::now()->addMonths(6),
                'user_email' => 'manager@carrefour.com'
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
                'status' => 'active',
                'commission_rate' => 5.5,
                'social_links' => json_encode([
                    'facebook' => 'https://facebook.com/quickmart',
                    'instagram' => 'https://instagram.com/quickmart',
                    'twitter' => 'https://twitter.com/quickmart'
                ]),
                'is_active' => true,
                'featured_until' => Carbon::now()->addMonths(3),
                'user_email' => 'manager@quickmart.com'
            ],
        ];

        foreach ($stores as $storeData) {
            $userEmail = $storeData['user_email'];
            unset($storeData['user_email']);
            
            $user = User::where('email', $userEmail)->first();
            
            if ($user) {
                // Assign both user_id and owner_id to the same user for now
                $store = Store::create(array_merge($storeData, [
                    'user_id' => $user->id,
                    'owner_id' => $user->id
                ]));
                
                // Update user with store_id
                $user->store_id = $store->id;
                $user->save();
            }
        }
    }
}
