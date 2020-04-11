<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
    public function bank() {
        return $this->belongsTo(Bank::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
