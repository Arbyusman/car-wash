<?php

namespace App\Observers;

use App\Models\Washer;
use App\Traits\LogTrait;

class WasherObserver
{
    use LogTrait;

    protected $table = 'washers';

    /**
     * Handle the Washer "created" event.
     */
    public function created(Washer $washer): void
    {
        $this->addLog('Membuat data Pekerja '.$washer->name, $this->table, $washer->id);
    }

    /**
     * Handle the Washer "updated" event.
     */
    public function updated(Washer $washer): void
    {

        $this->addLog('Mengubah data Pekerja '.$washer->name, $this->table, $washer->id);
    }

    /**
     * Handle the Washer "deleted" event.
     */
    public function deleted(Washer $washer): void
    {
        $this->addLog('Menghapus data Pekerja '.$washer->name, $this->table, $washer->id);
    }
}
