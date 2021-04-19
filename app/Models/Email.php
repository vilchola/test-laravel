<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'subject', 'receiver', 'message', 'user_id', 'sended'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'sended' => 'boolean',
    ];

    /**
     * Get the emails's status.
     *
     * @return string
     */
    public function getSendedAttribute($value)
    {
        return $value == 1 ? 'Yes' : 'No';
    }

    /**
     * Get the user that sends the email.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $search)
    {
        if (!is_null($search))
        {
            return $query->orWhere('receiver', 'like', '%'.$search.'%')
                ->orWhere('subject', 'like', '%'.$search.'%');
        }

        return $query;
    }
}
