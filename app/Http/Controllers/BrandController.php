<?php

namespace App\Http\Controllers;
use App\Models\brandM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $brands= brandM::withTrashed()->get();
        return view('brands.index',compact('brands'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , brandM $brandM)
    {
        $validation = Validator::make($request->all(), [

            'name'=>'required|unique:brands_tbl,name',
        ],[
            
            'name.required'=>'Thiếu tên thương hiệu sản phẩm',
            'name.unique'=>'Tên thương hiệu bị trùng',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        brandM::create(['name'=>$request->name,'created_at'=>now()]);
        return response()->json(['check'=>true]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , brandM $brandM)
    {
        $validation = Validator::make($request->all(), [
            'id'=>'required|exists:brands_tbl,id',
            'name'=>'required|unique:brands_tbl,name',
        ],[
            'id.required'=>'Thiếu mã loại thương hiệu',
            'id.exists'=>'Mã thương hiệu không tồn tại',
            'name.required'=>'Thiếu tên thương hiệu',
            'name.unique'=>'Tên thương hiệu bị trùng',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        brandM::where('id',$request->id)->update(['name'=>$request->name,'created_at'=>now()]);
        return response()->json(['check'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy(Request $request,brandM $brandM)
    {
        $validation = Validator::make($request->all(), [
            'id'=>'required|exists:brands_tbl,id',
        ],[
            'id.required'=>'Thiếu mã thương hiệu',
            'id.exists'=>'Mã thương hiệu không tồn tại'
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        brandM::where('id',$request->id)->delete();
        return response()->json(['check'=>true]);
    }

    public function restore(Request $request,brandM $brandM)
    {
        $validation = Validator::make($request->all(), [
            'id'=>'required|exists:brands_tbl,id',
        ],[
            'id.required'=>'Thiếu mã loại sản phẩm',
            'id.exists'=>'Mã loại sản phẩm không tồn tại',
        ]); 
        brandM::onlyTrashed()->where('id', $request->id)->restore();
        return response()->json(['check'=>true]);
    }

    public function Switch(Request $request,brandM $brandM)
    {
        $validation = Validator::make($request->all(), [
            'id'=>'required|exists:brands_tbl,id',
        ],[
            'id.required'=>'Thiếu mã thương hiệu',
            'id.exists'=>'Mã thương hiệu không tồn tại',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        $old =brandM::where('id',$request->id)->value('status');
        if($old ==0){
            brandM::where('id',$request->id)->update(['status'=>1,'updated_at'=>now()]);
        }else{
            brandM::where('id',$request->id)->update(['status'=>0,'updated_at'=>now()]);
        }
        return response()->json(['check'=>true]);
    }

    public function getBrandAPI(){
        $brands= brandM::where('status',1)-> select('id','name')->get();
        return response()->json($brands);

    }

}



