<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Product;
use App\ProductFee;
use App\Province;
use Auth;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SEO;

class CartController extends Controller {
    private $cartTable = [];
    private $shippingPrice = 1250;
    private $subTotal = 0;
    private $total = 0;

    public function index() {
        SEO::setTitle('ตะกร้า');
        $this->updateCart();
        return view('app.cart', [
            'cartTable' => $this->cartTable,
            'shippingPrice' => $this->shippingPrice,
            'subTotal' => $this->subTotal,
            'total' => $this->total,
        ]);
    }

    public function addCart(Request $request) {
        $product = Product::find($request->product_id);
        $fee = ProductFee::find($request->fee_id);
        $amount = (int) $request->amount;
        if (!$product) {
            return response()->json('', 400);
        }
        Cart::add(array(
            'id' => $fee->id,
            'name' => $product->name,
            'price' => $fee->price, 2,
            'quantity' => $amount,
            'attributes' => array(
                'product_id' => $product->id,
                'product_cover' => $product->cover,
                'product_slug' => $product->slug,
                'fee_id' => $fee->id,
            ),
        ));

        return response()->json('', 204);
    }

    public function getCart(Request $request) {
        $carts = Cart::getContent();
        $total = Cart::getTotal();
        return response()->json([
            'count' => $carts->count(),
            'list' => $carts,
            'total' => number_format($total, 2),
        ], 200);
    }

    public function deleteItem(Request $request) {
        $id = $request->cart_id;
        if ($id == "") {
            return response()->json('', 400);
        }
        Cart::remove($id);
        return response()->json('', 204);
    }

    public function clearCart(Request $request) {
        Cart::clear();
        return redirect()->route('cart');
    }

    public function checkout() {
        SEO::setTitle('สั่งซื้อสินค้า');
        if (Cart::isEmpty()) {
            return redirect()->route('home');
        }
        $this->updateCart();
        $provinces = Province::select('code', 'name')->orderBy('name')->get();

        return view('app.checkout', [
            'cartTable' => $this->cartTable,
            'shippingPrice' => $this->shippingPrice,
            'subTotal' => $this->subTotal,
            'total' => $this->total,
            'provinces' => $provinces,
        ]);
    }

    public function confirmCheckout(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'address1' => 'required|string',
            'address2' => 'required|string',
            'amphoe' => 'required|string',
            'province' => 'required|integer',
            'zip' => 'required|integer',
            'phone' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            if (Cart::isEmpty()) {
                throw new \Exception('Cart is Empty.');
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'amphoe' => $request->amphoe,
                'province' => $request->province,
                'zip' => $request->zip,
                'phone' => $request->phone,
                'shipping_price' => $this->shippingPrice,
                'status' => 0,
            ]);

            $this->updateCart();
            $carts = Cart::getContent();

            foreach ($carts as $cart) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->attributes->product_id,
                    'weight' => $cart->attributes->fee_weight,
                    'weight_type' => $cart->attributes->fee_type,
                    'price' => $cart->price,
                    'quantity' => $cart->quantity,
                ]);
            }
        } catch (ValidationException $e) {
            DB::rollback();
            return redirect()->route('cart')->withErrors($e->getErrors());
        }
        DB::commit();

        Cart::clear();
        return redirect()->route('account.order', ['id' => $order->id]);
    }


    private function updateCart() {
        $carts = Cart::getContent();
        if (!Cart::isEmpty()) {
            $productListID = $carts->pluck('attributes.product_id')->unique();
            $products = Product::whereIn('id', $productListID)->with('fees')->get();

            foreach ($carts as $cart) {
                // get product from collection when id equal cart id
                $product = $products->filter(function ($value, $key) use ($cart) {
                    return $value->id == $cart->attributes->product_id;
                })->first();

                // sort product fees with id and get fees from cart id
                $fee = array_get($product->fees->keyBy('id'), $cart->id);
                if (!$fee) {
                    Cart::remove($cart->id);
                    continue;
                }
                array_push($this->cartTable, [
                    'id' => $fee->id,
                    'name' => $product->name,
                    'price' => $fee->price,
                    'quantity' => $cart->quantity,
                    'attributes' => array(
                        'product_id' => $product->id,
                        'product_cover' => $product->cover,
                        'product_slug' => $product->slug,
                        'fee_id' => $fee->id,
                        'fee_type' => $fee->weight_type,
                        'fee_weight' => $fee->weight,
                        'fee_text' => $fee->weight_text,
                    ),
                ]);

                $this->subTotal += $fee->price * $cart->quantity;
            }
            $this->total = $this->subTotal + $this->shippingPrice;
        }

        // clear cart and update last price to session cart
        if (collect($this->cartTable)->isNotEmpty()) {
            Cart::clear();
            Cart::add($this->cartTable);
        }
    }
}
