<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LineItem;
use App\Models\Discount;
use App\Models\EstimateDiscount;


class EstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('estimates.index', ['estimates' => Estimate::all(), 'users' => $users]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
    
        return view('estimates.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $estimate = new Estimate;
        $estimate->fill($request->all());
        $estimate->save();

        return "Done";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function show(Estimate $estimate)
    {
        $subtotal = 0;
        $total_discount = 0;

        $items = $estimate->line_items;
        $applied_discounts = $estimate->estimate_discounts;
        foreach($applied_discounts as $discount){
            $total_discount += $discount->discount->rate;
        }

        $discount_rate = $total_discount/100;
        
        foreach($items as $item){
            $subtotal += $item->amount;
        }

        //dd($estimate->estimate_discounts);

        $total = $subtotal - ($discount_rate * $subtotal);

        return view('estimates.show', [
            'estimate' => $estimate,
            'items' => $items,
            'subtotal' => $subtotal,
            'discounts' => Discount::all(),
            'total' => $total,
            'applied_discounts' => $applied_discounts
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function edit(Estimate $estimate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estimate $estimate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estimate $estimate)
    {
        //
    }

    public function add_discount(Request $request){
        $estimate_discount = new EstimateDiscount;
        $data = $request->all();
        $estimate_discount->fill($data);

        $estimate_discount->save();
        return back();
    }
}
