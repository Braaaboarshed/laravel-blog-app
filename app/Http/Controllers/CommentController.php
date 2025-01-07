<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    use AuthorizesRequests;

    // دالة تخزين التعليق (store)
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $post = Post::findOrFail($postId);
        $this->authorize('createComment', $post);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post->id;
        $comment->save();

        return redirect()->route('posts.show', $post->id)->with('success', 'Comment added successfully!');
    }

    // دالة عرض تعديل التعليق (edit)
    public function edit(Comment $comment)
    {
        // التأكد من أن المستخدم هو من أضاف التعليق
        if ($comment->user_id != Auth::user()->id) {
            return redirect()->route('posts.show', $comment->post_id)->with('error', 'You cannot edit this comment');
        }

        return view('comments.edit', compact('comment'));
    }

    // دالة تحديث التعليق (update)
    public function update(Request $request, Comment $comment)
    {
        // if ($comment->user_id != Auth::user()->id) {
        //     return redirect()->route('posts.show', $comment->post_id)->with('error', 'You cannot update this comment');
        // }
        $this->authorize('updateComment', $comment);

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->content = $request->content;
        $comment->save();

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment updated successfully!');
    }

    // دالة حذف التعليق (destroy)
    public function destroy(Comment $comment)
    {
        $this->authorize('deleteComment', $comment);


        $comment->delete();

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment deleted successfully!');
    }
}

