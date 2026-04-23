<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(Request $request): \Illuminate\View\View
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }
}
