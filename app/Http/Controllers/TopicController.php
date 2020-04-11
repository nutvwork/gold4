<?php

namespace App\Http\Controllers;

use App\Product;
use App\Topic;
use Illuminate\Http\Request;
use SEO;

class TopicController extends Controller {

    public function index(Topic $topic) {
		//print_r($topic);
        SEO::setTitle($topic->name ) ;
        $products = $topic->products()->with('fees')->paginate(12);
		// with('fees') คือ Eager Loader
        return view('app.topic', compact('topic', 'products'));
    }

    public function adminIndex() {
        $topics = Topic::all();
        return view('admin.topic', compact('topics'));
    }

    public function adminView() {
        return view('admin.topic-create');
    }

    public function adminCreate(Request $request) {
        $request->validate([
            'name' => 'required|unique:topics|max:255',
        ]);
        Topic::create([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.topic.create')->with([
            'success' => 'บันทึกเรียบร้อย',
        ]);
    }

    public function adminViewUpdate(Request $request) {
        $topic = Topic::findOrFail($request->query('id'));
        return view('admin.topic-edit', compact('topic'));
    }

    public function adminUpdate(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        Topic::where('id', $request->id)->update([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.topic')->with([
            'success' => 'บันทึกข้อมูลเรียบร้อย',
        ]);
    }

    public function adminDelete(Request $request) {
        $topicID = $request->topic_id;

        $product = Product::where('topic_id', $topicID)->first();

        if ($product) {
            return redirect()->route('admin.topic')->withErrors([
                'cant_delete' => __('message.error_delete_topic'),
            ]);
        }

        Topic::find($topicID)->delete();

        return redirect()->route('admin.topic')->with([
            'success' => 'ลบข้อมูลเรียบร้อย',
        ]);
    }
}
