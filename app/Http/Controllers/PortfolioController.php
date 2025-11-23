<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    public function index()
    {
        // Get portfolios from database
        $portfolios = Portfolio::latest()->get();

        // If request is from dashboard (admin), return admin view
        if (request()->routeIs('dashboard.portfolios.*')) {
            return view('dashboard.portfolios.index', compact('portfolios'));
        }

        return view('portfolio', compact('portfolios'));
    }

    public function create()
    {
        return view('dashboard.portfolios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'category' => 'required|string|in:residential,commercial,luxury',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('foto')) {
            // Convert image to Base64
            $path = $image->getRealPath();
            $type = $image->getClientOriginalExtension();
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $input['foto'] = $base64;
        }

        Portfolio::create($input);

        return redirect()->route('dashboard.portfolios.index')
                        ->with('success', 'Portfolio berhasil ditambahkan.');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('dashboard.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'category' => 'required|string|in:residential,commercial,luxury',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('foto')) {
            // Convert image to Base64
            $path = $image->getRealPath();
            $type = $image->getClientOriginalExtension();
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $input['foto'] = $base64;
        } else {
            unset($input['foto']);
        }

        $portfolio->update($input);

        return redirect()->route('dashboard.portfolios.index')
                        ->with('success', 'Portfolio berhasil diperbarui.');
    }

    public function destroy(Portfolio $portfolio)
    {
        // No file to delete since we store base64 in DB
        $portfolio->delete();

        return redirect()->route('dashboard.portfolios.index')
                        ->with('success', 'Portfolio berhasil dihapus.');
    }
}
