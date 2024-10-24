<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please Log In');
        }
        
        $currentUser = Auth::user();

        if ($currentUser->id !== (int) $id) {
            return redirect()->back()->with('error', 'You do not have access to this profile.');
        }
                
        $user = $this->loadModel($id);
        return view('user.show', compact('user'))->with('message', 'Profile retrieved successfully.');
    }

    public function view($id)
    {
        $user = $this->loadModel($id);
        return view('user.view', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:15',
            'password' => 'required|string|min:8|confirmed',
            'discount' => 'nullable|numeric',
            'expiry' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $user = User::create([
            'f_name' => $validatedData['f_name'],
            'l_name' => $validatedData['l_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => bcrypt($validatedData['password']),
            'discount' => $validatedData['discount'],
            'expiry' => $validatedData['expiry'],
            'notes' => $validatedData['notes'],
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $currentUser = Auth::user();
        if ($currentUser->id !== (int) $id) {
            return redirect()->back()->with('error', 'You do not have permission to edit this user.');
        }

        $user = $this->loadModel($id);
        return view('user.edit', compact('user'))->with('message', 'User retrieved successfully.');
    }
    
    public function update(Request $request, $id)
    {
        $currentUser = Auth::user();
        if ($currentUser->id !== (int) $id) {
            return redirect()->back()->with('error', 'You do not have permission to update this user.');
        }

        $validatedData = $request->validate([
            'email'     => 'required|email|unique:User,email,'.$id,
            'f_name'    => 'required|string|max:255',
            'l_name'    => 'required|string|max:255',
            'phone'     => 'required|string|min:4',
            'password'  => 'nullable|min:8|confirmed',
        ]);
    
        $user = $this->loadModel($id);

        if ($request->filled('password')) {
            $validatedData['password'] = $request->password;
        }
    
        $user->update($validatedData);
        return redirect()->route('user.show', $id)->with('message', 'User updated successfully.');
    }
    
    public function delete($id)
    {
        $user = $this->loadModel($id);

        if (Auth::id() === $user->id) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }
        
        $user->delete();
        return redirect()->route('user.index')->with('message', 'User deleted successfully.');
    }

    public function index()
    {
        $user = User::all();
        return view('user.index', compact('user'));
    }

    public function admin()
    {
        $user = User::paginate(10);
        return view('user.admin', compact('user'));
    }

    protected function loadModel($id)
    {
        return User::findOrFail($id);
    }
}
