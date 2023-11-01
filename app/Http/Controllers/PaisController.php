<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;

class PaisController extends Controller
{
    // END POINT para obtener todos los paises

    public function index()
    {
        try {
            $paises = Pais::all();
            if ($paises->count() > 0) {
                return response()->json([
                    'code' => '200',
                    'message' => 'Paises obtenidos correctamente',
                    'data' => $paises
                ], 200);
            } else {
                return response()->json([
                    'message' => 'No se encontraron paises',
                    'code' => '404',
                    'data' => $paises
                ], 404);
            }
            return response()->json($paises);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error al obtener los paises',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
