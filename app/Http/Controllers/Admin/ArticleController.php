<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    public function index()
    {
        $page = request()->get('page', 1);
        $cacheKey = 'articles_page_' . $page;

        $articles = Cache::remember($cacheKey, config('cache.ttl'), function () use ($page) {
            return Article::with([
                'user:id,name',
                'category:id,name'
            ])->whereHas('category', function ($query) {
                $query->where('is_active', true);
            })->latest()->paginate();
        });
        return view('admin.article.index', compact('articles'));
    }

    public function create()
    {
        $categories = Cache::remember('categories', config('cache.ttl'), function () {
            return Category::select('name', 'id')->latest()->get();
        });
        return view('admin.article.create', compact('categories'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
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
