<?php

namespace App\Http\Controllers\SuperAdmin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $query = User::query();

            return Datatables::of($query)
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
                                 <a class="dropdown-item" href="' . route('user.edit', $item->id) . '">Update</a>
                                <form action="' . route('user.destroy', $item->id) . '" method="POST">
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
                ->rawColumns(['action'])
                ->make();
        }
        return view('pages.super-admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.super-admin.user.create');
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
        $data['password'] = bcrypt($request->password);

        User::create($data);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = User::findOrFail($id);

        return view('pages.super-admin.user.update', [
            'item' => $item
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

        $item = User::findOrFail($id);

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $item->update($data);

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::findOrFail($id);

        $item->delete();

        return redirect()->route('user.index');
    }
}
