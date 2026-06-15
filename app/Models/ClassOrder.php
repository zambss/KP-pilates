<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassOrder extends Model
{
    protected $fillable = [
        'user_id',
        'class_id',
        'class_price_id',
        'total_sessions',
        'price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function class()
    {
        return $this->belongsTo(ClassSession::class, 'class_id');
    }

    public function price()
    {
        return $this->belongsTo(ClassPrice::class, 'class_price_id');
    }

    public function classPrice()
{
    return $this->belongsTo(ClassPrice::class, 'class_price_id');
}
  public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    

    /* =====================
       HELPERS
    ===================== */
    public function isPackage()
    {
        return !is_null($this->package_id);
    }

    public function isClassPrice()
    {
        return !is_null($this->class_price_id);
    }

}
