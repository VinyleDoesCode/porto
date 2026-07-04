<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(ProfileRequest $request, Profile $profile)
    {
        $data = $request->validated();

        // Handle profile photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if it exists
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }

            // Store new photo in public storage
            $path = $request->file('photo')->store('profile_photos', 'public');
            $data['photo'] = $path;
        }

        $profile->update($data);

        // Append the absolute asset URL for immediate client rendering
        $profile->photo_url = $profile->photo ? Storage::url($profile->photo) : null;

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully!',
            'profile' => $profile
        ]);
    }
}
