<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Model\Address;
use Illuminate\Support\Facades\DB;


class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            'customer_id' => 'required',
            'name' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'zip_code' => 'required',
            'address' => 'required',
            'is_selected' => 'required',
            'is_home' => 'required',
        ]);

        $address = new Address;
        $address->customer_id = $request->customer_id;
        $address->name = $request->name;
        $address->country = $request->country;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->phone = $request->phone;
        $address->zip_code = $request->zip_code;
        $address->address = $request->address;
        $address->is_selected = $request->is_selected;
        $address->is_home = $request->is_home;
        $address->save();
        return response()->json(['Success' => 'Successfully added'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = DB::table('addresses')
            ->where('customer_id', $id)
            ->get();
        return response()->json($address);
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
        $data['name'] = $request->name;
        $data['country'] = $request->country;
        $data['state'] = $request->state;
        $data['city'] = $request->city;
        $data['phone'] = $request->phone;
        $data['zip_code'] = $request->zip_code;
        $data['address'] = $request->address;
        $data['is_home'] = $request->is_home;
        DB::table('addresses')->where('id', $id)->update($data);
        $address = DB::table('addresses')->where('id', $id)->get();
        return response()->json($address, 200);
    }

    public function SelectAddress(Request $request, $id)
    {
        $data = array();
        $data['is_selected'] = $request->is_selected;
        DB::table('addresses')->update(array('is_selected' => 'false'));
        DB::table('addresses')->where('id', $id)->update($data);
        return response()->json(['Success' => 'Successfully updated'], 200);
    }

    public function SelectedAddress(Request $request, $id)
    {
        $selectedAddress = DB::table('addresses')
            ->where('customer_id', $id)
            ->where('is_selected', 'true')
            ->get();
        return response()->json($selectedAddress);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('addresses')->where('id', $id)->delete();
        return response()->json(['Success' => 'Successfully deleted'], 200);
    }
}
