<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class centers extends Model
{
    use HasFactory;
    protected $fillable = array('name');


    public function register()
    {

        return $this->hasMany(statistics::class,'centers_id');
    }
}
