<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class mycontroller extends Controller
{
    public function index()
    {
        $products = product::latest()->paginate(5);

        return view('products.index', compact('products'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    
    public function create()
    {
        return view('products.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        product::create($input);

        return redirect()->route('products.index')
        ->with('success', 'Product created successfully.');
    }

    
    public function show(product $product)
    {
        return view('products.show', compact('product'));
    }

    
    public function edit(product $product)
    {
        return view('products.edit', compact('product'));
    }

    
    public function update(Request $request, product $product)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } 
        else {
            unset($input['image']);
        }

        $product->update($input);

        return redirect()->route('products.index')
        ->with('success', 'Product updated successfully');
    }

    
    public function destroy(product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
        ->with('success', 'Product deleted successfully');
    }

}