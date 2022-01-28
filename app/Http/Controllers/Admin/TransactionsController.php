<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\TransactionDetail;

class TransactionsController extends Controller
{
    public function index()
    {
        $sellTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('product', function ($product) {
                $product->where('users_id', Auth::user()->id);
            })->paginate(5);

        $buyTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('transaction', function ($transaction) {
                $transaction->where('users_id', Auth::user()->id);
            })->paginate(5);

        return view('pages.admin.transaction', [
            'sellTransactions' => $sellTransactions,
            'buyTransactions' => $buyTransactions,
        ]);
    }

    public function details(Request $request, $id)
    {
        $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->findOrFail($id);
        return view('pages.admin.transactions-details', [
            'transaction' => $transaction
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = TransactionDetail::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard-transactions', $id);
    }
}
