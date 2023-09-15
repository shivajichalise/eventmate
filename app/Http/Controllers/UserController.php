<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
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

    public function edit(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        return $user;
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
