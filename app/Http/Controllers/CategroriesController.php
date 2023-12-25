<?php

namespace App\Http\Controllers;
use App\Models\cateM;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategroriesController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cates= cateM::withTrashed()->get();
        return view('cates.index',compact('cates'));
    }
///////////////////////

public function getCateAPI(Request $request){
$cates = DB:: Table('categrories_tbl') -> where ('status', 1)
-> select ('id', 'name') -> get();
return response()->json($cates);

}

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,cateM $cateM)
    {
        $validation = Validator::make($request->all(), [
            'name'=>'required|unique:categrories_tbl,name',
        ],[
            'name.required'=>'Thiếu tên loại sản phẩm',
            'name.unique'=>'Tên loại sản phẩm bị trùng',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        cateM::create(['name'=>$request->name,'created_at'=>now()]);
        return response()->json(['check'=>true]);
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, cateM $cateM)
    {
        $validation = Validator::make($request->all(), [
            'id'=>'required|exists:categrories_tbl,id',
        ],[
            'id.required'=>'Thiếu mã loại sản phẩm',
            'id.exists'=>'Mã loại sản phẩm không tồn tại',
        ]); 
        cateM::where('id',$request->id)->delete();
        return response()->json(['check'=>true]);
    }

     /**
     * Show the form for editing the specified resource.
     */
    public function edit(cateM $cateM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cateM $cateM)
    {
        $validation = Validator::make($request->all(), [
            'id'=>'required|exists:categrories_tbl,id',
            'name'=>'required|unique:categrories_tbl,name',
        ],[
            'id.required'=>'Thiếu mã loại sản phẩm',
            'id.exists'=>'Mã loại sản phẩm không tồn tại',
            'name.required'=>'Thiếu tên loại sản phẩm',
            'name.unique'=>'Tên loại sản phẩm bị trùng',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        cateM::where('id',$request->id)->update(['name'=>$request->name,'created_at'=>now()]);
        return response()->json(['check'=>true]);
    }

    public function restore(Request $request, cateM $cateM)
    {
        $validation = Validator::make($request->all(), [
            'id'=>'required|exists:categrories_tbl,id',
        ],[
            'id.required'=>'Thiếu mã loại sản phẩm',
            'id.exists'=>'Mã loại sản phẩm không tồn tại',
        ]); 
        cateM::onlyTrashed()->where('id', $request->id)->restore();
        return response()->json(['check'=>true]);
    }

    public function Switch(Request $request,cateM $cateM)
    {
        $validation = Validator::make($request->all(), [
            'id'=>'required|exists:categrories_tbl,id',
        ],[
            'id.required'=>'Thiếu mã thương hiệu',
            'id.exists'=>'Mã thương hiệu không tồn tại',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        $old =cateM::where('id',$request->id)->value('status');
        if($old ==0){
            cateM::where('id',$request->id)->update(['status'=>1,'updated_at'=>now()]);
        }else{
            cateM::where('id',$request->id)->update(['status'=>0,'updated_at'=>now()]);
        }
        return response()->json(['check'=>true]);
    }

}

