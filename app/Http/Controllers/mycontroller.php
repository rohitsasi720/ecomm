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

    function readdata()
    {
        $pdata = product::all();
        return view('insertRead', ['data' => $pdata]);
    }

    function updateordelete(Request $req, $id)
    {
        $prod = product::find($id);
       
        $id = $prod->Id;
        $name = $prod->PName;
        $price = $prod->PPrice;
        $category = $prod->PCategory;
        $image = $prod->PImage;
        
        if ($req->get('upd') == 'Update') {
            return view('updateview', ['pid' => $id, 'pname' => $name, 'pprice' => $price, 'category' => $category, 'image' => $image]);
        }

        if ($req->get('view') == 'View') {
            return view('preview', ['pname' => $name, 'pprice' => $price, 'category' => $category, 'image' => $image]);
        } 
        
        else {
            $prod->delete();
        }
        
         return redirect('/');
        
        
        
        
        
        
        // $id = $req->get('id');
        // $name = $req->get('name');
        // $price = $req->get('price');
        // $category = $req->get('category');
        // $image = $req->file('image');

        // if ($req->get('upd') == 'Update') {
        //     return view('updateview', ['pid' => $id, 'pname' => $name, 'pprice' => $price, 'category' => $category, 'image' => $image]);
        // }
        
        // if ($req->get('view') == 'View') {
        //     $prod = product::find($id);
        //     $image = $prod->PImage;
        //     return view('preview', ['pname' => $name, 'pprice' => $price, 'category' => $category, 'image' => $image]);
        // } else {
        //     $prod = product::find($id);
        //     $prod->delete();
        // }
        // return redirect('/');
    }

    function update(Request $req)
    {
        $id = $req->get('id');
        $name = $req->get('name');
        $price = $req->get('price');
        $category = $req->get('category');
        $prod = product::find($id);
        dd($req->hasFile('image'));

        if ($req->hasFile('image')) {
            $image = $req->file('image')->getClientOriginalName();
            // move the uploaded file to public path
            $req->image->move(public_path('images'), $image);
            $prod->PImage = $image;
        }

        $prod->PName = $name;
        $prod->PPrice = $price;
        $prod->PCategory = $category;
        $prod->save();
        return redirect('/');
    }

    function preview(Request $req)
    {
        $id = $req->get('id');
        $prod = product::find($id);
        $name = $prod->PName;
        $price = $prod->PPrice;
        $category = $prod->PCategory;
        $image = $prod->PImage;

        if ($req->get('view') == 'View') {
            return view('preview', ['pname' => $name, 'pprice' => $price, 'category' => $category, 'image' => $image]);
        }
    }
}