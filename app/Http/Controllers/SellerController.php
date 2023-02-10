<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Bid_list;
use App\Models\Product;
use App\Models\User;
use App\Models\User_details;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SellerController extends Controller
{
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }

    public function index()
    {
        // $admin = User::where('type', 'admin')->count();
        // $buyer = User::where('type', 'buyer')->count();
        // $rider = User::where('type', 'rider')->count();
        // $seller = User::where('type', 'seller')->count();
        return view('seller.dashbord');
    }

    public function profile()
    {
        $email = Auth::user()->email;
        $user = User::where('email', $email)->with('user_details')->first();
        return view('seller.user-profile', compact('user'));
    }

    public function editprofile()
    {
        $email = Auth::user()->email;
        $user = User::where('email', $email)->with('user_details')->first();
        return view('seller.edit-profile', compact('user'));
    }
    public function saveprofile(Request $request)
    {
        // dd($request->all());
        $id = Auth::user()->id;
        $user = User::find(Auth::user()->id);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'img' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);
        if($user->email !== $request->email){
            $request->validate(['email' => 'required|email|unique:users']);
        }
        if($user->phone !== $request->phone){
            $request->validate(['phone' => 'required|numeric|unique:users']);
        }

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|min:6|max:12|confirmed',
            ]);
            $savepassword = User::where('id', $id)->update(['password' => Hash::make($request->password)]);
        }

        $saveuser = User::where('id', $id)->update($request->all(
            ['first_name', 'last_name', 'phone', 'email',]
        ));

        $saveuser_details = User_details::where('user_id', $id)->update($request->all(
            ['gender', 'division', 'district', 'thana_upazila', 'address',]
        ));

        if (!empty($request->file('img'))) {
            $user_detals = User_details::where('user_id', $id)->first();
            if (file_exists('images/user/' . $user_detals->img)) {
                @unlink('images/user/' . $user_detals->img);
            }

            $photo = $request->file('img');
            $photoname = time() . '.' . $photo->extension();
            $photo->move(public_path('images/user'), $photoname);
            $savephoto = User_details::where('user_id', $id)->update(['img' => $photoname]);
        }

        return redirect()->back()->with('success', 'Updated Successfully!');
    }

    public function addproduct(){
        return view('seller.add-product');
    }
    public function saveproduct(Request $request){
        $request->validate([
            'product_name' => 'required|max:255',
            'details' => 'required',
            'quantity' => 'required',
            'price_start' => 'required',
            'price_end' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $product = new Product;

        if (!empty($request->file('image'))) {
            $photo = $request->file('image');
            $photoname = time() . '.' . $photo->extension();
            $photo->move(public_path('images/product'), $photoname);
            $product->image = $photoname;
        }

        if(Product::count() > 0 ){$product->product_id = 'P-0'.Product::all()->last()->id+1;}
        else{$product->product_id = 'P-01';}

        $product->user_id = auth()->user()->id;
        $product->product_name = $request->product_name;
        $product->details = $request->details;
        $product->quantity = $request->quantity;
        $product->price_start = $request->price_start;
        $product->price_end = $request->price_end;
        $product->production_start = $request->production_start;
        $product->production_end = $request->production_end;
        $product->total_produced = $request->total_produced;
        $product->production_cost = $request->production_cost;
        $save = $product->save();

        if($save){return redirect()->back()->with('success', 'Saved Successfully!');}
        else return redirect()->back()->with('error', 'Faild to Saved!');
    }

    public function productlist(){
        $products = Product::where('user_id', auth()->user()->id)->get();
        return view('seller.product-list', compact('products'));
    }
    public function viewproduct($id){
        $product = Product::find($id);
        // dd($product);
        return view('seller.view-product', compact('product'));
    }

    public function editproduct($id){
        $product = Product::find($id);
        return view('seller.edit-product', compact('product'));
    }

    public function deleteproduct($id){
        $delete = Product::find($id)->delete();
        if($delete){return redirect()->back()->with('success', 'Deleted Successfully!');}
        else return redirect()->back()->with('error', 'Faild to Delete!');
    }

    public function update(Request $request, $id){
        $request->validate([
            'product_name' => 'required|max:255',
            'details' => 'required',
            'quantity' => 'required',
            'price_start' => 'required',
            'price_end' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
            'status' => 'in:0,1',
        ]);

        $product = Product::find($id);

        if (!empty($request->file('image'))) {
            if (file_exists('images/product/' . $product->image)) {
                @unlink('images/product/' . $product->image);
            }
            $photo = $request->file('image');
            $photoname = time() . '.' . $photo->extension();
            $photo->move(public_path('images/product'), $photoname);
            $product->image = $photoname;
        }
        $update = $product->update($request->only(
            ['product_name','details','quantity','price_start','price_end','status','sold_price','production_start','production_end','sold_date','total_produced','production_cost']));
        
        if($update){return redirect()->back()->with('success', 'Updated Successfully!');}
        else return redirect()->back()->with('error', 'Faild to update!');
    }

    public function getbids(){
        $bids = Bid::where('user_id', Auth::user()->id)->with('product')->get();
        return view('seller.bid', compact('bids'));
    }

    public function bid(Request $request){
        $product = Product::find($request->bidId);
        if( !empty($product) ){
            $bid = new Bid;
            $bid->product_id = $product->id;
            $bid->user_id = Auth::user()->id;
            $bid->product_name = $product->product_name;
            $bid->details = $product->details;
            $bid->quantity = $product->quantity;
            $bid->price_start = $product->price_start;
            $bid->price_end = $product->price_end;
            $bid->bid_start = $request->bid_start;
            $bid->bid_end = $request->bid_end;
            $save = $bid->save();

            if($save){return response()->json(array('msg'=> 'Successfully set for bidding'), 200);}
            else { return response()->json(array('msg'=> 'Failed to set bidding!!'), 404);}
        }
        else{
            return response()->json(array('msg'=> 'Product Do Not Exist!!'), 404);
        }
    }

    public function view_bids($id){
        $bid_list = Bid_list::where('bid_id', $id)->get();
        return response()->json(array('bid_list'=> $bid_list), 200);
    }
}
