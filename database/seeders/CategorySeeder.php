<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Store;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all stores to assign categories to
        $stores = Store::all();
        
        // If no stores exist, create a default one
        if ($stores->isEmpty()) {
            echo "No stores found. Skipping category creation.\n";
            return;
        }
        
        echo "Creating categories for " . $stores->count() . " stores...\n";
        
        $categories = [
            ['name' => 'Fruits & Vegetables', 'slug' => 'fruits-vegetables', 'icon' => 'fa-apple-alt', 'description' => 'Fresh fruits and vegetables'],
            ['name' => 'Meat & Poultry', 'slug' => 'meat-poultry', 'icon' => 'fa-drumstick-bite', 'description' => 'Fresh meat and poultry products'],
            ['name' => 'Dairy & Eggs', 'slug' => 'dairy-eggs', 'icon' => 'fa-cheese', 'description' => 'Milk, cheese, yogurt, and eggs'],
            ['name' => 'Bakery', 'slug' => 'bakery', 'icon' => 'fa-bread-slice', 'description' => 'Bread, cakes, and pastries'],
            ['name' => 'Beverages', 'slug' => 'beverages', 'icon' => 'fa-glass-whiskey', 'description' => 'Water, juice, soda, and other drinks'],
            ['name' => 'Snacks', 'slug' => 'snacks', 'icon' => 'fa-cookie', 'description' => 'Chips, cookies, and other snacks'],
            ['name' => 'Canned Goods', 'slug' => 'canned-goods', 'icon' => 'fa-can-food', 'description' => 'Canned vegetables, fruits, and soups'],
            ['name' => 'Frozen Foods', 'slug' => 'frozen-foods', 'icon' => 'fa-snowflake', 'description' => 'Frozen meals, vegetables, and ice cream'],
            ['name' => 'Breakfast', 'slug' => 'breakfast', 'icon' => 'fa-coffee', 'description' => 'Cereal, oatmeal, and breakfast items'],
            ['name' => 'Condiments & Sauces', 'slug' => 'condiments-sauces', 'icon' => 'fa-pepper-hot', 'description' => 'Ketchup, mustard, mayonnaise, and sauces'],
            ['name' => 'Pasta & Rice', 'slug' => 'pasta-rice', 'icon' => 'fa-wheat', 'description' => 'Pasta, rice, and other grains'],
            ['name' => 'Baking', 'slug' => 'baking', 'icon' => 'fa-cubes', 'description' => 'Flour, sugar, and baking ingredients'],
            ['name' => 'Personal Care', 'slug' => 'personal-care', 'icon' => 'fa-pump-soap', 'description' => 'Soap, shampoo, and personal care items'],
            ['name' => 'Household', 'slug' => 'household', 'icon' => 'fa-home', 'description' => 'Cleaning supplies and household essentials'],
            ['name' => 'Baby Products', 'slug' => 'baby-products', 'icon' => 'fa-baby', 'description' => 'Diapers, baby food, and other baby items'],
            ['name' => 'Pet Supplies', 'slug' => 'pet-supplies', 'icon' => 'fa-paw', 'description' => 'Pet food and accessories'],
        ];

        // Create categories for each store
        foreach ($stores as $store) {
            echo "Creating categories for {$store->name}...\n";
            
            foreach ($categories as $index => $category) {
                // Create unique slug per store
                $uniqueSlug = $category['slug'] . '-' . $store->id;
                
                Category::create([
                    'name' => $category['name'],
                    'slug' => $uniqueSlug,
                    'icon' => $category['icon'],
                    'description' => $category['description'],
                    'store_id' => $store->id,
                    'is_active' => true,
                    'display_order' => $index,
                ]);
            }
        }
    }
}
