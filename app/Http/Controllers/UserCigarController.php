<?php

namespace App\Http\Controllers;

use App\Models\UserCigar;
use Illuminate\Http\Request;

class UserCigarController extends Controller
{
    //

    public function store(Request $request)
    {
        $userCigar = new UserCigar();
        $userCigar->user_id = $request->user()->id;
        $userCigar->cigar_id = request('cigar');
        $userCigar->rating = request('rating');
        $userCigar->review = request('review');
        // @TODO add `smoke_again` column to user_cigar table
        // $userCigar->smoke_again = request('smoke_again');
        $userCigar->draw = request('draw');
        $userCigar->burn = request('burn');
        $userCigar->flavor = request('flavor');
        $userCigar->body = request('body');
        $userCigar->location = request('location');
        $userCigar->date = request('date');
        $userCigar->image = request('image');

        /**
         * check if the userCigar saved and then return json response for redirect to dashboard
         */
        if ($userCigar->save()) {
            return response()->json([
                'success' => true,
                'message' => 'UserCigar saved successfully',
                'data' => $userCigar
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'UserCigar not saved',
            ], 400);
        }
    }
}
