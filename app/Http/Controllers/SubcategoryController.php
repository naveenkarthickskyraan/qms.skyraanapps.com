<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NestedCategory;
use Illuminate\Support\Str;
use Storage;
use App\Helpers\LogActivity;
use App\Models\Quiz;
use Auth;


class SubcategoryController extends Controller
{
    /**
     * Fetch all NestedCategory in a hierarchical structure.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        if (empty($search)) {
            // Fetch entire tree starting from optional parent_id
            $nested_categories = NestedCategory::getTree($request->input('parent_id'));
    
        } else {
            // Fetch categories matching search query, including matching children
            $nested_categories = NestedCategory::with(['children' => function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            }])
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhereHas('children', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });
            })
            ->get();
        }
    
        // Transform names: replace hyphens and limit length (20 chars)
        $nested_categories->transform(function ($category) {
            $category->name = \Str::limit(str_replace('-', ' ', $category->name), 35, '...');
    
            $category->children->transform(function ($child) {
                $child->name = \Str::limit(str_replace('-', ' ', $child->name), 35, '...');
                return $child;
            });
    
            return $category;
        });
    
        // Remove duplicates and structure the final tree
        $uniqueTree = $this->removeDuplicates($nested_categories);
    
        return response()->json($uniqueTree);
    }


    /**
     * Recursively formats categories into a tree and removes duplicate nested_categories.
     */
    private function removeDuplicates($categories, &$seen = [])
    {
        return $categories->map(function ($category) use (&$seen) {
            if (isset($seen[$category->id])) {
                return null; // Skip duplicate
            }

            $seen[$category->id] = true; // Mark as seen

            return [
                'id' => $category->id,
                'name' => \Str::limit(str_replace('-', ' ', $category->name), 35),
                'children' => $this->removeDuplicates($category->children, $seen) // Ensure child hierarchy remains intact
            ];
        })->filter()->values(); // Remove null values and reset array keys
    }

    /**
     * Store a new NestedCategory.
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:nested_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = $request->only(['name', 'description', 'parent_id']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('nested_categories', 'public');
        }

        $baseSlug = str_replace(' ', '-', $request->input('name'));
        $slug = $baseSlug;
        $count = 1;

        // Check if slug exists, and if so, append a number until it's unique
        while (NestedCategory::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }

        $data['slug'] = $slug;
        $data['is_direction_based_category'] = $request->is_direction_based_category ?? 0;
        $data['admin_id'] = Auth::guard('admin')->user()->id;
        if($data['parent_id']){
            $parent = Quiz::where('category_id', $data['parent_id'])->where('deleted_at',0)->count();
            if($parent > 0){
                return response()->json(['error' => 'The selected category is already linked to existing quizzes and cannot be set as a parent category.'], 422);
            }
        }

        $nested_category = NestedCategory::create($data);

        LogActivity::addToLog();

        return response()->json($nested_category, 201);
    }



    public function show($id)
    {
        $nested_category = NestedCategory::with('parent')->findOrFail($id);
        return response()->json($nested_category);
    }


    /**
     * Update an existing nested_category.
     */
    public function update(Request $request, $id)
    {
        $nested_category = NestedCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'nullable|boolean'
        ]);

        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description') ?? null, // Ensure null if empty
            'slug' => str_replace(' ', '-', $request->input('name'))
        ];

        // Handle image removal
        if ($request->input('remove_image')) {
            if ($nested_category->image) {
                Storage::disk('public')->delete($nested_category->image);
                $data['image'] = null;
            }
        }
        
        $data['is_direction_based_category'] = $request->is_direction_based_category ?? 0;

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($nested_category->image) {
                Storage::disk('public')->delete($nested_category->image);
            }
            $data['image'] = $request->file('image')->store('nested_categories', 'public');
        }

        $nested_category->update($data);
        LogActivity::addToLog();

        return response()->json($nested_category);
    }

    /**
     * Delete a nested_category.
     */
    public function destroy($id)
    {
        $nested_category = NestedCategory::findOrFail($id);

        // Delete image if exists
        if ($nested_category->image) {
            Storage::disk('public')->delete($nested_category->image);
        }

        $nested_category->delete();
        LogActivity::addToLog();
        return response()->json(null, 204);
    }

}
