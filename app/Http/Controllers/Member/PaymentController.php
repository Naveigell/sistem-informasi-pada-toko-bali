<?php

namespace App\Http\Controllers\Member;

use App\Traits\AppendRajaOngkir;
use App\Http\Controllers\Controller;
use App\Http\Requests\Member\PaymentRequest;
use App\Models\Shipping;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use AppendRajaOngkir;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $shippings = Shipping::memberShipping()->with('payment', 'orders.product')->get();

        return view('member.pages.account.payment.index', compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function editPayment(Shipping $shipping)
    {
        $shipping->load('orders.product.image', 'payment', 'area');

        if (in_array($shipping->shipping_service, [Shipping::SERVICE_REGULAR])) {
            $this->appendRajaOngkir($shipping);
        }

        return view('member.pages.account.payment.form', compact('shipping'));
    }

    public function updatePayment(PaymentRequest $request, Shipping $shipping)
    {
        // attributes need to be updated
        $attributes = $request->only('payment_proof', 'sender_bank', 'sender_name', 'sender_account_number', 'merchant_bank');

        $shipping->payment()->updateOrCreate([
            "shipping_id" => $shipping->id,
        ], $attributes);

        return redirect(route('payments.index'))->with('success', trans('action.update.success', ['module' => 'Payment']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PaymentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {

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
