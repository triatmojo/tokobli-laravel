<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $product = Product::with(['user', 'category']);

            return Datatables::of($product)
                ->addColumn('action', function ($item) {
                    return
                        '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-info dropdown-toggle mr-1 mb-1"
                                        type="button"
                                        data-bs-toggle="dropdown"> Aksi 
                                </button>
                               <div class="dropdown-menu">
                                 <a class="dropdown-item" href="' . route('product.edit', $item->id) . '">Update</a>
                                <form action="' . route('product.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button type="submit" class="dropdown-item text-danger">
                                    Delete
                                    </button>
                                </form>
                               </div>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['action', 'image'])
                ->editColumn('price', function ($item) {
                    return currency_IDR($item->price);
                })
                ->make();
        }

        return view('pages.super-admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();

        return view('pages.super-admin.product.create', [
            'users' => $users,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        Product::create($data);

        if (!$data) {
            return redirect()->route('product.create');
        }

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with(['user', 'category'])->findOrFail($id);
        $users = User::all();
        $categories = Category::all();

        return view('pages.super-admin.product.update', [
            'product' => $product,
            'users' => $users,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $product = Product::findOrFail($id);
        $product->update($data);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete($product);

        return redirect()->route('product.index');
    }
}
