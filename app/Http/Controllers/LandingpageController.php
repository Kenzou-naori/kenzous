<?php

namespace App\Http\Controllers;

use App\Models\Landingpage;
use App\Models\Product;
use App\Http\Requests\StoreLandingpageRequest;
use App\Http\Requests\UpdateLandingpageRequest;

class LandingpageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::inRandomOrder()->with('category')->paginate(10);
        $displays = Landingpage::all();
        return view('welcome', compact('displays', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        $products = Product::take(1)->paginate(8);
        $displays = Landingpage::all();
        return view('about', compact('displays', 'products'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLandingpageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLandingpageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Landingpage  $landingpage
     * @return \Illuminate\Http\Response
     */
    public function show(Landingpage $landingpage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Landingpage  $landingpage
     * @return \Illuminate\Http\Response
     */
    public function edit(Landingpage $landingpage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLandingpageRequest  $request
     * @param  \App\Models\Landingpage  $landingpage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLandingpageRequest $request, Landingpage $landingpage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Landingpage  $landingpage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Landingpage $landingpage)
    {
        //
    }
}
