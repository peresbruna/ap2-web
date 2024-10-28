<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    public function criar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'preço' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $product = Produto::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Produto criado com sucesso',
            'data' => $product
        ], 201);
    }

    public function listar()
    {
        $product = Produto::all();
        return response()->json([
            'status' => true,
            'message' => 'Lista de produtos',
            'data' => $product
        ], 200);
    }

    public function listarPeloId($id)
    {
        $product = Produto::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Lista de produtos por ID',
            'data' => $product
        ], 200);
    }

    public function editar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'preço' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $product = Produto::findOrFail($id);
        $product->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Produto atualizado com sucesso',
            'data' => $product
        ], 200);
    }

    public function remover($id)
    {
        $product = Produto::findOrFail($id);
        $product->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Produto removido com sucesso'
        ], 204);
    }

}
