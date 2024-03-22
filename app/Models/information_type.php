<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class information_type extends Model
{
    use HasFactory;
    protected $table = "information_type";
    protected $fillable = array('name', 'magnitude');

    public function register()
    {

        return $this->hasMany(statistics::class,'information_type_id');
    }
}
