<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\TransactionDetail;


class DashboardController extends Controller
{
    public function index()
    {
        $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('product', function ($product) {
                $product->where('users_id', Auth::user()->id);
            })->paginate(5);

        $transaction_count = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('product', function ($product) {
                $product->where('users_id', Auth::user()->id);
            })->count();

        $revenue = $transaction->reduce(function ($carry, $item) {
            return $carry + $item->price;
        });

        $customers = User::count();

        return view('pages.admin.dashboard', [
            'transaction_data' => $transaction,
            'transaction_count' => $transaction_count,
            'revenue' => $revenue,
            'customers' => $customers
        ]);
    }
}
