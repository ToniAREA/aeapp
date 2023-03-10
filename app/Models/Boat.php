<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Boat extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'boats';

    protected $dates = [
        'lastuse',
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
        'type',
        'name',
        'mmsi',
        'notes',
        'internalnotes',
        'lastuse',
        'marina_id',
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

    public function boatsClients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function boatsMarinas()
    {
        return $this->belongsToMany(Marina::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function getLastuseAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setLastuseAttribute($value)
    {
        $this->attributes['lastuse'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function marina()
    {
        return $this->belongsTo(Marina::class, 'marina_id');
    }
}
