<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banners = [
            [
                'title' => 'Fresh Groceries at Your Doorstep',
                'image' => 'https://images.unsplash.com/photo-1542838132-92c53300491e',
                'link' => '/categories/fruits-vegetables',
                'position' => 'home_top',
                'starts_at' => now(),
                'ends_at' => now()->addMonths(3),
                'status' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Weekly Special Offers',
                'image' => 'https://images.unsplash.com/photo-1607349913338-fca47890d392',
                'link' => '/special-offers',
                'position' => 'home_middle',
                'starts_at' => now(),
                'ends_at' => now()->addMonths(3),
                'status' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Join Our Premium Membership',
                'image' => 'https://images.unsplash.com/photo-1534723452862-4c874018d66d',
                'link' => '/membership',
                'position' => 'home_bottom',
                'starts_at' => now(),
                'ends_at' => now()->addMonths(3),
                'status' => true,
                'is_active' => true,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
