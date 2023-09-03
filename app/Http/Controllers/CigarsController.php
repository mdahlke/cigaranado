<?php

namespace App\Http\Controllers;

use App\Models\Cigar;
use Illuminate\Http\Request;


class CigarsController extends Controller
{
    //

    public function create()
    {
        return view('cigars.create');
    }

    public function store()
    {
        $cigar = new Cigar();
        $cigar->name = request('name');
        $cigar->brand = request('brand');
        $cigar->type = request('type');
        $cigar->wrapper = request('wrapper');
        $cigar->origin = request('origin');
        $cigar->binder = request('binder');
        $cigar->filler = request('filler');
        $cigar->strength = request('strength');
        $cigar->flavor_profile = request('flavor_profile');
        // $cigar->shape = request('shape');
        // $cigar->length = request('length');
        // $cigar->ring = request('ring');
        // $cigar->price = request('price');

        /**
         * check if the cigar saved and then return json response for redirect to dashboard
         */
        if ($cigar->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Cigar saved successfully',
                'data' => $cigar
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cigar not saved',
            ], 400);
        }

    }
}
