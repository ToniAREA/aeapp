<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Priority extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'priorities';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'weight',
        'slug',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function priorityAppointments()
    {
        return $this->hasMany(Appointment::class, 'priority_id', 'id');
    }

    public function priorityWlists()
    {
        return $this->hasMany(Wlist::class, 'priority_id', 'id');
    }

    public function priorityToDos()
    {
        return $this->hasMany(ToDo::class, 'priority_id', 'id');
    }
}
