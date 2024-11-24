<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(10);

        return view('home', [
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'price' => 'required|numeric|between:0,99999999.99',
            'details' => 'required|min:6',
            'publish' => 'required|boolean'
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'publish' => $request->publish,
        ]);

        return redirect('/');
    }

    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    public function update(Product $product)
    {
        request()->validate([
            'name' => 'required|min:5',
            'price' => 'required|numeric|between:0,99999999.99',
            'details' => 'required|min:6',
            'publish' => 'required|boolean'
        ]);

        $product->update([
            'name' => request('name'),
            'price' => request('price'),
            'details' => request('details'),
            'publish' => request('publish'),
        ]);

        return redirect('/products/' . $product->id);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::orderBy('created_at', 'DESC')
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('details', 'LIKE', "{$query}")
            ->paginate(10);

        return view('products.index', [
            'products' => $products,
            'query' => $query
        ]);
    }
}
