<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Model\Wishlist;
use Illuminate\Support\Facades\DB;


class WishlistController extends Controller
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
        ]);

        $customer_id = DB::table('wishlists')->where('customer_id', $request->customer_id)->get();
        $product_id = DB::table('wishlists')->where('product_id', $request->product_id)->get();

        if (sizeof($customer_id) == 0 or sizeof($product_id) == 0) {
            $wishlist = new Wishlist;
            $wishlist->customer_id = $request->customer_id;
            $wishlist->product_id = $request->product_id;
            $wishlist->save();
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
        $cart = DB::table('wishlists')
            ->join('customers', 'wishlists.customer_id', 'customers.id')
            ->join('products', 'wishlists.product_id', 'products.id')
            ->select(
                'products.product_name',
                'products.product_price',
                'products.selling_price',
                'products.product_quantity',
                'products.thumbnail_image',
                'wishlists.*'
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        DB::table('wishlists')
            ->where('customer_id', $request->customer_id)
            ->where('product_id', $id)->delete();
        return response()->json(['Success' => 'Successfully deleted'], 200);
    }
}
