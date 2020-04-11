<?php

namespace App\Http\Controllers;

use App\AppConfig;
use dodStorage;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    public function index()
    {
        $slides = AppConfig::where('key', 'slide')->latest()->get();
        return view('admin.slide', compact('slides'));
    }

    public function viewCreate()
    {
        return view('admin.slide-create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg',
        ]);

        $slide = new AppConfig;
        $slide->key = 'slide';
        $slide->value = dodStorage::cropImage($request->file('image'), 'slides', 1970, 500);
        $slide->save();

        return redirect()->route('admin.slide')->with([
            'success' => 'บันทึกภาพสไลด์เรียบร้อย',
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'slide_id' => 'required|integer',
        ]);

        $slide = AppConfig::find($request->slide_id);
        dodStorage::delete($slide->value);
        $slide->delete();

        return redirect()->route('admin.slide')->with([
            'success' => 'ลบภาพสไลด์เรียบร้อย',
        ]);
    }
}
