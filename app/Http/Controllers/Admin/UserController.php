<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function show($id)
    {
        $user = \App\Models\User::withCount('orders')->findOrFail($id);
        $orders = \App\Models\Order::where('user_id', $id)->latest()->take(10)->get();
        return view('admin.users.show', compact('user', 'orders'));
    }

    public function destroy($id)
    {
        \App\Models\User::findOrFail($id)->delete();
        toast('User deleted successfully!', 'success');
        return redirect()->route('admin.users.index');
    }
}
