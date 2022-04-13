<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\BiodataPasswordRequest;
use App\Http\Requests\Member\BiodataRequest;
use Hash;
use Illuminate\Http\Request;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function create()
    {
        $biodata = auth()->user();

        return view('member.pages.biodata.form', compact('biodata'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BiodataRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(BiodataRequest $request)
    {
        auth()->user()->update($request->validated());

        return redirect(route('biodatas.create'))->with('success', trans('action.store.success', ['module' => 'Biodata']));
    }

    public function password(BiodataPasswordRequest $request)
    {
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->withErrors(["old_password" => "Your old password is wrong!"])->withInput();
        }

        auth()->user()->update($request->validated());

        return redirect(route('biodatas.create'))->with('success-password', 'Change password success!');
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
