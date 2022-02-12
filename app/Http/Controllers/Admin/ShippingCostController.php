<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShippingCostRequest;
use App\Models\ShippingCost;
use Illuminate\Http\Request;

class ShippingCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $shippingCosts = ShippingCost::query()->paginate(10);

        return view('admin.pages.additional.shipping_cost.index', compact('shippingCosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.additional.shipping_cost.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ShippingCostRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(ShippingCostRequest $request)
    {
        $shippingCost = new ShippingCost($request->validated());
        $shippingCost->save();

        return redirect(route('admin.shipping-costs.index'))->with('success', 'Shipping Cost added successfully');
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
     * @param ShippingCost $shippingCost
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(ShippingCost $shippingCost)
    {
        return view('admin.pages.additional.shipping_cost.form', compact('shippingCost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ShippingCostRequest $request
     * @param ShippingCost $shippingCost
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(ShippingCostRequest $request, ShippingCost $shippingCost)
    {
        $shippingCost->fill($request->validated());
        $shippingCost->save();

        return redirect(route('admin.shipping-costs.index'))->with('success', 'Shipping Cost updated successfully');
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
