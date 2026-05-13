<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        return view('my-account.index');
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())->with('items.product', 'payments')->latest()->get();

        return view('my-account.orders', ['orders' => $orders]);
    }

    public function orderDetails($id)
    {
        $order = Order::with(['items.product', 'payments', 'couponUsages'])->where('user_id', Auth::id())->findOrFail($id);

        return view('my-account.order-details', ['order' => $order]);
    }

    public function accountDetails()
    {
        return view('my-account.account-details');
    }

    public function accountDetailsUpdate(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);
        $user = Auth::user();

        // Only update password if new_password is provided
        if (!empty($data['new_password'])) {
            if (!Hash::check($data['current_password'], $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
            $data['password'] = Hash::make($data['new_password']);
        }

        // Remove password-related fields from data before update
        unset($data['current_password'], $data['new_password'], $data['new_password_confirmation']);

        $user->update($data);

        toast('Account details updated successfully');
        return redirect()->back();
    }

    public function address()
    {
        return view('my-account.address');
    }

    public function wishlist()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->with('product')->paginate(3);

        return view('my-account.wishlist', ['wishlists' => $wishlists]);
    }
}
