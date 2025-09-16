<?php
use Illuminate\Support\Facades\Route;
use App\Models\Category;   // Import Category model

Route::get("/getCategories", function () {

    $categories = Category::where('status', 'active')
                          ->orderBy('id', 'desc')
                          ->get();
//echo "<pre>";print_r($categories);die;
    return response()->json([
        'status' => true,
        'data'   => $categories
    ]);
});
