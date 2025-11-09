<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Portfolio;
use App\Models\ProgressUpdate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isOwner()) {
            $totalContacts = Contact::count();
            $totalPortfolios = Portfolio::count();
            $totalProgressUpdates = ProgressUpdate::count();
            $totalCustomers = User::where('role', 'customer')->count();
            
            return view('dashboard.owner', compact('totalContacts', 'totalPortfolios', 'totalProgressUpdates', 'totalCustomers'));
        } else {
            $userProgressUpdates = ProgressUpdate::where('user_id', $user->id)->latest()->get();
            
            return view('dashboard.customer', compact('userProgressUpdates'));
        }
    }
}
