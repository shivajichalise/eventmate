<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\ProfileUpdateAddressRequest;
use App\Http\Requests\ProfileUpdateContactRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        // return User::all();
        return $dataTable->render('users.index');
    }

    public function show(User $user)
    {
        $totalTicketsBought = count($user->ticketsWithPayments());
        $hasCompleteProfile = $user->isProfileCompleted();
        $assignedRoles = $user->assignedRoles();

        return view('users.show')->with([
            'user' => $user,
            'totalTicketsBought' => $totalTicketsBought,
            'hasCompleteProfile' => $hasCompleteProfile,
            'assignedRoles' => $assignedRoles,
        ]);
    }

    private function updateProfileStatus(User $user, string $step): void
    {
        $profileStatus = json_decode($user->profile_status, true) ?? [];
        $profileStatus = array_diff($profileStatus, [$step]);

        $user->update(['profile_status' => json_encode($profileStatus)]);
    }

    public function editForm(User $user, $step)
    {
        $profile_status = array_values(json_decode($user->profile_status, true));

        if (is_array($profile_status) && count($profile_status) > 0) {
            $step = $profile_status[0];
        }

        // $profile_status = $user->profile_status;
        // if (count($profile_status) != 0) {
        //     $step = $profile_status[0];
        // }

        switch ($step) {
            case 'addressInfo':
                $columns = ['address_line_1', 'state', 'city', 'country'];
                $addressInfo = $user->getUsersWithColumns($columns, $user->id);

                return view('users.edit.address')->with(['step' => 2, 'user' => $user, 'addressInfo' => $addressInfo]);
            case 'contactInfo':
                $columns = ['mobile_number', 'emergency_number'];
                $contactInfo = $user->getUsersWithColumns($columns, $user->id);

                return view('users.edit.contact')->with(['step' => 3, 'user' => $user, 'contactInfo' => $contactInfo]);
            case 'profileInfo':
            default:
                $columns = ['name', 'email', 'gender', 'is_disabled'];
                $profileInfo = $user->getUsersWithColumns($columns, $user->id);

                return view('users.edit.profile')->with(['step' => 1, 'user' => $user, 'profileInfo' => $profileInfo]);
        }
    }

    public function edit(User $user)
    {
        return $this->editForm($user, 'profile');
    }

    public function updateUserProfileInfo(ProfileUpdateRequest $request, User $user)
    {
        $fields = $request->validated();
        $user->update($fields);
        $this->updateProfileStatus($user, 'profileInfo');
        return redirect()->back()->with('success', 'User profile info updated successfully.');
    }

    public function updateUserAddressInfo(ProfileUpdateAddressRequest $request, User $user)
    {
        $fields = $request->validated();
        $user->update($fields);
        $this->updateProfileStatus($user, 'addressInfo');
        return redirect()->back()->with('success', 'User address info updated successfully.');
    }

    public function updateUserContactInfo(ProfileUpdateContactRequest $request, User $user)
    {
        $fields = $request->validated();
        $user->update($fields);
        $this->updateProfileStatus($user, 'contactInfo');
        return redirect()->back()->with('success', 'User contact info updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User is deleted successfully.');
    }
}
