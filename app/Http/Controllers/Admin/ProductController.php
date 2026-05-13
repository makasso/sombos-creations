<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {

        return view('admin.products.index');
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['slug'] = str_replace([' ', '_'], '-', strtolower($request->name));

        $product = Product::create($data);

        if ($request->has('gallery_images')) {
            foreach ($request->gallery_images as $gallery_image) {
                $image_path = $gallery_image->store("products/product-$product->id/gallery_images", 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $image_path,
                ]);
            }
        }

        toast('Product created successfully!', 'success');

        return redirect()->route('admin.products.index');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $images = ProductImage::where('product_id', $id)->get();

        $categories = Category::all();
        return view('admin.products.edit', ['product' => $product, 'categories' => $categories, 'images' => $images]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['slug'] = str_replace([' ', '_'], '-', strtolower($request->name));

        Product::where('id', $id)->update($data);

        if ($request->has('gallery_images')) {
            foreach ($request->gallery_images as $gallery_image) {
                $image_path = $gallery_image->store("products/product-$id/gallery_images", 'public');

                ProductImage::create([
                    'product_id' => $id,
                    'image_url' => $image_path,
                ]);
            }
        }

        toast('Product updated successfully!', 'success');

        return redirect()->route('admin.products.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        toast('Product deleted successfully!', 'success');

        return redirect()->route('admin.products.index');
    }

    public function deleteImage($id)
    {
        $productImage = ProductImage::findOrFail($id)->delete();

        Storage::delete($productImage->image_url);

        toast('Product image deleted successfully!', 'success');
    }

}
