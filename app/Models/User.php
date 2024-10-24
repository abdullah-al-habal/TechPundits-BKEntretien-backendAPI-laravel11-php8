<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * User Model
 *
 * This class represents a user in the application.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $two_factor_secret
 * @property array|null $two_factor_recovery_codes
 * @property \Illuminate\Support\Carbon|null $two_factor_confirmed_at
 * @property array|null $settings
 * @property bool $is_verified
 * @property bool $is_admin
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    // Start Constants
    // (No constants defined in this class)
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
        'is_admin'
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
        ];
    }

    // End Properties
    // Start Relationships
    // (No relationships defined in this class)
    // End Relationships
    // Start Scopes
    // (No scopes defined in this class)
    // End Scopes
    // Start Accessors and Mutators
    // (No accessors or mutators defined in this class)
    // End Accessors and Mutators
    // Start Query Builder Methods
    // (No query builder methods defined in this class)
    // End Query Builder Methods
    // Start Main Methods (core business logic)
    /**
     * Enable two-factor authentication for the user.
     *
     * @param string $secret The two-factor authentication secret
     * @param array $recoveryCodes The recovery codes for two-factor authentication
     * @return void
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
     *
     * @return void
     */
    public function disableTwoFactorAuth(): void
    {
        $this->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
        ])->save();
    }
    // End Main Methods

    // Start Helper Methods
    // (No helper methods defined in this class)
    // End Helper Methods
}
