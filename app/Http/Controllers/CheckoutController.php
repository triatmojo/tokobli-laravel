<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;

// midtrans
use Exception;
use Midtrans\Snap;
use Midtrans\Config;

class CheckoutController extends Controller
{
    public function proccess(Request $request)
    {
        // dd($request->all());
        // Save Users d ata
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // Proccess Checkout
        $code = 'STORE-' . mt_rand(00000, 99999);
        $carts = Cart::with(['product', 'user'])->where('users_id', $user->id)->get();

        // Transaction Create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'inscurance_price' => 0,
            'shipping_price' => $request->cost,
            'total_price' => $request->total_price,
            'transaction_status' => "PENDING",
            'code' => $code
        ]);

        // Transaction Detail Create
        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(00000, 99999);
            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx
            ]);
        }

        // Cart Delete Data
        Cart::where('users_id', Auth::user()->id)->delete();

        // Configure Midtrans
        Config::$serverKey = config("services.midtrans.serverKey");
        Config::$isProduction = config("services.midtrans.isProduction");
        Config::$isSanitized = config("services.midtrans.isSanitized");
        Config::$is3ds = config("services.midtrans.is3ds");
        // dd(config::$serverKey);

        // Created Array to send Midtrans
        $midtrans = [
            "transaction_details" => [
                "order_id" => $code,
                "gross_amount" => (int) $request->total_price,
            ],
            "customer_detauls" => [
                "first_name" => Auth::user()->name,
                "email" => Auth::user()->email,
            ],
            "enable_payments" => [
                "gopay", "bank_transfer"
            ],
            "vtweb" => []
        ];

        try {
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // Redirect to snap Payment Page
            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function callback(Request $request)
    {
    }
}
