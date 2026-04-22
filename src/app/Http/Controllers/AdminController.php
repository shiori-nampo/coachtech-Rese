<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminCreateRequest;

class AdminController extends Controller
{
    public function create()
    {
        return view('admin.create');
    }

    public function store(AdminCreateRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,
        ]);

        return back()->with('success', '店舗代表者を登録しました');
    }

    public function index()
    {
        $owners = User::with('shop')->where('role_id', 2)->get();

        return view('admin.index', compact('owners'));
    }
}
