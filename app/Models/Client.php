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

    public const DEFAULTER_RADIO = [
        'yes' => 'yes',
        'no'  => 'no',
    ];

    protected $dates = [
        'lastuse',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'id_client',
        'lastname',
        'vat',
        'address',
        'country',
        'email',
        'phone',
        'mobile',
        'notes',
        'internalnotes',
    ];

    protected $fillable = [
        'id_client',
        'name',
        'lastname',
        'vat',
        'address',
        'country',
        'email',
        'phone',
        'mobile',
        'notes',
        'internalnotes',
        'defaulter',
        'lastuse',
        'link_fd',
        'coordinates',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function clientWlists()
    {
        return $this->hasMany(Wlist::class, 'client_id', 'id');
    }

    public function clientAppointments()
    {
        return $this->hasMany(Appointment::class, 'client_id', 'id');
    }

    public function clientBoats()
    {
        return $this->belongsToMany(Boat::class);
    }

    public function boats()
    {
        return $this->belongsToMany(Boat::class);
    }

    public function getLastuseAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setLastuseAttribute($value)
    {
        $this->attributes['lastuse'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
