<?php

namespace App\Observers;

use App\Models\Project;

class ProjectObserver
{
    /**
     * @param Project $project
     */
    public function creating( Project $project ) : void
    {
        $project -> resource_id = generateAlphaNumericResource(15);
    }
}
