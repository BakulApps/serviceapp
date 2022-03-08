<?php

namespace App\Models\Master;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    use HasFactory;
    protected $table        = 'entity__master_garages';
    protected $fillable     = ['garage_id', 'garage_name', 'garage_address', 'garage_phone'];
    protected $primaryKey   = 'garage_id';
    public $timestamps      = false;

    public function transaction()
    {
        return $this->hasMany(
            Transaction::class,
            'transaction_garage1',
            'garage_id'
        );
    }
}
