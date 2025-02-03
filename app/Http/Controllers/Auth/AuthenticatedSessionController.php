<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        $user = Auth::user();

        // Redirect based on the role of the user
        if ($user->is_admin) {
            return redirect()->route('filament.pages.dashboard'); // Admin redirect
        }

        // Redirect customers to the product list page
        return redirect()->route('product.list'); // Assuming the route name for the product list is 'product.list'
    }

    return back()->withErrors(['email' => 'Invalid credentials.']);
}

}
