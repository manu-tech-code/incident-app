<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.create_user');
    }
    public function adduser(Request $request): RedirectResponse
    {
        User::create($request->all());
        return redirect(route('dashboard'));
    }
}
