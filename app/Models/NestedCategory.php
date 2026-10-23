<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Str;
use Auth;

class NestedCategory extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'slug', 'description', 'image', 'parent_id', 'admin_id','is_direction_based_category'];


    /**
     * A NestedCategory can have many children.
     */
    public function children()
    {
        return $this->hasMany(NestedCategory::class, 'parent_id')->with('children');
    }


    /**
     * A NestedCategory belongs to a parent.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(NestedCategory::class, 'parent_id');
    }


    public static function getTree($parentId = null)
    {
        if(Auth::guard('admin')->user()->role == "SuperAdmin"){
            if ($parentId == null) {
                $categories = NestedCategory::whereNull('parent_id')->with('children')->get();
            } else {
                $categories = NestedCategory::where('id', $parentId)->with('children')->get();
            }
            
        }else{
            if ($parentId == null) {
                $categories = NestedCategory::whereNull('parent_id')->where('admin_id', Auth::guard('admin')->user()->id)->with('children')->get();
            } else {
                $categories = NestedCategory::where('id', $parentId)->where('admin_id', Auth::guard('admin')->user()->id)->with('children')->get();
            }
        }
    
        // Loop and modify the 'name'
        $categories->transform(function ($category) {
            $category->name = Str::limit(str_replace('-', ' ', $category->name), 25);
    
            // If you want to also modify children's names recursively
            $category->children->transform(function ($child) {
                $child->name = Str::limit(str_replace('-', ' ', $child->name), 25);
                return $child;
            });

            return $category;
        });
    
        return $categories;
    }

}
