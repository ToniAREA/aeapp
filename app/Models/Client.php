<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'clients';

    public static $searchable = [
        'notes',
        'internalnotes',
    ];

    protected $dates = [
        'last_use',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'defaulter',
        'ref',
        'name',
        'lastname',
        'vat',
        'address',
        'country',
        'telephone',
        'mobile',
        'email',
        'notes',
        'internalnotes',
        'link',
        'coordinates',
        'last_use',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function clientProformas()
    {
        return $this->hasMany(Proforma::class, 'client_id', 'id');
    }

    public function clientWlists()
    {
        return $this->hasMany(Wlist::class, 'client_id', 'id');
    }

    public function clientAppointments()
    {
        return $this->hasMany(Appointment::class, 'client_id', 'id');
    }

    public function clientsBoats()
    {
        return $this->belongsToMany(Boat::class);
    }

    public function contacts()
    {
        return $this->belongsToMany(ContactContact::class);
    }

    public function boats()
    {
        return $this->belongsToMany(Boat::class);
    }

    public function getLastUseAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setLastUseAttribute($value)
    {
        $this->attributes['last_use'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}
