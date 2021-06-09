<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Transaction;
use Log;
use Auth;
use DB;
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
        
        //Check stock
        foreach($req->get('item') as $k => $v){
            $product = Product::findOrFail($v['item']);
            $error = [];
            if ($v['qty'] > $product->qty) {
                $error[] = $product->name.' insufficient stock';
            }
        }

        $date = new DateTime;
        $date = $date->format('Y-m-d');
        $id = 'WG/Req/'.$date.'/'.rand(10,100);

        
        if(boolval($error)){
            $msg = '';
            foreach ($error as $k => $v) {
                $msg .=  $v.PHP_EOL;
            }

            return redirect()->action('WebController@transactions')->with('toast_warning', $msg);
        } 
        
        $transaction = new Transaction();
        $transaction->transaction_id = $id;
        $transaction->status = 2;
        $transaction->transaction_type = 'request';
        $transaction->contact = $req->get('requestor');
        $transaction->processed_by = Auth::user()->id;
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
            'item.*.qty' => 'required|integer|gt:0',
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
        $transaction->processed_by = Auth::user()->id;
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

    public function searchReport(Request $req){
        $validate = $req->validate([
            'start' => 'required|integer',
            'end' => 'required|integer'
        ],
        [
            'start.integer' => 'Please input valid timestamp',
            'end.integer' => 'Please input valid timestamp'
        ]
        );

        if (!$validate) {
            return redirect()->action('WebController@reports');
        }
        $start = date('Y-m-d', substr($req->get('start'), 0,-3));
        $end = date('Y-m-d', substr($req->get('end'), 0,-3));
        
        $transactions = Transaction::where('created_at','>=', $start)->where('created_at','<=', $end.' 23:59:59')->where('status','2')->with('product')->get();

        return view('queryreport', compact('transactions'));
    }

    public function approval(Request $req){
        $validate = $req->validate([
            'id' => 'required|integer',
            'qry' => 'required|between:0,1'
        ],
        [
            'id.integer' => 'Invalid Request!',
            'qry.between' => 'Unable to process request'
        ]
        );

        if (!$validate) {
            return redirect()->action('WebController@incoming');
        }

        $transaction = Transaction::find($req->get('id'));

        if (!$transaction) {
            return redirect()->action('WebController@incoming')->with('toast_warning', 'Transaction not found.');
        }

        switch ($req->get('qry')) {
            case 1:
                $transaction->status = 2;
                $transaction->approved_by = Auth::user()->id;
                $transaction->save();
                return redirect()->action('WebController@incoming')->with('toast_success', 'Transaction approved.');
                break;
            
            default:
                $transaction->status = 3;
                $transaction->save();
                return redirect()->action('WebController@incoming')->with('toast_success', 'Transaction rejected.');
                break;
        }
    }
}
