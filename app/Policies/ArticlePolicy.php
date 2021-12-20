<?php

namespace App\Policies;

use App\Http\Models\Article;
use App\Http\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    //Hook que se ejecuta antes de hacer cualquier verificacion
    public function before(User $user, $ability)
    {
      if ($user->isGranted(User::ROLE_SUPERADMIN)) {
        return true;
      }
    }

    // Para ver el lista de articulos
    public function viewAny(User $user)
    {
      //
    }

    // Para ver el detalle de un articulo
    public function view(User $user, Article $article)
    {
      return $user->isGranted(User::ROLE_USER);
    }

    public function create(User $user)
    {
      return $user->isGranted(User::ROLE_USER);
    }

    public function update(User $user, Article $article)
    {
      return $user->isGranted(User::ROLE_USER) && $user->id === $article->user_id;
    }

    public function delete(User $user, Article $article)
    {
      return $user->isGranted(User::ROLE_ADMIN);
    }

    public function restore(User $user, Article $article)
    {
        //
    }

    public function forceDelete(User $user, Article $article)
    {
        //
    }
}
