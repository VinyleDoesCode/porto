<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienceRequest;
use App\Models\Experience;
use App\Models\Profile;

class ExperienceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(ExperienceRequest $request)
    {
        $profile = Profile::first();
        if (!$profile) {
            return response()->json(['success' => false, 'message' => 'Profile not found.'], 404);
        }

        $experience = Experience::create(array_merge(
            $request->validated(),
            ['profile_id' => $profile->id]
        ));

        return response()->json([
            'success' => true,
            'message' => 'Experience added successfully!',
            'experience' => $experience
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExperienceRequest $request, Experience $experience)
    {
        $experience->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Experience updated successfully!',
            'experience' => $experience
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        $experience->delete();

        return response()->json([
            'success' => true,
            'message' => 'Experience deleted successfully!'
        ]);
    }
}
