<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories'
        ]);

        $category = new Category();

        $category->name = $request->name;
        $category->category_code = $request->category_code;
        $category->description = $request->description;
        $category->image = $request->image;
        $category->is_active = $request->is_active ?? 0;
        $category->is_featured = $request->is_featured ?? 0;
        $category->is_trending = $request->is_trending ?? 0;
        $category->slug = Str::slug($request->name);
        $category->save();

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = $category->id . '.' . $image->getClientOriginalExtension();
            $path = Storage::putFileAs('categories', $image , $imageName);
            $category->image = $path;
            $category->save();
        }

        return response()->json([
            'message' => 'Category created successfully',
            'category' => $category,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'category_code' => 'required|unique:categories,category_code,' . $category->id,
        ]);

        $category = Category::find($category->id);

        $category->name = $request->name;
        $category->category_code = $request->category_code;
        $category->description = $request->description;
        $category->is_active = $request->is_active ?? 0;
        $category->is_featured = $request->is_featured ?? 0;
        $category->is_trending = $request->is_trending ?? 0;
        $category->slug = Str::slug($request->name);
        $category->save();

        if($request->hasFile('image')){
            if($category->image){
                Storage::delete($category->image);
            }

            $image = $request->file('image');
            $imageName = $category->id . '.' . $image->getClientOriginalExtension();
            $path = Storage::putFileAs('categories', $image , $imageName);
            $category->image = $path;
            $category->save();
        }

        return response()->json([
            'message' => 'Category updated successfully',
            'category' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category = Category::find($category->id);

        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully'
        ]);
    }

    public function forceDelete($id)
    {
        $category = Category::withTrashed()->find($id);

        if($category->image){
            Storage::delete($category->image);
        }

        $category->forceDelete();

        return response()->json([
            'message' => 'Category deleted successfully'
        ]);
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->find($id);

        $category->restore();

        return response()->json([
            'message' => 'Category restored successfully'
        ]);
    }

    public function is_active($id)
    {
        $category = Category::find($id);

        if($category->is_active == 0){
            $category->is_active = 1;
        }else{
            $category->is_active = 0;
        }
        $category->save();

        return response()->json([
            'message' => 'Category activity change successfully',
            'category' => $category
        ]);
    }

    public function is_featured($id)
    {
        $category = Category::find($id);

        if($category->is_featured == 0){
            $category->is_featured = 1;
        }else{
            $category->is_featured = 0;
        }
        $category->save();

        return response()->json([
            'message' => 'Category featured change successfully',
            'category' => $category
        ]);
    }

    public function is_trending($id)
    {
        $category = Category::find($id);

        if($category->is_trending == 0){
            $category->is_trending = 1;
        }else{
            $category->is_trending = 0;
        }
        $category->save();

        return response()->json([
            'message' => 'Category trending change successfully',
            'category' => $category
        ]);
    }
}
