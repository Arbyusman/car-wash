<?php

namespace App\Http\Controllers;

use App\Models\Washer;
use Illuminate\Http\Request;

class WasherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $title = 'Washers';

    private $description = 'Detail Pekerja';

    public function index()
    {
        $title = $this->title;
        $description = $this->description;
        $washers = Washer::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.washers.index', compact('title', 'washers', 'description'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Washer::create($request->all());

        return redirect()->route('washers.index')->with('success', 'Washer created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Washer $washer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $washer->update($request->all());

        return redirect()->route('washers.index')->with('success', 'Washer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Washer $washer)
    {
        $washer->delete();

        return redirect()->route('washers.index')->with('success', 'Washer deleted successfully');
    }
}
