<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'tree_id',
        'app_id',
        'tree_name',
        'starting_point_id',
        'starting_point_name',
        'selected_nodes',
        'selection_order',
        'selected_ids'
    ];

    // One-to-many relationship with Node
    public function tree()
    {
        return $this->belongsTo(NestedCategory::class, 'tree_id');
    }
    // One-to-many relationship with AppList
    public function apps()
    {
        return $this->belongsTo(AppList::class, 'app_id');
    }

    // One-to-many relationship with Node
    public function startingPoint()
    {
        return $this->belongsTo(NestedCategory::class, 'starting_point_id');
    }

}
