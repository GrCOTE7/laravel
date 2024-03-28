<?php

namespace App\Models;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements MustVerifyEmail, AuthenticatableContract
{
	use HasFactory;
	use Notifiable;
    use HasApiTokens;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

    public function getAuthIdentifierName()
    {
        return 'id';
    }
    public function getAuthPassword()
    {
        return $this->password;
    }
    public function getAuthPasswordName()
    {
        return $this->name;
    }

    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    public function getRememberToken()
    {
        return $this->{$this->getRememberTokenName()};
    }

    public function setRememberToken($value)
    {
        $this->{$this->getRememberTokenName()} = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
    /**
     * Get the email address that should be used for verification.
     * @return string
     */
    public function getEmailForVerification() {
        Session::put('lionel',777);
    }

    /**
     * Determine if the user has verified their email address.
     * @return bool
     */
    public function hasVerifiedEmail() {
        return true;
    }

    /**
     * Mark the given user's email as verified.
     * @return bool
     */
    public function markEmailAsVerified() {
    }

    /**
     * Send the email verification notification.
     * @return void
     */
    public function sendEmailVerificationNotification() {
        Session::put('lionel',777);
    }
}
