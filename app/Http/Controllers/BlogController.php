<?php

namespace App\Http\Controllers;

use App\Blog;
use dodStorage;
use Illuminate\Http\Request;
use SEO;

class BlogController extends Controller
{
    public function index()
    {
        SEO::setTitle('ความรู้เกี่ยวกับทอง');
        $blogs = Blog::select('title', 'cover', 'slug')->get();
        return view('app.blog', compact('blogs'));
    }

    public function view(Blog $blog)
    {
        SEO::setTitle($blog->title);
        SEO::setDescription(str_limit($blog->body, 70));
        $relateBlog = Blog::select('title', 'cover', 'slug')->whereNotIn('id', [$blog->id])->inRandomOrder()->take(4)->get();
        return view('app.blog-single', compact('blog', 'relateBlog'));
    }

    public function adminIndex()
    {
        $blogs = Blog::all();
        return view('admin.blog', compact('blogs'));
    }
    public function adminViewCreate()
    {
        return view('admin.blog-create');
    }
    public function adminCreate(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'cover' => 'required|mimes:jpeg,png,jpg',
        ]);

        $blog = new Blog;
        $blog->title = $request->title;
        $blog->body = $request->body;
        $blog->cover = dodStorage::cropImage($request->file('cover'), 'blogs', 350, 180);
        $blog->cover_full = dodStorage::cropImageRatio($request->file('cover'), 'blogs/full', 1200, 500);
        $blog->save();

        return redirect()->route('admin.blog')->with([
            'success' => 'บันทึกสำเร็จ',
        ]);
    }
    public function adminViewUpdate(Request $request)
    {
        $blog = Blog::find($request->id);
        return view('admin.blog-edit', compact('blog'));
    }
    public function adminUpdate(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|integer',
            'title' => 'required|max:255',
            'body' => 'required',
            'cover' => 'mimes:jpeg,png,jpg',
        ]);

        $blog = Blog::find($request->blog_id);
        $blog->title = $request->title;
        $blog->body = $request->body;
        if ($request->hasFile('cover')) {
            dodStorage::delete($blog->cover);
            dodStorage::delete($blog->cover_full);
            $blog->cover = dodStorage::cropImage($request->file('cover'), 'blogs', 350, 180);
            $blog->cover_full = dodStorage::cropImageRatio($request->file('cover'), 'blogs/full', 1200, 500);
        }
        $blog->save();

        return redirect()->route('admin.blog')->with([
            'success' => 'บันทึกสำเร็จ',
        ]);
    }

    public function adminDelete(Request $request)
    {
        Blog::find($request->blog_id)->delete();
        return redirect()->route('admin.blog')->with([
            'success' => 'บันทึกสำเร็จ',
        ]);
    }
}
