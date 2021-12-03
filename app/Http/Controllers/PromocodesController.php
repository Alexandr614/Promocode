<?php

namespace App\Http\Controllers;

use App\Models\Promocodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromocodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promocodes = Promocodes::paginate(20);
        return $promocodes;
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
        $note = Promocodes::where('code', $request->code)->first();

        if ($note === null) {
            return [
                "status" => false,
                "post" => "Данного промокода не существует"
            ];
        }

        $status = true;
        if ($note->active == 1) {
            if ($note->min_sum > $request->price_start) {
                $status = false;
                $response = "Промокод не действует на данную сумму";
            } else if ($note->date_close < date("Y-m-d")) {
                $status = false;
                $response = "Действие данного промокода закончилось";
                Promocodes::where('code', $request->code)->update(['active' => false]);
            } else if ($note->number_of_uses == 0) {
                $status = false;
                $response = "Действие данного промокода закончилось";
                Promocodes::where('code', $request->code)->update(['active' => false]);
            } else {
                if ($note->percent != null) {
                    $response = $request->price_start / 100 * (100 - $note->percent);
                } else {
                    $response = $request->price_start - $note->value_abs;
                }
                Promocodes::where('code', $request->code)->update(['number_of_uses' => $note->number_of_uses - 1]);
            }
        } else {
            $status = false;
            $response = "Действие данного промокода закончилось";
        }
        return [
            "status" => $status,
            "post" => $response
        ];
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
