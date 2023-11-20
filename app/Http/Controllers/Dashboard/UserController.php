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
        return view('admin.user.edit',compact('user'));
    }
    public function update(Request $request,$id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->save();

        return back()->with('success','User Updated Successfully.');
    }
    public function delete($id)
    {
        User::find($id)->delete();
        return back()->with('success','User Deleted Successfully.');
    }
    public function EditProfile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }
    public function UpdateProfile(Request $request)
    {
        $user = Auth::user();

        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required', 'string', 'email', 'max:255',
        ]);

        if ($validatedData->fails()) {
              return back()
                    ->withErrors($validatedData,'passw_val')
                    ->withInput();
        }
        if ($request->oldpassword !== null) {
            $request->validate([
                'oldpassword' => 'min:8',
                'newpassword' => 'min:8|different:oldpassword',
                'newpassword_confirmation' => 'same:newpassword'
            ]);
        }

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path('app-assets/images/profile');
            $file->move($destinationPath, $fileName);

        } else {

            $fileName = $user->image;

        }

        if ($request->oldpassword != null) {
            if (Hash::check($request->oldpassword, $user->password)) {
                if (Hash::check($request->newpassword, $user->password)) {
                    return back()->with('error', 'New password must be different from the current password.');
                }
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                if ($request->filled('newpassword')) {
                    $user->password = bcrypt($request->input('newpassword'));
                }
                $user->image = $fileName;
                $user->update();
                return back()->with('success', 'Profile and password updated successfully.');
            }
            else{
                return back()->with('error', 'Old password does not match.');
            }
        } else if($request->newpassword != null)
        {
            return back()->with('error', 'Enter old password to change password.');
        } else
        {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->image = $fileName;
            $user->update();
            return back()->with('success', 'Profile updated successfully');
        }
    
    }
    
}
