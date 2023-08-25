<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wlog extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'wlogs';

    public static $searchable = [
        'description',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'wlist_id',
        'boat_namecomplete',
        'date',
        'employee_id',
        'marina_id',
        'description',
        'hours',
        'proforma_number_id',
        'invoiced_line',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function wlist()
    {
        return $this->belongsTo(Wlist::class, 'wlist_id');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function marina()
    {
        return $this->belongsTo(Marina::class, 'marina_id');
    }

    public function proforma_number()
    {
        return $this->belongsTo(Proforma::class, 'proforma_number_id');
    }
}
