<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminCreateRequest;
use App\Mail\AdminNoticeMail;
use Illuminate\Support\Facades\Mail;

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
        $owners = User::with('shops')->where('role_id', 2)->paginate(10);

        return view('admin.index', compact('owners'));
    }

    public function show()
    {
        return view('admin.information');
    }

    public function send(Request $request)
    {
        $request->validate([
            'information' => 'required|string|max:1000',
        ], [
            'information.required' => 'お知らせ内容を入力してください',
            'information.max' => 'お知らせ内容は1000文字内で入力してください',
        ]);

        $users = User::where('role_id', 3)->get();
        $messageContent = $request->information;

        foreach ($users as $user) {
            Mail::to($user->email)->send(new AdminNoticeMail($messageContent));
        }

        return back()->with('success', 'お知らせメールを送信しました');

    }
}
