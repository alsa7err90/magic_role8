<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magpermission extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug'];
    public function magroles()
    {
        return $this->belongsToMany(Magrole::class);
    }

}
