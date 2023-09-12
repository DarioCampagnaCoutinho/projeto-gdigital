<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDO;

class TarefaController extends Controller
{
    public function index(){

        try {
            $tarefas = Tarefa::orderBy('id', 'desc')->get();
            if ($tarefas) {
                return response()->json([
                    'success' => true,
                    'categorys' => $tarefas
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

   }

   public function tarefas_subtarefas()
    {
        try {
            $tarefas = Tarefa::orderBy('id', 'asc')->with('subtarefas')->get();
            if ($tarefas) {
                return response()->json([
                    'success' => true,
                    'tarefas' => $tarefas,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

   public function store(Request $request)
    {
           try {
            $validation = Validator::make($request->all(), [
                'titulo' => ['required', 'string', 'max:20', 'min:5', 'unique:tarefas'],
            ]);
            if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validation->errors()->all(),
                ]);
            } else {
                $result = Tarefa::create([
                    'titulo' => $request->titulo,
                    'descricao' => $request->descricao,
                    'data_vencimento' => $request->data_vencimento,
                    'status' => $request->status,
                ]);
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'message' => "Tarefa Adicionada com Sucesso"
                    ]);
                } else {
                    return response()->json([
                        'success' => true,
                        'messge' => "Erro, verificar."
                    ]);
                }
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'messge' => $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $tarefas = Tarefa::findOrFail($id);
            $validation = Validator::make($request->all(), [
                'titulo' => ['required', 'string', 'max:20', 'min:5'],
            ]);
            if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validation->errors()->all()
                ]);
            } else {
                $tarefas->titulo = $request->titulo;
                $tarefas->descricao = $request->descricao;
                $tarefas->data_vencimento = $request->data_vencimento;
                $tarefas->status = $request->status;
                $result = $tarefas->update();
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Tarefa Atualizada com Sucesso'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Erro, verificar.'
                    ]);
                }
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $result = Tarefa::findOrFail($id)->delete();
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tarefa Deletada com Sucesso'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Erro, verificar.'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

}
