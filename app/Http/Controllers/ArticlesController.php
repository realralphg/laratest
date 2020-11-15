<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Article;
use App\Http\Resources\ArticleResource;

class ArticlesController extends Controller
{
    // I N D E X 
    public function index()
    {        
        $articles = Article::latest()->paginate(10);
        return ArticleResource::collection($articles);
    }

    // S T O R E 
    public function store(Request $request)
    {
        $article = Article::create($request->all());
        return response()->json($article, 201);        
    }

    // S H O W 
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return response()->json($article, 200);
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'the status message',
        //     'data' => $article
        // ]);
    }

    // U P D A T E 
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        if(!$article){
            return response()->json(['message' => 'Not Found'], 404);
        }
        $article->update($request->all());
        return response()->json(['message' => 'updated'], 200);
    }

    // D E S T R O Y 
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return response()->json(['message' => 'deleted'], 200);
    }
}