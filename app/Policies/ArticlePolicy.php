<?php

namespace App\Policies;

use App\Article;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
    }

    public function update(User $user, Article $article) {
		return $user->ownsArticle($article);
    }
    
    public function destroy(User $user, Article $article) {
		return $user->ownsArticle($article);
	}
}
