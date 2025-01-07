<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Tag;

class UserPolicy
{
    // السماح بإنشاء البوست
    public function createPost(User $user)
    {
        return true;
    }

    // السماح بمشاهدة جميع البوستات
    public function viewAnyPost(User $user)
    {
        return true;
    }

    // السماح بمشاهدة بوست معين
    public function viewPost(User $user, Post $post)
    {
        return true;
    }

    // السماح بتعديل بوست
    public function updatePost(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    // السماح بحذف بوست
    public function deletePost(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    // السماح بإضافة تعليق على بوست
    public function createComment(User $user, Post $post)
    {
        return true;
    }

    // السماح بتعديل تعليق
    public function updateComment(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }

    // السماح بحذف تعليق
    public function deleteComment(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id || $user->id === $comment->post->user_id;
    }

    // السماح للأدمن بإدارة التصنيفات (Categories)
    public function manageCategory(User $user)
    {
        return $user->is_admin;
    }

    // السماح للأدمن بإدارة التاغات (Tags)
    public function manageTag(User $user)
    {
        return $user->is_admin;
    }
}
