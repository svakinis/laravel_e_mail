<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['vardas', 'pavarde', 'gim_data', 'telefonas', 'adresas', 'city_id'];

    protected $dates = ['deleted_at']; // Nurodome, kad tai data (nebūtina nuo Laravel 7+)

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}