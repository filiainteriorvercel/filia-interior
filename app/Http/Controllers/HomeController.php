<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index()
    {
        // Hardcode company images for Vercel serverless (filesystem scanning not optimal)
        // In serverless, File::files() may not work reliably
        $companyImages = [
            'images/company/company1.jpg',
            'images/company/company2.jpg',
            'images/company/company3.jpg',
            'images/company/company4.jpg',
            'images/company/company5.jpg',
            'images/company/company6.jpg',
        ];
        
        // Filter only existing images
        $companyImages = array_filter($companyImages, function($image) {
            return file_exists(public_path($image));
        });

        return view('home', compact('companyImages'));
    }

    public function history()
    {
        return view('history');
    }

    public function location()
    {
        return view('location');
    }
}
