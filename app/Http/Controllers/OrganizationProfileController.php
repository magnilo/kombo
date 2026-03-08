<?php

namespace App\Http\Controllers;

use App\Models\OrganizationProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganizationProfileController extends Controller
{
    public function edit()
    {
        $profile = OrganizationProfile::first() ?? new OrganizationProfile();
        return view('admin.organization.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slogan' => 'nullable|string|max:255',
            'history' => 'nullable|string',
            'philosophy' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'registration_link' => 'nullable|url',
            'map_iframe' => 'nullable|string',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_description' => 'nullable|string|max:500',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
        ]);

        $profile = OrganizationProfile::first() ?: new OrganizationProfile();
        $data = $request->all();

        if ($request->hasFile('hero_image')) {
            if ($profile->hero_image) {
                Storage::disk('public')->delete($profile->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('organization', 'public');
        }

        $profile->fill($data)->save();

        return redirect()->back()->with('success', 'Profil organisasi berhasil diperbarui.');
    }
}
