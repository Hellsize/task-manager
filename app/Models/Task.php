<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
'title',
'is done',
'project_id'
    ];
    protected $casts = [
        'is done' => 'boolean'
    ];
    protected $hidden = [
        'updated_at',
        'created_at',
    ];
    public function creator(): BelongsTo{
        return $this->belongsTo(User::class.'creator_id');
    }
    public function project():BelongsTo{
        return $this->belongsTo(Project::class);
    }
    protected static function booted():void{
        static::addGlobalScope('creator',function(Builder $builder){
            $builder->where('creator_id', Auth::id());
        });
    }
}

