<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use App\Models\AppList;
use App\Models\Module;
Use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Helpers\LogActivity;
use App\Models\LetterCount;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentExport;

use Yajra\DataTables\Facades\DataTables;
use App\Models\NestedCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NestedCategoryController extends Controller
{
    function show(Request $request)
    {
        if (!has_permission('category_menu', 'read')) {
            abort(403);
        }
        if (!has_module_access('category_menu')) {
            abort(403);
        }

        if ($request->ajax()) {
                
            if(Auth::guard('admin')->user()->role == "SuperAdmin"){
                $categories = NestedCategory::select(['id', 'name', 'slug','image', 'description','is_active', 'created_at']);
            }else{
                $categories = NestedCategory::select(['id', 'name', 'slug','image', 'description','is_active', 'created_at'])->where('admin_id', Auth::guard('admin')->user()->id);
            }

            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('name', function ($category) {
                    return "<center>".$category->name."</center>" ?? '<center><span class="text-center">-----</span></center>';
                })
                ->addColumn('description', function ($category) {
                    return $category->description ?? '<center><span class="text-center">-----</span></center>';
                })
                ->addColumn('image', function ($row) {
                    if($row->image == null)
                    {
                        $app = asset('images/no-camera.png');
                        return '<center><img  src="'.$app.'" style="width: 55px !important;height: 55px !important; border-radius: 10px !important;box-shadow: 0px 0px 15px #405189 !important;border:2px !important;opacity: 85% !important;"></center>';
                    }else if (isset($row->image_type) && $row->image_type == 1)
                    {
                        $app = asset("storage/".$row->image);
                        return '<center><a href="'.$app.'" target="_blank"><img  src="'.$app.'" data-bs-toggle="tooltip"  title="Click to View Image in another tab"  style="width: 55px !important;height: 55px !important; border-radius: 10px !important;box-shadow: 0px 0px 15px #405189 !important;border:2px !important;opacity: 85% !important;"/></a></center>';
                    }else{
                        $app = asset("storage/".$row->image);
                        return '<center><a href="'.$app.'" target="_blank"><img  src="'.$app.'" data-bs-toggle="tooltip"  title="Click to View Image in another tab"  style="width: 55px !important;height: 55px !important; border-radius: 10px !important;box-shadow: 0px 0px 15px #405189 !important;border:2px !important;opacity: 85% !important;"/></a></center>';
                    }
                })
                ->editColumn('created_at', function ($row) {
                    return date('Y-m-d', strtotime($row->created_at));
                })
                ->addColumn('status', function ($row) {
                    return $row->is_active == '0'
                        ? '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Active</span>'
                        : '<span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> Deactivate</span>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group" role="group">
                        <form action="' . url('admin/edit_nested_category/' . $row->id) . '" method="POST" style="padding-left:5px;">
                            ' . csrf_field() . '
                            <button type="submit" class="btn btn-icon btn-circle btn-sm btn-outline-primary"
                                style="background: #012970cf; border-color:#012970cf; color:#ffffff !important;">
                                <i class="fa fa-edit"></i>
                            </button>
                        </form>
                        <form id="form_submit_' . $row->id . '" action="' . url('admin/delete_nested_category/' . $row->id) . '" method="POST" style="padding-left:5px;">
                            ' . csrf_field() . '
                            <button type="button" class="btn btn-icon btn-circle btn-sm btn-outline-danger"
                                onclick="return validateform(' . $row->id . ')"
                                style="background: #EE4B2B; border-color:#EE4B2B; color:#ffffff !important">
                                <i class="fa fa-trash-can-arrow-up"></i>
                            </button>
                        </form>
                    </div>';
                })
                ->addColumn('active', function ($row) {
                    return '<form action="' . url('admin/nested_category_status_update') . '" method="POST">
                        ' . csrf_field() . '
                        <input type="hidden" name="cat_id" value="' . $row->id . '">
                        <input type="hidden" name="status" value="' . $row->is_active . '">
                        <button type="submit" class="btn_status btn btn-success btn-sm"
                            style="background:' . ($row->is_active == '0' ? '#28a745' : '#ffad46') . '!important;border-color: ' . ($row->is_active == '0' ? '#28a745' : '#ffad46') . '!important;color: #fff!important;">
                            <i class="' . ($row->is_active == '0' ? 'fa-solid fa-arrow-up' : 'fa-solid fa-arrow-down') . '"></i>' . ($row->is_active == '0' ? ' Enabled' : ' Disabled') . '
                        </button>
                    </form>';
                })
                ->rawColumns(['name','description','image','status', 'action', 'active','created_at'])
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && $request->search['value'] != '') {
                        $search = $request->search['value'];
                        $query->where(function ($q) use ($search) {
                            $q->where('id', 'like', "%{$search}%")
                                ->orWhere('name', 'like', "%{$search}%")
                                ->orWhere('slug', 'like', "%{$search}%")
                                ->orWhere('description', 'like', "%{$search}%")
                                ->orWhere('created_at', 'like', "%{$search}%");
                        });
                    }
                })
                ->make(true);
        }

        $category = NestedCategory::orderBy('id','asc')->where('deleted_at','0')->get();
        return view('admin.category.category_list', ['categorys' => $category]);
    }

    function Add_list()
    {
        if (!has_permission('category_menu', 'create')) {
            abort(403);
        }
        if (!has_module_access('category_menu')) {
            abort(403);
        }

        return view('admin.category.add_category');

    }

    public function store(Request $request)
    {
        if (!has_permission('category_menu', 'create')) {
            abort(403);
        }
        if (!has_module_access('category_menu')) {
            abort(403);
        }
        
        $baseSlug = str_replace(' ', '-', $request->input('name'));
        $slug = $baseSlug;

        $valiadte = $request->validate([
            'category_name' => 'required|string|max:255',
            'category_description' => 'required',
            'file' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ], [
            'category_name.required' => 'Language name is required.',
            'category_name.string' => 'Language name must be a valid string.',
            'category_name.max' => 'Language name cannot exceed 255 characters.',

            'category_description.required' => 'Language code is required.',
        ]);

        $user = new NestedCategory;
        $user->language_name = $request['category_name'];
        $user->language_code = $request['category_description'];
        $user->save();
        if($user)
        {
            LogActivity::addToLog();
            return back()->with('message','Language Created Successfully');
        }
        else
        {
            LogActivity::addToLog();
            return back()->with('error','Something Went Wrong');
        }
    }

    public function active(Request $request)
    {
        if (!has_permission('category_menu', 'status')) {
            abort(403);
        }
        if (!has_module_access('category_menu')) {
            abort(403);
        }
        LogActivity::addToLog();

        $cat_id = $request->cat_id;
        $status = $request->status;
        if($status == 0)
        {
            $app_active = NestedCategory::find($cat_id);
            $app_active->is_active ='1';
            $app_active->save();
            return back()->with('message','Language Disabled Successfully');
        }
        if($status == 1)
        {
            $app_active = NestedCategory::find($cat_id);
            $app_active->is_active ='0';
            $app_active->save();
            return back()->with('message','Language Enabled Successfully');
        }
    }

    public function delete(Request $request, $id)
    {
        if (!has_permission('category_menu', 'delete')) {
            abort(403);
        }
        if (!has_module_access('category_menu')) {
            abort(403);
        }

        LogActivity::addToLog();

        $Q1 = NestedCategory::findOrFail($id);
        $Q1->deleted_at = '1';
        $Q1->delete();
        return back()->with('message','Delete Record Successfully');

    }

    public function EditCategory($id)
    {
        if (!has_permission('category_menu', 'update')) {
            abort(403);
        }
        if (!has_module_access('category_menu')) {
            abort(403);
        }

        $edit = NestedCategory::find($id);
        $array = array($edit);
        return view('admin.category.edit_Category_list', ['edit_category_id'=> $array]);


    }

    public function EditCatList(Request $request, $id)
    {
        if (!has_permission('category_menu', 'update')) {
            abort(403);
        }
        if (!has_module_access('category_menu')) {
            abort(403);
        }

        $nested_category = NestedCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'nullable|boolean'
        ]);
        $baseSlug = str_replace(' ', '-', $request->input('name'));
        $slug = $baseSlug;

        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description') ?? null, // Ensure null if empty
            'slug' => $slug
        ];

        // Handle image removal
        if ($request->input('remove_image')) {
            if ($nested_category->image) {
                Storage::disk('public')->delete($nested_category->image);
                $data['image'] = null;
            }
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($nested_category->image) {
                Storage::disk('public')->delete($nested_category->image);
            }
            $data['image'] = $request->file('image')->store('nested_categories', 'public');
        }

        $nested_category->update($data);

        if($nested_category)
        {
            LogActivity::addToLog();
            return back()->with('message','Category Updated Successfully');
        }
        else
        {
            LogActivity::addToLog();
            return back()->with('error','Something Went Wrong');
        }
    }

}
