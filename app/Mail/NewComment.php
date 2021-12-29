<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Models\Comment;

class NewComment extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;

    public function __construct(Comment $newComment)
    {
      $this->comment = $newComment;
    }

    public function build()
    {
        return $this->view('emails.comments.new');
    }
}
