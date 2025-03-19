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
     * @OA\Post(
     *     path="/api/products",
     *     summary="Créer un produit",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="price", type="number", format="float")
     *         )
     *     ),
     *     @OA\Response(response="201", description="Produit créé")
     * )
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
 * @OA\Get(
 *     path="/api/products/{id}",
 *     summary="Récupérer un produit",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID du produit",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Produit trouvé",
 *         @OA\JsonContent(ref="#/components/schemas/Product")
 *     ),
 *     @OA\Response(
 *         response="404",
 *         description="Produit non trouvé"
 *     )
 * )
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
 * @OA\Put(
 *     path="/api/products/{id}",
 *     summary="Mettre à jour un produit",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID du produit",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="description", type="string"),
 *             @OA\Property(property="price", type="number", format="float")
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Produit mis à jour",
 *         @OA\JsonContent(ref="#/components/schemas/Product")
 *     ),
 *     @OA\Response(
 *         response="404",
 *         description="Produit non trouvé"
 *     )
 * )
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
 * @OA\Delete(
 *     path="/api/products/{id}",
 *     summary="Supprimer un produit",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID du produit",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Produit supprimé"
 *     ),
 *     @OA\Response(
 *         response="404",
 *         description="Produit non trouvé"
 *     )
 * )
 */
public function destroy($id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $product->delete();

    return response()->json(['message' => 'Product deleted successfully']);
}
}