<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{
    public function browse(){
        $suppliers = Supplier::all();
        return view('supplier', compact('suppliers'));
    }

    public function store(Request $req){
        $req->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required'
        ]);

        $supplier = new Supplier();
        $supplier->name = $req->get('name');
        $supplier->phone_number = $req->get('phone_number');
        $supplier->address = $req->get('address');
        $supplier->save();

        return redirect()->action('SupplierController@browse')->with('toast_success','Data Added!');
    }

    public function edit(Request $req){
        $supplier = Supplier::find($req->get('id'));
        if (!$supplier) {
            return redirect()->action('SupplierController@browse')->with('toast_error','Data Invalid!');
        }
        
        $supplier->name = $req->get('name');
        $supplier->phone_number = $req->get('phone_number');
        $supplier->address = $req->get('address');
        $supplier->save();

        return redirect()->action('SupplierController@browse')->with('toast_success','Data Updated!');
    }

    public function remove($id){
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return redirect()->action('SupplierController@browse')->with('toast_error','Data Invalid!');
        }

        $supplier->delete();

        return redirect()->action('SupplierController@browse')->with('toast_success','Data Removed!');
    }
}
