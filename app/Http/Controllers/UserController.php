<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DateTime;
use App\User;
use App\Product;
use App\Transaction;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function dashboard(){
        return view('user.dashboard');
    }

    public function request(){
        $stockItems = Product::select('id','name', 'qty')->get();

        return view('user.request', compact('stockItems'));
    }

    public function requestTransaction(Request $req){
        $validate = $req->validate([
            'item.*.qty' => 'required|integer',
        ],
        [
            'item.*.qty.integer' => 'Please input valid quantity',
        ]
        );

        if (!$validate) {
            return redirect()->action('UserController@request');
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

            return redirect()->action('UserController@request')->with('toast_warning', $msg);
        } 
        
        $transaction = new Transaction();
        $transaction->transaction_id = $id;
        $transaction->status = 1;
        $transaction->transaction_type = 'request';
        $transaction->contact = Auth::user()->name;
        $transaction->processed_by = Auth::user()->id;
        $transaction->save();
        
        foreach($req->get('item') as $k => $v){
            $product = Product::findOrFail($v['item']);
            $product->qty = $product->qty - $v['qty'];
            $product->save();
            $transaction = Transaction::where('transaction_id',$id)->firstOrFail();
            $product->transaction()->attach($transaction->id, ['qty' => $v['qty'], 'note' => $v['note'] ]);
        }

        return redirect()->action('UserController@request')->with('toast_success', 'Request Booked! Please wait for admin approval.');
    }

    public function inventory(){
        $products = Product::all();
        
        return view('user.inventory', compact('products'));
    }
    public function logOrder(){
        $transactions = Transaction::select('id','transaction_id', 'status', 'transaction_type', 'contact', 'created_at')->where('processed_by', Auth::user()->id)->with('product')->get();

        return view('user.logorder', compact('transactions'));
    }

    public function account(){
        return view('user.account');
    }
    
    public function changeName(Request $req){
        $user = Auth::user();
        $user = User::find($user->id);
        $user->name = $req->get('name');
        $user->save();

        return redirect()->action('UserController@account')->with('toast_success', 'Display Name Changed!');
    }

    public function changePassword(Request $req){
        $user = Auth::user();
        $user = User::find($user->id);

        $currentPass = $user->password;
        $inputPass = $req->get('oldPassword');
        $newPass = $req->get('newPassword');

        $check = Hash::check($inputPass, $currentPass);

        if ($check) {
            $user->password = Hash::make($newPass);
            $user->save();
            return redirect()->action('UserController@account')->with('toast_success','Password Changed!');
        }

        return redirect()->action('UserController@account')->with('toast_error','Password Mismatch!');
    }

}
