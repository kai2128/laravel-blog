<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->get('limit', 6);
        $articles = Article::with('category:id,name')->latest()->simplePaginate($limit);
        return ArticleResource::collection($articles);
    }

    public function show(Request $request, Article $article)
    {
        $article->load('category:id,name');
        return new ArticleResource($article);
    }
}
