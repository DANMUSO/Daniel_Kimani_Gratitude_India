<?php

namespace App\Http\Controllers\API;
use Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Developer;
class DeveloperController extends Controller
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
        return Developer::latest()->paginate(10);
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
            'email' => 'required|string|email|max:191|unique:developers',
            'phone' => 'required|unique:developers',
        ]);
        if($request->photo) {
            $name = time().'.'. explode('/', explode(':', substr($request->photo, 0 , strpos($request->photo, ';')))[1])[1];
        Image::make($request->photo)->save(public_path('img/product/').$name);
        }
        $dev = new Developer;
        $dev -> name = $request->name;
        $dev -> devtype = $request-> devtype;
        $dev -> phone = $request-> phone;
        $dev -> email = $request-> email;
        $dev ->image =$name;
        $dev -> save();

        echo json_encode($dev);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
