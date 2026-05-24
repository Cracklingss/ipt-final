<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\EventOrganizer;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::with('organizer')->get();
        return view('admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $organizers = EventOrganizer::all();
        return view('admins.create', compact('organizers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'event_organizer_id' => 'nullable|exists:event_organizers,id',
        ]);

        $admin = Admin::create($data);
        return redirect()->route('admins.show', $admin);
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        return view('admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $organizers = EventOrganizer::all();
        return view('admins.edit', compact('admin','organizers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'event_organizer_id' => 'nullable|exists:event_organizers,id',
        ]);

        $admin->update($data);
        return redirect()->route('admins.show', $admin);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index');
    }
}
