<?php

namespace App\Providers;

use App\GoldPrice;
use App\Order;
use App\Topic;
use Cart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Route;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('app.*', function ($view) {
            $listCart = Cart::getContent();
            $routeName = Route::currentRouteName();
		    echo $routeName;
            $allTopics = Topic::all();
            $view->with(compact('listCart', 'routeName', 'allTopics'));
        });
        View::composer('admin.*', function ($view) {
            $orderNotification = Order::where('status', 1)->count();
            $view->with(compact('orderNotification'));
        });

        View::composer(['app.home', 'app.product'], function ($view) {
            $goldPrice = GoldPrice::where('type', 'REF')->first();
            $view->with(compact('goldPrice'));
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
