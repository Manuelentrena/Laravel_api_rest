<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Models\Comment;
use App\Http\Models\Article;
use Illuminate\Http\Request;
use App\Http\Resources\Comment as CommentResource;
use Symfony\Component\HttpFoundation\Response as StatusCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewComment;

class CommentController extends Controller
{
    private static $rules = [
      'text' => 'required|string',
    ];

    private static $messages = [
      'required' => 'El campo :attribute es obligatorio',
      'string' => 'El campo :attribute debe ser string',
    ];

    public function index(Article $article)
    {
      $comments = $article->comments;
      return response()->json(CommentResource::collection($comments), StatusCode::HTTP_CREATED);
    }

    public function store(Request $request, Article $article)
    {
      $validatedComment = $request->validate(self::$rules, self::$messages);
      $newComment = $article->comments()->save(new Comment($validatedComment));

      // Send Email to Author
      Mail::to($article->user)
      //->cc("New Comment in your Article")
      //->bcc($evenMoreUsers)
      ->send(new NewComment($newComment));



      return response()->json(new CommentResource($newComment), StatusCode::HTTP_CREATED);
    }

    public function show(Article $article, $id)
    {
      $comment = $article->comments->where('id', '=', $id)->first();
      return response()->json(new CommentResource($comment), StatusCode::HTTP_CREATED);
    }

    public function update(Request $request, Comment $comment)
    {
        //
    }

    public function destroy(Comment $comment)
    {
        //
    }
}
