<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Model\Review;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;



class ReviewController extends Controller
{

  public function index()
  {
  }




  public function store(Request $request)
  {
    $validateData = $request->validate([
      'customer_id' => 'required',
      'product_id' => 'required',
      'rating' => 'required',
    ]);

    if (
      Review::where('customer_id', '=', $request->customer_id)->exists() !=
      Review::where('product_id', '=', $request->product_id)->exists()
      || !Review::where('customer_id', '=', $request->customer_id)->exists()
    ) {
      $review = new Review;
      $review->customer_id = $request->customer_id;
      $review->product_id = $request->product_id;
      $review->rating = $request->rating;
      $review->review = $request->review;
      $review->save();
      $avg = Review::where('product_id', $request->product_id)->avg('rating');
      DB::table('products')->where('id', $request->product_id)->update(array('product_review' => $avg));
      return response()->json(['Success' => 'Successfully added'], 200);
    } else {
      return response()->json(['Error' => 'Already exist'], 404);
    }
  }


  public function show($id)
  {
    // $reviews = DB::table('reviews')->where('product_id', $id)->get();
    $reviews = DB::table('reviews')
      ->join('customers', 'reviews.customer_id', 'customers.id')
      ->select(
        'customers.name',
        'reviews.*',
      )
      ->where('product_id', $id)
      ->get();
    return response()->json($reviews);
  }


  public function update(Request $request, $id)
  {
    $data = array();
    $data['rating'] = $request->rating;
    $data['review'] = $request->review;
    DB::table('reviews')->where('customer_id', $id)->update($data);
    $avg = Review::where('product_id', $request->product_id)->avg('rating');
    DB::table('products')->where('id', $request->product_id)->update(array('product_review' => $avg));
  }

  public function destroy($id)
  {
    DB::table('reviews')->where('customer_id', $id)->delete();
  }
}
