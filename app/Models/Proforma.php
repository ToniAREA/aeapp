<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proforma extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'proformas';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'client_id',
        'date',
        'proforma_number',
        'description',
        'total_amount',
        'sent',
        'paid',
        'claims',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function proformaNumberWlogs()
    {
        return $this->hasMany(Wlog::class, 'proforma_number_id', 'id');
    }

    public function proformaNumberMlogs()
    {
        return $this->hasMany(Mlog::class, 'proforma_number_id', 'id');
    }

    public function proformaNumberClaims()
    {
        return $this->hasMany(Claim::class, 'proforma_number_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function wlists()
    {
        return $this->belongsToMany(Wlist::class);
    }
}
