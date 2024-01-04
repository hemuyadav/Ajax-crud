<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxCrudController extends Controller{
// {
//     protected $fillable =['id', 'name', 'email','password','address'];
// }
public function index(){
    return view('ajaxCrud', ['todos' =>Product::orderBy('id','DESC')->get()]);
}
// public function edit(Product $product){
//     return response()->json($product);
// }
public function edit(Product $product,$todo) {
    try {
        // Your existing code
        $product = Product::where('id',$todo)->first();
        return response()->json($product);
    } catch (\Exception $e) {
        // Log the error
        \Log::error($e->getMessage());
        // Return an error response if needed
        return response()->json(['error' => 'An error occurred'], 500);
    }
}

public function store(Request $request){
    $product = Product::updateOrCreate(
        ['id' => $request->id],
        [
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => $request->password,
            'address' => $request->address,
        ]
        
        
    );
    if( $request->id==null){
        return response()->json(['msg'=>'Added','data'=>$product]);
    }else{
        return response()->json(['msg'=>'updated','data'=>$product]);
    }
}
//  public function destroy(Product $product)
//  {
//       return $product;
      
//     $product->delete();
//     return response()->json('success');
//  }

public function destroy($id)
{
    // $delete =  Product:: delet();
     DB::delete('delete from ajax_crud where id = ?',[$id]);
     return response()->json(['message' => 'Record deleted successfully']);
}
}