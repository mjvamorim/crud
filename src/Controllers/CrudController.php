<?php

namespace Amorim\Crud\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Validator;
use Response;
use DataTables;


class CrudController extends Controller
{   

    public function __construct()
    {
        $this->middleware('tenant');
    }

    function index($model)
    {
        $class = config('crud.'.$model);
        if (class_exists($class)) {
            $showables  = $class::getShowableFields();
            return view('crud::crudview',compact('showables','model'));
        }
        return redirect('/home'); 
    }

    function getData($model)
    {
        $class = config('crud.'.$model);
        $collection = $class::select();

        //Tornar esse codigo dinâmico
        if($model=='unidade') {
            $collection = $class::select()
            ->with(['proprietario'])
            ->get();
        }

        
        return DataTables::of($collection)
            ->addColumn('action', function($model){
                $btedit = '<button class="btn edit" id="'.$model->id.'" title="Alterar" data-toggle="tooltip" ><i class="glyphicon glyphicon-edit"></i> </button>';
                $btdelt = '<button class="btn delt" id="'.$model->id.'" title="Apagar" data-toggle="tooltip" ><i class="glyphicon glyphicon-trash"></i> </button>';
                return '<div align="center">'.$btedit.'<span> </span>'.$btdelt.'</div>';
            })
            ->make(true);
    }

    function fetchData(Request $request, $model )
    {

        $class = config('crud.'.$model);
        $id = $request->input('id');
        $item = $class::find($id);
        echo json_encode($item);
    }


    function postData(Request $request, $model)
    {
        $class = config('crud.'.$model);
        if($request->get('button_action') == 'delete')
        {
            $id = $request->input('id');

            $deleted = $class::destroy($id);
            if ($deleted) {
                $error_array = [];
                $success_output = '<div class="alert alert-success">Data Deleted</div>';
            } else {
                $success_output = '<div class="alert alert-danger">Data Deleted</div>';
                $error_array = [];
            }

        }
        else {

            $rules = $class::getRules();
            $validation = Validator::make($request->all(), $class::getRules());      
            $error_array = array();
            $success_output = '';
            if ($validation->fails())
            {
                foreach ($validation->messages()->getMessages() as $field_name => $messages)
                {
                    $error_array[] = $messages; 
                }
            }
            else
            {
                if($request->get('button_action') == 'insert')
                {
                    $item = new $class;
                    $input =  $request->only($item->fillable);
                    $item->fill($input);
                    $item->save();
                    $success_output = '<div class="alert alert-success">Data Inserted</div>';
                }

                if($request->get('button_action') == 'update')
                {
                    $item = $class::find($request->get('id'));
                    $input =  $request->only($item->fillable);
                    $item->fill($input);
                    $item->save();
                    $success_output = '<div class="alert alert-success">Data Updated</div>';
                }
            }
        }
            
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output,
            'eu'        => 'Mauricio Amorim',
        );
        echo json_encode($output);
    }
}
