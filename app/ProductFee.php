<?php

namespace App;

use App\GoldPrice;
use Illuminate\Database\Eloquent\Model;

class ProductFee extends Model {

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
        if ($this->weight == 0) {
            return '';
        }
        if ($this->weight > 1) {
            return number_format($this->weight, 0, '.', ',');
        }
        return number_format($this->weight, 2, '.', ',');
    }

    public function getPriceAttribute() {
        $goldPrice = GoldPrice::where('type', 'REF')->first();
        $sell = $goldPrice->sell;
        switch ($this->getOriginal('weight_type')) {
            case 0:
                return (($sell / 15.244) * $this->weight) + $this->fee;
                break;
            case 1:
                return ($sell / 8) + $this->fee;
                break;
            case 2:
                return (($sell / 4) * $this->weight) + $this->fee;
                break;
            case 3:
                return ($sell * $this->weight) + $this->fee;
                break;
            default:
                return ($sell * $this->weight) + $this->fee;
                break;
        }
    }
}
