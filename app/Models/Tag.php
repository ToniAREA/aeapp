<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'tags';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function tagsWlogs()
    {
        return $this->belongsToMany(Wlog::class);
    }

    public function tagsWlists()
    {
        return $this->belongsToMany(Wlist::class);
    }

    public function tagsMatLogs()
    {
        return $this->belongsToMany(MatLog::class);
    }
}
