<?php

namespace App\Http\Controllers;

use App\Http\Requests\CertificationRequest;
use App\Models\Certification;
use App\Models\Profile;

class CertificationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CertificationRequest $request)
    {
        $profile = Profile::first();
        if (!$profile) {
            return response()->json(['success' => false, 'message' => 'Profile not found.'], 404);
        }

        $certification = Certification::create(array_merge(
            $request->validated(),
            ['profile_id' => $profile->id]
        ));

        return response()->json([
            'success' => true,
            'message' => 'Certification added successfully!',
            'certification' => $certification
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CertificationRequest $request, Certification $certification)
    {
        $certification->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Certification updated successfully!',
            'certification' => $certification
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certification $certification)
    {
        $certification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Certification deleted successfully!'
        ]);
    }
}
