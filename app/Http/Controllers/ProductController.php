<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductController extends Controller
{

    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository) 
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @OA\Get(
     *      path="/api/products",
     *      summary="List all products",
     *      tags={"Products"},
     *      description="This API helps you to view all the products.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      )
     * )
     */
    
    public function index()
    {
        $records = $this->productRepository->getAll();
        return response()->json($records);
    }
    
    /**
     * @OA\Get(
     *      path="/api/products/{id}",
     *      summary="Retrieve a product",
     *      tags={"Products"},
     *      description="This API lets you retrieve and view a specific product by id.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Unique identifier for the resource",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         style="form"
     *     )
     * )
     */

    public function show(Int $id)
    {
        $record = $this->productRepository->getById($id);
        return response()->json($record);
    }

    /**
     * @OA\Post(
     *      path="/api/products",
     *      summary="Create a product",
     *      tags={"Products"},
     *      description="This API helps you to create a new product.",
     *      security={{ "bearerAuth": { }}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="shopping_list_id", type="integer"),
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="qty", type="integer")
     *            )
     *           )
     *       ),
     * )
     */

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        return response()->json($this->productRepository->store($data));
    }

    /**
     * @OA\Put(
     *      path="/api/products/{id}",
     *      summary="Update a product",
     *      tags={"Products"},
     *      description="This API helps you to update a product.",
     *      security={{ "bearerAuth": { }}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Unique identifier for the resource",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         style="form"
     *      ),
     *       @OA\RequestBody(
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="shopping_list_id", type="integer"),
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="qty", type="integer")
     *            )
     *           )
     *       ),
     * )
     */

    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        return response()->json($this->productRepository->update($id, $data));
    }

    /**
     * @OA\Delete(
     *      path="/api/products/{id}",
     *      summary="Delete a product",
     *      tags={"Products"},
     *      description="This API helps you delete a product",
     *      security={{ "bearerAuth": { }}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Unique identifier for the resource",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         style="form"
     *     ),
     * )
     */

    public function destroy($id)
    {
        return response()->json($this->productRepository->destroy($id));
    }
}