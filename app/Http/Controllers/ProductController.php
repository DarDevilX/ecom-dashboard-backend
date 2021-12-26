<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Product;

class ProductController extends Controller
{
    function addProduct(request $req){
        $product = new Product;
        $product->name = $req->input('name');
        $product->price = $req->input('price');
        $product->description = $req->input('description');
        $product->file_path = $req->file('file')->store('products');
        $product->save();
        if($product){
            return ['status'=>true];
        }else{
            return ['status'=>false];
        }
        return $product;
    }

    function list(){
        return Product::all();
    }

    function delete($id){
        $result = Product::where('id',$id)->delete();
        return $result;
    }

    function getProduct($id){
        return Product::find($id);
    }
    
    function updateProduct($id,request $req){
        $product = Product::where('id',$id)->first();
        $product->name = $req->input('name');
        $product->price = $req->input('price');
        $product->description = $req->input('description');
        if($req->file()){
            $product->file_path = $req->file('file')->store('products');
        }
        $product->save();
        if($product){
            return ['status'=>true];
        }else{
            return ['status'=>false];
        }
    }
}
