<?php

namespace App\Http\Controllers\API;


use Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'vendorName' => 'required|string|max:191',
            'vendorEmail' => 'required|string|email|max:191|unique:products',
            'vendorPhone' => 'required|unique:products',
            'productName' => 'required|string|max:191',
            'type' => 'required|string|max:191',
            'desc' => 'required|string|max:191',

        ]);
        if($request->photo) {
            $name = time().'.'. explode('/', explode(':', substr($request->photo, 0 , strpos($request->photo, ';')))[1])[1];
        Image::make($request->photo)->save(public_path('img/product/').$name);
        }
        $product = New Product;
        $product ->vendorName =$request->vendorName;
        $product ->vendorEmail =$request->vendorEmail;
        $product ->vendorPhone =$request->vendorPhone;
        $product ->productName =$request->productName;
        $product ->type =$request->type;
        $product ->desc =$request->desc;
        $product ->image =$name;
        $product->save();
        echo json_encode($product);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'vendorName' => 'required|string|max:191',
            'vendorEmail' => 'required|string|max:191',
            'vendorPhone' => 'required|max:191',
            'productName' => 'required|string|max:191',
            'type' => 'required|string|max:191',
            'desc' => 'required|string|max:191',

        ]);
        $product = Product::findOrFail($id);

        $product -> update($request->all());
        return $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();
    }
}
