<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Model\Category;
use Illuminate\Support\Facades\DB;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return response()->json($category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        $category = new Category;
        $category->category_name = $request->category_name;

        $position = strpos($request->photo, ';');
        $sub = substr($request->photo, 0, $position);
        $ext = explode('/', $sub)[1];

        $name = time() . "." . $ext;
        $img = Image::make($request->photo);
        $upload_path = 'backend/category/';
        $image_url = $upload_path . $name;
        $img->save($image_url);

        $category->image_url = $image_url;
        $category->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $data = array();
        $data['category_name'] = $request->category_name;
        $position = strpos($request->photo, ';');
        $sub = substr($request->photo, 0, $position);
        $ext = explode('/', $sub)[1];

        $name = time() . "." . $ext;
        $img = Image::make($request->photo);
        $upload_path = 'backend/category/';
        $image_url = $upload_path . $name;
        $img->save($image_url);

        $data['image_url'] = $image_url;
        DB::table('categories')->where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('categories')->where('id', $id)->delete();
    }
}
