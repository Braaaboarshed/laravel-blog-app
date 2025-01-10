<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Tag;

class UserPolicy
{
    //   
    public function createPost(User $user)
    {
        return true;
    }

    //    
    public function viewAnyPost(User $user)
    {
        return true;
    }

    //    
    public function viewPost(User $user, Post $post)
    {
        return true;
    }

    //   
    public function updatePost(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    //   
    public function deletePost(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    //     
    public function createComment(User $user, Post $post)
    {
        return true;
    }

    //   
    public function updateComment(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }

    //   
    public function deleteComment(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id || $user->id === $comment->post->user_id;
    }

    //     (Categories)
    public function manageCategory(User $user)
    {
        return $user->is_admin;
    }

    //     (Tags)
    public function manageTag(User $user)
    {
        return $user->is_admin;
    }
}
