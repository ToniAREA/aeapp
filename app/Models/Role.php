<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'roles';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function forRoleToDos()
    {
        return $this->belongsToMany(ToDo::class);
    }

    public function forRoleAppointments()
    {
        return $this->belongsToMany(Appointment::class);
    }

    public function forRoleWlists()
    {
        return $this->belongsToMany(Wlist::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
