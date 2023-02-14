<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class mycontroller extends Controller
{
    function insert(Request $req)
    {
        $name = $req->get('pname');
        $price = $req->get('pprice');
        $category = $req->get('category');
        $image = $req->file('image')->getClientOriginalName();
        //move uploaded file
        $req->image->move(public_path('images'), $image);

        $prod = new product();
        $prod->PName = $name;
        $prod->PPrice = $price;
        $prod->PCategory = $category;
        $prod->PImage = $image;
        $prod->save();
        return redirect('/');
    }

    function readdata(){
        $pdata = product::all();
        return view('insertRead',['data' => $pdata]);
    }

    function updateordelete(Request $req){
        $id = $req->get('id');
        $name = $req->get('name');
        $price = $req->get('price');
        $category = $req->get('category');

        if($req->get('update') == 'Update'){
            return view('updateview', ['pname' => $name,'pprice' => $price,'category' => $category]);
        }
        else {
            $prod = product::find($id);
            $prod->delete();
        }
        return redirect('/');
        }
}