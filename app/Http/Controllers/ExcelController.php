<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportExcel;
use App\Models\Project;
use App\Models\Image;

class ExcelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('excel');
    }

    public function import(Request $request){
        if($request->file('file') == NULL){
            return redirect('/excel')->with('success', 'You must be select excel file!');
        }
        Excel::import(new ImportExcel, $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function load(Request $request){
        $data = Project::all();
        return response()->json($data);
    }

    public function update(Request $request){        
        $id = $request->input('data')["id"];        
        $Project = Project::find($id);
        $Project->name = $request->input('data')['name'] == null ? '' : $request->input('data')['name'];
        $Project->planned_start = $request->input('data')['planned_start'] == null ? '' : $request->input('data')['planned_start'];
        $Project->planned_finish = $request->input('data')['planned_finish'] == null ? '' : $request->input('data')['planned_finish'];
        $Project->actual_start = $request->input('data')['actual_start'] == null ? '' : $request->input('data')['actual_start'];
        $Project->actual_finish = $request->input('data')['actual_finish'] == null ? '' : $request->input('data')['actual_finish'];
        $Project->percent_complete = $request->input('data')['percent_complete'] == null ? '' : $request->input('data')['percent_complete'];
        $Project->comment = $request->input('data')['comment'] == null ? : $request->input('data')['comment'];
        $Project->update();
        return response()->json([ 'msg' => 'Update Succesufully!' ]);
    }

    public function store(Request $request){
        $name = '';
        if ($image = $request->file('image')) {
            $name = date('Ymdhs') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('/assets/images/upload'), $name);
        }
        $path = 'public/assets/images/upload';
        $save = new Image;
        $save->name = $name;
        $save->path = $path;
        $save->taskId = $request->input('id');
        $save->save();
        return response()->json(['msg' => 'Image Upload Successfully!']);
    }

    public function show(Request $request){
        $id = $request->input('id');
        $image = Image::where('taskId', $id)->get();
        return response()->json([ 'data' => $image ]);
    }


}