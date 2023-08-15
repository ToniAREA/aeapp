<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Boat extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'boats';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'id_boat',
        'mmsi',
        'notes',
        'internalnotes',
    ];

    protected $fillable = [
        'id_boat',
        'boat_type_id',
        'name',
        'imo',
        'mmsi',
        'marina_id',
        'notes',
        'internalnotes',
        'coordinates',
        'link',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function boatWlists()
    {
        return $this->hasMany(Wlist::class, 'boat_id', 'id');
    }

    public function boatAppointments()
    {
        return $this->hasMany(Appointment::class, 'boat_id', 'id');
    }

    public function boatMatLogs()
    {
        return $this->hasMany(MatLog::class, 'boat_id', 'id');
    }

    public function boatsClients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function boatsProformas()
    {
        return $this->belongsToMany(Proforma::class);
    }

    public function boat_type()
    {
        return $this->belongsTo(BoatsType::class, 'boat_type_id');
    }

    public function marina()
    {
        return $this->belongsTo(Marina::class, 'marina_id');
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }
}
