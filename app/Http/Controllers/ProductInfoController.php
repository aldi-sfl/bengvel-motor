<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;


class ProductInfoController extends Controller
{
    public function index($name, $hashedId)
    {
        $product = Product::findByHashedId($hashedId);

        if (!$product) {
            abort(404);
        }

        $title = $product->name . ' - Orbit Motor';
        $avatar = session('avatar');
        return view('pages.User.product.viewProduct', [
            'product' => $product,
            'categories' => Category::all(),
            'title' => $title,
            'avatar' => $avatar
        ]);
    }
    
}
    