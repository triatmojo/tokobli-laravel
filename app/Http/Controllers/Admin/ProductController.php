<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SuperAdmin\ProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


use App\Models\Product;
use App\Models\Category;
use App\Models\ProductGallery;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['galleries', 'category'])->where('users_id', Auth::user()->id)->get();

        return view('pages.admin.product', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('pages.admin.products-create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $product = Product::create($data);

        $gallery = [
            'products_id' => $product->id,
            'photo' => $request->file('photo')->store('assets/product', 'public')
        ];


        ProductGallery::create($gallery);

        return redirect()->route('dashboard-product');
    }

    public function details(Request $request, $id)
    {
        $products = Product::with(['galleries', 'category'])->findOrFail($id);
        $categories = Category::all();

        return view('pages.admin.products-details', compact('categories', 'products'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = Product::findOrFail($id);

        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('dashboard-product');
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();
        $data['photo'] = $request->file('photo')->store('assets/product', 'public');

        ProductGallery::create($data);

        return redirect()->route('dashboard-product', $request->products_id);
    }
    public function deleteGallery(Request $request, $id)
    {
        $data = ProductGallery::findOrFail($id);

        $data->delete();

        return redirect()->route('dashboard-products-details', $data->products_id);
    }

    public function deleteProduct(Request $request, $id)
    {
        $data = Product::findOrFail($id);

        $gallery = ProductGallery::where('products_id', $id);

        if ($gallery) $gallery->delete();

        $data->delete();

        return redirect()->route('dashboard-product', $data->products_id);
    }
}
