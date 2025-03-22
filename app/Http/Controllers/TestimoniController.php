<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except('store');
    }

    /**
     * Display a listing of the resource.
     */
    private $title = 'Testimoni';

    private $description = 'Detail Testimoni Pencucian';

    public function index()
    {
        $title = $this->title;
        $description = $this->description;
        $testimonis = Testimoni::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.testimoni.index', compact('title', 'testimonis', 'description'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z\s]+$/',
            ],
            'email' => ['required', 'string', 'email', 'max:255'],
            'description' => ['required', 'string', 'regex:/^[A-Za-z\s]+$/'],
        ]);

        Testimoni::create($request->all());

        return redirect()->back()->with('success', 'Testimoni created successfully');
    }
}
