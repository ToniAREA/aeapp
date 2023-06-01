<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mlog extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'mlogs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id_mlog',
        'client_id',
        'boat_id',
        'wlist_id',
        'product_id',
        'description',
        'quantity',
        'price_unit',
        'discount',
        'total',
        'status',
        'proforma_number_id',
        'invoiced_line',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function boat()
    {
        return $this->belongsTo(Boat::class, 'boat_id');
    }

    public function wlist()
    {
        return $this->belongsTo(Wlist::class, 'wlist_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function proforma_number()
    {
        return $this->belongsTo(Proforma::class, 'proforma_number_id');
    }
}
