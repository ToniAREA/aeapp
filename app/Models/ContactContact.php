<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactContact extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'contact_contacts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'nif',
        'phone',
        'mobile',
        'address',
        'country',
        'notes',
        'internalnotes',
    ];

    protected $fillable = [
        'contact_first_name',
        'contact_last_name',
        'contact_email',
        'contact_address',
        'nif',
        'phone',
        'mobile',
        'address',
        'country',
        'notes',
        'internalnotes',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
