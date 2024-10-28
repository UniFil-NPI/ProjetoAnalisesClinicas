<?php

namespace App\Http\Controllers;

use App\Models\ExamType;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExamTypeController extends Controller
{
    public function index()
    {
        return Inertia::render('ExamType/Index');
    }

    public function create()
    {
        return Inertia::render('ExamType/Create');
    }
    
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
        ]);
        try {
            $components = $this->check_components_input($request);
            
            $components_json = json_encode($components);
            
            ExamType::create([
                'name' => $request->name,
                'components_info' => $components_json,
            ]);
            return redirect()->route('type.index')->with("message", "Novo tipo de exame cadastrado com sucesso.");
        } catch (Exception $e) {
            $error_message = $this->is_error_in_the_list($e);
            return Inertia::render('ExamType/Create', ["error" => $error_message]);
        }
    }
    
    
    private function check_components_input($request) {
        try{
            $components = [];
            $index = 1;
            foreach($request->components_info as $component) {
                if($component["name"] == null){
                    throw new Exception("O campo nome do componente {$index} está faltando.");
                }
                if($component["min_female"] == 0){
                    throw new Exception("O campo min. Feminio do componente {$index} está faltando.");
                }
                if($component["max_female"] == 0){
                    throw new Exception("O campo max. Feminino do componente {$index} está faltando.");
                }
                if($component["min_male"] == 0){
                    throw new Exception("O campo min. Masculino do componente {$index} está faltando.");
                }
                if($component["max_male"] == 0){
                    throw new Exception("O campo max. Masculino do componente {$index} está faltando.");
                }
                if($component["metric"] == null){
                    throw new Exception("O campo de unidade de medida do componente {$index} está faltando.");
                }
                $components[] = $component;
                $index++;
            }
            return $components;

        } catch (Exception $e) {
            return $e;
        }
    }

    private function is_error_in_the_list($e) {
        $error_messages = [
            "O campo nome do componente",
            "O campo min. Feminio do componente",
            "O campo max. Feminino do componente",
            "O campo min. Masculino do componente",
            "O campo max. Masculino do componente",
            "O campo de unidade de medida do componente",
        ];
        
        $error_message = implode("", array_filter($error_messages, function($value) use ($e) {
            return strpos($e->getMessage(), $value) !== false;
        }));
        
        return $error_message ? $e->getMessage() : "Não foi possível realizar o cadastro do tipo.";
    }
    public function search(Request $request)
    {
        if ($request->search == "") {
            return ExamType::select('exam_types.*')
            ->orderBy('exam_types.created_at', 'desc')->get();
        } 
        try {
            return ExamType::select('exam_types.*')
            ->where('exam_types.name', $request->search)->orderBy('exam_types.created_at', 'desc')->get();
        } catch(Exception $e) {
            return Inertia::render('ExamType/Index', ["error" => "Nome não encontrado no sistema."]);
        }

    }

    public function edit($id)
    {
        $exam_type = ExamType::find($id);

        return Inertia::render('ExamType/Edit', ['exam_type' => $exam_type]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        try {

            $components = $this->check_components_input($request);
            
            $components_json = json_encode($components);
            
            $exam_type = ExamType::find($id);

            $exam_type->updateOrFail([
                'name' => $request->name,
                'components_info' => $components_json,
            ]);

            return redirect()->route('type.index')->with("message", "Dados do tipo de exame atualizados com sucesso.");
        } catch (Exception $e) {

            return Inertia::render('Exam/Edit', ["error" => "Não foi possível realizar a atualização dos dados.", 'exam' => $exam]);
        }
    }
}
