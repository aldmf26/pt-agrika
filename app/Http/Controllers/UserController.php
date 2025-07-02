<?php

namespace App\Http\Controllers;

use App\Models\Ttd;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $user = User::with(['roles', 'ttd'])->get();
        $role = Role::all();

        $data = [
            'title' => 'User',
            'users' => $user,
            'roles' => $role
        ];
        return view('user.index', $data);
    }

    public function upload(Request $r)
    {
        $path = $r->file('ttd')->store('ttd', 'public');
        Ttd::updateOrCreate(['user_id' => $r->id], ['link' => $path]);
        return redirect()->route('user.index')->with(['sukses' => 'User Updated']);
    }

    public function update(Request $r)
    {
        for ($i = 0; $i < count($r->id); $i++) {
            $user = User::findOrFail($r->id[$i]); // Ambil instance user
            $user->update([
                'name' => $r->name[$i],
                'email' => $r->email[$i],
            ]);

            // Sinkronkan role
            $user->roles()->sync([$r->role[$i]]);
        }

        return redirect()->route('user.index')->with(['sukses' => 'User Updated']);
    }

    public function store(Request $r)
    {
        User::create([
            'name' => $r->name,
            'email' => $r->email,
            'password' => bcrypt($r->password),
            'posisi_id' => 1,
            'lokasi' => 'bjm',
        ]);
        return redirect()->route('user.index')->with(['sukses' => 'User Updated']);
    }
}
