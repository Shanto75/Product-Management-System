<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Product;
use App\Models\Settings;
use App\Models\User;
use App\Models\User_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class adminController extends Controller
{
    public function getuser()
    {
        $product = Product::with('user')->get();
        dd($product);
        // dd(User::all()->last()->id);
        // return view('admin.error');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }

    public function index()
    {
        $admin = User::where('type', 'admin')->count();
        $buyer = User::where('type', 'buyer')->count();
        $rider = User::where('type', 'rider')->count();
        $seller = User::where('type', 'seller')->count();
        $product = Product::count();
        $bid = Bid::count();
        return view('admin.dashbord', compact('admin', 'buyer', 'rider', 'seller', 'product', 'bid'));
    }

    public function profile()
    {
        $email = Auth::user()->email;
        $admins = User::where('email', $email)->with('user_details')->first();
        return view('admin.profile', compact('admins'));
    }

    public function userprofile($id)
    {
        $user = User::where('id', $id)->with('user_details')->first();
        return view('admin.user-profile', compact('user'));
    }

    public function edituser($id)
    {
        // $id = Auth::user()->id;
        $user = User::where('id', $id)->with('user_details')->first();
        return view('admin.edituser', compact('user'));
    }
    public function saveuser(Request $request, $id)
    {
        // dd($id);
        // dd($request->all());
        $request->validate([
            'type' => 'required|in:admin,seller,buyer,rider',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|min:6|max:12|confirmed',
            ]);
            $savepassword = User::where('id', $id)->update(['password' => Hash::make($request->password)]);
        }

        $saveuser = User::where('id', $id)->update($request->all(
            ['type', 'first_name', 'last_name', 'phone', 'email',]
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
        // if ($saveuser & $saveuser_details & $savephoto & $savepassword) {
        // } else {
        //     return redirect()->back()->with('error', 'Failed to Updated!');
        // }

        // return ['msg' => $save];
    }

    public function settings()
    {
        $settings = Settings::first();
        return view('admin.settings', compact('settings'));
    }

    public function savesettings(Request $request)
    {
        if (Settings::count() == 0) {
            $save = Settings::insert($request->all(
                ['name', 'email', 'phone', 'optional_phone', 'address', 'about']
            ));
            if (!empty($request->file('logo'))) {
                $settings = Settings::first();
                $photo = $request->file('logo');
                $photoname = 'logo' . '.' . $photo->extension();
                $photo->move(public_path('images/settings'), $photoname);
                $settings->logo = $photoname;
            }
        } else {
            $settings = Settings::first();
            $settings->name = $request->name;
            $settings->email = $request->email;
            $settings->phone = $request->phone;
            $settings->optional_phone = $request->optional_phone;
            $settings->address = $request->address;
            $settings->about = $request->about;

            if (!empty($request->file('logo'))) {
                $photo = $request->file('logo');
                $photoname = 'logo' . '.' . $photo->extension();
                $photo->move(public_path('images/settings'), $photoname);
                $settings->logo = $photoname;
            }
            $save = $settings->save();
        }


        return ['msg' => $save];
    }

    public function adduserindex()
    {
        return view('admin.adduser');
    }
    public function adduser(Request $request)
    {
        $request->validate([
            'type' => 'required|in:admin,seller,buyer,rider',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|numeric|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:12|confirmed',
        ]);

        $count = User::where('type', $request->type)->count();

        if ($request->type == 'admin') {
            $userserial = 100000 + $count + 1;
            $userid = 'A' . substr(date('Y'), -2) . 'U' . $userserial;
        } elseif ($request->type == 'seller') {
            $userserial = 100000 + $count + 1;
            $userid = 'S' . substr(date('Y'), -2) . 'U' . $userserial;
        } elseif ($request->type == 'buyer') {
            $userserial = 100000 + $count + 1;
            $userid = 'B' . substr(date('Y'), -2) . 'U' . $userserial;
        } elseif ($request->type == 'rider') {
            $userserial = 100000 + $count + 1;
            $userid = 'R' . substr(date('Y'), -2) . 'U' . $userserial;
        } else {
            return redirect('/admin/adduser')->with('error', 'Failed to add new user! Type of user is invalid.');
        }

        $user = new User;
        $user->user_id = $userid;
        $user->type = $request->type;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = $request->password;
        $save = $user->save();

        $User_details = new User_details;
        $User_details->optional_phone = $request->optional_phone;
        $User_details->gender = $request->gender;
        $User_details->division = $request->division;
        $User_details->district = $request->district;
        $User_details->thana_upazila = $request->thana_upazila;
        $User_details->address = $request->address;
        $User_details->user_id = $user->id;

        if (!empty($request->file('img'))) {
            $photo = $request->file('img');
            $photoname = time() . '.' . $photo->extension();
            $photo->move(public_path('images/user'), $photoname);
            $User_details->img = $photoname;
        }
        $save = $User_details->save();

        if ($save) {
            return redirect('/admin/adduser')->with('success', 'New User Created!');
        } else {
            return redirect('/admin/adduser')->with('error', 'Failed to add new user!');
        }
    }

    public function adminlist()
    {
        $type = 'Admin';
        $users = User::where('type', 'admin')->with('user_details')->orderBy('created_at', 'DESC')->get();
        return view('admin.userlist', compact('users', 'type'));
    }
    public function sellerlist()
    {
        $type = 'Seller';
        $users = User::where('type', 'seller')->with('user_details')->orderBy('created_at', 'DESC')->get();
        return view('admin.userlist', compact('users', 'type'));
    }
    public function buyerlist()
    {
        $type = 'Buyer';
        $users = User::where('type', 'buyer')->with('user_details')->orderBy('created_at', 'DESC')->get();
        return view('admin.userlist', compact('users', 'type'));
    }
    public function riderlist()
    {
        $type = 'Rider';
        $users = User::where('type', 'rider')->with('user_details')->orderBy('created_at', 'DESC')->get();
        return view('admin.userlist', compact('users', 'type'));
    }

    public function deleteuser($id)
    {
        $deleteuser = User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'User Deleted Successfully!');
    }

    public function bid()
    {
        $bids = Bid::with('product', 'user', 'bid_list')->get();
        // dd($bids);
        return view('admin.bid', compact('bids'));
    }

    public function product()
    {
        $products = Product::with('user', 'bid')->get();
        // dd($products);
        return view('admin.product-list', compact('products'));
    }
}
