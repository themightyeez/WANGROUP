<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Log;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function addProduct(Request $req){
        $validate = $req->validate([
            'itemName' => 'required',
            'category' => 'required',
            'qty' => 'required|integer',
            'photo' => 'nullable'
        ],
        [
            'itemName.required' => 'Please input item name',
            'category.required' => 'Category must be selected',
            'qty.integer' => 'Quantity must be integer',
        ]
        );

        if (!$validate) {
            return redirect()->action('WebController@transactions');
        }

        $product = new Product();
        $product->name = $req->get('itemName');
        $product->category = $req->get('category');
        $product->qty = $req->get('qty');
        if ($req->hasFile('photo')) {
            $req->file('photo')->move('product-photo/', $req->file('photo')->getClientOriginalName());
            $product->photo = $req->file('photo')->getClientOriginalName();
        }

        $product->save();

        return redirect()->action('WebController@transactions')->with('toast_success', 'Product Added!');
    }

    public function editProduct(Request $req){
        $validate = $req->validate([
            'qty' => 'required|integer',
            'photo' => 'nullable',
            'note' => 'nullable'
        ],
        [
            'qty.integer' => 'Quantity must be integer',
        ]
        );

        if (!$validate) {
            return redirect()->action('WebController@inventory');
        }

        $product = Product::find($req->get('id'));

        if (!$product) {
            return redirect()->action('WebController@inventory')->with('toast_error', 'Product not found');
        }


        $product->qty = $req->get('qty');
        if ($req->hasFile('photo')) {
            $req->file('photo')->move('product-photo/', $req->file('photo')->getClientOriginalName());
            $product->photo = $req->file('photo')->getClientOriginalName();
        }
        $product->note = $req->get('note');
        Log::info($req);
        $product->save();

        return redirect()->action('WebController@inventory')->with('toast_success', 'Product updated!');
    }

    public function addCategory(Request $req){
        $category = new Category();
        $category->name = $req->get('category');
        $category->save();

        return redirect()->action('WebController@transactions')->with('toast_success', 'New Category Added!');
    }

    public function queryCategory(){
        $qry = Category::select('id','name')->get();

        if (!$qry) {
            return response()->json(["status" => "failed", "msg" => "data invalid"]);
        }
        
        $parse = array();

        foreach ($qry as $k) {
            $data = array("id" => $k['id'], "name" => $k['name']);
            array_push($parse,$data);
        }

        return response()->json(["status" => "success", "data" => $parse]);
    }

    public function removeCategory(Request $req){
        $category = Category::find($req->get('category'));
        $category->delete();

        return redirect()->action('WebController@transactions')->with('toast_success', 'Category '.$category->name.' deleted');
    }
}
