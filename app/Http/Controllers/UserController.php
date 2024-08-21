<?php

namespace App\Http\Controllers;

use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::whereNot('role', 'admin')->get();
        return view('master.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $group = GroupUser::all();
        return view('master.user.create', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'unique:users'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        if ($request->group) {
            foreach ($request->group as $group) {
                $existGroup = GroupUser::where('group_name', $group)->first();
                if ($existGroup) {
                    $existGroup->user()->syncWithoutDetaching($user->id);
                } else {
                    $newGroup = new GroupUser();
                    $newGroup->group_name = $group;
                    $newGroup->save();
                    $newGroup->user()->syncWithoutDetaching($user->id);
                }
            }
        }
        return redirect()->route('user.index')->with(['success' => 'Berhasil Menambahkan User']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with(['success' => 'Berhasil Menghapus User']);
    }
}
