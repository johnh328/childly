<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Model\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;


class OrderController extends Controller
{

  public function index()
  {
    $orders = DB::table('orders')
      ->join('customers', 'orders.customer_id', 'customers.id')
      ->select(
        'customers.name',
        'customers.email',
        'customers.phone',
        'orders.*'
      )->orderBy('created_at', 'DESC')
      ->get();
    return response()->json($orders);
  }




  public function store(Request $request)
  {
    $validateData = $request->validate([
      'customer_id' => 'required',
      'product_id' => 'required',
      'product_amount' => 'required',
      'address' => 'required',
      'online_payment_id' => 'required',
      'payment_mode' => 'required',
    ]);

    $order = new Order;
    $order->customer_id = $request->customer_id;
    $order->product_id = $request->product_id;
    $order->address = $request->address;

    $order->product_color = $request->product_color;
    $order->product_attribute = $request->product_attribute;
    $order->product_attribute_value = $request->product_attribute_value;

    $order->order_id = uniqid();

    $product_name = DB::table('products')->where('id', $request->product_id)->pluck('product_name')[0];
    $product_thumbnail = DB::table('products')->where('id', $request->product_id)->pluck('thumbnail_image')[0];
    $product_price = DB::table('products')->where('id', $request->product_id)->pluck('selling_price')[0];
    $product_code = DB::table('products')->where('id', $request->product_id)->pluck('product_code')[0];

    $order->product_name = $product_name;
    $order->product_thumbnail = $product_thumbnail;
    $order->product_price = $product_price;
    $order->product_code = $product_code;

    $quantity = DB::table('products')->where('id', $request->product_id)->pluck('product_quantity')[0];
    $remaining_quantity = (int)$quantity - (int)$request->product_amount;
    if ($remaining_quantity < 0) {
      return response()->json(['Error' => 'Insufficient quantity'], 400);
    }
    $rq = (string)$remaining_quantity;
    $data = array();
    $data['product_quantity'] = $rq;
    DB::table('products')->where('id', $request->product_id)->update($data);

    $order->product_amount = $request->product_amount;

    $price = DB::table('products')->where('id', $request->product_id)->pluck('selling_price')[0];
    $delivery_charge = DB::table('products')->where('id', $request->product_id)->pluck('delivery_charge')[0];
    $total_price = ((int)$price * (int)$request->product_amount) + $delivery_charge;
    $order->total_price = (string)$total_price;

    $sha = sha1(time());
    $order->invoice_id = $sha;

    $rnd = Str::random(12);
    $tracking_id = DB::table('orders')->where('tracking_id', 1)->pluck('tracking_id');
    if ($tracking_id == [] && $rnd == $tracking_id) {
      $rnd = Str::random(12);
    }
    $order->tracking_id = $rnd;

    $refundable_day = DB::table('products')->where('id', $request->product_id)->pluck('refundable_day')[0];
    if ($refundable_day) {
      $current_day = Carbon::today();
      $date = $current_day->addDays($refundable_day);
      $order->refundable_date = $date;
    }


    $order->payment_status = 'paid';
    $order->payment_mode = 'cash';
    $order->tracking_status = 'Ordered';
    $order->is_cancelled = 'false';
    $order->save();
  }



  public function show($id)
  {
    $orders = DB::table('orders')
      ->where('customer_id', $id)
      ->join('customers', 'orders.customer_id', 'customers.id')
      ->select(
        'customers.name',
        'customers.email',
        'customers.phone',
        'orders.*'
      )->orderBy('created_at', 'DESC')
      ->get();
    return response()->json($orders);
  }

  public function OrderById($id)
  {
    $orders = DB::table('orders')
      ->join('customers', 'orders.customer_id', 'customers.id')
      ->where('orders.id', $id)
      ->select(
        'customers.name',
        'customers.email',
        'customers.phone',
        'orders.*'
      )
      ->get();
    return response()->json($orders);
  }

  public function Refund()
  {
    $orders = DB::table('orders')
      ->join('customers', 'orders.customer_id', 'customers.id')
      ->where('tracking_status', 'refund')
      ->orWhere('tracking_status', 'returned')
      ->select(
        'customers.name',
        'customers.email',
        'customers.phone',
        'orders.*'
      )->orderBy('created_at', 'DESC')
      ->get();
    return response()->json($orders);
  }

  public function TotalSale()
  {
    $order = DB::table('orders')
      ->where('is_cancelled', 'false')
      ->sum('total_price');
    return response()->json($order);
  }

  public function TodayOrder()
  {
    $orders = DB::table('orders')
      ->join('customers', 'orders.customer_id', 'customers.id')
      ->select(
        'customers.email',
        'orders.*'
      )
      ->whereDate('orders.created_at', Carbon::today())
      ->latest()
      ->get();
    return response()->json($orders);
  }



  public function update(Request $request, $id)
  {
    $data = array();
    $data['tracking_status'] = $request->tracking_status;
    $data['is_cancelled'] = $request->is_cancelled;
    DB::table('orders')->where('id', $id)->update($data);
    return response()->json(['Success' => 'Updated Successfully'], 200);
  }

  public function destroy($id)
  {
    DB::table('orders')->where('id', $id)->delete();
  }
}
