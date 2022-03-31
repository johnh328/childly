<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Image;

class CostumersController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['signIn', 'signUp', 'refresh']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function signIn(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = request(['email', 'password']);

        if (!$token = auth('customers')->attempt($credentials)) {
            return response()->json(['error' => 'Incorrect email or password'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function signUp(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|unique:customers|max:255',
            'name' => 'required',
            'phone' => 'required',
            'password' => 'required|min:6',
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $register_on = $request->register_on = Carbon::now()->toDateString();
        $data['register_on'] = $register_on;
        $data['password'] = Hash::make($request->password);
        DB::table('customers')->insert($data);

        return $this->signIn($request);
    }

    public function updateProfile(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required|min:6',
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['parent'] = $request->parent;
        $data['password'] = Hash::make($request->password);
        $image = $request->image_url;
        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = $id . "." . $ext;
            $img = Image::make($image);
            $upload_path = 'backend/customer/';
            $image_url = $upload_path . $name;
            $img->save($image_url);
            $data['image_url'] = $image_url;
        }
        DB::table('customers')->where('id', $id)->update($data);
        $customer = DB::table('customers')->select('name', 'email', 'phone', 'image_url', 'parent')
            ->where('id', $id)
            ->get();
        return response()->json($customer, 200);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function signOut()
    {
        auth()->logout();

        return response()->json(['success' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('customers')->refresh());
    }



    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'name' => auth('customers')->user()->name,
            'customer_id' => auth('customers')->user()->id,
            'email' => auth('customers')->user()->email,
            'phone' => auth('customers')->user()->phone,
            'image_url' => auth('customers')->user()->image_url,
            'parent' => auth('customers')->user()->parent,
        ]);
    }
}
