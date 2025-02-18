<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipment;

class EquipmentType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public $timestamps = true;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }
}
