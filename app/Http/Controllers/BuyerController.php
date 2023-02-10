<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Bid_list;
use App\Models\Product;
use App\Models\User;
use App\Models\User_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class BuyerController extends Controller
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
        return view('buyer.dashbord');
    }

    public function profile()
    {
        $email = Auth::user()->email;
        $user = User::where('email', $email)->with('user_details')->first();
        return view('buyer.user-profile', compact('user'));
    }

    public function editprofile()
    {
        $user = User::find(Auth::user()->id);
        return view('buyer.edituser', compact('user'));
    }
    public function saveprofile(Request $request)
    {
        // dd($id);
        // dd($request->all());
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
        ]);

        $user = User::with('user_details')->find(Auth::user()->id);
        // $user_details = User_details::where('user_id',Auth::user()->id)->first();

        // dd($user);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|min:6|max:12|confirmed',
            ]);
            $user->update(['password' => Hash::make($request->password)]);
        }

        $user->update($request->all(
            ['first_name', 'last_name', 'phone', 'email',]
        ));

        $user->user_details->update($request->all(
            ['gender', 'division', 'district', 'thana_upazila', 'address',]
        ));

        if (!empty($request->file('img'))) {
            if (file_exists('images/user/' . $user->user_details->img)) {
                @unlink('images/user/' . $user->user_details->img);
            }

            $photo = $request->file('img');
            $photoname = time() . '.' . $photo->extension();
            $photo->move(public_path('images/user'), $photoname);
            $user->user_details->update(['img' => $photoname]);
        }

        $save = $user->save();
        if($save){return redirect()->back()->with('success', 'Saved Successfully!');}
        else return redirect()->back()->with('error', 'Faild to Saved!');
    }

    public function buyproduct()
    {
        $products = Bid::where('sold',0)->with('product')->get();
        return view('buyer.buy-product', compact('products'));
    }

    public function get_product_details($id)
    {
        $product = Product::where('id',$id)->with('user')->first();
        return ['product' => $product];
    }

    public function bid_product(Request $request)
    {
        $bid = Bid::where('id',$request->bidId)->first();
        $bid_list = new Bid_list;
        $bid_list->bid_id = $bid->id;
        $bid_list->user_id = Auth::user()->id;
        $bid_list->bid_amount = $request->bid_amount;
        $save = $bid_list->save();

        if($save){return response()->json(array('msg'=> 'Bid Successfull'), 200);}
        else { return response()->json(array('msg'=> 'Failed to bid!!'), 404);}
    }

    public function mybid(){
        $bid_lists = Bid_list::where('user_id',Auth::user()->id)->with('bid')->get();
        // $bid = Bid::join('bid_lists', 'bids.id', '=', 'bid_lists.bid_id')
        //        ->get(['bids.*', 'bid_lists.bid_amount']);

        // dd($bid_lists);
        return view('buyer.my-bid', compact('bid_lists'));
    }
    public function deletemybid($id){
        $delete = Bid_list::where('id',$id)->delete();
        if($delete){return redirect()->back()->with('success', 'Deleted Successfully!');}
        else return redirect()->back()->with('error', 'Faild to Delete!');
    }
}
