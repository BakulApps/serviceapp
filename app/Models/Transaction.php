<?php

namespace App\Models;

use App\Models\Master\Garage;
use App\Models\Master\Unit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table        = 'entity__transactions';
    protected $fillable     = ['transaction_id', 'transaction_unit', 'transaction_garage', 'transaction_customer',
        'transaction_phone', 'transaction_desc', 'transaction_desc_finish', 'transaction_date_in', 'transaction_date_finish',
        'transaction_status', 'transaction_stiker', 'transaction_apar'];
    protected $primaryKey   = 'transaction_id';
    public $timestamps      = false;

    public function date_in()
    {
        return Carbon::parse($this->transaction_date_in)->translatedFormat('d M Y');
    }
    public function garage()
    {
        return $this->hasOne(
            Garage::class,
            'garage_id',
            'transaction_garage'
        );
    }

    public function unit()
    {
        return $this->hasOne(
            Unit::class,
            'unit_id',
            'transaction_unit'
        );
    }

    public function emisi()
    {
        return $this->hasOne(
            Emisi::class,
            'emisi_transaction',
            'transaction_id'
        );
    }
}
