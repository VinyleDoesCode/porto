<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        // Load the first profile along with all its relationships
        $profile = Profile::with(['experiences', 'educations', 'projects', 'skills'])->first();

        // If no profile exists yet (e.g. before seeding), create a blank one
        if (!$profile) {
            $profile = Profile::create([
                'full_name' => 'Alex Morgan',
                'headline' => 'Full Stack Developer',
                'short_description' => 'Welcome to my portfolio website.',
                'email' => 'alex@example.com',
            ]);
            $profile->load(['experiences', 'educations', 'projects', 'skills']);
        }

        return view('portfolio', compact('profile'));
    }
}
