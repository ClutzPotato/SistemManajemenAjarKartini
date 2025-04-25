<<<<<<< HEAD
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if the current password matches the user's password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);

        return redirect()->back()->with('success', 'Password changed successfully.');
    }

    public function changeUsername(Request $request)
    {
        $request->validate([
            'new_username' => 'required|string|min:3|max:20',
        ]);
    
        $user = Auth::user();
    
        // Update the user's username
        $user->name = $request->new_username;
        
        // Save the changes
        $user->save();
    
        return redirect()->back()->with('success', 'Username changed successfully.');
    }
    
}
=======
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if the current password matches the user's password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);

        return redirect()->back()->with('success', 'Password changed successfully.');
    }

    public function changeUsername(Request $request)
    {
        $request->validate([
            'new_username' => 'required|string|min:3|max:20',
        ]);
    
        $user = Auth::user();
    
        // Update the user's username
        $user->name = $request->new_username;
        
        // Save the changes
        $user->save();
    
        return redirect()->back()->with('success', 'Username changed successfully.');
    }
    
}
>>>>>>> a9da1429d854b914262a8c81495b704b87d0c2b2
