<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->only(['name', 'email']);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name'  => ['required'],
            'email' => ['required', 'email',],
        ]);
        $request->user()->update($validated);
        return response()->json(['success' => true]);
    }
}
