<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ProfileUpdateAddressRequest;
use App\Http\Requests\ProfileUpdateContactRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    private function updateProfileStatus(Request $request, string $step): void
    {
        $profileStatus = json_decode($request->user()->profile_status, true) ?? [];
        $profileStatus = array_diff($profileStatus, [$step]);
        $request->user()->update(['profile_status' => $profileStatus]);
    }

    private function updateProfile($request): void
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
    }

    /**
         * Update the user's profile information.
         */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $this->updateProfile($request);
        $this->updateProfileStatus($request, 'profileInfo');
        $request->user()->assignRoleIfProfileCompleted('attendee');

        return Redirect::route('profile.edit');
    }

    /**
     * Update the user's profile address information.
     */
    public function updateAddress(ProfileUpdateAddressRequest $request): RedirectResponse
    {
        $this->updateProfile($request);
        $this->updateProfileStatus($request, 'addressInfo');
        $request->user()->assignRoleIfProfileCompleted('attendee');

        return Redirect::route('profile.edit');
    }

    /**
     * Update the user's profile contact information.
     */
    public function updateContact(ProfileUpdateContactRequest $request): RedirectResponse
    {
        $this->updateProfile($request);
        $this->updateProfileStatus($request, 'contactInfo');
        $request->user()->assignRoleIfProfileCompleted('attendee');

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
