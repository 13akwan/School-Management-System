<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SchoolClass;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('class');

        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'name',
                    'like',
                    '%' . $request->search . '%'
                )

                ->orWhere(
                    'email',
                    'like',
                    '%' . $request->search . '%'
                );
            });
        }

        if ($request->role) {

            $query->where(
                'role',
                $request->role
            );
        }

        $users = $query
            ->latest()
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = SchoolClass::all();

        return view('users.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:tbl_users,email',
            'password' => 'required|min:6',
            'role' => 'required',
            'class_id' => 'nullable'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'class_id' => $request->role == 'student'
                ? $request->class_id
                : null
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dibuat');
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
    public function edit(User $user)
    {
        $classes = SchoolClass::all();

        return view('users.edit', compact(
            'user',
            'classes'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'class_id' => $request->role == 'student'
                ? $request->class_id
                : null
        ];

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }
}
