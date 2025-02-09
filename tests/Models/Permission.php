<?php

namespace Tests\Models;

use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

/**
 * @property-read \Illuminate\Database\Eloquent\Relations\Pivot $pivot
 * @property-read \Illuminate\Database\Eloquent\Relations\Pivot $role_user
 */
class Permission extends Model
{
    use HasRelationships;

    public function countries(): HasManyDeep
    {
        return $this->hasManyDeepFromReverse(
            (new Country())->permissionsWithPivotAlias()
        );
    }
}
