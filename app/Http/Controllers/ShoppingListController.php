<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShoppingListRequest;
use App\Repositories\Contracts\ShoppingListRepositoryInterface;

class ShoppingListController extends Controller
{

    private ShoppingListRepositoryInterface $shoppingListRepository;

    public function __construct(ShoppingListRepositoryInterface $shoppingListRepository) 
    {
        $this->shoppingListRepository = $shoppingListRepository;
    }

    
    /**
     * @OA\Get(
     *      path="/api/shopping-lists",
     *      summary="List all shopping lists",
     *      tags={"Shopping Lists"},
     *      description="This API lets you retrieve all shopping lists",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     * )
     */
    
    public function index()
    {
        $records = $this->shoppingListRepository->getAll();
        return response()->json($records);
    }

    /**
     * @OA\Get(
     *      path="/api/shopping-lists/{id}",
     *      summary="Retrieve a shopping list",
     *      tags={"Shopping Lists"},
     *      description="This API lets you retrieve a shopping list by id",
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

    public function show(Int $id)
    {
        $record = $this->shoppingListRepository->getById($id);
        return response()->json($record);
    }

    /**
     * @OA\Post(
     *      path="/api/shopping-lists",
     *      summary="Create a shopping list",
     *      tags={"Shopping Lists"},
     *      description="This API helps you to create a new shopping list",
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
     *               @OA\Property(property="name", type="string")
     *            )
     *           )
     *       ),
     * )
    */

    public function store(ShoppingListRequest $request)
    {
        $data = $request->all();
        return response()->json($this->shoppingListRepository->store($data));
    }

    /**
     * @OA\Put(
     *      path="/api/shopping-lists/{id}",
     *      summary="Update a shopping list",
     *      tags={"Shopping Lists"},
     *      description="This API lets you make changes to a shopping list",
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
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="name", type="string")
     *            )
     *           )
     *      ),
     * )
     */

    public function update(ShoppingListRequest $request, $id)
    {
        $data = $request->all();
        return response()->json($this->shoppingListRepository->update($id, $data));
    }

    /**
     * @OA\Post(
     *      path="/api/shopping-lists/{id}/clone",
     *      summary="Clone  a shopping list",
     *      tags={"Shopping Lists"},
     *      description="This API lets you to clone a shopping list",
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
     *     )
     * )
     */

    public function clone(Int $id)
    {
        return response()->json($this->shoppingListRepository->clone($id));
    }

    /**
     * @OA\Delete(
     *      path="/api/shopping-lists/{id}",
     *      summary="Delete a shopping list",
     *      tags={"Shopping Lists"},
     *      description="This API helps you delete a shopping list",
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
     *     @OA\PathItem (
     *     ),
     * )
     */

    public function destroy($id)
    {
        return response()->json(['deleted' => $this->shoppingListRepository->destroy($id)]);
    }
}
