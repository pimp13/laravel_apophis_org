<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Content\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $page = request()->get('page', 1);
        $cacheKey = 'categories_page_' . $page;

        $categories = Cache::remember($cacheKey, config('cache.ttl'), function () use ($page) {
            return Category::select('id', 'name', 'slug', 'is_active')->latest()->paginate();
        });
        return view('admin.content-category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.content-category.create');
    }

    public function store(CategoryRequest $request)
    {
        $inputs = $request->all();
        $inputs['is_active'] = isset($request->is_active) ? true : false;
        $inputs['slug'] = str()->slug($request->slug, '-', null);
        Category::create($inputs);
        $page = request()->get('page', 1);
        $cacheKey = 'categories_page_' . $page;
        cache()->forget($cacheKey);
        return to_route('category.index')->with('success_message', 'دسته بندی شما با موفقیت ثبت شد.');
    }

    public function edit(Category $category)
    {
        return view('admin.content-category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validate = $request->validate([
            "name" => ["required", "string", "max:50", "min:10"],
            "slug" => ["required", "string", "max:50", "min:5", Rule::unique('categories', 'slug')->ignore($category->id)],
            "description" => ["nullable", "string", "max:150", "min:20"],
            "is_active" => ["in:0,1", "numeric"]
        ]);

        $validate['is_active'] = isset($request->is_active) ? true : false;
        $validate['slug'] = str()->slug($request->slug, '-', null);
        $category->update($validate);
        $page = request()->get('page', 1);
        $cacheKey = 'categories_page_' . $page;
        cache()->forget($cacheKey);
        return to_route('category.index')->with('success_message', 'دسته بندی شما با موفقیت ویرایش شد.');
    }

    public function destroy(Category $category)
    {
        $result = $category->delete();
        $page = request()->get('page', 1);
        $cacheKey = 'categories_page_' . $page;
        if ($result) {
            cache()->forget($cacheKey);
            return back()->with('success_message', 'دسته بندی مورد نظر با موفقیت حذف شد');
        }
    }

    public function changeStatus(Category $category)
    {
        $page = request()->get('page', 1);
        $cacheKey = 'categories_page_' . $page;
        $category->is_active = !$category->is_active;
        $category->save();
        cache()->forget($cacheKey);
        return response()->json($category->is_active);
    }
}
