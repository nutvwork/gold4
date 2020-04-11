<?php

namespace App\Http\Controllers;

use App\AppConfig;
use dodStorage;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = AppConfig::where('key', 'promotion')->latest()->get();
        return view('admin.promotion', compact('promotions'));
    }

    public function viewCreate()
    {
        return view('admin.promotion-create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg',
            'url' => 'nullable|url',
        ], [
            'url.url' => 'ลิงก์ไม่ถูกรูปแบบ กรุณาตรวจสอบ',
        ]);

        $slide = new AppConfig;
        $slide->key = 'promotion';
        $slide->value = dodStorage::cropImageRatio($request->file('image'), 'promotions', 350, 180);
        $slide->value_2 = $request->url;
        $slide->save();

        return redirect()->route('admin.promotion')->with([
            'success' => 'บันทึกภาพโปรโมชั่นเรียบร้อย',
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'promotion_id' => 'required|integer',
        ]);

        $promotion = AppConfig::find($request->promotion_id);
        dodStorage::delete($promotion->value);
        $promotion->delete();

        return redirect()->route('admin.promotion')->with([
            'success' => 'ลบภาพโปรโมชั่นเรียบร้อย',
        ]);
    }

    public function viewUpdate(Request $request)
    {
        $promotionID = $request->query('id');
        $promotion = AppConfig::find($promotionID);

        return view('admin.promotion-edit', compact('promotion'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpeg,png,jpg',
            'url' => 'nullable|url',
        ], [
            'url.url' => 'ลิงก์ไม่ถูกรูปแบบ กรุณาตรวจสอบ',
        ]);

        $promotion = AppConfig::find($request->slide_id);
        if ($request->hasFile('image')) {
            $promotion->value = dodStorage::cropImageRatio($request->file('image'), 'promotions', 350, 180);
        }
        $promotion->value_2 = $request->url;
        $promotion->save();

        return redirect()->route('admin.promotion')->with([
            'success' => 'แก้ไขภาพโปรโมชั่นเรียบร้อย',
        ]);
    }
}
