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
        $exam_types =  ExamType::select("exam_types.*")->orderBy('id', 'desc')->paginate(5);
        return Inertia::render('ExamType/Index', ['exam_types' => $exam_types]);
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
            $components = $this->check_components_input($request, "create");
            if (!is_array($components)) {
                throw $components;
            }
            
            $components_json = json_encode($components);
            
            ExamType::create([
                'name' => $request->name,
                'components_info' => $components_json,
            ]);
            return redirect()->route('type.index')->with("message", "Novo tipo de exame cadastrado com sucesso.");
        } catch (Exception $e) {
            $error_message = $this->is_error_in_the_list($e);
            return Inertia::render('ExamType/Create', ["error" => $error_message == "" ? "Não foi possível realizar o cadastro do tipo." : $error_message]);
        }
    }
    
    
    public function search($search_value=null)
    {
        if ($search_value == null) {
            $exam_types =  ExamType::select("exam_types.*")->orderBy('id', 'desc')->paginate(5);
        } else {
            $search = strtolower($search_value);

            $exam_types = ExamType::select('exam_types.*')
            ->whereRaw('LOWER(exam_types.name) LIKE ?', '%' . $search . '%')->orderBy('id', 'desc')->paginate(5);
        }
        return Inertia::render('ExamType/Index', ['exam_types' => $exam_types]);
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

        $exam_type = ExamType::find($id);

        try {
            
            $components = $this->check_components_input($request, "edit");
            
            if (!is_array($components)) {
                throw $components;
            }
            
            $components_json = json_encode($components);
            
            $exam_type->updateOrFail([
                'name' => $request->name,
                'components_info' => $components_json,
            ]);
            
            return redirect()->route('type.index')->with("message", "Dados do tipo de exame atualizados com sucesso.");
        } catch (Exception $e) {
            $error_message = $this->is_error_in_the_list($e);
            return Inertia::render('ExamType/Edit', ['exam_type' => $exam_type ,"error" => $error_message == "" ? "Não foi possível salvar as alterações." : $error_message]);
        }
    }

    private function check_components_input($request, $type) {
        try{
            $components = [];
            $index = 1;
            foreach($request->components_info as $component) {
                if ($type == "create"){
                    if($component["name"] == null){
                        throw new Exception("Não foi possível criar um novo tipo, campo não preenchido.");
                    }
                    if($component["min_female"] == 0){
                        throw new Exception("Não foi possível criar um novo tipo, campo não preenchido.");
                    }
                    if($component["max_female"] == 0){
                        throw new Exception("Não foi possível criar um novo tipo, campo não preenchido.");
                    }
                    if($component["min_male"] == 0){
                        throw new Exception("Não foi possível criar um novo tipo, campo não preenchido.");
                    }
                    if($component["max_male"] == 0){
                        throw new Exception("Não foi possível criar um novo tipo, campo não preenchido.");
                    }
                    if($component["metric"] == null){
                        throw new Exception("Não foi possível criar um novo tipo, campo não preenchido.");
                    }
                }
                if ($type == "edit") {
                    if($component["name"] == null){
                        throw new Exception("Não foi possível salvar alterações, campo não preenchido.");
                    }
                    if($component["min_female"] == 0){
                        throw new Exception("Não foi possível salvar alterações, campo não preenchido.");
                    }
                    if($component["max_female"] == 0){
                        throw new Exception("Não foi possível salvar alterações, campo não preenchido.");
                    }
                    if($component["min_male"] == 0){
                        throw new Exception("Não foi possível salvar alterações, campo não preenchido.");
                    }
                    if($component["max_male"] == 0){
                        throw new Exception("Não foi possível salvar alterações, campo não preenchido.");
                    }
                    if($component["metric"] == null){
                        throw new Exception("Não foi possível salvar alterações, campo não preenchido.");
                    }
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
            "Não foi possível criar um novo tipo, campo não preenchido.",
            "Não foi possível salvar alterações, campo não preenchido.",
        ];
        
        $error_message = implode("", array_filter($error_messages, function($value) use ($e) {
            return strpos($e->getMessage(), $value) !== false;
        }));
        
        return $error_message ? $e->getMessage() : "";
    }
}
