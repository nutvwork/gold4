<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

	function dateTh($strDate)
 {
     $strYear = date("Y", strtotime($strDate)) + 543;
     $strMonth = date("n", strtotime($strDate));
     $strDay = date("j", strtotime($strDate));
     $strMonthThai = getMonth($strMonth);
     return "$strDay $strMonthThai พ.ศ. $strYear";
 }
}
