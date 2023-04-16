<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Claim extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'claims';

    protected $dates = [
        'claim_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'proforma_number_id',
        'note',
        'claim_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function proforma_number()
    {
        return $this->belongsTo(Proforma::class, 'proforma_number_id');
    }

    public function getClaimDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setClaimDateAttribute($value)
    {
        $this->attributes['claim_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
