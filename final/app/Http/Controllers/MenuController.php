<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Get menu items from database
        $coffeeItems = Menu::latest()->get();
        
        return view('menu', compact('coffeeItems'));
    }
}