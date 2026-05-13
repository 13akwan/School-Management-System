<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'name' => $request->name,
        ];

        if ($request->hasFile('photo')) {

            $photo = $request->file('photo')
                ->store('profiles', 'public');

            $data['photo'] = $photo;
        }

        $user->update($data);

        return back()->with(
            'success',
            'Profile updated successfully'
        );
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check(
            $request->current_password,
            $user->password
        )) {

            return back()->withErrors([
                'current_password' => 'Current password incorrect'
            ]);
        }

        $user->update([
            'password' => bcrypt($request->new_password)
        ]);

        return back()->with(
            'success',
            'Password updated successfully'
        );
    }
}