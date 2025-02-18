<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PersonAccountable;
use App\Models\EquipmentType;
use App\Models\Section;
use App\Models\TransferHistory;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = ['equipment_type_id', 'brand', 'model', 'acquired_data', 'section_id', 'serial_number', 'mr_no', 'person_accountable_id', 'remarks'];

    public $timestamps = true;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function person_accountable()
    {
        return $this->belongsTo(PersonAccountable::class);
    }

    public function equipment_type()
    {
        return $this->belongsTo(EquipmentType::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function transfer_history()
    {
        return $this->hasMany(TransferHistory::class);
    }
}
