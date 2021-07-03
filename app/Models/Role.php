<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'roles';

    protected $fillable = [
        'name',
        'label'
    ];
    
    protected $appends = ['created_at_label'];

    /**
     * Relationships
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Scopes
     */
    public function scopeFilterByName(Builder $builder, $name)
    {
        return $builder->when(
            $name,
            function (Builder $builder) use($name) {
                return $builder->where('name', 'like', "%$name%");
            }
        );
    }
    
    public function scopeFilterByLabel(Builder $builder, $label)
    {
        return $builder->when(
            $label,
            function (Builder $builder) use($label) {
                return $builder->where('label', 'like', "%$label%");
            }
        );
    }
    
    /**
     * Accessors
     */
    public function getCreatedAtLabelAttribute()
    {
        if (empty($this->created_at)) {
            return '';
        }
        
        return $this->created_at->format('d/m/Y H:i');
    }
}
