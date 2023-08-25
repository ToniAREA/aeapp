<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Wlist extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'wlists';

    protected $appends = [
        'photos',
    ];

    protected $dates = [
        'deadline',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const ORDER_TYPE_RADIO = [
        'estimate' => 'Estimate',
        'order'    => 'Order',
        'work'     => 'Work',
        'requests' => 'Requests',
    ];

    protected $fillable = [
        'client_id',
        'boat_id',
        'order_type',
        'boat_namecomplete',
        'description',
        'deadline',
        'priority_id',
        'status',
        'url_invoice',
        'notes',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function wlistWlogs()
    {
        return $this->hasMany(Wlog::class, 'wlist_id', 'id');
    }

    public function wlistMatLogs()
    {
        return $this->hasMany(MatLog::class, 'wlist_id', 'id');
    }

    public function wlistsAppointments()
    {
        return $this->belongsToMany(Appointment::class);
    }

    public function wlistsProformas()
    {
        return $this->belongsToMany(Proforma::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function boat()
    {
        return $this->belongsTo(Boat::class, 'boat_id');
    }

    public function for_roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function for_users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getPhotosAttribute()
    {
        $files = $this->getMedia('photos');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function getDeadlineAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDeadlineAttribute($value)
    {
        $this->attributes['deadline'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class, 'priority_id');
    }
}
