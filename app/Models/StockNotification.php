<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StockNotification extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'product_id',
        'email',
        'token',
        'notified_at',
    ];
    
    protected $casts = [
        'notified_at' => 'datetime',
    ];
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($notification) {
            if (!$notification->token) {
                $notification->token = Str::random(32);
            }
        });
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function scopeNotNotified($query)
    {
        return $query->whereNull('notified_at');
    }
    
    public function markAsNotified()
    {
        $this->notified_at = now();
        $this->save();
    }
}
