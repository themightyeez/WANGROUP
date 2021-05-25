<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class WebController extends Controller
{
    public function index(){
        return view('login');
    }

    public function dashboard() {
        return view('dashboard');
    }

    public function incoming() {
        return view('incomingrequest');
    }

    public function inventory() {
        return view('inventory');
    }

    public function transactions() {
        return view('transactions');
    }

    public function reports() {
        return view('reports');
    }

    public function account(){
        return view('account');
    }
    
    public function supplier(){
        return view('supplier');
    }


    
}
