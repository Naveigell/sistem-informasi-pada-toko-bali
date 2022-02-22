<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShippingRequest;
use App\Models\Payment;
use App\Models\Shipping;
use App\Traits\AppendRajaOngkir;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    use AppendRajaOngkir;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param Shipping $shipping
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Shipping $shipping)
    {
        $shipping->load('orders.product.image', 'payment');

        if (in_array($shipping->shipping_service, [Shipping::SERVICE_REGULAR])) {
            $this->appendRajaOngkir($shipping);
        }

        return view('admin.pages.shipping.form', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ShippingRequest $request
     * @param Shipping $shipping
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(ShippingRequest $request, Shipping $shipping)
    {
        $shipping->load('payment');

        // if payment is valid, we need the tracking id
        if ($shipping->payment->status === array_keys(Payment::STATUSES)[0]) {
            $requestData = ["shipping_status"];

            // if tracking id is not available yet
            if (!$shipping->tracking_id) {
                $requestData[] = "tracking_id";
            }

            $shipping->fill($request->only($requestData));
            $shipping->save();
        } else {
            $shipping->payment()->update($request->only('status'));
        }

        return redirect(route('admin.orders.index'))->with('success', trans('action.update.success', ['module' => 'Shipping approve']));
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
