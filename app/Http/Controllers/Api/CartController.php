<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Model\Cart;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
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
            'product_id' => 'required',
            'product_amount' => 'required',
        ]);

        $customer_id = DB::table('carts')->where('customer_id', $request->customer_id)->get();
        $product_id = DB::table('carts')->where('product_id', $request->product_id)->get();

        if (sizeof($customer_id) == 0 or sizeof($product_id) == 0) {
            $cart = new Cart;
            $cart->customer_id = $request->customer_id;
            $cart->product_id = $request->product_id;
            $cart->product_amount = $request->product_amount;
            $cart->product_color = $request->product_color;
            $cart->product_attribute = $request->product_attribute;
            $cart->product_attribute_value = $request->product_attribute_value;
            $cart->save();
            return response()->json(['Success' => 'Successfully added'], 200);
        } else {
            return response()->json(['Error' => "Already Exist"], 400);
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
        $cart = DB::table('carts')
            ->join('customers', 'carts.customer_id', 'customers.id')
            ->join('products', 'carts.product_id', 'products.id')
            ->select(
                'products.product_name',
                'products.product_price',
                'products.selling_price',
                'products.delivery_charge',
                'products.thumbnail_image',
                'products.product_quantity',
                'products.free_shipping',
                'carts.*'
            )
            ->get();
        return response()->json($cart);
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
        $data['product_amount'] = $request->product_amount;
        DB::table('carts')->where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('carts')->where('id', $id)->delete();
        return response()->json(['Success' => 'Successfully deleted'], 200);
    }
}
