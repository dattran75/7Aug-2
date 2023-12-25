<?php

namespace App\Http\Controllers;

use App\Models\productM;
use Illuminate\Http\Request;
use App\Models\brandM;
use App\Models\cateM;
use Illuminate\Support\Facades\Validator;
use DB;
use File;
class ProductController extends Controller
{
    
    public function brandproductsAPI($id){
        $idBrand = productM::where('id',$id)->value('idBrand');
         $products = DB::Table('products')->where('idBrand',$idBrand)->select('id','name','price','discount','images')->take(4)->get();
         return response()->json($products);
    }

    public function getSingleProductAPI($id){
        $product= DB::table('products')
        ->join('brands','products.idBrand','=','brands.id')
        ->join('categrories','products.idCate','=','categrories.id')
        ->where('products.id','=',$id)->select('products.*','brands.name as brand','categrories.name as cate')->first();
        $gallery = DB::table('products_images')->where('idProduct',$id)->select('images')->get();
        return response()->json(['product'=>$product,'gallery'=>$gallery]);
    }


    public function index()
    {
        $brands = brandM::where('status', '=', 1)->select('id', 'name')->get();
        $cates = cateM::where('status', '=', 1)->select('id', 'name')->get();
        $products = DB::table('products')->join('brands_tbl','products.idBrand','=','brands_tbl.id')
        ->join('categrories_tbl','products.idCate','=','categrories_tbl.id')
        ->select('products.*','categrories_tbl.name as catename','brands_tbl.name as brandname')
        ->paginate(6);
        $url = 'http://127.0.0.1:8000/images/';
        // dd($products);
       
        return view('products.index',compact('brands','cates','products','url'));
    }
    /////////////////////////////////////////////////////////////////////

    // public function addProduct(Request $request,cateM $cateM, brandM $brandM, ProductM $ProductM)
    // {
    //     $validation = Validator::make($request->all(), [
         
    //         'name'=>'required|unique:products,name',
    //         'price'=>'required|numeric',
    //         'quantity'=>'required|numeric|min:0',
    //         'discount'=>'required|numeric|min:0',
    //         'idBrand'=>'required|exists:brands_tbl,id',
    //         'idCate'=>'required|exists:categrories_tbl,id',
    //         'content'=>'required',
    //         'file'=>'required',
    //     ],[
                        
    //         'name.required'=>'Thiếu tên loại sản phẩm',
    //         'name.unique'=>'Tên loại sản phẩm bị trùng',
    //         'price.required'=>'Thiếu giá sản phẩm',
    //         'price.numeric'=>'Giá sản phẩm phải là số',
    //         'quantity.required'=>'Thiếu số lượng sản phẩm',
    //         'quantity.numeric'=>'Số lượng sản phẩm phải là số',
    //         'quantity.min'=>'Số lượng sản phẩm >0',
    //         'discount.numeric'=>'Giảm giá không hợp lệ',
    //         'content.required'=>'Chưa nhập thông tin sản phẩm',
    //         'file.required'=>'Chưa chọn hình ảnh sản phẩm',
         

            
    //     ]); 
    //     if ($validation->fails()) {
    //         return response()->json(['check' => false,'msg'=>$validation->errors()]);
    //     }
    //     if(!isset($_FILES['file'])){
    //         return response()->json(['check'=>false,'msg'=>'Thiếu hình ảnh']);
    //     }

    //     move_uploaded_file($_FILES['file']['tmp_name'],'images/'.$_FILES['file']['name']);
    //     productM::create(['name'=>$request->name,'quantity'=>$request->quantity,'price'=>$request->price,'discount'=>$request->discount,'idBrand'=>$request->idBrand,'idCate'=>$request->idCate,'images'=>$_FILES['file']['name'],'content'=>$request->content]);
       
    //     $filetype = $_FILES['files']['type'];
    //     $accept = ['gif', 'jpeg', 'jpg', 'png'];
    //     $keyarr = [];
    //     foreach ($filetype as $key => $value) {
    //         if (in_array($value, $accept)) {
    //             array_push($keyarr, $key);
    //         }
    //     }
    //    foreach ($_FILES['file']['name'] as $key1 => $value) {
    //     if (!in_array($key1, $keyarr)) {
    //         $temp = explode(".", $value);
    //         $newfilename = random_int(1,99999999);
    //         move_uploaded_file($_FILES['file']['tmp_name'][$key1],'images/'.$newfilename);
    //         ProductGallerryM::creat(['idProduct' => $idPro, 'images' => $newfilename, 'created_at' => now()]);
    //     }
    //    }

    //     return response()->json(['check'=>true]);
    // }

/////////////////////////////////////////////////////////

public function addProduct(Request $request,cateM $cateM, brandM $brandM, ProductM $ProductM)
     {
if (Gate::allows('create_product')) {
    $Validator = Validator::make($request->all(), [
        'name' => 'required',
        'price' => 'required|numeric|min:0',
        'discount' => 'required|numeric|min:0',
        'idBrand' => 'required|numeric|exists:brands,id',
        'idCate' => 'required|numeric|exists:categrories,id',
        'content' => 'required'
    ]);
if ($Validator->fails()) {
        return response()->json(['check' => false, 'message' => $Validator->errors()]);
    }
    $id = Auth::id();
    $idProd = productM::insertGetId(
        [
            'name' => $request->name, 'price' => $request->price,
            'discount' => $request->discount, 'idUser' => $id, 'idBrand' => $request->idBrand,
            'idCate' => $request->idCate, 'content' => $request->content,
            'created_at' => now()
        ]
);
    $filetype = $_FILES['files']['type'];
    $accept = ['gif', 'jpeg', 'jpg', 'png', 'svg', 'jfif', 'JFIF', 'blob', 'GIF', 'JPEG', 'JPG', 'PNG', 'gif', 'jpeg', 'jpg', 'png', 'svg', 'jfif', 'JFIF', 'blob', 'GIF', 'JPEG', 'JPG', 'PNG', 'SVG', 'webpimage', 'WEBIMAGE', 'webpimage', 'webpimage', 'webpimage', 'webp', 'WEBP', 'SVG', 'webpimage', 'WEBIMAGE', 'webpimage', 'webpimage', 'webpimage', 'webp', 'WEBP'];
$keyarr = [];
    foreach ($filetype as $key => $value) {
        if (!in_array($value, $accept)) {
            array_push($keyarr, $key);
        }
    }
foreach ($_FILES['files']['name'] as $key1 => $value1) {
        if (!in_array($key1, $keyarr)) {
            $temp = explode(".", $value1);
            $newfilename = random_int(1,99999999). '.' . end($temp);
move_uploaded_file($_FILES['files']['tmp_name'][$key1], 'images/' . $newfilename);
            ProductGallerryM::creat(['idProduct' => $idPro, 'images' => $newfilename, 'created_at' => now()]);
}
}
return response()->json(['check'=>true]);
}
     }

////////////////////////////////////////////////////////

    public function edit(Request $request, ProductM $ProductM)
    {
        $validation = Validator::make($request->all(), [
         
            'id'=>'required|exists:products,id',
        ],[
            'id.required'=>'Thiếu mã sản phẩm',
            'id.exists'=>'Mã sản phẩm không tồn tại',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        $result = productM::where('id',$request->id)->get();
        return response()->json(['check'=>true,'products'=>$result]);

        
        
     }
/////////////////////////////////////

     public function update(Request $request,cateM $cateM, brandM $brandM, ProductM $ProductM)
     {
        $validation = Validator::make($request->all(), [

            'name'=>'required',
            'price'=>'required|numeric',
            'quantity'=>'required|numeric|min:0',
            'discount'=>'required|numeric|min:0',
            'idBrand'=>'required|exists:brands_tbl,id',
            'idCate'=>'required|exists:categrories_tbl,id',
            'content'=>'required',
            'id'=>'required|exists:products,id'
        ],[
            'name.required'=>'Thiếu tên sản phẩm',
            'price.required'=>'Thiếu giá sản phẩm',
            'price.numeric'=>'Giá sản phẩm không hợp lệ',
            'quantity.required'=>'Thiếu số lượng sản phẩm',
            'quantity.numeric'=>'Số lượng sản phẩm không hợp lệ',
            'quantity.min'=>'Số lượng sản phẩm >0',
            'discount.numeric'=>'Giá sản phẩm không hợp lệ',
            'id.required'=>'Chưa nhận được mã sản phẩm',
            'id.exists'=>'Mã sản phẩm không tồn tại',
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        if(!isset($_FILES['file'])){
            productM::where('id',$request->id)->update(['name'=>$request->name,'price'=>$request->price,
                    'discount'=>$request->discount,'idBrand'=>$request->idBrand,
                    'quantity'=>$request->quantity,'idCate'=>$request->idCate,
                    'content'=>$request->content,'updated_at'=>now()]);
                    return response()->json(['check'=>true]);
        }else{
            if(file_exists(public_path('images/'.$_FILES['file']['name']))){
                if(isset($_POST['replace'])&& $_POST['replace']==1){
                    move_uploaded_file($_FILES['file']['tmp_name'],'images/'.$_FILES['file']['name']);
                    productM::where('id',$request->id)->update(['name'=>$request->name,'price'=>$request->price,
                    'discount'=>$request->discount,'idBrand'=>$request->idBrand,
                    'quantity'=>$request->quantity,'idCate'=>$request->idCate,
                    'images'=>$_FILES['file']['name'],
                    'content'=>$request->content,'updated_at'=>now()]);
                     return response()->json(['check'=>true]);
                }else{
                 return response()->json(['check'=>false,'image'=>true]);
     
                }
             }else{
                $image= productM::where('id',$request->id)->value('images');
                if(file_exists(public_path('images/'.$image))){
                    File::delete(public_path('images/'.$image));
                }
                 move_uploaded_file($_FILES['file']['tmp_name'],'images/'.$_FILES['file']['name']);
                 productM::where('id',$request->id)->update(['name'=>$request->name,'price'=>$request->price,
                 'discount'=>$request->discount,'idBrand'=>$request->idBrand,
                 'quantity'=>$request->quantity,'idCate'=>$request->idCate,
                 'images'=>$_FILES['file']['name'],
                 'content'=>$request->content,'updated_at'=>now()]);
                  return response()->json(['check'=>true]);
             }
        }
        
    }

    public function deleteProduct(Request $request,productM $productM){
        $validation = Validator::make($request->all(), [

            'id'=>'required|exists:products,id',
          
        ],[
            'id.required'=>'Thiếu mã sản phẩm',
            'id.exists'=>'Mã không tồn tại',
          
        ]); 
        if ($validation->fails()) {
            return response()->json(['check' => false,'msg'=>$validation->errors()]);
        }
        $image= productM::where('id',$request->id)->value('images');
        if(file_exists(public_path('images/'.$image))){
            File::delete(public_path('images/'.$image));
        }
        productM::where('id',$request->id)->delete();
        return response()->json(['check'=>true]);
        
    }
   
    public function getProductAPI(){
        $products = DB::Table('products')->inRandomOrder()->select('id','name','price','discount','images')->take(4)->get();
        // $products = DB::Table('products')->orderBy('id','desc')->select('id','name','price','discount','images')->take(4)->get();
        return response()->json($products);
    }
}
