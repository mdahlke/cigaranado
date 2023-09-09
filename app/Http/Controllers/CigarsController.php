<?php

namespace App\Http\Controllers;

use App\Models\Cigar;
use App\Models\FlavorProfile;
use Illuminate\Database\Eloquent\Collection;
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
        $cigar->cigar_brand_id = request('brand_id');
        $cigar->type = request('type');
        $cigar->wrapper = request('wrapper');
        $cigar->origin = request('origin');
        $cigar->binder = request('binder');
        $cigar->filler = request('filler');
        $cigar->strength = request('strength');
        $cigar->flavor_profile = 'Spicy';

        $flavors = collect(request('flavor_profile'));

        // partition the flavors into existing and new flavors
        list($createdFlavors, $existingFlavors) = $flavors->partition(function ($item) {
            return is_string($item);
        });

        // add the newly created flavors and get their ids
        $createdFlavorIds = [];
        $createdFlavors->each(function ($flavor) {
            $new = new FlavorProfile();
            $new->name = $flavor;
            $new->save();

            $createdFlavorIds[] = $new->id;
        });

        /**
         * check if the cigar saved and then return json response for redirect to dashboard
         */
        if ($cigar->save()) {

            // attach the newly creatd flavors to the cigar
            $cigar->flavorProfile()->attach($createdFlavorIds);

            // attach the already existing flavors to the cigar
            $cigar->flavorProfile()->attach($existingFlavors->pluck('value')->toArray());

            return response()->json([
                'success' => true,
                'message' => 'Cigar saved successfully',
                'data' => $cigar->load('flavorProfile')
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cigar not saved',
            ], 400);
        }

    }
}
