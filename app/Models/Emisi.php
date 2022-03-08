<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emisi extends Model
{
    use HasFactory;
    protected $table        = 'entity__emisis';
    protected $fillable     = ['emisi_id', 'emisi_transaction', 'emisi_co', 'emisi_hc', 'emisi_co2', 'emisi_02', 'emisi_02'];
    protected $primaryKey   = 'emisi_id';
    public $timestamps      = false;
}
