<?php

namespace App\Observers;

use App\Models\VehicleType;
use App\Traits\LogTrait;

class VehicleTypeObserver
{
    use LogTrait;

    protected $table = 'vehicle_types';

    /**
     * Handle the VehicleType "created" event.
     */
    public function created(VehicleType $vehicleType): void
    {
        $this->addLog('Membuat data Tipe Kendaraan '.$vehicleType->name, $this->table, $vehicleType->id);
    }

    /**
     * Handle the VehicleType "updated" event.
     */
    public function updated(VehicleType $vehicleType): void
    {

        $this->addLog('Mengubah data Tipe Kendaraan '.$vehicleType->name, $this->table, $vehicleType->id);
    }

    /**
     * Handle the VehicleType "deleted" event.
     */
    public function deleted(VehicleType $vehicleType): void
    {
        $this->addLog('Menghapus data Tipe Kendaraan '.$vehicleType->name, $this->table, $vehicleType->id);
    }
}
