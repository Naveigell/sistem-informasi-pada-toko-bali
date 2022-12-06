<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::with('product.image', 'user')->paginate(10);

        return view('admin.pages.review.index', compact('reviews'));
    }

    public function storeReview(Review $review)
    {
        Testimonial::create([
            "username"    => $review->user->username,
            "star"        => $review->star,
            "description" => $review->description,
        ]);

        return redirect(route('admin.reviews.index'))->with('success', trans('action.update.success', ['module' => 'Review']));
    }
}
