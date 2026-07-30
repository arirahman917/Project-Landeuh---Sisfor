<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'activity'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Record a new activity log entry for the current user.
     */
    public static function log(string $activity, ?int $userId = null): void
    {
        // Try to identify user from admin guard, web guard, or parameter
        $id = $userId ?? auth()->guard('admin')->id() ?? auth()->id();
        
        if ($id) {
            self::create([
                'user_id' => $id,
                'activity' => $activity,
            ]);
        }
    }
}
