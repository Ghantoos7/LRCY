<?php

namespace App\Http\Controllers;

use App\Models\event_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{

    public function downloadPictureByUrl($pictureUrl) {
        $filePath = str_replace('http://127.0.0.1:8000/storage/', '', $pictureUrl);
        $fullPath = 'public/images/' . $filePath;
        $exists = Storage::disk('local')->exists($fullPath);
    
        if ($exists) {
            $fileContent = Storage::disk('local')->get($fullPath);
            $base64Content = base64_encode($fileContent);
            return response()->json(['data' => $base64Content]);
        }
    
        return response()->json(['message' => 'Image not found.'], 404);
    }
    
    
}
