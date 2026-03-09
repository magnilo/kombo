<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrganizationProfileRequest;
use App\Models\OrganizationProfile;
use App\Services\ImageUploadService;

class OrganizationProfileController extends Controller
{
    public function __construct(
        private ImageUploadService $imageService
    ) {}

    /**
     * Show the form for editing organization profile.
     */
    public function edit()
    {
        $profile = OrganizationProfile::first() ?? new OrganizationProfile();
        return view('admin.organization.edit', compact('profile'));
    }

    /**
     * Update organization profile.
     */
    public function update(UpdateOrganizationProfileRequest $request)
    {
        $profile = OrganizationProfile::first() ?: new OrganizationProfile();
        $data = $request->validated();

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $this->imageService->update(
                $request->file('hero_image'),
                $profile->hero_image,
                'organization'
            );
        }

        $profile->fill($data)->save();

        return redirect()
            ->back()
            ->with('success', 'Profil organisasi berhasil diperbarui.');
    }
}
