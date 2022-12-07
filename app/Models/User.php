<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Models
 * @method static|Builder member()
 * @method static|Builder admin()
 * @property string $role
 * @property string $name
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ROLE_OWNER = 'owner';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_MEMBER = 'member';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'avatar',
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

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = str_replace(['-', ' '], ['.', ''], \Str::slug($value));
    }

    public function getAvatarUrlAttribute()
    {
        if (!$this->avatar) {
            return 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTL_JlCFnIGX5omgjEjgV9F3sBRq14eTERK9w&usqp=CAU';
        }

        return asset('storage/images/users/' . $this->avatar);
    }

    public function setAvatarAttribute($value)
    {
        if (is_string($value) || is_null($value)) {
            $this->attributes['avatar'] = $value;
        } else if ($value instanceof UploadedFile) {
            $filename = $value->hashName();

            Storage::putFileAs('public/images/users', $value, $filename);

            $this->attributes['avatar'] = $filename;
        }
    }

    /**
     * @param Builder $query
     */
    public function scopeMember($query)
    {
        $query->where('role', self::ROLE_MEMBER);
    }

    /**
     * @param Builder $query
     */
    public function scopeAdmin($query)
    {
        $query->whereIn('role', [self::ROLE_OWNER, self::ROLE_ADMIN]);
    }
}
