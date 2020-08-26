<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\UserResource;

class UserController extends Controller
{

    public function all() {
		$user = User::latestFirst()->paginate(10);
		return UserResource::collection($user);
	}

    public function user(User $user) {
        return new UserResource($user);
    }

    public function register(Request $request) {
        // dd($request->role_id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;
        $user->save();

        if ($request->role_id == 2) {
            $user->assignRole('writer');
        }
        if ($request->role_id == 3) {
            $user->assignRole('member');
        }

		return new UserResource($user);
    }
    
    public function destroy(User $user) {
		$user->delete();
		return response(null, 204);
	}
}
