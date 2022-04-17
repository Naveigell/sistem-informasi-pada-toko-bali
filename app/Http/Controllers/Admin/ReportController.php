<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function create()
    {
        return view('admin.pages.report.create');
    }

    public function print(Request $request)
    {
        $request->validate([
            "from" => "nullable|date|required_with:to",
            "to"   => "nullable|date|required_with:from",
        ]);

        $shippings = Shipping::with('user', 'orders.product')->where('shipping_status', array_keys(Shipping::SHIPPING_STATUSES)[2]);

        if ($request->from && $request->to) {
            $shippings->whereBetween('created_at', [$request->get('from'), $request->get('to')]);
        }

        $shippings = $shippings->get()->groupBy('created_date');

//        dd($shippings);

        /**
         * @var \Barryvdh\DomPDF\Facade\Pdf $pdf
         */
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('admin.pages.report.print', compact('shippings'));

        return $pdf->stream();
    }
}
