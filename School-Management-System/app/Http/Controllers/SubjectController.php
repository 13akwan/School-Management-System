<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Subject::query();

        // search
        if ($request->search) {

            $query->where(
                'name',
                'like',
                '%' . $request->search . '%'
            );
        }

        $subjects = $query
            ->latest()
            ->paginate(10);

        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tbl_subjects,name'
        ]);

        Subject::create([
            'name' => $request->name
        ]);

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Subject berhasil dibuat');
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
    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|unique:tbl_subjects,name,' . $subject->id
        ]);

        $subject->update([
            'name' => $request->name
        ]);

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Subject berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Subject berhasil dihapus');
    }
}
