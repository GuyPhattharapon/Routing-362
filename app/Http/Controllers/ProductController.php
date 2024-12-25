<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    private $products = [
        ['id' => 1, 'name' => 'IdeaPad 5 Pro 16ARH7', 'description' => 'High-performance laptop', 'price' => 1500, 'image' => '/images/Laptop1.png'],
        ['id' => 2, 'name' => 'iPhone 13 pro', 'description' => 'Latest smartphone with great features', 'price' => 800, 'image' => '/images/iPhone13Pro.png'],
        ['id' => 3, 'name' => 'Tablet xiaomi pad 6', 'description' => 'Portable tablet for everyday use', 'price' => 500, 'image' => '/images/Tablet1.png'],
        ['id' => 4, 'name' => 'AirPods Max', 'description' => 'Noise-cancelling headphones', 'price' => 200, 'image' => '/images/Headphones.jpg'],
        ['id' => 5, 'name' => 'RTX 4060', 'description' => 'Supports up to 3072 CUDA cores', 'price' => 299, 'image' => '/images/RTX 4060.png'],
        ['id' => 6, 'name' => 'Gaming Mouse', 'description' => 'Ergonomic gaming mouse', 'price' => 69, 'image' => '/images/Gaming Mouse2.png'],
        ['id' => 7, 'name' => 'Keyboard', 'description' => 'Mechanical keyboard with RGB lights', 'price' => 120, 'image' => '/images/Keyboard.png'],
        ['id' => 8, 'name' => 'Monitor', 'description' => '4K Ultra HD monitor', 'price' => 400, 'image' => '/images/Monitor.jpeg'],
        ['id' => 9, 'name' => 'Printer', 'description' => 'Wireless all-in-one printer', 'price' => 250, 'image' => '/images/Printer.png'],
        ['id' => 10, 'name' => 'External Hard Drive', 'description' => '1TB portable hard drive', 'price' => 100, 'image' => '/images/External Hard Drive.jpg'],
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Products/Index', ['products' => $this->products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
        {
        $product = collect($this->products)->firstWhere('id', $id);
        if (!$product) {
        abort(404, 'Product not found');
        }
        return Inertia::render('Products/Show', ['product' => $product]);
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }
}
