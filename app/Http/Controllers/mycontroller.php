<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use Illuminate\Http\Request;
use App\Models\product;
use Maatwebsite\Excel\Facades\Excel;


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

        $name = $request->input('name');

        $existingProduct = product::where('name', $name)->first();

        $newProduct = product::create($input);

        if ($existingProduct) {
            $newProduct->update(['name' => $input['name'] . '-' . $newProduct->id]);
        }

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

        // delete old image if exists
        if ($product->image) {
            $oldImagePath = public_path('images/' . $product->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
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
        if ($product->image) {
            $imagePath = public_path('images/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        
        $product->delete();

        return redirect()->route('products.index')
        ->with('success', 'Product deleted successfully');
    }

    public function cart()
    {
        return view('cart');
    }

    public function addToCart($id)
    {
        $product = product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } 
        else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function importProduct(){
        return view('products.index');
    }

    public function uploadProduct(Request $request){

        if ($request->hasFile('file'))
        {
            Excel::import(new ProductImport, $request->file);
            return redirect()->route('products.index')->with('success', 'Data imported successfully');   
        }
        else
        {
            return redirect()->back()->with('error', 'Please select a file to upload');
        }  
    }
    
}