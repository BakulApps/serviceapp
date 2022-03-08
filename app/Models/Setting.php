<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table        = 'entity__settings';
    protected $fillable     = ['setting_id', 'setting_name', 'setting_value'];
    protected $primaryKey   = 'setting_id';
    public $timestamps      = false;

    public function value($name)
    {
        return $this->where('setting_name', $name)->value('setting_value');
    }
}
