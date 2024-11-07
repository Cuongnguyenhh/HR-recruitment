<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Get(
 *     path="/api/users",
 *     tags={"Users"},
 *     summary="Get list of users",
 *     description="Returns list of users",
 *     @OA\Response(
 *         response=200,
 *         description="successful operation"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated"
 *     ),
 * )
 */
class BaseController extends Controller
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->middleware('auth:sanctum')->except('login','register');
    }

    public function index()
    {
        return response()->json($this->model->all());
    }

    public function show($id)
    {
        $items = $this->model->find($id);
        if (!$items) {
            return response()->json(['message' => 'Item not found'], 404);
        }
        return response()->json(
            [
            'status' => true,
            'data'=>$items
        ], 200);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate($this->validationRule());
        $item = $this->model->create($validateData);
        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate($this->validationRule());
        $item = $this->model->find($id);
        if ($item) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Not Found '
                ],
                500
            );
        }
        $item->update($validateData);
        return response()->json(
            [
                'success' => true,
                'item' => $item
            ],
            200
        );
    }
    public function destroy($id)
    {
        $item = $this->model->find($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }
        $item->update(
            [
            'is_active' => false,
            'is_deleted' => true,
            'deleted_time' => time(),  
        ]);
        return response()->json(['message' => 'Item deleted'], 204);
    }
    protected function validationRule()
    {
        return []; // Return your validation rules here. Example: ['name' =>'required','email' => 'unique:users']
    }
}
