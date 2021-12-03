<?php

namespace App\Http\Controllers;

use App\Models\Promocodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreatePromocodeController extends Controller
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
        $validated = Validator::make(
            $request->all(),
            [
                "code" => "required",
                "percent" => "exclude_unless:value_abs,null|numeric|max:100",
                "value_abs" => "exclude_unless:percent,null|numeric",
                "min_sum" => "required",
                "date_close" => "required",
                "number_of_uses" => "required"
            ]
        );

        if (!$validated->errors()->isEmpty()) {
            return [
                "status" => false,
                "errors" => $validated->errors()
            ];
        }

        if ($request->date_close < date('Y-m-d')) {
            $request->active = false;
        } else {
            $request->active = true;
        }

        $post = Promocodes::create([
            "code" => $request->code,
            "percent" => $request->percent,
            "value_abs" => $request->value_abs,
            "min_sum" => $request->min_sum,
            "date_close" => $request->date_close,
            "number_of_uses" => $request->number_of_uses,
            "active" => $request->active,
        ]);

        $post = ["Промокод успешно создан"];

        return [
            "status" => true,
            "post" => $post
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
