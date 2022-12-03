<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::paginate(10);

        return view('admin.pages.testimonial.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function create()
    {
        return view('admin.pages.testimonial.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|Redirector|RedirectResponse
     */
    public function store(TestimonialRequest $request)
    {
        Testimonial::create($request->validated());

        return redirect(route('admin.testimonials.index'))->with('success', trans('action.store.success', ['module' => 'Testimonial']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Testimonial $testimonial
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.pages.testimonial.form', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TestimonialRequest $request
     * @param Testimonial $testimonial
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        $testimonial->update($request->validated());

        return redirect(route('admin.testimonials.index'))->with('success', trans('action.update.success', ['module' => 'Testimonial']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Testimonial $testimonial
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect(route('admin.testimonials.index'))->with('success', trans('action.destroy.success', ['module' => 'Testimonial']));
    }
}
