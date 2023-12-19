<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index');
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'telegram' => 'required|string|max:255',
            'rank' => 'required',
            'limit' => 'required|numeric|min:0',
            'status' => 'required',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user->name = $request->name;
        $user->telegram = $request->telegram;
        $user->status = $request->status;
        $user->limit = $request->limit;
        $user->rank = $request->rank;
        $user->save();

        return redirect()->route('users.list')->with('success', 'User Updated Successfully.');
    }
    public function delete($id)
    {
        User::find($id)->delete();
        return back()->with('success', 'User Deleted Successfully.');
    }
    public function EditProfile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }
    public function UpdateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validatedData->fails()) {
            return back()
                ->withErrors($validatedData, 'passw_val')
                ->withInput();
        }
        // if ($request->hasFile('profile_image')) {
        //     $file = $request->file('profile_image');
        //     $fileName = $file->getClientOriginalName();
        //     $destinationPath = public_path('app-assets/images/profile');
        //     $file->move($destinationPath, $fileName);

        // } else {

        //     $fileName = $user->image;

        // }
        if ($request->oldpassword !== null) {
            $request->validate([
                'oldpassword' => 'min:8',
                'newpassword' => 'min:8|different:oldpassword',
                'newpassword_confirmation' => 'required|same:newpassword'
            ]);

            if (password_verify($request->oldpassword, $user->password)) {
                
                if ($request->input('newpassword') !== $request->input('newpassword_confirmation')) {
                    return back()->with('error', 'New password and confirmation password do not match.');
                }
                
                $user->name = $request->input('name');
                $user->telegram = $request->input('telegram');
                $user->password = bcrypt($request->input('newpassword'));
                $user->wallet = $request->wallet;
                $user->save();

                return redirect()->route('dashboard')->with('success', 'Profile and password updated.');
            } else {
                return back()->with('error', 'Old password does not match.');
            }
        } elseif ($request->newpassword !== null) {
            return back()->with('error', 'Enter old password to change password.');
        } else {
            $user->name = $request->input('name');
            $user->telegram = $request->input('telegram');
            $user->wallet = $request->wallet;
            $user->save();

            return redirect()->route('dashboard')->with('success', 'Profile updated successfully');
        }
    }
}
