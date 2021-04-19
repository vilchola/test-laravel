<?php

namespace App;

use App\Models\Email;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'email', 'password', 'name', 'phone', 'document', 'birthdate',
    ];

    protected $sortable = [
        'id', 'email', 'name', 'phone', 'document', 'birthdate',
    ];

    /**
     * The attributes that are auto calculated.
     *
     * @var array
     */
    protected $appends =[
        'age',
      ];

    /**
     * Protected attributes that CANNOT be mass assigned.
     *
     * @var array
     */
    protected $guarded = [
        'email', 'document',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Ensures that password is Hashed whenever assigned.
     * 
     * @var string $pass clear-text string password
     */
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Get the user's age.
     *
     * @return string
     */
    public function getAgeAttribute($value)
    {
        return Carbon::parse($this->birthdate)->age;
    }

    /**
     * Get the emails for the user.
     */
    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function scopeSearch($query, $search)
    {
        if (!is_null($search))
        {
            return $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('document', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%')
                ->orWhere('phone', 'like', '%'.$search.'%');
        }

        return $query;
    }
}
