<?php
 namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
     /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Liste des produits",
     *     @OA\Response(response="200", description="Liste des produits")
     * )
     */
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
public function show($id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    return response()->json($product);
}

/**
* Update the specified resource in storage.
*/
public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $product->update($validated);

        return response()->json($product);
    }


/**
* Remove the specified resource from storage.
*/public function destroy($id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $product->delete();

    return response()->json(['message' => 'Product deleted successfully']);
}
}