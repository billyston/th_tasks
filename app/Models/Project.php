<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    /**
     * @return string
     */
    public function getRouteKeyName () : string { return 'resource_id'; }

    /**
     * @return HasMany
     */
    public function statuses() : HasMany
    {
        return $this -> hasMany( Status::class);
    }

    /**
     * @return HasMany
     */
    public function users() : HasMany
    {
        return $this -> hasMany( User::class);
    }
}
