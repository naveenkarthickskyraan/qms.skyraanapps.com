<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\AppList;
use App\Models\Module;
Use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\NestedCategory;
use App\Models\Prayer;
use App\Models\MappedAppCategory;
use App\Helpers\LogActivity;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Yajra\DataTables\Facades\DataTables;

class AppController extends Controller
{
    public function show(Request $request)
    {
        if (!has_permission('app_menu', 'read')) {
            abort(403);
        }
        if (!has_module_access('app_menu')) {
            abort(403);
        }

        if ($request->ajax()) {
            $categories = AppList::where('deleted_at', '0');

            return DataTables::of($categories)
                ->addIndexColumn()
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
                        <a href="' . url('admin/admin_add_app?app_name=' . urlencode($row->app_name)) . '"
                            class="btn btn-icon btn-circle btn-sm btn-outline-primary"
                            style="background:rgb(0 22 255); border-color:rgb(0 22 255); color:#ffffff !important;">
                            <i class="fa fa-plus mt-2"></i>
                        </a>

                        <form action="' . url('admin/edit_app/' . $row->id) . '" method="POST" style="padding-left:5px;">
                            ' . csrf_field() . '
                            <button type="submit" class="btn btn-icon btn-circle btn-sm btn-outline-primary"
                                style="background: #012970cf; border-color:#012970cf; color:#ffffff !important;">
                                <i class="fa fa-edit"></i>
                            </button>
                        </form>
                        <form id="form_submit_' . $row->id . '" action="' . url('admin/delete_app/' . $row->id) . '" method="POST" style="padding-left:5px;">
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
                    return '<form action="' . url('admin/app_status_update') . '" method="POST">
                        ' . csrf_field() . '
                        <input type="hidden" name="app_id" value="' . $row->id . '">
                        <input type="hidden" name="status" value="' . $row->is_active . '">
                        <button type="submit" class="btn_status btn btn-success btn-sm"
                            style="background:' . ($row->is_active == '0' ? '#28a745' : '#ffad46') . '!important;border-color: ' . ($row->is_active == '0' ? '#28a745' : '#ffad46') . '!important;color: #fff!important;">
                            <i class="' . ($row->is_active == '0' ? 'fa-solid fa-circle' : 'fa-solid fa-ban') . '"></i>
                        </button>
                    </form>';
                })
                ->rawColumns(['status', 'action', 'active','created_at'])
                ->make(true);
        }

        $apps = AppList::orderBy('id','asc')->where('deleted_at','0')->get();
        $language = NestedCategory::where('deleted_at','0')->get();
        $app_active = AppList::where('is_active','1')->get();

        LogActivity::addToLog();
        return view('admin.applist.app_list', compact('language','apps','app_active'));
    }

    function Add_list()
    {
        if (!has_permission('app_menu', 'create')) {
            abort(403);
        }
        if (!has_module_access('app_menu')) {
            abort(403);
        }

        $language = NestedCategory::where('deleted_at','0')->get();
        return view('admin.applist.add_app', compact('language'));
    }

    public function store(Request $request)
    {
        if (!has_permission('app_menu', 'create')) {
            abort(403);
        }
        if (!has_module_access('app_menu')) {
            abort(403);
        }

        $request->validate([
            'app_name' => 'required|string|max:255',
            'package_name' => 'required',
            'language' => 'required',
        ]);

        $user = new AppList;
        $user->app_name = $request['app_name'];
        $user->package_name = $request['package_name'];
        $user->language_code = $request->language;
        $user->admin_id = Auth::guard('admin')->user()->id;
        $user->save();
        LogActivity::addToLog();
        return back()->with('message','App Created Successfully');
    }

    public function edit($id)
    {
        if (!has_permission('app_menu', 'update')) {
            abort(403);
        }

        if (!has_module_access('app_menu')) {
            abort(403);
        }

        LogActivity::addToLog();
        $edit = AppList::find($id);
        $category = NestedCategory::where('deleted_at','0')->get();
        $font = Prayer::where('language_code',$edit->language_code)->pluck('font_name')->toArray();
        $mapped_res = MappedAppCategory::select(['category_id'])->where('app_id',$id)->pluck('category_id')->toArray();
        return view('admin.applist.mapped_app_category', ['edit'=> $edit,'category_list'=>$category,'mapped_app'=>$mapped_res]);

    }

    public function active(Request $request)
    {
        if (!has_permission('app_menu', 'status')) {
            abort(403);
        }
        if (!has_module_access('app_menu')) {
            abort(403);
        }

        LogActivity::addToLog();

        $parent_id = $request->app_id;
        $status = $request->status;
        if($status == 0)
        {
            $app_active = AppList::find($parent_id);
            $app_active->is_active ='1';
            $app_active->save();
            return back()->with('message','App Disabled Successfully');
        }
        if($status == 1)
        {
            $app_active = AppList::find($parent_id);
            $app_active->is_active ='0';
            $app_active->save();
            return back()->with('message','App Enabled Successfully');
        }

    }

    public function delete(Request $request, $id)
    {
        if (!has_permission('app_menu', 'delete')) {
            abort(403);
        }
        if (!has_module_access('app_menu')) {
            abort(403);
        }

        $Q1 = AppList::find($id);
        $Q1->deleted_at = '1';
        $Q1->save();
        LogActivity::addToLog();
        return back()->with('message','Delete Record Successfully');
    }

    public function EditApp($id)
    {
        if (!has_permission('app_menu', 'update')) {
            abort(403);
        }
        if (!has_module_access('app_menu')) {
            abort(403);
        }

        $edit = AppList::find($id);
        $category_id = NestedCategory::where('deleted_at',0)->get();
        $array = array($edit);
        return view('admin.applist.edit_app_list', ['edit_app_id'=> $array, "category_id" => $category_id]);
    }

    public function EditAppList(Request $request, $id)
    {
        if (!has_permission('app_menu', 'update')) {
            abort(403);
        }
        if (!has_module_access('app_menu')) {
            abort(403);
        }

        $request->validate([
            'app_name' => 'required|string|max:255',
        ]);

        $user = AppList::find($id);
        $user->app_name = $request->input('app_name');
        LogActivity::addToLog();
        $user->save();
        return back()->with('message','App Edit Successfully');
    }
}
