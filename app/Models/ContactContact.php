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
        'contact_nif',
        'contact_mobile',
        'contact_notes',
        'contact_internalnotes',
    ];

    protected $fillable = [
        'contact_first_name',
        'contact_last_name',
        'contact_nif',
        'contact_address',
        'contact_country',
        'contact_mobile',
        'contact_mobile_2',
        'contact_email',
        'contact_email_2',
        'social_link',
        'contact_tags',
        'contact_notes',
        'contact_internalnotes',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function contactEmployees()
    {
        return $this->hasMany(Employee::class, 'contact_id', 'id');
    }

    public function contactsClients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function contactsContactCompanies()
    {
        return $this->belongsToMany(ContactCompany::class);
    }
}
