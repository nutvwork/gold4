<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model {
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /*use Sluggable;
    public function sluggable() {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
	*/

    public function getRouteKeyName() {
        return 'slug';
    }
}
