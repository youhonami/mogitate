<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductsRequest;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        $sort = $request->input('sort');
        if ($sort) {
            switch ($sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
            }
        }
        $products = $query->paginate(6);
        return view('index', ['products' => $products]);
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        if ($request->has('back')) {
            return redirect('/products')->withInput();
        }
        $imagePath = $request->file('image')->store('images', 'public');
        $productData = $request->only(['name', 'price', 'description']);
        $productData['image'] = $imagePath;
        $product = Product::create($productData);
        if ($request->has('season')) {
            $seasonIds = $request->input('season');
            $product->seasons()->sync($seasonIds);
        }

        return redirect()->action([ProductsController::class, 'index']);
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/products')->with('success', '商品が削除されました');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        if ($keyword) {
            $products = Product::where('name', 'LIKE', "%{$keyword}%")->paginate(6);
        } else {
            $products = Product::paginate(6);
        }
        return view('index', ['products' => $products]);
    }

    public function update(ProductsRequest $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'season' => 'array',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }
        $product->save();

        // 中間テーブルの季節情報を更新
        if ($request->has('season')) {
            $seasonIds = $request->input('season');
            $product->seasons()->sync($seasonIds);
        } else {
            $product->seasons()->sync([]);
        }

        return redirect()->route('products.show', $product->id)->with('success', '商品情報が更新されました');
    }
}
