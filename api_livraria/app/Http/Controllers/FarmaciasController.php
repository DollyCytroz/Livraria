<?php

namespace App\Http\Controllers;

use App\Models\Farmacias;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class FarmaciasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //buscando todas as criptomoedas
        $registros = Farmacias::All();

        //contando o número de registros
        $contador = $registros->count();

        //verificando se há registros
        if ($contador > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Farmacias encontradas com sucesso!',
                'data' => $registros,
                'total' => $contador
            ], 200); //Retorna http 200 (ok) com os dados e a contagem
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Nenhuma farmacia encontrada.',
            ], 404); //Retorna http 404 (not found) se não houver registros
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'nome_farmacia' => 'required',
        'endereco_farmacia' => 'required',
        'horario_farmacia' => 'required'
      ]);

      if($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Registros inválidos',
            'errors' => $validator->errors()
        ], 400);
      }

      $registros = Farmacias::create($request->all());

      if($registros) {
        return response()->json([
            'success' => true,
            'message' => 'Farmacia cadastrada com sucesso!',
            'data' => $registros
        ], 201);
      } else {
        return response()->json([
            'success' => false,
            'message' => 'Error ao cadastrar a farmacia',
        ], 500);
      }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $registros = Farmacias::find($id);

        if($registros){
            return response()->json([
                'success' => true,
                'message' => 'Farmacia localizada com sucesso!',
                'data' => $registros
            ], 200);   
        } else{
            return response()->json([
                'success' => false,
                'message' => 'Farmacia não localizada.',
            ], 404);
        }
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nome_farmacia' => 'required',
            'endereco_farmacia' => 'required',
            'horario_farmacia' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $registrosBanco = Farmacias::find($id);

        if (!$registrosBanco) {
            return response()->json([
                'success' => false,
                'message' => 'Farmacia não encontrada'
            ], 404);
        }

        $registrosBanco->nome_farmacia = $request->nome_farmacia;
        $registrosBanco->endereco_farmacia = $request->endereco_farmacia;
        $registrosBanco->horario_farmacia = $request->horario_farmacia;

        if ($registrosBanco->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Farmacia atualizada com sucesso!',
                'data' => $registrosBanco
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar a farmacia'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registros = Farmacias::find($id);

        if(!$registros) {
            return response()->json([
                'success' => false,
                'message' => 'farmacia não encontrada'
            ], 404);
        }

        if ($registros->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Farmacia deletada com sucesso'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro ao deletar a farmacia'
        ], 500);
    }
}
