<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function index(){
        try {
            $clientes = Cliente::select('cliente.id', 'cliente.nombre', 'cliente.telefono', 'pais.nombre as fk_pais')->join('pais','cliente.fk_pais','=','pais.id')->get();
            if($clientes->count() > 0){
                return response()->json([
                    'code' => '200',
                    'message' => 'Clientes obtenidos correctamente',
                    'data' => $clientes
                ], 200);
            }else{
                return response()->json([
                    'message' => 'No se encontraron clientes',
                    'code' => '404',
                    'data' => $clientes
                ], 404);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error al obtener los clientes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request){
        try {

            $validacion = Validator::make($request->all(), [
                'nombre' => 'required',
                'telefono' => 'required',
                'fk_pais' => 'required'
            ]);

            if ($validacion->fails()) {
                return response()->json([
                    'message' => 'Error al validar los datos',
                    'error' => $validacion->errors()
                ], 400);
            }else{
                //$cliente = Cliente::create($request->all());
                $cliente = new Cliente();
                $cliente->nombre = $request->nombre;
                $cliente->telefono = $request->telefono;
                $cliente->fk_pais = $request->fk_pais;
                $cliente->save();

                return response()->json([
                    'code' => '200',
                    'message' => 'Cliente creado correctamente',
                    'data' => $cliente
                ], 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error al crear el cliente',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id){
        try {

            $validacion = Validator::make($request->all(), [
                'nombre' => 'required',
                'telefono' => 'required',
                'fk_pais' => 'required'
            ]);

            if ($validacion->fails()) {
                return response()->json([
                    'message' => 'Error al validar los datos',
                    'error' => $validacion->errors()
                ], 400);
            }else{
                $cliente = Cliente::find($id);
                if($cliente != null){
                    $cliente->nombre = $request->nombre;
                    $cliente->telefono = $request->telefono;
                    $cliente->fk_pais = $request->fk_pais;
                    $cliente->save();

                return response()->json([
                    'code' => '200',
                    'message' => 'Cliente actualizado correctamente',
                    'data' => $cliente
                ], 200);
                }else{
                    return response()->json([
                        'message' => 'No se encontró el cliente',
                        'code' => '404',
                        'data' => $cliente
                    ], 404);
                }
            }
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error al actualizar el cliente',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete($id){
        try {
            $cliente = Cliente::find($id);
            if($cliente != null){
                $cliente->delete();
                return response()->json([
                    'code' => '200',
                    'message' => 'Cliente eliminado correctamente',
                    'data' => $cliente
                ], 200);
            }else{
                return response()->json([
                    'message' => 'No se encontró el cliente',
                    'code' => '404',
                    'data' => $cliente
                ], 404);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error al eliminar el cliente',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function find($id){
        try {
            $cliente = Cliente::find($id);
            if($cliente != null){
                $datos = Cliente::select('cliente.id', 'cliente.nombre', 'cliente.telefono', 'pais.nombre as fk_pais')->join('pais','pais.id','=','cliente.fk_pais')->where('cliente.id','=',$id)->get();

                return response()->json([
                    'code' => '200',
                    'message' => 'Cliente obtenido correctamente',
                    'data' => $datos[0]
                ], 200);
            }else{
                return response()->json([
                    'message' => 'No se encontró el cliente',
                    'code' => '404',
                    'data' => $cliente
                ], 404);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error al obtener los clientes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function find2($id){
        try {
            $cliente = Cliente::find($id);
            if($cliente != null){

                return response()->json([
                    'code' => '200',
                    'message' => 'Cliente obtenido correctamente',
                    'data' => $cliente
                ], 200);
            }else{
                return response()->json([
                    'message' => 'No se encontró el cliente',
                    'code' => '404',
                    'data' => $cliente
                ], 404);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error al obtener los clientes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
