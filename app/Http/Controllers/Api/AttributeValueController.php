<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Model\AttributeValue;
use Illuminate\Support\Facades\DB;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attribute_value = AttributeValue::all();
        return response()->json($attribute_value);
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
            'attribute_value' => 'required|max:255',
            'attribute_id' => 'required',
        ]);

        $attribute_value = new AttributeValue;
        $attribute_value->attribute_value = $request->attribute_value;
        $attribute_value->attribute_id = $request->attribute_id;
        $attribute_value->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $attribute_values = DB::table('attribute_values')->where('attribute_id', $id)->get();
        return response()->json($attribute_values);
    }

    public function showAttribute($id)
    {
        $attribute_values = DB::table('attribute_values')->where('id', $id)->first();
        return response()->json($attribute_values);
    }

    public function showAttributeByName($name)
    {
        $id = DB::table('attributes')->where('attribute_name', $name)->pluck('id')[0];
        $attribute_values = DB::table('attribute_values')->where('attribute_id', $id)->get();
        return response()->json($attribute_values);
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
        $data['attribute_value'] = $request->attribute_value;
        DB::table('attribute_values')->where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('attribute_values')->where('id', $id)->delete();
    }
}
