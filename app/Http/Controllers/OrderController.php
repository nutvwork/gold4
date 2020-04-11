<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Notifications\ShipTrack;
use App\Order;
use App\Payment;
use Auth;
use Carbon\Carbon;
use dodStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SEO;
use Validator;

class OrderController extends Controller
{
    public function adminIndex()
    {
        $orders = Order::whereIn('status', [1, 2])
            ->orderBy('status')
            ->get();
        return view('admin.order', compact('orders'));
    }

    public function adminViewUpdate(Request $request)
    {
        $order = Order::where('id', $request->id)
            ->withCount(['details as total' => function ($query) {
                $query->select(DB::raw('SUM(price * quantity)'));
            }])
            ->first();
        return view('admin.order-edit', compact('order'));
    }

    public function adminUpdate(Request $request)
    {
        $order = Order::find($request->order_id);
        if ($order->status == 2) {
            $request->validate([
                'no' => 'required|string|max:255',
            ], [
                'no.required' => 'กรุณากรอกเลขพัสดุ',
            ]);
            $order->shipping_track = $request->no;
            $order->save();
            $order->increment('status', 1);
            $order->notify(new ShipTrack($order));
            return redirect()->route('admin.order')->with([
                'success' => __('message.success'),
            ]);
        }
        if ($request->action === 'reject') {
            $order->decrement('status', 1);
        } else {
            $order->increment('status', 1);
        }
        return redirect()->route('admin.order')->with([
            'success' => __('message.success'),
        ]);
    }

    public function order(Request $request)
    {
        SEO::setTitle('รายการสั่งซื้อ');
        $id = $request->query('id');
        if ($id) {
            $order = Order::where('user_id', Auth::id())
                ->where('id', $id)
                ->where('status', 0)
                ->withCount(['details as total' => function ($query) {
                    $query->select(DB::raw('SUM(price * quantity)'));
                }])
                ->notCancle()
                ->first();
            if (!$order) {
                return redirect()->route('account.order');
            }
            $banks = Bank::all();
            $now = Carbon::now();
            return view('app.account-order-detail', compact('order', 'now', 'banks'));
        }
        $orders = Order::select('id', 'created_at', 'shipping_price', 'status')
            ->where('user_id', Auth::id())
            ->where('status', 0)
            ->withCount(['details as total' => function ($query) {
                $query->select(DB::raw('SUM(price * quantity)'));
            }])
            ->notCancle()
            ->get();
        return view('app.account-order', compact('orders'));
    }

    public function orderConfirm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slip' => 'required|mimes:jpeg,jpg,png',
        ], [
            'slip.required' => 'กรุณาอัพโหลดรูปสลิป',
        ])->validate();

        $request->flash();
        $year = $request->year;
        $month = $request->month;
        $day = $request->day;
        $hour = $request->hour;
        $minute = $request->minute;
        $orderID = $request->order_id;
        $amount = $request->amount;
        $bankID = $request->bank_id;

        $order = Order::notCancle()
            ->where('id', $orderID)
            ->withCount(['details as total' => function ($query) {
                $query->select(DB::raw('SUM(price * quantity)'));
            }])
            ->first();
        if (!$order) {
            return redirect()->route('account.order');
        }

        $grandTotal = floatval($order->total) + floatval($order->shipping_price);
        if (floatval($amount) < $grandTotal) {
            return redirect()->back()->withErrors([
                'errors' => __('validation.transfer_amount_invalid'),
            ])->withInput($request->all());
        }

        $pay = new Payment;
        $pay->order_id = $orderID;
        $pay->bank_id = $bankID;
        $pay->price = $amount;
        $pay->payment_date = Carbon::create($year, $month, $day, $hour, $minute);
        //$pay->url_slip = dodStorage::store($request->file('slip'), 'slip');
        $pay->save();
        $order->increment('status', 1);
        return redirect()->route('account.order')
            ->with('success', __('message.success_transfer_order'));
    }

    public function history(Request $request)
    {
        SEO::setTitle('ประวัติการสั่งซื้อ');
        $id = $request->query('id');
        if ($id) {
            $order = Order::where('user_id', Auth::id())
                ->where('id', $id)
                ->where('status', '>', 0)
                ->withCount(['details as total' => function ($query) {
                    $query->select(DB::raw('SUM(price * quantity)'));
                }])
                ->first();
            if (!$order) {
                return redirect()->route('account.history');
            }
            return view('app.account-history-detail', compact('order'));
        }
        $orders = Order::select('id', 'created_at', 'status')
            ->where('user_id', Auth::id())
            ->where('status', '>', 0)
            ->get();
        return view('app.account-history', compact('orders'));
    }
}
