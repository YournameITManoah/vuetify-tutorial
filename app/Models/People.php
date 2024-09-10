<?php

namespace App\Models;

use Database\Factories\PeopleFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string|null $phone
 * @property string $gender
 * @property string|null $address
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static PeopleFactory factory($count = null, $state = [])
 * @method static Builder|People newModelQuery()
 * @method static Builder|People newQuery()
 * @method static Builder|People query()
 * @method static Builder|People whereAddress($value)
 * @method static Builder|People whereCreatedAt($value)
 * @method static Builder|People whereEmail($value)
 * @method static Builder|People whereGender($value)
 * @method static Builder|People whereId($value)
 * @method static Builder|People whereName($value)
 * @method static Builder|People wherePhone($value)
 * @method static Builder|People whereUpdatedAt($value)
 * @mixin Eloquent
 */
class People extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'gender',
        'address',
    ];

    public function getCreatedAtAttribute($value): string
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }
}
