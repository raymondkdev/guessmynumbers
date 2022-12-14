<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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
    use SoftDeletes;

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
     * Number of attempts on this game.
     *
     * @return int
     */
    public function getNumberOfAttemptsAttribute()
    {
        $numberOfCompletedAttemptsOnThisGame = DB::table('attempts')
            ->where('game_id', $this->id)
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->selectRaw('count(guesses.id) as number_of_guesses')
                        ->from('guesses')
                        ->whereColumn('guesses.attempt_id', 'attempts.id')
                        ->groupBy('attempt_id')
                        ->limit(1);
                }, '>=', 3)
                ->orWhere('won', 1);
            })
            ->count();
        return $numberOfCompletedAttemptsOnThisGame;
    }

    /**
     * Number of wons played this game.
     *
     * @return int
     */
    public function getNumberOfWonsAttribute()
    {
        $numberOfWons = Attempt::where('game_id', $this->id)
            ->where('won', 1)
            ->count();
        return $numberOfWons;
    }

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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['number_of_attempts', 'number_of_wons'];
}
