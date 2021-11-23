<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Models\Article;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as StatusCode;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    
    public function index()
    {
        return Article::all();
    }

    
    public function store(Request $request)
    {
        $article = Article::create($request->all());
        return response()->json($article, StatusCode::HTTP_CREATED);
    }

    
    public function show(Article $article)
    {
        return $article;
    }

    
    public function update(Request $request, Article $article)
    {
        $article->update($request->all());
        return response()->json($article, StatusCode::HTTP_OK);
    }

    
    public function destroy(Article $article)
    {
        /* if($article->delete()){
          return response([
            'data' => [
              'status' => StatusCode::HTTP_NO_CONTENT,
              'message' => 'post borrado',
            ]
          ]);
        } */
        $article->delete();
        return response()->json(null, StatusCode::HTTP_NO_CONTENT);
    }

    public function getUserEmail(Article $article){
      return $article->user->email;
    }
}
