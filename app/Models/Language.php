<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int                             $id
 * @property string                          $name
 * @property string                          $code
 * @property bool                            $is_active
 * @property bool                            $is_default
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Language query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Language whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Language whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Language whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Language whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Language whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Language whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Language extends Model
{
    protected $fillable = [
        'name',
        'code',
        'flag',
        'is_active',
        'is_default',
        'status',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
    ];

    public function getStatusAttribute(): bool
    {
        return (bool) ($this->is_active ?? false);
    }

    public function setStatusAttribute($value): void
    {
        $this->attributes['is_active'] = (bool) $value;
    }
}
