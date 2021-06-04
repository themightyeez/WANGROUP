<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Transaction;
use Log;
use DateTime;

class TransactionController extends Controller
{
    public function requestTransaction(Request $req){
        $validate = $req->validate([
            'item.*.qty' => 'required|integer',
            'requestor' => 'required'
        ],
        [
            'item.*.qty.integer' => 'Please input valid quantity',
            'requestor.required' => 'Please input requestor identity'
        ]
        );

        if (!$validate) {
            return redirect()->action('WebController@transactions');
        }

        $date = new DateTime;
        $date = $date->format('Y-m-d');
        $id = 'WG/Req/'.$date.'/'.rand(10,100);

        $transaction = new Transaction();
        $transaction->transaction_id = $id;
        $transaction->status = 2;
        $transaction->transaction_type = 'request';
        $transaction->contact = $req->get('requestor');
        $transaction->save();

        foreach($req->get('item') as $k => $v){
            $product = Product::findOrFail($v['item']);
            $product->qty = $product->qty - $v['qty'];
            $product->save();

            $transaction = Transaction::where('transaction_id',$id)->firstOrFail();
            $product->transaction()->attach($transaction->id, ['qty' => $v['qty'], 'note' => $v['note'] ]);
        }


        return redirect()->action('WebController@transactions')->with('toast_success', 'Request Booked!');
    }

    public function returnTransaction(Request $req){
        $validate = $req->validate([
            'item.*.qty' => 'required|integer',
            'returnee' => 'required'
        ],
        [
            'item.*.qty.integer' => 'Please input valid quantity',
            'returnee.required' => 'Please input returnee identity'
        ]
        );

        if (!$validate) {
            return redirect()->action('WebController@transactions');
        }

        $date = new DateTime;
        $date = $date->format('Y-m-d');
        $id = 'WG/Ret/'.$date.'/'.rand(10,100);

        $transaction = new Transaction();
        $transaction->transaction_id = $id;
        $transaction->status = 2;
        $transaction->transaction_type = 'return';
        $transaction->contact = $req->get('returnee');
        $transaction->save();

        foreach($req->get('item') as $k => $v){
            $product = Product::findOrFail($v['item']);
            $product->qty = $product->qty + $v['qty'];
            $product->save();

            $transaction = Transaction::where('transaction_id',$id)->firstOrFail();
            $product->transaction()->attach($transaction->id, ['qty' => $v['qty'], 'note' => $v['note'] ]);
        }


        return redirect()->action('WebController@transactions')->with('toast_success', 'Return Processed!');
    }

}
