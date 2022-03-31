<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $totalProducts  = Product::query()->count();
        $totalMembers   = User::query()->where('role', User::ROLE_MEMBER)->count();
        $totalShippings = Shipping::query()->count();
        $totalReviews   = round((Review::query()->sum('star') / (Review::query()->count() * 5)) * 5, 1);

        $shippings = Shipping::query()->addSelect(\DB::raw('SUM(total) AS _total'))
                                      ->addSelect(\DB::raw('MONTH(updated_at) AS _month'))
                                      ->whereYear('updated_at', date('Y'))
                                      ->where('shipping_status', array_keys(Shipping::SHIPPING_STATUSES)[2])
                                      ->groupBy('_month')
                                      ->pluck('_total', '_month')->toArray();

        $monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $months     = [];

        foreach ($monthNames as $index => $monthName) {
            if (in_array($index + 1, array_keys($shippings))) {
                $months[$monthName] = $shippings[$index + 1];
            } else {
                $months[$monthName] = 0;
            }
        }

        return view('admin.pages.dashboard.index', compact('totalProducts', 'totalMembers', 'totalShippings', 'totalReviews', 'months'));
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
