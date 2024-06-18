<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        $users = user::query()
            ->when(request('query'), function ($query, $searchQuery) {
                $query->where('name', 'like', "{$searchQuery}%");
            })
            ->latest()
            ->paginate(8);

        return $users;
    }

    public function store()
    {
        request()->validate([
            'email' => 'required|unique:users,email,'
        ]);


        return User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),

        ]);
    }

    public function update(User $user)
    {
        request()->validate([
            'email' => 'required|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('password') ? bcrypt(request('password')) : $user->password,
        ]);

        return $user;
    }

    public function destory(User $user)
    {
        $user->delete();

        return response()->noContent();
    }

    // public function search()
    // {
    //     $searchQuery = request('query');

    //     $users = user::where('name', 'like', "{$searchQuery}%")->paginate(5);

    //     return response()->json($users);
    // }

    public function bulkDelete()
    {
        User::whereIn('id', request('ids'))->delete();

        return response()->json(['message' => 'Users deleted successfully!']);
    }
}
