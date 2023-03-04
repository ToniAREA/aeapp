<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wlist extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'wlists';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'desciption',
        'client_id',
        'boat_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function wlistWlogs()
    {
        return $this->hasMany(Wlog::class, 'wlist_id', 'id');
    }

    public function wlogs()
    {
        return $this->belongsToMany(Wlog::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function boat()
    {
        return $this->belongsTo(Boat::class, 'boat_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
