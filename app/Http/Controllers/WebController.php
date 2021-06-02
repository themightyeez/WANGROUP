<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Router;
use App\Category;
use App\Product;
use Auth;
use Alert;

class WebController extends Controller
{
    public function dashboard() {
        $devices = Router::all();
        return view('dashboard', compact('devices'));
    }

    public function incoming() {
        return view('incomingrequest');
    }

    public function inventory() {
        $products = Product::all();
        return view('inventory', compact('products'));
    }

    public function transactions() {
        $opnameCategory = Category::select('id','name')->get();


        return view('transactions', compact('opnameCategory'));
    }

    public function reports() {
        return view('reports');
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
