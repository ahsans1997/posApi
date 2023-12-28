<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'sub_categories' => SubCategory::all()
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
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'sub_category_code' => 'nullable|string|max:255|unique:sub_categories,sub_category_code',
            'description' => 'nullable|string',
        ]);

        $subCategory = new SubCategory();

        $subCategory->category_id = $request->category_id;
        $subCategory->name = $request->name;
        $subCategory->sub_category_code = $request->sub_category_code;
        $subCategory->description = $request->description;
        $subCategory->is_active = $request->is_active ?? 0;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->save();

        return response()->json([
            'message' => 'Sub Category created successfully',
            'sub_category' => $subCategory
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'sub_category_code' => 'nullable|string|max:255|unique:sub_categories,sub_category_code,' . $subCategory->id,
            'description' => 'nullable|string',
        ]);

        $subCategory = SubCategory::find($subCategory->id);

        $subCategory->category_id = $request->category_id;
        $subCategory->name = $request->name;
        $subCategory->sub_category_code = $request->sub_category_code;
        $subCategory->description = $request->description;
        $subCategory->is_active = $request->is_active ?? 0;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->save();

        return response()->json([
            'message' => 'Sub Category updated successfully',
            'sub_category' => $subCategory
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory = SubCategory::find($subCategory->id);

        $subCategory->delete();

        return response()->json([
            'message' => 'Sub Category deleted successfully'
        ]);
    }

    /**
     * Restore the specified resource from storage.
     */

    public function restore($id)
    {
        $subCategory = SubCategory::withTrashed()->find($id);

        $subCategory->restore();

        return response()->json([
            'message' => 'Sub Category restored successfully'
        ]);
    }

    /**
     * Force Delete the specified resource from storage.
     */

    public function forceDelete($id)
    {
        $subCategory = SubCategory::withTrashed()->find($id);

        $subCategory->forceDelete();

        return response()->json([
            'message' => 'Sub Category deleted successfully'
        ]);
    }

    /**
     * Active the specified resource from storage.
     */

    public function isActive($id)
    {
        $subCategory = SubCategory::find($id);

        if ($subCategory->is_active == 0) {
            $subCategory->is_active = 1;
        } else {
            $subCategory->is_active = 0;
        }
        $subCategory->save();

        return response()->json([
            'message' => 'Sub Category activity status changed successfully'
        ]);
    }
}
