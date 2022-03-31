<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Model\Customer;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = DB::table('customers')->orderBy('id', 'DESC')->get();
        return response()->json($customer);
    }

    public function TodayCustomer()
    {
        $customer = DB::table('customers')->whereDate('created_at', Carbon::today())->get();
        return response()->json($customer);
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
            'name' => 'required|unique:customers|max:255',
            'email' => 'required|unique:customers',
            'phone' => 'required|unique:customers',

            'parent' => 'required',

            'billing_name' => 'required',
            'billing_country' => 'required',
            'billing_state' => 'required',
            'billing_city' => 'required',
            'billing_address' => 'required',
            'billing_phone' => 'required',
            'billing_zip_code' => 'required',

            'shipping_name' => 'required',
            'shipping_country' => 'required',
            'shipping_state' => 'required',
            'shipping_city' => 'required',
            'shipping_address' => 'required',
            'shipping_phone' => 'required',
            'shipping_zip_code' => 'required',
        ]);

        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time() . "." . $ext;
            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'images/customer/';
            $image_url = $upload_path . $name;
            $img->save($image_url);

            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->currency = $request->currency;
            $customer->register_on = Carbon::now()->toDateString();
            $customer->photo = $image_url;

            $customer->parent = $request->parent;

            $customer->billing_name = $request->billing_name;
            $customer->billing_country = $request->billing_country;
            $customer->billing_state = $request->billing_state;
            $customer->billing_city = $request->billing_city;
            $customer->billing_address = $request->billing_address;
            $customer->billing_phone = $request->billing_phone;
            $customer->billing_zip_code = $request->billing_zip_code;

            $customer->shipping_name = $request->shipping_name;
            $customer->shipping_country = $request->shipping_country;
            $customer->shipping_state = $request->shipping_state;
            $customer->shipping_city = $request->shipping_city;
            $customer->shipping_address = $request->shipping_address;
            $customer->shipping_phone = $request->shipping_phone;
            $customer->shipping_zip_code = $request->shipping_zip_code;

            $customer->save();
        } else {
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->register_on = Carbon::now()->toDateString();

            $customer->parent = $request->parent;

            $customer->billing_name = $request->billing_name;
            $customer->billing_country = $request->billing_country;
            $customer->billing_state = $request->billing_state;
            $customer->billing_city = $request->billing_city;
            $customer->billing_address = $request->billing_address;
            $customer->billing_phone = $request->billing_phone;
            $customer->billing_zip_code = $request->billing_zip_code;

            $customer->shipping_name = $request->shipping_name;
            $customer->shipping_country = $request->shipping_country;
            $customer->shipping_state = $request->shipping_state;
            $customer->shipping_city = $request->shipping_city;
            $customer->shipping_address = $request->shipping_address;
            $customer->shipping_phone = $request->shipping_phone;
            $customer->shipping_zip_code = $request->shipping_zip_code;

            $customer->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = DB::table('customers')->where('id', $id)->first();
        return response()->json($customer);
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
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['parent'] = $request->parent;
        $data['billing_name'] = $request->billing_name;
        $data['billing_country'] = $request->billing_country;
        $data['billing_state'] = $request->billing_state;
        $data['billing_city'] = $request->billing_city;
        $data['billing_address'] = $request->billing_address;
        $data['billing_phone'] = $request->billing_phone;
        $data['billing_zip_code'] = $request->billing_zip_code;

        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_country'] = $request->shipping_country;
        $data['shipping_state'] = $request->shipping_state;
        $data['shipping_city'] = $request->shipping_city;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_zip_code'] = $request->shipping_zip_code;
        $user = DB::table('customers')->where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = DB::table('customers')->where('id', $id)->first();
        DB::table('customers')->where('id', $id)->delete();
    }
}
