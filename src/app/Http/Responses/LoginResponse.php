<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
  public function toResponse($request)
  {
    $user = Auth::user();


    if ($user->role_id === 1) {
      return redirect()->route('admin.index');
    } elseif ($user->role_id === 2) {
      return redirect()->route('owners.index');
    }


    return redirect('/');
  }
}