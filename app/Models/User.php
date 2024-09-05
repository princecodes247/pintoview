<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'email',
        'password',
        'role', 
        'facebook',
        'twitter',
        'whatsapp',
        'telegram',
        'custom_domain',
        'has_completed_onboarding',
        'eligible_for_trial',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function isPremium()
    {
        // Check if the user has an active subscription with the plan name 'premium'
        $activeSubscription = $this->subscriptions()
            ->where('plan_name', 'premium')
            ->where('ends_at', '>', now())
            ->latest('ends_at')
            ->first();
    
        return !is_null($activeSubscription);
    }
    
    
    public function isSubscriptionActive()
    {
        $activeSubscription = $this->subscriptions()
            ->where('ends_at', '>', Carbon::now())
            ->latest('ends_at')
            ->first();

        return !is_null($activeSubscription);
    }

    /**
     * Relationship: User has many subscriptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
