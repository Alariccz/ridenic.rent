<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand; // Jangan lupa import model Brand
use App\Models\Item; // Import model Item

class CatalogController extends Controller
{
    public function index()
    {
        // Ambil semua data brand dari database
        $brands = Brand::all();

        // Ambil semua data items (mobil) yang sudah terhubung dengan brand dan type
        $items = Item::with(['brand', 'type'])->get();

        return view('catalog', compact('brands', 'items'));
    }
}
