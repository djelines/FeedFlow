<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Cache\RetrievesMultipleKeys;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use PhpParser\Node\Expr\FuncCall;
use App\Actions\User\UpdateUserAction;
use App\DTOs\UserDTO;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    /**
     * Update in table user mail_notifications.
     */
    public function editNotficationsProfile(UserUpdateRequest $userUpdateRequest, UpdateUserAction $action) {

        $dto = UserDTO::fromRequest($userUpdateRequest);
        $action->execute($dto, $userUpdateRequest->user());

        return back()->with('success', 'Préférences de notifications mises à jour.');
    }


    /**
     * Show page Setting for user.
     */

    public function showSetting(){
        return view('layouts.setting');
    }
}
