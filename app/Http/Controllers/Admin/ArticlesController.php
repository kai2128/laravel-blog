<?php

namespace App\Http\Controllers\Admin;

use App\Actions\UploadFile;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryResource;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ArticlesController extends Controller
{
    //
    public function index(Request $request)
    {
        $articles = Article::with(['category:id,name'])->latest()->simplePaginate(10);

        return Inertia::render('Articles/Index', [
            'articles' => ArticleResource::collection($articles)
        ]);
    }

    public function create(Request $request)
     {
        return Inertia::render("Articles/Create", [
            'edit' => false,
            'article'=> new ArticleResource(new Article()),
            'categories' => CategoryResource::collection(Category::select('id', 'name')->get()),
        ]);
    }

    public function edit(Article $article)
    {
        return Inertia::render("Articles/Create", [
            'edit' => true,
            'article' => new ArticleResource($article),
            'categories' => CategoryResource::collection(Category::select('id', 'name')->get()),
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'category_id' => ['required', Rule::exists(Category::class, 'id')],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique(Article::class)->ignore($article->id)],
            'image' => ['nullable', 'image', 'max:3000'],
            'description' => ['required', 'string'],
        ]);

        $data['image'] = $article->image;
        if ($request->file('image')) {
            $article->deleteImage('image');

            $imgName = UploadFile::uploadImgFile($request->file('image'), $article->uploadFolder());

            $data['image']= $imgName;
        }

        $article->update($data);

        return redirect()->route('articles.index')->with('success', "Article {$data['title']} updated successfully");
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => ['required', Rule::exists(Category::class, 'id')],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique(Article::class)],
            'image' => ['required', 'image', 'max:3000'],
            'description' => ['required', 'string'],
        ]);
        $imgName = UploadFile::uploadImgFile($request->file('image'), (new Article())->uploadFolder());

        $data['image'] = $imgName;

        Article::create($data);

        return redirect()->route('articles.index')->with('success', "Article {$data['title']} created successfully");
    }

    public function destroy(Article $article)
    {
        $article->deleteImage();
        $article->delete();
        return redirect()->route('categories.index')->with('success', 'Article deleted successfully');
    }


}
