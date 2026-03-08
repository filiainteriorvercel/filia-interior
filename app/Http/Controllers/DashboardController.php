<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Portfolio;
use App\Models\ProgressUpdate;
use App\Models\Project;
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
            $totalProjects = Project::count();
            $totalCustomers = User::where('role', 'customer')->count();

            return view('dashboard.owner', compact('totalContacts', 'totalPortfolios', 'totalProgressUpdates', 'totalProjects', 'totalCustomers'));
        }

        $userProjects = Project::with([
            'progressUpdates' => fn ($query) => $query->latest('tanggal_update'),
            'payments' => fn ($query) => $query->latest('payment_date'),
        ])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $userProgressUpdates = ProgressUpdate::where('user_id', $user->id)->latest()->get();

        return view('dashboard.customer', compact('userProjects', 'userProgressUpdates'));
    }
}
