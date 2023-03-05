<?php

namespace App\Observers;

use App\Models\Task;

class TaskObserver
{
    /**
     * @param Task $task
     */
    public function creating( Task $task ) : void
    {
        $task -> resource_id = generateAlphaNumericResource(15);
    }
}
