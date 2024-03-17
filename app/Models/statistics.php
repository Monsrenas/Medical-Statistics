<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statistics extends Model
{
    use HasFactory;

    public function centers() 
    {
        return $this->hasOne(centers::class,'id','centers_id');
    }

    public function inftype() 
    {
        return $this->hasOne(information_type::class,'id','information_type_id');
    }
}
