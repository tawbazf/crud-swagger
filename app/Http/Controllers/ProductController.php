<?php
 namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
public function index()
{
return Product::all();
}
/**
* Store a newly created resource in storage.
*/
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
    ]);

    $product = Product::create($validated);

    return response()->json($product, 201);
}
/**
* Display the specified resource.
*/
public function show(string $id)
{
//
}

/**
* Update the specified resource in storage.
*/
public function update(Request $request, string $id)
{
//
}

/**
* Remove the specified resource from storage.
*/
public function destroy(string $id)
{
//
}
}