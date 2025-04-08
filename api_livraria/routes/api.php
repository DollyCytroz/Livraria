<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivrariaController;
use App\Http\Controllers\FarmaciasController;

//rota para vizualizar registros
Route::get('/',function(){return response()->json(['Sucesso'=>true]);});
Route::get('/livraria',[LivrariaController::class,'index']);
Route::get('/livraria/{codigo}',[ALivrariaController::class,'show']);

//rota para inserir registros
Route::post('/livraria',[LivrariaController::class,'store']);

//rota para alterar registros
Route::put('/livraria/{codigo}',[LivrariaController::class,'update']);

//rota para excluir registros por id/codigo
Route::delete('/livraria/{id}',[ALivrariaController::class,'destroy']);

//rota para vizualizar registros
Route::get('/farmacias',[LFarmaciasController::class,'index']);
Route::get('/farmacias/{codigo}',[FarmaciasController::class,'show']);

//rota para inserir registros
Route::post('/farmacias',[FarmaciasController::class,'store']);

//rota para alterar registros
Route::put('/farmacias/{codigo}',[FarmaciasController::class,'update']);

//rota para excluir registros por id/codigo
Route::delete('/farmacias/{id}',[FarmaciasController::class,'destroy']);