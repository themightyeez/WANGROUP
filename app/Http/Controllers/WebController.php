<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Router;
use App\Category;
use App\Product;
use App\Transaction;
use Auth;
use Alert;

class WebController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function dashboard() {
        $devices = Router::all();
        return view('dashboard', compact('devices'));
    }

    public function incoming() {
        $transactions = Transaction::select('id','transaction_id', 'transaction_type', 'contact', 'created_at')->where('status','1')->with('product')->get();

        return view('incomingrequest', compact('transactions'));
    }

    public function inventory() {
        $products = Product::all();
        return view('inventory', compact('products'));
    }

    public function transactions() {
        $opnameCategory = Category::select('id','name')->get();
        $stockItems = Product::select('id','name', 'qty')->get();

        return view('transactions', compact('opnameCategory','stockItems'));
    }

    public function reports() {
        $transactions = Transaction::select('id','transaction_id', 'transaction_type', 'contact', 'created_at')->where('status','2')->with('product')->get();

        return view('reports', compact('transactions'));
    }

    public function account(){
        return view('account');
    }
    
    public function changeName(Request $req){
        $user = Auth::user();
        $user = User::find($user->id);
        $user->name = $req->get('name');
        $user->save();

        return redirect()->action('WebController@account')->with('toast_success', 'Display Name Changed!');
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
            return redirect()->action('WebController@account')->with('toast_success','Password Changed!');
        }

        return redirect()->action('WebController@account')->with('toast_error','Password Mismatch!');
    }

    
}
