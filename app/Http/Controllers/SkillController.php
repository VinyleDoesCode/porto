<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillRequest;
use App\Models\Skill;
use App\Models\Profile;

class SkillController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(SkillRequest $request)
    {
        $profile = Profile::first();
        if (!$profile) {
            return response()->json(['success' => false, 'message' => 'Profile not found.'], 404);
        }

        $skill = Skill::create(array_merge(
            $request->validated(),
            ['profile_id' => $profile->id]
        ));

        return response()->json([
            'success' => true,
            'message' => 'Skill added successfully!',
            'skill' => $skill
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SkillRequest $request, Skill $skill)
    {
        $skill->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Skill updated successfully!',
            'skill' => $skill
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();

        return response()->json([
            'success' => true,
            'message' => 'Skill deleted successfully!'
        ]);
    }
}
