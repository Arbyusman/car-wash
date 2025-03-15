<?php

namespace App\Observers;

use App\Models\User;
use App\Traits\LogTrait;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

class UserObserver
{
    use LogTrait;

    protected $table = 'users';

    /**
     * Handle the Vehicle "created" event.
     */
    public function created(User $user): void
    {
        $this->addLog('Membuat user '.$user->name, $this->table, $user->id);
    }

    /**
     * Handle the Vehicle "updated" event.
     */
    public function updated(User $user): void
    {

        $this->addLog('Mengubah user '.$user->name, $this->table, $user->id);
    }

    /**
     * Handle the Vehicle "deleted" event.
     */
    public function deleted(User $user): void
    {
        $this->addLog('Menghapus user '.$user->name, $this->table, $user->id);
    }

    public function handleLogin(Login $event)
    {
        $user = $event->user;
        $this->addLog('User '.$user->name.' logged in', $this->table, $user->id);
    }

    /**
     * Handle user logout events.
     */
    public function handleLogout(Logout $event)
    {
        $user = $event->user;
        if ($user) {
            $this->addLog('User '.$user->name.' logged out', $this->table, $user->id);
        }
    }
}
