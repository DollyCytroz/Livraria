<?php

namespace App\Http\Controllers;

use App\Models\Livraria;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class LivrariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //buscando todas as criptomoedas
        $registros = Livraria::All();

        //contando o número de registros
        $contador = $registros->count();

        //verificando se há registros
        if ($contador > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Livraria encontradas com sucesso!',
                'data' => $registros,
                'total' => $contador
            ], 200); //Retorna http 200 (ok) com os dados e a contagem
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Nenhuma livraria encontrada.',
            ], 404); //Retorna http 404 (not found) se não houver registros
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'nome_livraria' => 'required',
        'endereco_livraria' => 'required',
        'horario_livraria'=> 'required'
      ]);

      if($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Registros inválidos',
            'errors' => $validator->errors()
        ], 400);
      }

      $registros = Livraria::create($request->all());

      if($registros) {
        return response()->json([
            'success' => true,
            'message' => 'Livraria cadastrada com sucesso!',
            'data' => $registros
        ], 201);
      } else {
        return response()->json([
            'success' => false,
            'message' => 'Error ao cadastrar a livraria'
        ], 500);
      }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $registros = Livraria::find($id);

        if($registros){
            return response()->json([
                'success' => true,
                'message' => 'Livraria localizada com sucesso!',
                'data' => $registros
            ], 200);   
        } else{
            return response()->json([
                'success' => false,
                'message' => 'Livraria não localizada.',
            ], 404);
        }
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nome_livraria' => 'required',
            'endereco_livraria' => 'required',
            'horario_livraria' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $registrosBanco = Livraria::find($id);

        if (!$registrosBanco) {
            return response()->json([
                'success' => false,
                'message' => 'Livraria não encontrada'
            ], 404);
        }

        $registrosBanco->nome_livraria = $request->nome_livraria;
        $registrosBanco->endereco_livraria = $request->endereco_livraria;
        $registrosBanco->horario_livraria = $request->horario_livraria;

        if ($registrosBanco->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Livraria atualizado com sucesso!',
                'data' => $registrosBanco
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar a livraria'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registros = Livraria::find($id);

        if(!$registros) {
            return response()->json([
                'success' => false,
                'message' => 'livraria não encontrada'
            ], 404);
        }

        if ($registros->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'livraria deletada com sucesso'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro ao deletar a livraria'
        ], 500);
    }
}
