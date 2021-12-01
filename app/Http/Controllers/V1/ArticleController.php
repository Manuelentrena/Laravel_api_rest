<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Models\Article;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Resources\ArticleCollection;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as StatusCode;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    private static $rules = [
      'title' => 'required|string|unique:articles|max:255',
      'body' => 'required',
    ];

    private static $messages = [
      'required' => 'El campo :attribute es obligatorio',
      'string' => 'El campo :attribute debe ser string',
      'unique' => 'El campo :attribute debe ser único',
      'max' => 'Longitud máxima de :attribute superada',
    ];

    public function index()
    {
        return new ArticleCollection(Article::paginate());
    }

    
    public function store(Request $request)
    {
        // METHOD 1

        /* $validatedData = Validator::make($request->all(),[
          'title' => 'required|string|unique:articles|max:255',
          'body' => 'required',
        ]);

        if($validatedData->fails()){
          return response()->json([
            'error' => 'datos inválidos', 
            'msg' => $validatedData->errors()
          ],
          StatusCode::HTTP_BAD_REQUEST);
        } */

        // METHOD 2
        $validatedData = $request->validate(self::$rules, self::$messages);

        $article = Article::create($validatedData);
        return response()->json($article, StatusCode::HTTP_CREATED);
    }

    
    public function show(Article $article)
    {
        return response()->json(new ArticleResource($article), StatusCode::HTTP_OK);
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
