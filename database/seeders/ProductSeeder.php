<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = Store::all();
        $categories = Category::all();
        
        // Define some products by category
        $productsByCategory = [
            'Fruits & Vegetables' => [
                ['name' => 'Fresh Bananas', 'price' => 120, 'original_price' => 140, 'description' => 'Locally grown fresh bananas, sold per kg'],
                ['name' => 'Red Apples', 'price' => 250, 'original_price' => 280, 'description' => 'Imported red apples, pack of 6'],
                ['name' => 'Spinach', 'price' => 50, 'original_price' => 60, 'description' => 'Fresh spinach leaves, 500g bundle'],
                ['name' => 'Tomatoes', 'price' => 100, 'original_price' => 120, 'description' => 'Ripe tomatoes, 1kg'],
                ['name' => 'Avocados', 'price' => 120, 'original_price' => 150, 'description' => 'Ripe avocados, pack of 3'],
            ],
            'Meat & Poultry' => [
                ['name' => 'Chicken Breast', 'price' => 450, 'original_price' => 500, 'description' => 'Boneless chicken breast, 1kg pack'],
                ['name' => 'Beef Mince', 'price' => 550, 'original_price' => 600, 'description' => 'Lean beef mince, 500g pack'],
                ['name' => 'Lamb Chops', 'price' => 800, 'original_price' => 850, 'description' => 'Fresh lamb chops, 600g pack'],
                ['name' => 'Pork Ribs', 'price' => 650, 'original_price' => 700, 'description' => 'Marinated pork ribs, 800g'],
            ],
            'Dairy & Eggs' => [
                ['name' => 'Milk 1L', 'price' => 120, 'original_price' => 130, 'description' => 'Fresh pasteurized milk, 1 liter'],
                ['name' => 'Free-range Eggs', 'price' => 360, 'original_price' => 400, 'description' => 'Free-range eggs, tray of 30'],
                ['name' => 'Cheddar Cheese', 'price' => 450, 'original_price' => 500, 'description' => 'Mature cheddar cheese, 400g'],
                ['name' => 'Greek Yogurt', 'price' => 180, 'original_price' => 200, 'description' => 'Plain Greek yogurt, 500g tub'],
            ],
            'Bakery' => [
                ['name' => 'White Bread', 'price' => 55, 'original_price' => 60, 'description' => 'Sliced white bread, 400g loaf'],
                ['name' => 'Chocolate Muffins', 'price' => 250, 'original_price' => 280, 'description' => 'Chocolate muffins, pack of 4'],
                ['name' => 'Croissants', 'price' => 300, 'original_price' => 350, 'description' => 'Butter croissants, pack of 6'],
            ],
            'Beverages' => [
                ['name' => 'Mineral Water 6-pack', 'price' => 360, 'original_price' => 400, 'description' => 'Natural mineral water, 6 x 1L bottles'],
                ['name' => 'Orange Juice', 'price' => 180, 'original_price' => 200, 'description' => 'Pure orange juice, 1L carton'],
                ['name' => 'Soda Variety Pack', 'price' => 450, 'original_price' => 500, 'description' => 'Assorted sodas, pack of 6 cans'],
                ['name' => 'Coffee Beans', 'price' => 800, 'original_price' => 900, 'description' => 'Arabica coffee beans, 500g'],
            ],
            'Snacks' => [
                ['name' => 'Potato Crisps', 'price' => 150, 'original_price' => 180, 'description' => 'Original flavor potato chips, 200g'],
                ['name' => 'Chocolate Cookies', 'price' => 190, 'original_price' => 220, 'description' => 'Chocolate chip cookies, 300g pack'],
                ['name' => 'Mixed Nuts', 'price' => 450, 'original_price' => 500, 'description' => 'Premium mixed nuts, 350g pack'],
            ],
            'Frozen Foods' => [
                ['name' => 'Frozen Mixed Vegetables', 'price' => 250, 'original_price' => 280, 'description' => 'Mixed vegetables, 1kg bag'],
                ['name' => 'Ice Cream', 'price' => 350, 'original_price' => 400, 'description' => 'Vanilla ice cream, 2L tub'],
                ['name' => 'Frozen Pizza', 'price' => 550, 'original_price' => 600, 'description' => 'Pepperoni pizza, 450g'],
            ],
            'Household' => [
                ['name' => 'Laundry Detergent', 'price' => 450, 'original_price' => 500, 'description' => 'Concentrated laundry detergent, 2L'],
                ['name' => 'Toilet Paper', 'price' => 380, 'original_price' => 420, 'description' => 'Toilet paper, 10 rolls pack'],
                ['name' => 'All-Purpose Cleaner', 'price' => 280, 'original_price' => 320, 'description' => 'Multi-surface cleaner, 1L bottle'],
            ],
            'Personal Care' => [
                ['name' => 'Shampoo', 'price' => 350, 'original_price' => 400, 'description' => 'Moisturizing shampoo, 500ml'],
                ['name' => 'Toothpaste', 'price' => 180, 'original_price' => 200, 'description' => 'Whitening toothpaste, 120g'],
                ['name' => 'Deodorant', 'price' => 250, 'original_price' => 280, 'description' => '48-hour protection deodorant, 150ml'],
            ],
        ];
        
        // Create products for each store with slight price variations
        foreach ($stores as $store) {
            $isFeatured = rand(0, 1) === 1;
            $isNew = true;
            
            foreach ($productsByCategory as $categoryName => $products) {
                // Find matching category by name
                // Using filter instead of where to handle slug variation in categories
                $category = $categories->filter(function($cat) use ($categoryName) {
                    return stripos($cat->name, $categoryName) !== false;
                })->first();
                
                if (!$category) {
                    echo "Category not found: {$categoryName}\n";
                    continue;
                }
                
                foreach ($products as $productData) {
                    // Add slight price variation for each store
                    $priceVariation = rand(-30, 50);
                    $regularPrice = $productData['price'] + $priceVariation;
                    $salePrice = $productData['original_price'] + $priceVariation;
                    
                    // Ensure sale price is always lower than regular price
                    if ($salePrice >= $regularPrice) {
                        $temp = $salePrice;
                        $salePrice = $regularPrice - rand(10, 50);
                        $regularPrice = $temp;
                    }
                    
                    // Select an appropriate image for the product category
                    $imageUrl = $this->getImageForCategory($categoryName);
                    
                    // Create the product using the exact field names from the model
                    Product::create([
                        'store_id' => $store->id,
                        'category_id' => $category->id,
                        'name' => $productData['name'],
                        'slug' => Str::slug($productData['name'] . '-' . $store->name),
                        'description' => $productData['description'],
                        'short_description' => Str::limit($productData['description'], 100),
                        'regular_price' => $regularPrice, 
                        'sale_price' => $salePrice,
                        'sku' => 'SKU-' . strtoupper(Str::random(8)),
                        'stock_quantity' => rand(10, 100),
                        'is_featured' => $isFeatured,
                        'status' => rand(0, 10) > 2 ? 'active' : 'draft',
                        'image_url' => $imageUrl,
                    ]);
                    
                    // Toggle featured status for variety
                    $isFeatured = !$isFeatured;
                }
            }
        }
    }
    
    /**
     * Get a relevant image URL for a product category
     * 
     * @param string $categoryName
     * @return string
     */
    private function getImageForCategory($categoryName)
    {
        $images = [
            'Fruits & Vegetables' => [
                'https://images.unsplash.com/photo-1610348725531-843dff563e2c',
                'https://images.unsplash.com/photo-1518843875459-f738682238a6',
                'https://images.unsplash.com/photo-1519996529931-28324d5a630e',
            ],
            'Meat & Poultry' => [
                'https://images.unsplash.com/photo-1607623814075-e51df1bdc82f',
                'https://images.unsplash.com/photo-1615937657715-bc7b4b7962c1',
            ],
            'Dairy & Eggs' => [
                'https://images.unsplash.com/photo-1559598467-f8b76c8155d0',
                'https://images.unsplash.com/photo-1489611427062-4ee75d4687fe',
            ],
            'Bakery' => [
                'https://images.unsplash.com/photo-1509440159596-0249088772ff',
                'https://images.unsplash.com/photo-1517433670267-08bbd4be890f',
            ],
            'Beverages' => [
                'https://images.unsplash.com/photo-1622483767028-3f66f32aef97',
                'https://images.unsplash.com/photo-1596803244897-c11875a4c559',
            ],
            'Snacks' => [
                'https://images.unsplash.com/photo-1621939514649-280e2ee25f60',
                'https://images.unsplash.com/photo-1566478989037-eec170784d0b',
            ],
            'Frozen Foods' => [
                'https://images.unsplash.com/photo-1603415526960-f7e0328c63b1',
                'https://images.unsplash.com/photo-1569552272775-7a807d39a5f1',
            ],
            'Household' => [
                'https://images.unsplash.com/photo-1626806787461-102c1a731d79',
                'https://images.unsplash.com/photo-1583947215259-38e31be8751f',
            ],
            'Personal Care' => [
                'https://images.unsplash.com/photo-1556228578-0d85b1a4d571',
                'https://images.unsplash.com/photo-1576426863848-c21f53c60b19',
            ],
        ];
        
        $categoryImages = $images[$categoryName] ?? [
            'https://images.unsplash.com/photo-1607082349566-187342175e2f', // Default grocery image
            'https://images.unsplash.com/photo-1542838132-92c53300491e',
        ];
        
        return $categoryImages[array_rand($categoryImages)];
    }
}
