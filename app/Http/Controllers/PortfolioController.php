<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    public function index()
    {
        // Get portfolio photos from public/images/portfolio
        $portfolioImages = [];
        $portfolioPath = public_path('images/portfolio');
        
        if (File::exists($portfolioPath)) {
            $files = File::files($portfolioPath);
            foreach ($files as $file) {
                if (in_array($file->getExtension(), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $portfolioImages[] = [
                        'filename' => $file->getFilename(),
                        'path' => 'images/portfolio/' . $file->getFilename(),
                        'title' => pathinfo($file->getFilename(), PATHINFO_FILENAME)
                    ];
                }
            }
        }

        // Get portfolios from database
        $portfolios = Portfolio::latest()->get();

        return view('portfolio', compact('portfolioImages', 'portfolios'));
    }
}
