<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;

class LogController extends Controller
{
    private $title = 'Logs';

    private $description = 'Detail Log Aplikasi';

    public function index()
    {
        $title = $this->title;
        $description = $this->description;
        $logs = ActivityLog::with('user')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.logs.index', compact('title', 'logs', 'description'));
    }
}
