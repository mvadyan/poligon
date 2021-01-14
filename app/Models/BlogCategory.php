<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use HasFactory, SoftDeletes;

    const ROOT = 1;

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|string
     */
    public function getParentTitleAttribute()
    {
        $title = $this->parentCategory->title
            ?? ($this->isRoot()
            ? 'Корень'
                : '???');

        return $title;
    }

    /**
     * @return bool
     */
    private function isRoot(): bool
    {
        return $this->id === self::ROOT;
    }
}
