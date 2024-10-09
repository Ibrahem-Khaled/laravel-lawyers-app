<?php
namespace App\Http\Controllers\dashboard;

use App\Models\Post;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->role == 'admin' || Auth::user()->role == 'supervisor' ? Post::all() : Post::where('user_id', Auth::user()->id)->get();
        $users = User::all(); // Fetch all users to select from them
        return view('dashboard.posts', compact('posts', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'user_id' => 'required|exists:users,id', // Ensure user exists
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Post::create([
            'user_id' => $validated['user_id'],
            'title' => $validated['title'],
            'body' => $validated['body'],
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'تم إضافة المنشور بنجاح.');
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image) {
                \Storage::delete($post->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $post->image;
        }

        $post->update([
            'user_id' => $validated['user_id'],
            'title' => $validated['title'],
            'body' => $validated['body'],
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'تم تحديث المنشور بنجاح.');
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            \Storage::delete($post->image);
        }
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'تم حذف المنشور بنجاح.');
    }
}
