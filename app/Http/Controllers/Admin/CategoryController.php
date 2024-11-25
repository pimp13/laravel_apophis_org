<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Content\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index()
    {
        $page = request()->get('page', 1);
        $cacheKey = 'categories_page_' . $page;

        $categories = Cache::remember($cacheKey, config('cache.ttl'), function () use ($page) {
            return Category::latest()->paginate();
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
        return to_route('category.index')->with('success_message', 'دسته بندی شما با موفقیت ثبت شد.');
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
