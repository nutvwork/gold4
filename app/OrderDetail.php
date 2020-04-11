<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model {
    protected $fillable = ['order_id', 'product_id', 'weight', 'weight_type', 'quantity', 'price'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function setWeightTypeAttribute($value) {
        switch ($value) {
            case 'กรัม':
                $this->attributes['weight_type'] = 0;
                break;
            case 'ครึ่งสลึง':
                $this->attributes['weight_type'] = 1; // ครึ่งสลึง
                break;
            case 'สลึง':
                $this->attributes['weight_type'] = 2; // สลึง
                break;
            case 'บาท':
                $this->attributes['weight_type'] = 3;
                break;
            default:
                $this->attributes['weight_type'] = 3;
                break;
        }
    }

    public function getWeightTypeAttribute($value) {
        switch ($value) {
            case 0:
                return 'กรัม';
                break;
            case 1:
                return 'ครึ่งสลึง'; // ครึ่งสลึง
                break;
            case 2:
                return 'สลึง'; // สลึง
                break;
            case 3:
                return 'บาท';
                break;
            default:
                return 'บาท';
                break;
        }
    }

    public function getWeightTextAttribute() {
        $weight = number_format($this->weight);
        if ($weight == 0) {
            return '';
        }
        return $weight;
    }

    public function getSubtotalOrderAttribute($value) {
        return $this->quantity * $this->price;
    }
}
