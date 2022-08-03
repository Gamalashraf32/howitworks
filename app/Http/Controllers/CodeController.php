<?php

namespace App\Http\Controllers;


use App\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CodeController extends Controller
{
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data=Code::query()->select('id','code');

            return DataTables::of($data)
                ->addColumn('actions', function($data){
                    return '<div class="btn-group">
                                                <button class="btn btn-sm btn-primary" data-id="'.$data->id.'" id="editP">Update</button>
                                                <button class="btn btn-sm btn-danger" data-id="'.$data->id.'" id="deletep">Delete</button>
                                          </div>';
                })

                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('howitworks');
    }
    public function create(Request $request)
    {
        $validator=\Illuminate\Support\Facades\Validator::make($request->all(),[
            'code'=>'required|string|min:3|max:10',
        ]);
        if ($validator->fails())
        {
            $errors = [];
            foreach ($validator->errors()->getMessages() as $message) {
                $error = implode($message);
                $errors[] = $error;
            }
            return response()->json([
                "message"=>implode(' , ', $errors),
                "status"=>false
            ]);
        }
        $code =Code::create([
            'code'=>$request->code,
        ]);
        if ($code){

            return response()->json(
                [
                    'status'=>true,
                    'message'=>'Saved successfully'
                ]
            );
        }
        else
        {
            return response()->json(
                [
                    'status'=>false,
                    'message'=>'Data not saved '
                ]
            );
        }
    }
    public function getupcode(Request $request){
        $code_id = $request->id;
        $codes = Code::find($code_id);
        return response()->json([
            'status'=>true,
            'codes'=>$codes
        ]);
    }
    public function update(Request $request){
        $validator=\Illuminate\Support\Facades\Validator::make($request->all(),[
            'code'=>'required|string|min:3|max:10',
        ]);
        if ($validator->fails())
        {
            $errors = [];
            foreach ($validator->errors()->getMessages() as $message) {
                $error = implode($message);
                $errors[] = $error;
            }
            return response()->json([
                "message"=>implode(' , ', $errors),
                "status"=>false
            ]);
        }
        $code_id=$request->cid;
        Code::where('id',$code_id)->update([
            'code'=>$request->code
        ]);
        return response()->json([
            'status' => true,
            'message' => "success"
        ]);
    }
    public function delete(Request $request){
        $code_id = $request->id;
        $delete=Code::where('id',$code_id)->delete();
        if($delete) {
            return response()->json([
                'status' => true,
                'message' => "deleted"
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => "not deleted"
            ]);
        }
    }
    public function view(Request $request)
    {
        $codes=$request->code;
        $data= DB::table('codes')->get()->last()->code;
        if ($data==$codes) {
            return response()->json(['status'=>true]);
        }else{
            return response()->json(['status'=>false]);
        }

        }
}
