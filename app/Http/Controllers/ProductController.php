<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Search by keyword
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . trim($request->search) . '%');
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Sort by effective price or date
        if ($request->filled('sort')) {
            if ($request->sort === 'price_asc') {
                $query->orderByRaw('COALESCE(NULLIF(sale_price, 0), price) ASC');
            } elseif ($request->sort === 'price_desc') {
                $query->orderByRaw('COALESCE(NULLIF(sale_price, 0), price) DESC');
            } elseif ($request->sort === 'newest') {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::all();
        $featuredProducts = Product::where('is_featured', true)->take(6)->get();

        return view('welcome', compact('products', 'categories', 'featuredProducts'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
