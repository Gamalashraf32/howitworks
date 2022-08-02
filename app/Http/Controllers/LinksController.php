<?php

namespace App\Http\Controllers;



use App\Models\Code;
use App\Models\HowItWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class LinksController extends Controller
{
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data=HowItWork::query()->select('id','title','link');

            return DataTables::of($data)
                ->addColumn('actions', function($data){
                    return '<div class="btn-group">

                                                <button class="btn btn-sm btn-primary" data-id="'.$data->id.'" id="editt">Update</button>
                                                <button class="btn btn-sm btn-danger" data-id="'.$data->id.'" id="delete1">Delete</button>
                                          </div>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('howitworkspdf');
    }


        public function create(Request $request)
        {

            $data=$request->validate([
                'title'=>'required',
                'link'
            ]);
            $data['title']=$request->title;
            $file = $request->file('file');
            $filename = time().''.$file->getClientOriginalName();

            $location = 'files';
            $file->move($location,$filename);


            $filepath = url('files/'.$filename);
            $data['link'] = $filepath;

            $d=HowItWork::create($data);
                if ($d) {

                    return response()->json(
                        [
                            'status' => true,
                            'message' => 'Saved successfully'
                        ]
                    );
                } else {
                    return response()->json(
                        [
                            'status' => false,
                            'message' => 'Data not saved '
                        ]
                    );
                }
            }
    public function getuppdf(Request $request)
    {
        $file_id = $request->id;
        $file = HowItWork::find($file_id);
        return response()->json([
            'status' => true,
            'files' => $file
        ]);
    }

    public function update(Request $request){
        $file_id=$request->fid;
        HowItWork::where('id',$file_id)->update([
            'title'=>$request->title
        ]);
        return response()->json([
            'status' => true,
            'message' => "success"
        ]);
    }
    public function delete(Request $request){
        $file_id = $request->id;
        $delete=HowItWork::where('id',$file_id)->delete();
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

            return response()->json(['status'=>true,'code'=>$codes]);



        }else{
            return response()->json(['status'=>false,'code'=>$codes]);
        }


    }
}
