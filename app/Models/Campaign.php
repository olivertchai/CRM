<?php

namespace App\Models;

use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\BelongsToMany;
use Lib\Validations;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property \DateTime $start_date
 * @property \DateTime $end_date
 * @property string $status
 * @property int $user_id
 * @property User $user
 * @property User[] $reinforced_by_users
 */
class Campaign extends Model
{
    protected static string $table = 'campaigns';
    protected static array $columns = ['title', 'description', 'start_date', 'end_date', 'status', 'user_id', 'image_url'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reinforcedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'campaign_user_reinforce', 'campaign_id', 'user_id');
    }

    public function validates(): void
    {
        Validations::notEmpty('title', $this);
    }

    public function isSupportedByUser(User $user): bool
    {
        return CampaignUserReinforce::exists(['campaign_id' => $this->id, 'user_id' => $user->id]);
    }
}