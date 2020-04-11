<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model {
    protected $fillable = [
        'name',
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    use Sluggable;
    public function sluggable() {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
