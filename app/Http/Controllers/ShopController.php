<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $collections = Collection::all();
        $tags = Tag::has('products')->get();

        // Start with all products
        $products = Product::query()->with('reviews');

        // Filter by category (support both 'category' and 'category_id' params for consistency)
        $categoryParam = $request->category ?? $request->category_id;
        if ($categoryParam && $categoryParam != 'all') {
            $products->where('category_id', $categoryParam);
        }

        // Filter by collection if a collection is selected
        if ($request->has('collection') && $request->collection != 'all') {
            $products->whereHas('collections', function ($query) use ($request) {
                $query->where('collections.slug', $request->collection);
            });
        }

        // Filter by tag
        if ($request->has('tag') && $request->tag != 'all') {
            $products->whereHas('tags', function ($query) use ($request) {
                $query->where('tags.slug', $request->tag);
            });
        }

        // Filter by attribute values
        if ($request->has('attribute')) {
            $attributeFilters = $request->attribute;
            if (is_array($attributeFilters)) {
                foreach ($attributeFilters as $attributeName => $value) {
                    $products->whereHas('attributes', function ($query) use ($value) {
                        $query->where('attribute_values.value', $value);
                    });
                }
            }
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $products->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $products->where('price', '<=', $request->max_price);
        }

        // Filter by availability
        if ($request->has('availability')) {
            if ($request->availability === 'in_stock') {
                $products->where('stock', '>', 0);
            } elseif ($request->availability === 'out_of_stock') {
                $products->where('stock', '<=', 0);
            }
        }

        // Sorting
        switch ($request->get('sort')) {
            case 'a-z':
                $products->orderBy('name', 'asc');
                break;
            case 'z-a':
                $products->orderBy('name', 'desc');
                break;
            case 'price-low-high':
                $products->orderBy('price', 'asc');
                break;
            case 'price-high-low':
                $products->orderBy('price', 'desc');
                break;
            case 'best-selling':
                $products->withCount(['orderItems as total_sold' => function ($query) {
                    $query->select(\DB::raw('SUM(quantity)'));
                }])->orderBy('total_sold', 'desc');
                break;
            case 'date-old-new':
                $products->orderBy('created_at', 'asc');
                break;
            default:
                $products->latest();
                break;
        }

        $inStockCount = (clone $products)->where('stock', '>', 0)->count();
        $outOfStockCount = (clone $products)->where('stock', '<=', 0)->count();

        // Paginate the results
        $products = $products->paginate(12)->appends($request->query());

        return view('shop', [
            'products' => $products,
            'categories' => $categories,
            'collections' => $collections,
            'tags' => $tags,
            'inStockCount' => $inStockCount,
            'outOfStockCount' => $outOfStockCount,
        ]);
    }


    public function collections()
    {
        return view('collections', [
            'collections' => Collection::latest()->paginate(12),
        ]);
    }
}
