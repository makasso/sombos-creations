<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.collections.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('admin.collections.create', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'products' => 'required|array',
        ]);

        $data['slug'] = str_replace([' ', '_'], '-', strtolower($request->name));


        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('collections', 'public');
        }

        DB::transaction(function () use ($data) {
            $collection = Collection::create($data);

            if ($data['products']) {
                $collection->products()->attach($data['products']);
            }
        });


        toast('Collection created successfully!', 'success');

        return redirect()->route('admin.collections.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $collection = Collection::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $collection = Collection::findOrFail($id);
        $products = Product::all();

        return view('admin.collections.edit', ['collection' => $collection, 'products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $collection = Collection::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'products' => 'nullable|array',
        ]);

        $data['slug'] = str_replace([' ', '_'], '-', strtolower($request->name));


        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('collections', 'public');
        }

        DB::transaction(function () use ($collection, $data) {
            $collection->update($data);

            if ($data['products']) {
                $collection->products()->sync($data['products']);
            }
        });



        toast('Collection updated successfully!', 'success');

        return redirect()->route('admin.collections.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $collection = Collection::findOrFail($id);
        $collection->delete();

        toast('Collection deleted successfully!', 'success');

        return redirect()->route('admin.collections.index');
    }
}
