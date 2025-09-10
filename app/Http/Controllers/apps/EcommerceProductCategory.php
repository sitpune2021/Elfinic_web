<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class EcommerceProductCategory extends Controller
{
  public function index()
  {
    return view('content.apps.app-ecommerce-category-list');
  }
public function list(Request $request)
{

        $categories = Category::select(['id', 'name', 'slug','image', 'description', 'status'])->get();

        $data = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'cat_image' => $category->image ?? 'default.png', // assuming you have an image column
                'categories' => $category->name,
                'category_detail' => Str::limit($category->description, 80),
                'status' => ($category->status != 'active') ? "<span class='badge bg-label-danger'>Inactive</span>" : "<span class='badge bg-label-success'>Active</span>" ,
                'total_earnings' => "$" . number_format(rand(1000, 100000), 2), // demo earnings
                'total_products' => rand(1000, 9000) // demo count
            ];
        });

        return response()->json(['data' => $data]);

}
 public function categoryProcess(Request $request)
    {
    //  dd($request->all());die;
      $request->validate([
        'name'        => 'required|string|max:255',
        'slug'        => 'required|string|max:50',
        'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'description' => 'nullable|string',
        'status'      => 'required|in:active,inactive',
        ]);

        $imageName = null;
          if ($request->hasFile('image')) {
              $image = $request->file('image');
              $imageName = time() . '.' . $image->getClientOriginalExtension();
              $image->move(public_path('assets/img/category-images'), $imageName);
          }


        $category = Category::create([
            'name'  => $request->input('name'),
            'slug'           => $request->input('slug'),
            'image' => $imageName,
            'description'    => $request->input('description'),
            'status'         => $request->input('status'),
        ]);


        if ($request->ajax()) {
        return response()->json(['success' => true, 'category' => $category]);
    }

    return redirect()->route('app/ecommerce/product/category')
                     ->with('success', 'Category created successfully.');
    }

}
