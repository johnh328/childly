<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Model\Product;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('sub_categories', 'products.sub_category_id', 'sub_categories.id')
            ->join('suppliers', 'products.supplier_id', 'suppliers.id')
            ->select('categories.category_name', 'suppliers.name', 'sub_categories.sub_category_name', 'suppliers.name', 'products.*')
            ->orderBy('products.id', 'DESC')
            ->get();
        return response()->json($product);
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
            'product_name' => 'required|max:255',
            'product_code' => 'required|unique:products|max:255',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'supplier_id' => 'required',
            'product_price' => 'required',
            'selling_price' => 'required',
            'product_quantity' => 'required',
            'free_shipping' => 'required',
            'refundable' => 'required',
            'cash_on_delivery' => 'required',
            'product_description' => 'required',
            'product_more_info' => 'required',
        ]);

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->delivery_charge = $request->delivery_charge;
        $product->sub_category_id = $request->sub_category_id;
        $product->product_name = $request->product_name;
        $product->brand_name = $request->brand_name;
        $product->product_code = $request->product_code;
        $product->product_price = $request->product_price;
        $product->selling_price = $request->selling_price;
        $product->supplier_id = $request->supplier_id;
        $product->product_quantity = $request->product_quantity;
        $product->free_shipping = $request->free_shipping;
        $product->refundable = $request->refundable;
        $product->cash_on_delivery = $request->cash_on_delivery;
        $product->product_description = $request->product_description;
        $product->product_more_info = $request->product_more_info;
        $product->product_attribute = $request->attribute_name;
        $product->product_attribute_value = $request->product_attribute_value;
        $product->product_color = $request->product_color;
        $product->return_detail = $request->return_detail;
        $product->refundable_day = $request->refundable_day;

        $position = strpos($request->photo, ';');
        $sub = substr($request->photo, 0, $position);
        $ext = explode('/', $sub)[1];

        $name = time() . "." . $ext;
        $img = Image::make($request->photo);
        $upload_path = 'backend/product/thumbnail/';
        $image_url = $upload_path . $name;
        $img->save($image_url);

        $product->thumbnail_image = $image_url;

        $images = array();


        foreach ((array) $request->photos as $file) {
            $position = strpos($file, ';');
            $sub = substr($file, 0, $position);
            $ext = explode('/', $sub)[1];

            $safeName = Str::random(10) . '.' . $ext;
            $img = Image::make($file);
            $upload_path = 'backend/product/product_images/';
            $image_urls = $upload_path . $safeName;
            $img->save($image_urls);
            $images[] = $image_urls;
            $product->product_images = $images;
        }

        $product->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::table('products')->where('id', $id)->get();
        return response()->json($product);
    }

    public function ShowByCategory($id)
    {
        $product = DB::table('products')->where('sub_category_id', $id)->get();
        return response()->json($product);
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
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['brand_name'] = $request->brand_name;
        $data['category_id'] = $request->category_id;
        $data['sub_category_id'] = $request->sub_category_id;
        $data['supplier_id'] = $request->supplier_id;
        $data['product_price'] = $request->product_price;
        $data['selling_price'] = $request->selling_price;
        $data['product_quantity'] = $request->product_quantity;
        $data['free_shipping'] = $request->free_shipping;
        $data['product_more_info'] = $request->product_more_info;
        $data['refundable'] = $request->refundable;
        $data['cash_on_delivery'] = $request->cash_on_delivery;
        $data['product_description'] = $request->product_description;
        $data['product_attribute'] = $request->product_attribute;
        $data['product_attribute_value'] = $request->product_attribute_value;
        $data['product_color'] = $request->product_color;
        $data['return_detail'] = $request->return_detail;
        $data['delivery_charge'] = $request->delivery_charge;
        $data['refundable_day'] = $request->refundable_day;
        $image = $request->new_thumbnail_image;
        $photos = $request->new_photos;

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time() . "." . $ext;
            $img = Image::make($image);
            $upload_path = 'backend/product/thumbnail/';
            $image_url = $upload_path . $name;
            $success = $img->save($image_url);

            if ($success) {
                $data['thumbnail_image'] = $image_url;
                $img = DB::table('products')->where('id', $id)->first();
                $image_path = $img->thumbnail_image;
                unlink($image_path);
                DB::table('products')->where('id', $id)->update($data);
            }
        }
        if ($photos) {
            foreach ((array) $request->new_photos as $file) {
                $position = strpos($file, ';');
                $sub = substr($file, 0, $position);
                $ext = explode('/', $sub)[1];

                $safeName = Str::random(10) . '.' . $ext;
                $img = Image::make($file);
                $upload_path = 'backend/product/product_images/';
                $image_urls = $upload_path . $safeName;
                $success = $img->save($image_urls);
                $images[] = $image_urls;
                $data['product_images'] = $images;
                if ($success) {
                    $data['product_images'] = $images;
                    $img = DB::table('products')->where('id', $id)->first();
                    $image_path = $img->product_images;
                    if (file_exists($image_path[0])) unlink($image_path);
                    // unlink(json_decode($image_path)[0]);
                    // DB::table('products')->where('id', $id)->update($data);
                }
            }
        }
        DB::table('products')->where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        DB::table('products')->where('id', $id)->delete();
        DB::table('carts')->where('product_id', $id)->delete();
        DB::table('wishlists')->where('product_id', $id)->delete();
        DB::table('reviews')->where('product_id', $id)->delete();
        $photo = $product->thumbnail_image;
        $images = $product->product_images;
        if ($photo) {
            unlink($photo);
            DB::table('products')->where('id', $id)->delete();
        }
        foreach (json_decode($images, true) as $image) {
            unlink($image);
        }
        // else {
        //     DB::table('products')->where('id', $id)->delete();
        // }
    }



    public function StockUpdate(Request $request, $id)
    {

        $data = array();
        $data['product_quantity'] = $request->product_quantity;
        DB::table('products')->where('id', $id)->update($data);
    }

    public function ProductSearch(Request $request)
    {

        $query = $request->get('query');
        $filterResult = Product::where('product_name', 'LIKE', '%' . $query . '%')->get();
        return response()->json($filterResult, 200);
    }
}
