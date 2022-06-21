<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function editProfile()
    {

        $admin = Admin::find(auth('admin')->user()->id);

        return view('dashboard.profile.edit', compact('admin'));

    }

    public function updateProfile(ProfileRequest $request)
    {
        try {
            $admin = Admin::find(auth('admin')->user()->id);

            if ($request->filled('password')) {
                $request->merge(['password' => bcrypt($request->password)]);
            }else{
                unset($request['password']);
            }

            unset($request['id']);
            unset($request['password_confirmation']);

            $admin->update($request->all());

            return redirect()->back()->with(['success' => __('admin/general.updated successfully')]);

        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' =>  __('admin/general.error to update')]);

        }

    }
}