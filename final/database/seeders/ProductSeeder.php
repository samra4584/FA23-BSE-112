<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing products and menus
        Product::truncate();
        Menu::truncate();

        // Ensure storage directory exists
        if (!Storage::disk('public')->exists('products')) {
            Storage::disk('public')->makeDirectory('products');
        }

        // Copy images from public/images to storage/app/public/products
        $publicImagesPath = public_path('images');
        $storagePath = storage_path('app/public/products');

        // Menu Items (Coffee)
        $menuItems = [
            [
                'name' => 'Espresso',
                'price' => 3.50,
                'description' => 'Rich and bold, our espresso gives you the true coffee kick you need.',
                'image' => 'espresso.jpeg',
            ],
            [
                'name' => 'Cappuccino',
                'price' => 4.00,
                'description' => 'Smooth, creamy, and topped with milk foam.',
                'image' => 'cappuccino.jpeg',
            ],
            [
                'name' => 'Latte',
                'price' => 4.50,
                'description' => 'Perfect mix of espresso and milk for a soothing drink.',
                'image' => 'latte.jpg',
            ],
            [
                'name' => 'Mocha',
                'price' => 4.75,
                'description' => 'A delightful blend of chocolate and espresso for a rich, sweet treat.',
                'image' => 'mocha.jpeg',
            ],
            [
                'name' => 'Americano',
                'price' => 3.80,
                'description' => 'Smooth espresso diluted with hot water for a light yet flavorful coffee experience.',
                'image' => 'americano.jpeg',
            ],
            [
                'name' => 'Flat White',
                'price' => 4.20,
                'description' => 'Creamy microfoam poured over rich espresso for a smooth and velvety taste.',
                'image' => 'flatwhite.jpeg',
            ],
        ];

        // Products
        $products = [
            [
                'name' => 'Premium Coffee Beans',
                'price' => 15.00,
                'description' => 'Freshly roasted beans sourced from the finest farms worldwide.',
                'image' => 'coffeebeans.jpg',
            ],
            [
                'name' => 'Chocolate Powder',
                'price' => 8.00,
                'description' => 'Premium cocoa blend for a smooth, rich, and indulgent chocolate taste.',
                'image' => 'powder.jpeg',
            ],
            [
                'name' => 'Coffee Caramel Syrup',
                'price' => 8.00,
                'description' => 'Rich caramel flavor crafted to perfectly sweeten and elevate your coffee experience.',
                'image' => 'caramel.jpeg',
            ],
            [
                'name' => 'Cookies',
                'price' => 5.00,
                'description' => 'Freshly baked cookies with a perfect crunch — the ideal companion to your coffee.',
                'image' => 'cookies.jpeg',
            ],
            [
                'name' => 'Vanilla Coffee Syrup',
                'price' => 6.50,
                'description' => 'Add a sweet vanilla twist to your favorite drink.',
                'image' => 'syrup.jpeg',
            ],
            [
                'name' => 'Coffee Blender',
                'price' => 45.00,
                'description' => 'High-performance coffee blender for perfectly mixed and creamy beverages every time.',
                'image' => 'blender.jpeg',
            ],
        ];

        // Create menu items
        foreach ($menuItems as $item) {
            $imagePath = $this->copyImage($item['image'], $publicImagesPath, $storagePath);
            Menu::create([
                'name' => $item['name'],
                'price' => $item['price'],
                'description' => $item['description'],
                'image' => 'products/' . $item['image'],
            ]);
        }

        // Create products
        foreach ($products as $product) {
            $imagePath = $this->copyImage($product['image'], $publicImagesPath, $storagePath);
            Product::create([
                'name' => $product['name'],
                'price' => $product['price'],
                'description' => $product['description'],
                'image' => 'products/' . $product['image'],
            ]);
        }
    }

    /**
     * Copy image from public to storage
     */
    private function copyImage($imageName, $sourcePath, $destinationPath)
    {
        $sourceFile = $sourcePath . '/' . $imageName;
        $destinationFile = $destinationPath . '/' . $imageName;

        if (File::exists($sourceFile)) {
            File::copy($sourceFile, $destinationFile);
        }

        return $destinationFile;
    }
}
