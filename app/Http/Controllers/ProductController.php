<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductFee;
use App\ProductImage;
use App\Topic;
use dodStorage;
use Illuminate\Http\Request;
use Response;
use SEO;
use Validator;

class ProductController extends Controller
{
    public $coverWidth = 500;
    public $coverHeight = 500;

    public function index(Product $product)
    {
        SEO::setTitle($product->name) ;
        SEO::setDescription($product->description) ;
        SEO::opengraph()->addImage(asset($product->cover)) ;
        $relates = Product::where('topic_id', $product->topic_id)->with('fees')->inRandomOrder()->take(4)->get() ;
        return view('app.product', compact('product', 'relates'));
    }

    public function all()
    {
        SEO::setTitle('ทองคำทั้งหมด');
        $products = Product::latest()->paginate(12);
        return view('app.product-all', compact('products'));
    }

    public function adminIndex()
    {
        $products = Product::latest()->paginate(50);
        return view('admin.product', compact('products'));
    }

    public function adminViewCreate()
    {
        $topics = Topic::all();
        return view('admin.product-create', compact('topics'));
    }

    public function adminCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'sku' => 'nullable|max:50',
            'cover' => 'required|mimes:jpeg,png,jpg',
            'description' => 'nullable|string',
            'topic_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all(),
            ], 422);
        }
        $productFee = json_decode($request->product_fee, true);
        if (count($productFee) <= 0) {
            return response()->json([
                'errors' => [__('message.fee_required')],
            ], 422);
        }
        $validatorFee = Validator::make($productFee, [
            '*.weight' => 'required|numeric|between:0,99.99',
            '*.weight_type' => 'required|string',
            '*.fee' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            '*.vip_discount' => 'required|numeric',
        ]);
        if ($validatorFee->fails()) {
            return response()->json([
                'errors' => $validatorFee->errors()->all(),
            ], 422);
        }

        $product = new Product;
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->description = $request->description;
        $product->cover = dodStorage::cropImageRatio($request->file('cover'), 'covers', 500, 500);
        $product->topic_id = $request->topic_id;
        $product->save();

        foreach ($productFee as $value) {
            $productFee = new ProductFee;
            $productFee->product_id = $product->id;
            $productFee->weight = $value["weight"];
            $productFee->weight_type = $value["weight_type"];
            $productFee->fee = $value["fee"];
            $productFee->vip_discount = $value["vip_discount"];
            $productFee->save();
        }

        $productPhoto = json_decode($request->product_photo, true);
        foreach ($productPhoto as $value) {
            $productImage = new ProductImage;
            $productImage->product_id = $product->id;
            $productImage->url = $value;
            $productImage->save();
        }

        return response()->json([
            'slug' => $product->slug,
        ]);
    }

    public function adminViewUpdate(Request $request)
    {
        $product = Product::findOrFail($request->query('id'));
        $topics = Topic::all();
        return view('admin.product-edit', compact('product', 'topics'));
    }

    public function adminUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'name' => 'required|max:255',
            'sku' => 'nullable|max:50',
            'description' => 'nullable|string',
            'topic_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        $productFee = json_decode($request->product_fee, true);
        if (count($productFee) <= 0) {
            return response()->json([
                'errors' => [__('message.fee_required')],
            ], 422);
        }
        $validatorFee = Validator::make($productFee, [
            '*.weight' => 'nullable|numeric',
            '*.weight_type' => 'required|string',
            '*.fee' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            '*.vip_discount' => 'required|numeric',
        ]);
        if ($validatorFee->fails()) {
            return response()->json([
                'errors' => $validatorFee->errors()->all(),
            ], 422);
        }

        $coverPath = '';
        if ($request->hasFile('cover')) {
            $coverPath = dodStorage::cropImageRatio($request->file('cover'), 'covers', 500, 500);
        }

        $product = Product::find($request->product_id);
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->description = $request->description;
        if ($request->hasFile('cover')) {
            dodStorage::delete($product->cover);
            $product->cover = $coverPath;
        }
        $product->topic_id = $request->topic_id;
        $product->save();

        ProductFee::where('product_id', $request->product_id)->delete();

        foreach ($productFee as $value) {
            $productFee = new ProductFee;
            $productFee->product_id = $product->id;
            $productFee->weight = $value["weight"];
            $productFee->weight_type = $value["weight_type"];
            $productFee->fee = $value["fee"];
            $productFee->vip_discount = $value["vip_discount"];
            $productFee->save();
        }

        return response()->json([
            'slug' => $product->slug,
        ]);
    }

    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,png,jpg',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        if ($request->hasFile('image')) {
            $imagePath = dodStorage::cropImageRatio($request->file('image'), 'products', 500, 500);

            if ($request->has('product_id')) {
                $p = new ProductImage;
                $p->product_id = $request->product_id;
                $p->url = $imagePath;
                $p->save();
            }
            return response()->json([
                'url' => $imagePath,
            ], 200);
        }

        return response()->json('', 400);
    }

    public function deleteImage(Request $request)
    {
        if ($request->has('id')) {
            ProductImage::where('id', $request->id)->delete();
        }
        dodStorage::delete($request->url);
        return response()->json('', 204);
    }

    public function adminDeleteProduct(Request $request)
    {
        $id = $request->product_id;
        $product = Product::find($id);
        if ($product) {
            ProductFee::where('product_id', $id)->delete();
            $image = ProductImage::where('product_id', $id)->get();
            foreach ($image as $value) {
                dodStorage::delete($value->url);
            }
            ProductImage::where('product_id', $id)->delete();
            dodStorage::delete($product->cover);
            $product->delete();
        }

        return redirect()->route('admin.product')->with([
            'success' => 'บันทึกเรียบร้อย',
        ]);
    }
}
