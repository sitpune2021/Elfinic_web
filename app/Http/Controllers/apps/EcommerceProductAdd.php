<?php

namespace App\Http\Controllers\apps;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EcommerceProductAdd extends Controller
{
  public function index()
  {
    $Category = Category::where('status', 'active')
    ->orderBy('id', 'desc')
    ->get();
    return view('content.apps.app-ecommerce-product-add', compact('Category'));
  }



}
