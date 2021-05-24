<?php
namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{

    public function purchase(Request $request)
    {
        $user = Customer::firstOrCreate(
            [
                'email' => $request->input('email')
            ],
            [
                'password'  => Hash::make(Str::random(12)),
                'name'      => $request->input('firstname') . ' ' . $request->input('lastname'),
                'address'   => $request->input('address'),
                'city'      => $request->input('city'),
                'state'     => $request->input('state'),
                'zip_code'  => $request->input('zip_code')
            ]
        );

        try {
            $user->createOrGetStripeCustomer();
            $payment = $user->charge(
                $request->input('amount'),
                $request->input('payment_method_id'),
            );
            $payment = $payment->asStripePaymentIntent();

            $order = $user->orders()
                ->create([
                    'transaction_id' => $payment->charges->data[0]->id,
                    'total' => $payment->charges->data[0]->amount
                ]);

            $cart = json_decode($request->input('cart'), true);
            foreach ($cart as $item) {
                $order
                    ->products()
                    ->attach($item['id'], [
                        'size'      => $item['size'],
                        'quantity'  => $item['quantity'],
                    ]);
            }

            $order->load('products');
            return $order;
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
