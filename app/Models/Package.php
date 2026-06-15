<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'category',
        'name',
        'description',
        'highlight',
        'allowed_types',
    ];

    public function prices()
    {
        return $this->hasMany(PackagePrice::class);
    }

    public function benefits()
    {
        return $this->hasMany(PackageBenefit::class);
    }

      public function getAllowedTypesArrayAttribute(): array
    {
        return explode(',', $this->allowed_types);
    }

    /**
     * Check apakah package boleh untuk tipe kelas tertentu
     */
    public function allows(string $type): bool
    {
        return in_array($type, $this->allowed_types_array);
    }

}
