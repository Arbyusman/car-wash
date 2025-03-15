<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Vehicle;
use App\Traits\LogTrait;

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
}
