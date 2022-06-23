<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Properties:
 * @property int $id
 * @property int $number_one
 * @property int $number_two
 * @property int $number_three
 * @property string $live_on
 * @property string $author_name
 * @property string|null $author_location
 * @property string|null $author_email
 * @property string|null $link
 * @property string|null $link_title
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * Relationships
 * @property Attempt[] $attempts
 */
class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_one',
        'number_two',
        'number_three',
        'live_on',
        'author_name',
        'author_location',
        'author_email',
        'link',
        'link_title',
    ];

    /**
     * @return HasMany
     */
    public function attempts(): HasMany
    {
        return $this->hasMany(Attempt::class);
    }

    /**
     * @return HasManyThrough
     */
    public function guesses(): HasManyThrough
    {
        return $this->hasManyThrough(Guess::class, Attempt::class);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeCurrentlyActive(Builder $query): Builder
    {
        return $query
            ->where('live_on', '=', Carbon::now('America/Los_Angeles')->format('Y-m-d a'));
    }
}
