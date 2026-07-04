<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationRequest;
use App\Models\Education;
use App\Models\Profile;

class EducationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(EducationRequest $request)
    {
        $profile = Profile::first();
        if (!$profile) {
            return response()->json(['success' => false, 'message' => 'Profile not found.'], 404);
        }

        $education = Education::create(array_merge(
            $request->validated(),
            ['profile_id' => $profile->id]
        ));

        return response()->json([
            'success' => true,
            'message' => 'Education added successfully!',
            'education' => $education
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EducationRequest $request, Education $education)
    {
        $education->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Education updated successfully!',
            'education' => $education
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Education $education)
    {
        $education->delete();

        return response()->json([
            'success' => true,
            'message' => 'Education deleted successfully!'
        ]);
    }
}
