<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $profile = Profile::first();
        if (!$profile) {
            return response()->json(['success' => false, 'message' => 'Profile not found.'], 404);
        }

        $data = $request->validated();

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('project_thumbnails', 'public');
            $data['thumbnail'] = $path;
        }

        $project = Project::create(array_merge(
            $data,
            ['profile_id' => $profile->id]
        ));

        // Append the absolute asset URL for immediate client rendering
        $project->thumbnail_url = $project->thumbnail ? Storage::url($project->thumbnail) : null;

        return response()->json([
            'success' => true,
            'message' => 'Project created successfully!',
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if it exists
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }

            $path = $request->file('thumbnail')->store('project_thumbnails', 'public');
            $data['thumbnail'] = $path;
        }

        $project->update($data);

        // Append the absolute asset URL
        $project->thumbnail_url = $project->thumbnail ? Storage::url($project->thumbnail) : null;

        return response()->json([
            'success' => true,
            'message' => 'Project updated successfully!',
            'project' => $project
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Delete the thumbnail image from storage
        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project deleted successfully!'
        ]);
    }
}
