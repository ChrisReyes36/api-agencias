<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\api\Agencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AgenciaController extends Controller
{
  public function index()
  {
    try {
      // Obteniendo agencias.
      $agencias = Agencia::all();
      // Retornando respuesta.
      return response()->json([
        'success' => true,
        'agencias' => $agencias
      ], 200);
    } catch (\Exception $e) {
      // Retornando respuesta del error.
      return response()->json([
        'success' => false,
        'message' => $e->getMessage()
      ], 500);
    }
  }

  public function store(Request $request)
  {
    try {
      // Obteniendo datos.
      $data = $request->all();
      // Validaciones.
      $validator = Validator::make($data, [
        'agencia_nombre' => 'required|max:255|unique:agencias',
        'agencia_direccion' => 'required',
        'agencia_telefono' => ['required', 'regex:/^[2|7|6]{1}[0-9]{3}[-][0-9]{4}$/'],
      ]);
      // Si hay errores.
      if ($validator->fails()) {
        return response()->json([
          'success' => false,
          'message' => 'Error de validación',
          'errors' => $validator->errors()
        ], 400);
      }
      // Creando un registro.
      $agencia = Agencia::create($data);
      $agencia->save();
      // Retornando respuesta.
      return response()->json([
        'success' => true,
        'message' => '¡Agencia creada exitósamente!',
        'agencia' => $agencia
      ], 201);
    } catch (\Exception $e) {
      // Retornando respuesta del error.
      return response()->json([
        'success' => false,
        'message' => $e->getMessage()
      ], 500);
    }
  }

  public function show($agencia_id)
  {
    try {
      // Obteniendo agencia.
      $agencia = Agencia::where('agencia_id', $agencia_id)->first();
      // Verificando si existe.
      if (!$agencia) {
        return response()->json([
          'success' => false,
          'message' => '¡Agencia no encontrada!'
        ], 404);
      }
      // Retornando respuesta.
      return response()->json([
        'success' => true,
        'agencia' => $agencia
      ], 200);
    } catch (\Exception $e) {
      // Retornando respuesta del error.
      return response()->json([
        'success' => false,
        'message' => $e->getMessage()
      ], 500);
    }
  }

  public function update(Request $request, $agencia_id)
  {
    try {
      // Obteniendo datos.
      $data = $request->all();
      // Obteniendo agencia.
      $agencia = Agencia::where('agencia_id', $agencia_id)->first();
      // Verificando si existe.
      if (!$agencia) {
        return response()->json([
          'success' => false,
          'message' => '¡Agencia no encontrada!'
        ], 404);
      }
      // Validaciones.
      $validator = Validator::make($data, [
        'agencia_nombre' => ['required', 'max:255', Rule::unique('agencias')->ignore($agencia_id, 'agencia_id')],
        'agencia_direccion' => 'required',
        'agencia_telefono' => ['required', 'regex:/^[2|7|6]{1}[0-9]{3}[-][0-9]{4}$/'],
      ]);
      // Si hay errores.
      if ($validator->fails()) {
        return response()->json([
          'success' => false,
          'message' => 'Error de validación',
          'errors' => $validator->errors()
        ], 400);
      }
      // Actualizando agencia.
      Agencia::where('agencia_id', $agencia_id)->update($data);
      $agencia = Agencia::where('agencia_id', $agencia_id)->first();
      // Retornando respuesta.
      return response()->json([
        'success' => true,
        'message' => '¡Agencia actualizada exitósamente!',
        'agencia' => $agencia
      ], 200);
    } catch (\Exception $e) {
      // Retornando respuesta del error.
      return response()->json([
        'success' => false,
        'message' => $e->getMessage()
      ], 500);
    }
  }

  public function destroy($agencia_id)
  {
    try {
      // Obteniendo agencia.
      $agencia = Agencia::where('agencia_id', $agencia_id)->first();
      // Verificando si existe.
      if (!$agencia) {
        return response()->json([
          'success' => false,
          'message' => '¡Agencia no encontrada!'
        ], 404);
      }
      // Actualizando agencia.
      Agencia::where('agencia_id', $agencia_id)->delete();
      // Retornando respuesta.
      return response()->json([
        'success' => true,
        'message' => '¡Agencia eliminada exitósamente!',
      ], 200);
    } catch (\Exception $e) {
      // Retornando respuesta del error.
      return response()->json([
        'success' => false,
        'message' => $e->getMessage()
      ], 500);
    }
  }
}
