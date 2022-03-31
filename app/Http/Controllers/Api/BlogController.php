<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Model\Blog;
use Illuminate\Support\Facades\DB;
use Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog_category = Blog::all();
        return response()->json($blog_category);
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
            'blog_title' => 'required',
            'blog_category_name' => 'required',
            'blog_image_url' => 'required',
            'blog_description' => 'required',
            'blog_status' => 'required',
        ]);

        $blog = new Blog;
        $blog->blog_title = $request->blog_title;
        $blog->blog_category_name = $request->blog_category_name;
        $blog->blog_image_url = $request->blog_image_url;
        $blog->blog_description = $request->blog_description;
        $blog->blog_status = $request->blog_status;

        $position = strpos($request->photo, ';');
        $sub = substr($request->photo, 0, $position);
        $ext = explode('/', $sub)[1];

        $name = time() . "." . $ext;
        $img = Image::make($request->photo);
        $upload_path = 'backend/blog/';
        $image_url = $upload_path . $name;
        $img->save($image_url);

        $blog->blog_image_url = $image_url;
        $blog->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        return response()->json($blog);
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
        $data['blog_title'] = $request->blog_title;
        $data['blog_category_name'] = $request->blog_category_name;
        $data['blog_image_url'] = $request->blog_image_url;
        $data['blog_description'] = $request->blog_description;
        $data['blog_status'] = $request->blog_status;
        DB::table('blogs')->where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('blogs')->where('id', $id)->delete();
    }
}
