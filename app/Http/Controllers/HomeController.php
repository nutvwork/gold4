<?php

namespace App\Http\Controllers;

use App\AppConfig;
use App\Bank;
use App\Blog;

use App\GoldPrice;
use App\Order;
use App\Product;
use App\User;
use App\Topic;
use Cart;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SEO;

class HomeController extends Controller
{
    public function index()
    {
        SEO::setTitle('ห้างทองเยาวราชบางกอก');
        $productTopSelling = Product::select('slug', 'cover', 'name', DB::raw("count('order_details.product_id') as rank"))
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->groupBy('products.id', 'products.slug', 'products.cover', 'products.name')
            ->orderBy('rank', 'DESC')
            ->limit(10)
            ->get();

		/*$allTopics = Product::select('slug', 'cover', 'name', DB::raw("count('order_details.product_id') as rank"))
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->groupBy('products.id', 'products.slug', 'products.cover', 'products.name')
            ->orderBy('rank', 'DESC')
            ->limit(10)
            ->get();
			*/

			SEO::setTitle('ห้างทองเยาวราชบางกอก');
           $productTopSelling = Product::select('slug', 'cover', 'name', DB::raw("count('order_details.product_id') as rank"))
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->groupBy('products.id', 'products.slug', 'products.cover', 'products.name')
            ->orderBy('rank', 'DESC')
            ->limit(10)
            ->get();

        $slides = AppConfig::where('key', 'slide')->inRandomOrder()->take(4)->get();
        $promotions = AppConfig::where('key', 'promotion')->inRandomOrder()->take(3)->get();
        $blogs = Blog::inRandomOrder()->take(3)->get();

        return view('app.home', compact('slides', 'promotions', 'blogs', 'productTopSelling','GoldPrice'));

		 $allTopics = Topic::all();
         $listCart = Cart::getContent();

        $slides = AppConfig::where('key', 'slide')->inRandomOrder()->take(4)->get();
        $promotions = AppConfig::where('key', 'promotion')->inRandomOrder()->take(3)->get();
        $blogs = Blog::inRandomOrder()->take(3)->get();

        return view('app.home', compact('slides', 'promotions', 'blogs', 'productTopSelling','allTopics','listCart'));
    }

    public function adminIndex()
    {
        $now = Carbon::now();
        $totalToday = Order::selectRaw('COALESCE(SUM((select SUM(price * quantity) from `order_details` where `orders`.`id` = `order_details`.`order_id`)), 0) as `total`')
            ->where('status', '>', 1)
            ->whereDate('created_at', Carbon::today())
            ->first();

        $totalMonth = Order::selectRaw('COALESCE(SUM((select SUM(price * quantity) from `order_details` where `orders`.`id` = `order_details`.`order_id`)), 0) as `total`')
            ->where('status', '>', 1)
            ->whereMonth('created_at', $now->month)
            ->first();

        $totalYear = Order::selectRaw('COALESCE(SUM((select SUM(price * quantity) from `order_details` where `orders`.`id` = `order_details`.`order_id`)), 0) as `total`')
            ->where('status', '>', 1)
            ->whereYear('created_at', $now->year)
            ->first();

        $userCount = User::count('id');

        return view('admin.index', compact('totalToday', 'totalMonth', 'totalYear', 'userCount'));
    }

    public function contact()
    {
        $banks = Bank::all();
        return view('app.contact', compact('banks'));
    }

    public function goldSaving()
    {
        SEO::setTitle('ออมทองกับเรา');
        SEO::setDescription('สามารถเปิดบัญชีออมทองคำได้แล้ววันนี้ที่ ห้างทองเยาวราชบางกอก ทั้ง 4 สาขา');
        return view('app.gold-saving');
    }
}
