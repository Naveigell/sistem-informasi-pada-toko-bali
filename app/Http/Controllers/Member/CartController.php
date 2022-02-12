<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\CartRequest;
use App\Models\Cart;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::memberCarts()->with('product', 'member', 'product.image')->get();
        $total = $carts->reduce(function ($total, $item) {
            return $total + $item->product->price * $item->quantity;
        }, 0);

        return view('member.pages.cart.index', compact('carts', 'total'));
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
     * @param CartRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CartRequest $request)
    {
        Cart::query()->updateOrCreate([
            "product_id" => $request->get('product_id'),
            "user_id"    => auth()->id(),
        ], [
            "quantity"   => $request->get('quantity'),
        ]);

        return back()->with('success', 'Product has been added to cart');
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
     * @param Cart $cart
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function destroy(Cart $cart)
    {
        throw_if($cart->user_id != auth()->id(), new AuthenticationException());

        $cart->delete();

        return back()->with('success', 'Cart deleted successfully');
    }
}
