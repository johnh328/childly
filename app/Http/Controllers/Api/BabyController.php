<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Model\Baby;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Image;

class BabyController extends Controller
{

    public function index()
    {
        $baby_name = Baby::all();
        return response()->json($baby_name);
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'baby_name' => 'required',
            'customer_id' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'is_selected' => 'required',
            'parent_name' => 'required',
        ]);

        $baby = new Baby;
        $baby->baby_name = $request->baby_name;
        $baby->customer_id = $request->customer_id;
        $baby->parent_name = $request->parent_name;
        $baby->gender = $request->gender;
        $baby->dob = $request->dob;
        $baby->is_selected = $request->is_selected;
        $image = $request->image_url;
        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time() . $request->customer_id . "." . $ext;
            $img = Image::make($image);
            $upload_path = 'backend/baby/';
            $image_url = $upload_path . $name;
            $img->save($image_url);
            $baby->image_url = $image_url;
        }
        $baby->save();
    }

    public function SelectedBaby(Request $request, $id)
    {
        $selectedBaby = DB::table('babies')
            ->where('customer_id', $id)
            ->where('is_selected', 'true')
            ->get();
        return response()->json($selectedBaby);
    }

    public function SelectBaby(Request $request, $id)
    {
        $data = array();
        $data['is_selected'] = $request->is_selected;
        DB::table('babies')->update(array('is_selected' => 'false'));
        DB::table('babies')->where('id', $id)->update($data);
        return response()->json(['Success' => 'Successfully updated'], 200);
    }


    public function show($id)
    {
        $babies = DB::table('babies')->where('customer_id', $id)->get();
        return response()->json($babies);
    }

    public function showBaby($id)
    {
        $baby = DB::table('babies')->where('id', $id)->first();
        return response()->json($baby);
    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['baby_name'] = $request->baby_name;
        $data['gender'] = $request->gender;
        $data['dob'] = $request->dob;
        $image = $request->image_url;
        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time() . $id . "." . $ext;
            $img = Image::make($image);
            $upload_path = 'backend/baby/';
            $image_url = $upload_path . $name;
            $success = $img->save($image_url);

            if ($success) {
                $img = DB::table('babies')->where('id', $id)->first();
                $image_path = $img->image_url;
                unlink($image_path);
                $data['image_url'] = $image_url;
                DB::table('babies')->where('id', $id)->update($data);
            }
        }
        DB::table('babies')->where('id', $id)->update($data);
        $baby = DB::table('babies')->where('id', $id)->get();
        return response()->json($baby, 200);
    }

    public function destroy($id)
    {
        $baby = DB::table('babies')->where('id', $id)->first();
        $photo = $baby->image_url;
        if ($photo) {
            unlink($photo);
            DB::table('babies')->where('id', $id)->delete();
        } else {
            DB::table('babies')->where('id', $id)->delete();
        }
    }
}
