<?php

namespace App\Http\Controllers;

use App\Models\UserCigar;
use App\Models\UserCigarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class UserCigarController extends Controller
{
    //

    public function store(Request $request)
    {
        $userCigar = new UserCigar();
        $userCigar->user_id = $request->user()->id;
        $userCigar->cigar_id = $request->input('cigar');
        $userCigar->rating = $request->input('rating');
        $userCigar->review = $request->input('review');
        $userCigar->draw = $request->input('draw');
        $userCigar->burn = $request->input('burn');
        $userCigar->flavor = $request->input('flavor');
        $userCigar->body = $request->input('body');
        $userCigar->location = $request->input('location');
        $userCigar->date = $request->input('date');


        
        
        if ($userCigar->save()) {
            $this->saveImages($request, $userCigar);

            return response()->json([
                'success' => true,
                'message' => 'Rating saved successfully',
                'data' => $userCigar
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Rating not saved',
            ], 400);
        }
    }

    /**
     * Save images to imagekit and save the imagekit id to the userCigarImage table
     * @param Request $request
     * @param UserCigar $userCigar
     * @return array
     */
    private function saveImages(Request $request, UserCigar $userCigar): array
    {
        /** @var \ImageKit\ImageKit $imagekit */
        $imagekit = app('imagekit');
        $created = [];

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if(is_array($image)){
                foreach($image as $img){
                    $props = [
                        'file' => fopen($img->getPathname(), 'r'),
                        'fileName' => $img->getClientOriginalName(),
                        'mimeType' => $img->getClientMimeType(),
                    ];
                
                    $uploaded[] = $imagekit->upload($props);

                    unset($props['file']);
                    $props['ext'] = $img->clientExtension();
                    $uploadedProps[] = $props;

                }
            }
            
        }
        
        foreach($uploaded as $img){
            // add img to userCigar
            $props = [
                'user_cigar_id' => $userCigar->id,
                'image' => $img->result->fileId,
                'url' => $img->result->url,
                'thumbnail' => $img->result->thumbnailUrl,
                'name' => $img->result->name,
                'type' => $img->result->fileType,
                'path' => $img->result->filePath,
            ];

            $created[] = UserCigarImage::create($props);
        }

        return $created;
    }
}
