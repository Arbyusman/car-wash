<?php

namespace App\Observers;

use App\Models\Vehicle;
use App\Traits\LogTrait;

class VehicleObserver
{
    use LogTrait;

    protected $table = 'vehicles';

    /**
     * Handle the Vehicle "created" event.
     */
    public function created(Vehicle $vehicle): void
    {
        $this->addLog('Membuat data Tipe Kendaraan '.$vehicle->name, $this->table, $vehicle->id);
    }

    /**
     * Handle the Vehicle "updated" event.
     */
    public function updated(Vehicle $vehicle): void
    {

        $this->addLog('Mengubah data Tipe Kendaraan '.$vehicle->name, $this->table, $vehicle->id);
    }

    /**
     * Handle the Vehicle "deleted" event.
     */
    public function deleted(Vehicle $vehicle): void
    {
        $this->addLog('Menghapus data Tipe Kendaraan '.$vehicle->name, $this->table, $vehicle->id);
    }
}
