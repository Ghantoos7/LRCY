<?php

namespace App\Http\Controllers;

use App\Models\event_image;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download($id)
    {
        $eventImage = event_image::find($id);

        if ($eventImage) {
            $decoded_image = base64_decode($eventImage->event_image_source);
            $response = response($decoded_image);
            $response->header('Content-Type', 'image/jpeg'); // Replace 'image/jpeg' with the appropriate MIME type of your images
            $response->header('Content-Disposition', 'attachment; filename="' . $eventImage->id . '.jpeg"');

            return $response;
        }

        return response()->json(['message' => 'Image not found.'], 404);
    }
}
