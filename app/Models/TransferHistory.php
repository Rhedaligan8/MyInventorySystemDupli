<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipment;

class TransferHistory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'equipment_id', 'date_of_transfer', 'previous_location', 'previous_person', 'transfer_location', 'transfer_person'];

    public $timestamps = true;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

}
