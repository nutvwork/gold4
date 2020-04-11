<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Order extends Model {
    protected $fillable = ['user_id', 'name', 'address1', 'address2', 'amphoe', 'province', 'zip', 'phone', 'status', 'shipping_price'];

    use Notifiable;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function details() {
        return $this->hasMany(OrderDetail::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function provinceData() {
        return $this->belongsTo(Province::class, 'province', 'code');
    }

    public function due_date() {
        return Carbon::parse($this->created_at)->addHours(1);
    }

    public function scopeNotCancle($query) {
        return $query->where('created_at', '>=', Carbon::now()->subHour());
    }

    public function scopeIsCancle($query) {
        return $query->where('created_at', '<=', Carbon::now()->subHour());
    }

    public function routeNotificationForMail($notification) {
        return $this->user->email;
    }

    public function getStatusTextAttribute() {
        switch ($this->status) {
            case 0:
                return 'รอชำระเงิน';
                break;
            case 1:
                return 'รอยืนยันการชำระเงิน';
                break;
            case 2:
                return 'เตรียมจัดส่งสินค้า';
                break;
            case 3:
                return 'จัดส่งสินค้าแล้ว';
                break;
            default:
                return 'รอชำระเงิน';
                break;
        }
    }
}
