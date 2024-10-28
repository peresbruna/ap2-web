<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendedorController extends Controller
{
    public function criar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'cpf' => 'required|string|max:15',
            'ano' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $seller = Vendedor::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Vendedor criado com sucesso',
            'data' => $seller
        ], 201);
    }

    public function listar()
    {
        $seller = Vendedor::all();
        return response()->json([
            'status' => true,
            'message' => 'Lista de Vendedores',
            'data' => $seller
        ], 200);
    }

    public function listarPeloId($id)
    {
        $seller = Vendedor::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Lista de vendedores por ID',
            'data' => $seller
        ], 200);
    }

    public function editar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'cpf' => 'required|string|max:15',
            'ano' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $seller = Vendedor::findOrFail($id);
        $seller->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Vendedor atualizado com sucesso',
            'data' => $seller
        ], 200);
    }

    public function remover($id)
    {
        $seller = Vendedor::findOrFail($id);
        $seller->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Vendedor removido com sucesso'
        ], 204);
    }
}
