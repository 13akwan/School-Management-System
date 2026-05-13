<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SchoolClass;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SchoolClass::query();

        if ($request->search) {

            $query->where(
                'name',
                'like',
                '%' . $request->search . '%'
            );
        }

        if ($request->grade) {

            $query->where(
                'name',
                'like',
                $request->grade . ' %'
            );
        }

        if ($request->major) {

            $query->where(
                'name',
                'like',
                '%' . $request->major . '%'
            );
        }

        $classes = $query
            ->latest()
            ->paginate(10);

        return view('classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tbl_classes,name'
        ]);

        SchoolClass::create([
            'name' => $request->name
        ]);

        return redirect()
            ->route('admin.classes.index')
            ->with('success', 'Class berhasil dibuat');
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
    public function edit(SchoolClass $class)
    {
        return view('classes.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolClass $class)
    {
        $request->validate([
            'name' => 'required|unique:tbl_classes,name,' . $class->id
        ]);

        $class->update([
            'name' => $request->name
        ]);

        return redirect()
            ->route('admin.classes.index')
            ->with('success', 'Class berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolClass $class)
    {
        $class->delete();
        return redirect()
        ->route('admin.classes.index')
        ->with('success', 'Class berhasil dihapus');
    }
}
