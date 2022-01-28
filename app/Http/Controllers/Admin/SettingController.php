<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;
use App\Models\Province;
use App\Models\Regency;

class SettingController extends Controller
{
    public function store()
    {
        $users = Auth::user();
        $categories = Category::all();

        return view('pages.admin.setting-store', [
            'users' => $users,
            'categories' => $categories,
        ]);
    }

    public function account()
    {
        $users = Auth::user();
        $province = Province::findOrFail($users->provinces_id);
        $regency = Regency::findOrFail($users->regencies_id);

        return view('pages.admin.setting-account', [
            'users' => $users,
            'province' => $province,
            'regency' => $regency,

        ]);
    }

    public function update(Request $request, $redirect)
    {
        $data = $request->all();

        $user = Auth::user();

        $user->update($data);

        return redirect()->route($redirect);
    }
}
