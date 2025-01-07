<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;





class PostController extends Controller
{
    use AuthorizesRequests;



    public function index()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $posts = Post:: all();

        return view('posts.index', compact('posts','tags','categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create', compact('categories', 'tags'));
    }


    public function store(Request $request)
    {
        $this->authorize('createPost', Post::class);
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array', // تأكد من أن التاغات مصفوفة
            'tags.*' => 'exists:tags,id', // تأكد من أن كل تاج موجود في جدول التاغات
        ]);

        // إنشاء البوست
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
        ]);


        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }



    public function show(Post $post)
    {

        $categories = Category::all();
        $tags = Tag::all();
        $comments = $post->comments ;

        return view('posts.show', compact('post','tags','categories','comments'));
    }

    public function edit(Post $post)
    {
        $this->authorize('updatePost', $post);

        $post = Post::findOrFail($post->id);
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.edit', compact('categories', 'tags','post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('updatePost', $post);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags' => "exists:tags,id"
        ]);
       Post::findOrFail($post->id);
        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id']
        ]);

        $post->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }




    public function destroy(Post $post)
    {
          $this->authorize('deletePost', $post);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }

}
