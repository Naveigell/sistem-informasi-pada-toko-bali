<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\ReviewRequest;
use App\Models\Product;
use App\Models\Review;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Shipping $shipping
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Shipping $shipping)
    {
        $shipping->load('orders.product.image');

        $reviewsIds = Review::query()->where('shipping_id', $shipping->id)->pluck('product_id')->toArray();

        return view('member.pages.review.index', compact('shipping', 'reviewsIds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Shipping $shipping
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Shipping $shipping, Product $product)
    {
        return view('member.pages.review.form', compact('shipping', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReviewRequest $request
     * @param Shipping $shipping
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(ReviewRequest $request, Shipping $shipping, Product $product)
    {
        Review::create(array_merge(
            $request->validated(),
            [
                "product_id"  => $product->id,
                "shipping_id" => $shipping->id,
                "user_id"     => auth()->id(),
            ]
        ));

        return redirect(route('shippings.products.reviews.index', [$shipping]))->with('success', trans('action.store.success', ['module' => 'Review']));
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
