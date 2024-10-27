<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property null|\Illuminate\Support\Carbon $email_verified_at
 * @property string $password
 * @property null|string $remember_token
 * @property null|string $two_factor_secret
 * @property null|array $two_factor_recovery_codes
 * @property null|\Illuminate\Support\Carbon $two_factor_confirmed_at
 * @property null|array $settings
 * @property bool $is_verified
 * @property bool $is_admin
 * @property null|string $fcm_token
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 */
#[ScopedBy([])]
#[ObservedBy([])]
// #[CollectedBy()]
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    // Start Constants
    // End Constants

    // Start Properties
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'fcm_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];


    /**
     * Define model validation rules
     *
     * @var array
     */
    public static array $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:unique:users',
        'password' => 'required|string|min:8',
        'fcm_token' => 'nullable|string',
    ];

    // End Properties

    // Start Relationships
    // End Relationships

    // Start Scopes
    // End Scopes

    // Start Accessors and Mutators

    /**
     * Accessor for FCM token.
     * This method capitalizes the `fcm_token` when retrieved.
     *
     * @return string|null
     */
    public function getFcmTokenAttribute(): ?string
    {
        return ucfirst($this->attributes['fcm_token'] ?? '');
    }

    /**
     * Mutator for FCM token.
     * This method trims and lowercases the `fcm_token` when saving.
     *
     * @param  string  $value
     */
    public function setFcmTokenAttribute(string $value): void
    {
        $this->attributes['fcm_token'] = strtolower(trim($value));
    }

    // End Accessors and Mutators

    // Start Query Builder Methods
    // End Query Builder Methods

    // Start Main Methods (core business logic)
    /**
     * Enable two-factor authentication for the user.
     *
     * @param  string  $secret  The two-factor authentication secret
     * @param  array  $recoveryCodes  The recovery codes for two-factor authentication
     */
    public function enableTwoFactorAuth(string $secret, array $recoveryCodes): void
    {
        $this->forceFill([
            'two_factor_secret' => encrypt($secret),
            'two_factor_recovery_codes' => encrypt(json_encode($recoveryCodes)),
        ])->save();
    }

    /**
     * Disable two-factor authentication for the user.
     */
    public function disableTwoFactorAuth(): void
    {
        $this->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
        ])->save();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
            'two_factor_recovery_codes' => 'array',
            'settings' => 'array',
            'is_verified' => 'boolean',
            'is_admin' => 'boolean',
            'fcm_token' => 'string',
        ];
    }
    // End Main Methods

    // Start Helper Methods
    // End Helper Methods
}
