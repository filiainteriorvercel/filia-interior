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

        // Load portfolio images from public/images/portfolio
        $portfolioPath = public_path('images/portfolio');
        $portfolioImages = [];
        
        // Strictly load images 1.jpg to 8.jpg as requested
        for ($i = 1; $i <= 8; $i++) {
            $path = 'images/portfolio/' . $i . '.jpg';
            if (file_exists(public_path($path))) {
                $portfolioImages[] = $path;
            }
        }

        return view('home', compact('companyImages', 'portfolioImages'));
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
