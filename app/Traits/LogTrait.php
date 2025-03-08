<?php

namespace App\Traits;

use App\Models\ActivityLog;

trait LogTrait
{
    public function addLog($subject, $table = null, $table_id = null, $interface = 'web')
    {
        $request = app('request');

        $type = match ($request->method()) {
            'POST' => $request->is('login') ? 'login' : ($request->is('logout') ? 'logout' : 'add'),
            'PUT', 'PATCH' => 'edit',
            'DELETE' => 'delete',
            default => 'view'
        };

        if (strpos((string) $table_id, ',')) {
            $table_id = '"'.$table_id.'"';
        }

        ActivityLog::create([
            'subject' => $subject,
            'url' => $request->url(),
            'type' => $type,
            'table' => $table,
            'table_id' => $table_id,
            'user_id' => auth()->user()?->id ?? 1,
        ]);
    }
}
