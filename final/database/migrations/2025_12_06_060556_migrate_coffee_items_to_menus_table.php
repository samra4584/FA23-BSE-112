<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migrate coffee items from products to menus
        $coffeeItems = DB::table('products')->where('type', 'coffee')->get();
        
        foreach ($coffeeItems as $item) {
            DB::table('menus')->insert([
                'name' => $item->name,
                'price' => $item->price,
                'description' => $item->description,
                'image' => $item->image,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ]);
        }
        
        // Delete coffee items from products table
        DB::table('products')->where('type', 'coffee')->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Move menu items back to products as coffee type
        $menuItems = DB::table('menus')->get();
        
        foreach ($menuItems as $item) {
            DB::table('products')->insert([
                'name' => $item->name,
                'price' => $item->price,
                'description' => $item->description,
                'image' => $item->image,
                'type' => 'coffee',
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ]);
        }
    }
};
