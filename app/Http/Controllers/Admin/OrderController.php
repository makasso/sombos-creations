<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders.index');
    }

    public function show($id)
    {
        $order = \App\Models\Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $request->validate([
            'status'         => 'required|in:pending,processing,shipped,completed,cancelled',
            'payment_status' => 'required|in:pending,paid,failed,refunded',
        ]);

        \App\Models\Order::where('id', $id)->update([
            'status'         => $request->status,
            'payment_status' => $request->payment_status,
        ]);

        toast('Order updated successfully!', 'success');
        return redirect()->route('admin.orders.show', $id);
    }

    public function destroy($id)
    {
        \App\Models\Order::findOrFail($id)->delete();
        toast('Order deleted successfully!', 'success');
        return redirect()->route('admin.orders.index');
    }
}
