<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return view('Admin.Branch.index', compact('branches'));
    }
    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
            // Validate the incoming request data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|unique:users,phone|max:10',
                'email' => 'required|email|max:255|unique:users,email',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            try {
                $imagePath = $request->image ? $request->image->store('uploads/Branch') : null;

                // Create the User
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'phone' => $request->phone,
                    'is_admin' => 2, // Assuming 'is_admin' is numeric
                    'image' => $imagePath,
                ]);

                // Create the Branch associated with the User
                $branch = new Branch();
                $branch->user_id = $user->id;
                $branch->name = $request->name;
                $branch->address = $request->address;
                $branch->phone = $request->phone;
                $branch->email = $request->email;
                $branch->password = Hash::make($request->password); // Correctly hash the password

                $branch->image = $imagePath;
                $branch->save();

                return redirect()->route('admin.admin-dashboard.branch.index')->with('message', 'Branch and User  successfully Created');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error adding branch & user: ' . $e->getMessage());
            }
        } else {
            return view('Admin.Branch.add');
        }
    }

    public function show($slug)
    {
        $branch = Branch::where('slug', $slug)->first();
        // dd($branch);
        return view('Admin.Branch.show', compact('branch',));
    }
    public function edit(Request $request, $slug)
    {
        // Find the branch by slug
        $branch = Branch::where('slug', $slug)->first();

        if (!$branch) {
            return redirect()->route('admin.admin-dashboard.branch.index')->with('error', 'Branch not found');
        }

        if ($request->isMethod('POST')) {
            // Validate the incoming request data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:10',
                'email' => 'required|email|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            try {
                // Handle image upload if provided
                $imagePath = $branch->image;

                if ($request->hasFile('image')) {
                    $imagePath = $request->image->store('uploads/Branch');
                }

                // Update branch details
                $branch->name = $request->name;
                $branch->address = $request->address;
                $branch->image = $imagePath;

                // Optionally update password if provided
                if ($request->filled('password')) {
                    $branch->password = Hash::make($request->password);
                }
                if ($request->filled('phone')) {
                    $branch->phone = $request->phone;
                }
                if ($request->filled('email')) {
                    $branch->email = $request->email;
                }

                // Save the updated branch
                $branch->save();

                return redirect()->route('admin.admin-dashboard.branch.index')->with('message', 'Branch and User successfully updated');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error updating branch & user: ' . $e->getMessage());
            }
        } else {
            // Load the edit view with the branch data
            return view('Admin.Branch.edit', compact('branch'));
        }
    }



    public function del($slug)
    {
        $branch = Branch::where('slug', $slug)->first();

        if (!$branch) {
            return redirect()->route('admin.admin-dashboard.branch.index')->with('error', 'Branch not found');
        }

        // Delete the branch (this will trigger the `deleting` event in the Branch model)
        $branch->delete();

        return redirect()->route('admin.admin-dashboard.branch.index')->with('message', 'Branch and associated User deleted successfully');
    }
}
