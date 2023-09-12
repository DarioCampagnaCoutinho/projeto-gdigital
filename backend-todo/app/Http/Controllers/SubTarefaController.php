<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\SubTarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDO;

class SubTarefaController extends Controller
{
    public function index()
    {
        try {
            $subtarefas = SubTarefa::orderBy('id', 'desc')->with('tarefas')->get();
            if ($subtarefas) {
                return response()->json([
                    'success' => true,
                    'posts' => $subtarefas,
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
                'descricao' => ['required', 'string', 'max:1000', 'min:10'],
                'tarefa_id' => ['required'],
            ]);
            if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validation->errors()->all(),
                ]);
            } else {
                    $result = SubTarefa::create([
                    'descricao' => $request->descricao,
                    'status' => $request->status,
                    'tarefa_id' => $request->tarefa_id,
                ]);
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'message' => 'SubTarefa Adicionada com Sucesso'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => "Erro, verificar."
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

    public function update(Request $request)
    {
        try {
            $subtarefas = SubTarefa::findOrFail($request->id);
            $validation = Validator::make($request->all(), [
                'descricao' => ['required', 'string', 'max:1000', 'min:10'],
                'tarefa_id' => ['required'],
            ]);
            if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validation->errors()->all(),
                ]);
            } else {
                $subtarefas->descricao = $request->descricao;
                $subtarefas->status = $request->status;
                $subtarefas->tarefa_id = $request->tarefa_id;
                $result = $subtarefas->save();
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'message' => "Subtarefa Adicionada com Sucesso",
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => "Erro, verificar.",
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
        $subtarefas = SubTarefa::findOrFail($id);
        

        $result = $subtarefas->delete();
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => "Subtarefa Deletada com Sucesso",
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Erro, verificar.",
            ]);
        }
    }
}
