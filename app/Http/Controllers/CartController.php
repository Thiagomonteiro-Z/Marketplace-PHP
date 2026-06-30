<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];

        return view('cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $productData = $request->get('product');

        $product = Product::whereSlug($productData['slug']);

        if(!$product->count() || $productData['amount'] <= 0) return redirect()->route('home');

        $product = array_merge($productData, $product->first(['name', 'price', 'store_id'])->toArray());

        if(session()->has('cart')) {
            $products = session()->get('cart');
            $productsSlugs = array_column($products, 'slug');

            if(in_array($product['slug'], $productsSlugs)) {
                $products = $this->productIncrement($product['slug'], $product['amount'], $products);

                session()->put('cart', $products);

            } else {
                session()->push('cart', $product);
            }

        } else {
            $products[] = $product;

            session()->put('cart', $products);
        }

        return redirect()->route('product.single', ['slug' => $product['slug']])->with('success', 'Produto adicionado ao carrinho');
    }

    public function remove($slug)
    {
        if(!session()->has('cart')) {
            return redirect()->route('cart.index');
        }
        $products = session()->get('cart');
        $products = array_filter($products, function ($line) use ($slug) {
            return $line['slug'] != $slug;
        });

        session()->put('cart', $products);
        return redirect()->route('cart.index')->with('success', 'Produto removido do carrinho');
    }

    public function cancel()
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Compra cancelada');
    }

    private function productIncrement($slug, $amount, $products)
    {
        $products = array_map(function($line) use($slug, $amount){
            if($slug == $line['slug']) {
                $line['amount'] += $amount;
            }

            return $line;
        }, $products);

        return $products;
    }

    public function productUpdate($slug, $amount, $products)
    {
        $products = array_map(function($line) use($slug, $amount){
            if($slug == $line['slug']) {
                $line['amount'] = $amount;
            }

            return $line;
        }, $products);

        return $products;
    }
}
