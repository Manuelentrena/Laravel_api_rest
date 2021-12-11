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
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    private static $rulesStore = [
      'title' => 'required|string|unique:articles|max:255',
      'body' => 'required',
      'category_id' => 'exists:categories,id',
      'image' => 'required|image|dimensions:min_width=200,min_height=200',
    ];

    private function rulesUpdate($article_id){
      // Ignoramos el title, ya que unique da problemas al actualizar
      return [
        'title' => 'required|string|unique:articles,title,'.$article_id.'|max:255',
        'body' => 'required',
        'category_id' => 'exists:categories,id',
      ];
    }

    private static $messages = [
      'required' => 'El campo :attribute es obligatorio',
      'string' => 'El campo :attribute debe ser string',
      'unique' => 'El campo :attribute debe ser único',
      'max' => 'Longitud máxima de :attribute superada',
      'category_id.exists' => 'No existe la category ID',
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
        $validatedData = $request->validate(self::$rulesStore, self::$messages);
        $article = new Article($validatedData);
        // Add image
        $path = $article->image->store('public/articles'); 
          //Save file in cd storage/public how idUser_title.extension
          //->storeAs('public/articles',  $validatedData->user()->id. '_' . $article->title . '.' .$validatedData->image->extension()); 
        $article->image = $path;
        $article->save();

        return response()->json(new ArticleResource($article), StatusCode::HTTP_CREATED);
    }

    public function show(Article $article)
    {
      return response()->json(new ArticleResource($article), StatusCode::HTTP_OK);
    }

    public function image(Article $article)
    {
      return response()->download(public_path(Storage::url($article->image)),$article->title);
    }

    public function update(Request $request, Article $article)
    {
      $validatedData = $request->validate($this->rulesUpdate($article->id), self::$messages);
      $article->update($validatedData);
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
