<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $product = Product::with(['category', 'supplier'])->get();
        return response()->json($product);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'buying_price' => ['required', 'max:255'],
            'selling_price' => ['required', 'max:255'],
            'category_id' => ['required'],
            'buying_date' => ['required'],
            'quantity' => ['required'],
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->product_code = $request->product_code;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->quantity = $request->quantity;
        $product->buying_date = $request->buying_date;
        $product->save();
        return response()->json(['success', 'New product added successfully!']);
    }

    public function edit($id){
        $product = Product::find($id);
        return response()->json($product);
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'buying_price' => ['required', 'max:255'],
            'selling_price' => ['required', 'max:255'],
            'category_id' => ['required'],
            'buying_date' => ['required'],
            'quantity' => ['required'],
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->product_code = $request->product_code;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->quantity = $request->quantity;
        $product->buying_date = $request->buying_date;
        $product->save();
        return response()->json(['success', 'Product Updated successfully!']);
    }

    public function delete($id){
        $product = Product::find($id)->delete();
        return response()->json(['success', 'Product deleted successfully!']);
    }

}
