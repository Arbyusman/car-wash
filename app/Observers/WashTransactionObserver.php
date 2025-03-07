<?php

namespace App\Observers;

use App\Models\WashTransaction;
use App\Traits\LogTrait;

class WashTransactionObserver
{
    use LogTrait;

    protected $table = 'wash_transactions';

    /**
     * Handle the WashTransaction "created" event.
     */
    public function created(WashTransaction $washTransaction): void
    {
        $this->addLog('Membuat data Transaksi '.$washTransaction->transaction_number, $this->table, $washTransaction->id);
    }

    /**
     * Handle the WashTransaction "updated" event.
     */
    public function updated(WashTransaction $washTransaction): void
    {

        $this->addLog('Mengubah data Transaksi '.$washTransaction->transaction_number, $this->table, $washTransaction->id);
    }

    /**
     * Handle the WashTransaction "deleted" event.
     */
    public function deleted(WashTransaction $washTransaction): void
    {
        $this->addLog('Menghapus data Transaksi '.$washTransaction->transaction_number, $this->table, $washTransaction->id);
    }
}
