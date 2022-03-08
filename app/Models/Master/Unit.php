<?php

namespace App\Models\Master;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table        = 'entity__master_units';
    protected $fillable     = ['unit_id', 'unit_nopol', 'unit_merk', 'unit_type', 'unit_year', 'unit_region'];
    protected $primaryKey   = 'unit_id';
    public $timestamps      = false;

    public function transaction()
    {
        return $this->hasMany(
            Transaction::class,
            'transaction_unit',
            'unit_id'
        );
    }
}
