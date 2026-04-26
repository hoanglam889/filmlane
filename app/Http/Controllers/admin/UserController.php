<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('admin.user_index', compact('users'));
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Prevent admin from changing their own role (optional but good practice)
        if (auth()->id() == $user->id) {
            return redirect()->back()->with('error', 'Không thể tự thay đổi quyền của chính mình!');
        }

        // Toggle role (0 -> 1, 1 -> 0)
        $user->role = $user->role == 1 ? 0 : 1;
        $user->save();

        return redirect()->back()->with('success', 'Đã cập nhật quyền cho người dùng: ' . $user->name);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if (auth()->id() == $user->id) {
            return redirect()->back()->with('error', 'Không thể tự xóa chính mình!');
        }

        $user->delete();

        return redirect()->back()->with('success', 'Đã xóa người dùng: ' . $user->name);
    }
}
