<?php

namespace App\Observers;

use App\Models\Status;

class StatusObserver
{
    /**
     * @param Status $satus
     */
    public function creating( Status $satus ) : void
    {
        $satus -> resource_id = generateAlphaNumericResource(15);
    }
}
