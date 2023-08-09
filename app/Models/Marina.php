<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marina extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'marinas';

    public static $searchable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id_marina',
        'name',
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

    public function marinaBoats()
    {
        return $this->hasMany(Boat::class, 'marina_id', 'id');
    }

    public function marinaWlogs()
    {
        return $this->hasMany(Wlog::class, 'marina_id', 'id');
    }
}
