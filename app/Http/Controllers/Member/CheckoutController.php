<?php

namespace App\Http\Controllers\Member;

use App\Helper\RajaOngkir;
use App\Http\Controllers\Controller;
use App\Http\Requests\Member\CheckoutRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\ShippingCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $carts = Cart::memberCarts()->with('product', 'member', 'product.image')->get();

        if ($carts->count() <= 0) {
            return back();
        }

        $total = $carts->reduce(function ($total, $item) {
            return $total + $item->product->price * $item->quantity;
        }, 0);

        $areas     = ShippingCost::all();
        $provinces = RajaOngkir::provinces();
        $couriers  = Shipping::SHIPPING_REGULAR_COURIER;

        return view('member.pages.checkout.index', compact('carts', 'total', 'areas', 'provinces', 'couriers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CheckoutRequest $request
     * @return string
     */
    public function store(CheckoutRequest $request)
    {
        $userInformation = [
            "name"  => auth()->user()->name,
            "email" => auth()->user()->email,
        ];

        DB::beginTransaction();
        try {

            // save shipping first
            $shipping = new Shipping(array_merge($userInformation, $request->all(), $request->only('cost'), ["user_id" => auth()->id()]));
            $shipping->save();

            // move member carts into order
            $carts = Cart::memberCarts()->get()->map(function ($cart) use ($shipping) {
                return [
                    "user_id"     => $cart['user_id'],
                    "admin_id"    => $cart['admin_id'],
                    "product_id"  => $cart['product_id'],
                    "quantity"    => $cart['quantity'],
                    "shipping_id" => $shipping->id,
                    "created_at"  => now()->toDateTimeString(),
                    "updated_at"  => now()->toDateTimeString(),
                ];
            })->toArray();

            Order::query()->insert($carts);

            // delete member carts after order inserted
            Cart::memberCarts()->delete();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            return "Something error in our server";
        }

        return redirect(route('checkouts.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
