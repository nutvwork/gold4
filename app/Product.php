<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model {
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

    public function fees() {
        return $this->hasMany(ProductFee::class)
            ->orderBy('weight_type')
            ->orderBy('weight')
                        ;
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    public function topic() {
        return $this->belongsTo(Topic::class);
    }
    public function rrr(){

           
    }



}
?>

