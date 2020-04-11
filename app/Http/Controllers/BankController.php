<?php

namespace App\Http\Controllers;

use App\Bank;
use dodStorage;
use Illuminate\Http\Request;
use Validator;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::all();
        return view('admin.bank', compact('banks'));
    }

    public function viewCreate(Request $request)
    {
        return view('admin.bank-create');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required|string',
            'account_name' => 'required|string',
            'account_no' => 'required|string',
            'image' => 'nullable|mimes:jpeg,jpg,png',
        ])->validate();

        $bank = new Bank;
        $bank->bank_name = $request->bank_name;
        $bank->account_name = $request->account_name;
        $bank->account_no = $request->account_no;
        if ($request->hasFile('image')) {
            $bank->url_image = dodStorage::cropImage($request->file('image'), 'bank', 100, 100);
        }
        $bank->save();

        return redirect()->route('admin.bank');
    }

    public function viewUpdate(Request $request)
    {
        $bank = Bank::find($request->query('id'));

        if (!$bank) {
            return redirect()->route('admin.bank');
        }

        return view('admin.bank-edit', compact('bank'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required|string',
            'account_name' => 'required|string',
            'account_no' => 'required|string',
            'image' => 'nullable|mimes:jpeg,jpg,png',
        ])->validate();

        $bank = Bank::find($request->id);
        if (!$bank) {
            return redirect()->route('admin.bank');
        }
        $bank->bank_name = $request->bank_name;
        $bank->account_name = $request->account_name;
        $bank->account_no = $request->account_no;
        if ($request->hasFile('image')) {
            dodStorage::delete($bank->url_image);
            $bank->url_image = dodStorage::cropImage($request->file('image'), 'bank', 100, 100);
        }
        $bank->save();

        return redirect()->route('admin.bank')->with([
            'success' => __('message.success'),
        ]);
    }
}
