<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    /**
     * @return string
     */
    public function getRouteKeyName () : string { return 'resource_id'; }

    /**
     * @return BelongsTo
     */
    public function status() : BelongsTo
    {
        return $this -> belongsTo( Status::class);
    }

    /**
     * @return BelongsTo
     */
    public function priority() : BelongsTo
    {
        return $this -> belongsTo( Priority::class);
    }

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this -> belongsTo( User::class);
    }
}
