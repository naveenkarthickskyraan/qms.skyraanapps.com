<?php

namespace App\Http\Controllers;
// namespace App\Http\Controllers\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Validator, Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Models\admin;
use App\Models\Module;
use App\Models\AppList;
use App\Models\Category;
use App\Models\AdManager;
use App\Models\NestedCategory;
use App\Models\Batch;
use App\Helpers\LogActivity;
use App\Models\Quiz;
use DB;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class AdminController extends Controller
{
    public function authenticate(Request $request)
    {
        $captchaRules = [
            'captcha1' => 'required',
            'captcha2' => 'required',
            'captcha3' => 'required',
            'captcha4' => 'required',
            'password2'=> 'required',
            // 'captcha5' => 'required',
            // 'captcha6' => 'required',
        ];

        // Validate individual captcha inputs
        $validator = Validator::make($request->all(), $captchaRules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Combine individual captcha inputs into a single value
        $combinedCaptcha = $request->input('captcha1') .
                           $request->input('captcha2') .
                           $request->input('captcha3') .
                           $request->input('captcha4') .
                           $request->input('captcha5') .
                           $request->input('captcha6');

        // Validate the combined captcha value
        $validator = Validator::make([
            'captcha' => $combinedCaptcha,
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ], [
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required|captcha',
        ], [
            'captcha.captcha' => 'Invalid captcha code.',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = admin::where('email', $request->email)->first();
        $key = "CpLl4D63MOFI";
        $check_key = Hash::make($key);
        if ($user && $user->is_active == 0 && $user->deleted_at == 0) {
            if (Hash::check($request->password, $user->password) && Hash::check($request->password2, $check_key)) {
                // Both passwords match, so the user can be authenticated
                if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                    // Successful login
                    LogActivity::addToLog();
                    return redirect()->route('admin/dashboard')->with('message',"Welcome - ".$request->email);
                } else {
                    // Authentication failed
                    // session()->flash('error', );
                    $Array = ['Authentication failed. Password does not match. Please ensure that the entered passwords match each other.'];
                    return redirect()->back()->withErrors($Array)->withInput($request->only('email'));
                    // return back()->withInput();
                }
            } else {
                // Passwords do not match
                // session()->flash('error', 'Authentication failed. Passwords or Key do not match.');
                // return back()->withInput($request->only('email'));

                $Array = ['Sorry, the entered passwords do not match. Please double-check and try again.'];
                return redirect()->back()->withErrors($Array)->withInput($request->only('email'));
            }
        } elseif ($user) {
            // User is not active or is deleted
            $Array = ["You can't access this site right now!"];
            return redirect()->back()->withErrors($Array)->withInput($request->only('email'));
        } else {
            // User not found
            // session()->flash('error', 'Either Email/Password is incorrect - Please Try Again');
            // return back()->withInput($request->only('email'));
            $Array = ['Either the email or password is incorrect. Please try again.'];
            return redirect()->back()->withErrors($Array)->withInput($request->only('email'));
        }
    }

    public function logout() {
        LogActivity::addToLog();
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('message',"Logout Successfully");
    }

    public function login_check()
    {
        Session::forget('employee_id');
        if(Auth::guard('admin')->check() == true) {
            return Redirect::to('admin/dashboard');
        } else {
            return Redirect::to('admin/login');
        }
    }

    public function dashboard()
    {
        // Get counts for the stats cards
        $totalQuizzes = Quiz::where('deleted_at', '0')->count();
        $totalCategories = NestedCategory::where('deleted_at', '0')->count();
        $totalApplications = AppList::where('deleted_at', '0')->count();
        $activeUsers = admin::where('deleted_at', '0')->count(); // Assuming you have a User model

        // Get data for the chart (your existing code)
        $getDateCounts = function ($model) {
            return $model::select(DB::raw("DATE(created_at) as date"), DB::raw("COUNT(*) as total"))
                ->where('deleted_at', '0')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->pluck('total', 'date');
        };

        $appData = $getDateCounts(AppList::class);
        $categoryData = $getDateCounts(NestedCategory::class);
        $quizData = $getDateCounts(Quiz::class);
        $batchData = $getDateCounts(Batch::class);

        // Merge all dates
        $allDates = collect($appData->keys())
            ->merge($categoryData->keys())
            ->merge($quizData->keys())
            ->merge($batchData->keys())
            ->unique()
            ->sort()
            ->values();

        // Helper to fill missing dates with 0
        $fillMissingDates = function ($data, $allDates) {
            return $allDates->map(function ($date) use ($data) {
                return $data[$date] ?? 0;
            });
        };

        $appData = $fillMissingDates($appData, $allDates);
        $categoryData = $fillMissingDates($categoryData, $allDates);
        $quizData = $fillMissingDates($quizData, $allDates);
        $batchData = $fillMissingDates($batchData, $allDates);
        $dates = $allDates;

        // Get recent activity for the activity feed
        $recentActivities = LogActivity::logActivityLists(); // Assuming you have an ActivityLog model

        // LogActivity::addToLog();

        return view('admin.dashboard', compact(
            'totalQuizzes',
            'totalCategories',
            'totalApplications',
            'activeUsers',
            'appData',
            'categoryData',
            'quizData',
            'batchData',
            'dates',
            'recentActivities'
        ));
    }

    public function profile_update(Request $request)
    {
        LogActivity::addToLog();
        $role = Auth::guard('admin')->user()->role;
        $AccessPrivilege = Auth::guard('admin')->user()->accountAccessPrivilege;
        $AccessModule = Auth::guard('admin')->user()->accountAccessModule;
        $explode = explode('|',$AccessModule);
        $explode_1 = explode('|',$AccessPrivilege);
        $module = Module::Select(['module_name'])->whereIn('module_name',$explode)->get();
        $permission=[];
        foreach($module as $row)
        {
            $permission[] = $row->module_name;
        }
        $permis = $permission;
        $array = in_array('admin_info', $permis);
        $array_1= in_array('view',$explode_1);
        if(($role == "SuperAdmin") || ($array == true &&  $array_1 == true))
        {
            if (in_array('profile-settings', $_GET)) {
                if (array_key_exists('key', $_GET) && ($_GET['key'] == "profile-settings" && in_array('setting_menu', $permis)) || ($role == "SuperAdmin")) {
                    return view('admin.accounts.profile_update');
                } else {
                    return redirect()->route('admin/dashboard')->with("error", "Access Denied");
                }
            } else {
                return view('admin.accounts.profile_update');
            }

        }
        else
        {
            return redirect()->route('admin/dashboard')->with("error","Access Denied");
        }
    }

    public function profileUpdate(Request $request)
    {
        LogActivity::addToLog();
        $request->validate([
            'name' =>'required|min:8|string|max:25',
            'email'=>'required|email|string|max:255',
        ]);
        $user = Auth::guard('admin')->user();
        $user->name = $request['name'];
        $user->email = $request['email'];
        if($request->password != null)
        {
            if (!Hash::check($request->currentPassword, Auth::guard('admin')->user()->password)) {
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }
            $request->validate(
            [
                'currentPassword' => 'required',
                'password' => 'required|min:8|confirmed',
            ]);
            $user->password = Hash::make($request['password']);
        }
        if($request->hasFile('file'))
        {
            $image = $request['file'];
            $image_name = $image->getClientOriginalName();
            $extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $encrpt = round(microtime(true)*1000);
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $charactersLength; $i++)
            {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $new_name = ($encrpt).'_'.$randomString.'.'.$extension;
            $image->move(public_path('user'),$new_name);
            $new_name_2= 'user/'.$new_name;
            $uploaded_file = $new_name_2 ?? '';
            $user->image = $uploaded_file;
        }
        $user->save();
        return back()->with('message','Profile Updated Successfully');


    }

    public function superadmin()
    {
        if (!has_permission('admin_menu', 'read')) {
            abort(403);
        }

        if(!has_module_access('admin_menu')) {
            abort(403);
        }

        $role = Auth::guard('admin')->user()->role;
        if($role == "SuperAdmin")
        {
            $superadmin = admin::orderBy('role','asc')->whereNot('Role','SuperAdmin')->where('deleted_at','0')->get();
        }else{
            $superadmin = admin::orderBy('role','asc')->whereNot('id',Auth::guard('admin')->user()->id)->whereNot('Role','SuperAdmin')->where('deleted_at','0')->get();
        }

        return view('admin.accounts.admin_accounts',compact('superadmin','role'));


    }

    function add()
    {
        if (!has_permission('admin_menu', 'create')) {
            abort(403);
        }
        if(!has_module_access('admin_menu')) {
            abort(403);
        }

        $AccessPrivilege = Auth::guard('admin')->user()->accountAccessPrivilege;
        $AccessModule = Auth::guard('admin')->user()->accountAccessModule;
        $modules = Module::all();
        $moduleIcons = [
            'app_menu' => 'mobile-alt',
            'category_menu' => 'folder-tree',
            'batch_menu' => 'layer-group',
            'quiz_menu' => 'coins',
            'admin_menu' => 'users',
        ];

        $existingModules = explode('|', $AccessModule);
        $existingPermissions = [];

        foreach ($existingModules as $module) {
            $existingPermissions[$module] = explode('|', $AccessPrivilege);
        }

        return view('admin.accounts.add_admmin',compact(
            'modules',
            'moduleIcons',
            'existingModules',
            'existingPermissions'));

    }

    function insert(Request $request)
    {
        if (!has_permission('admin_menu', 'create')) {
            abort(403);
        }
        if(!has_module_access('admin_menu')) {
            abort(403);
        }

        $request->validate([
            'name' =>'required|min:8|string|max:25',
            'email'=>'required|email|string|max:255',
            "password" => 'required|confirmed|min:8',
            'permissions'=>'required',
        ],
        [
            'password.same'=>'password are not the same password must match same value',
            'password.min'=>'confirm-password length must be greater than 8 characters',
        ]);
        $user = new admin;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->image = $request['file'];
        $user->password = Hash::make($request['password']);

        $user->role = $request->parent;
        if($request->file_type == 1)
        {
            $user->image_type = $request->file_type;
            if($request->hasFile('file'))
            {
                $image = $request['file'];
                $image_name = $image->getClientOriginalName();
                $extension = pathinfo($image_name, PATHINFO_EXTENSION);
                $encrpt = round(microtime(true)*1000);
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $charactersLength; $i++)
                {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                $new_name = ($encrpt).'_'.$randomString.'.'.$extension;
                $image->move(public_path('user'),$new_name);
                $new_name_2= 'user/'.$new_name;
                $uploaded_file = $new_name_2 ?? '';
                $user->image = $uploaded_file;
            }
        }
        else if($request->file_type == 2)
        {
            $user->image = $request->url_image;
            $user->image_type = $request->file_type;
        }
        LogActivity::addToLog();


        // Store selected modules
        $modules = $keyNames = array_keys($request->input('permissions', [])); // array

        // Store selected permissions
        $permissions = $request->input('permissions', []); // array

        // Save modules as pipe-separated string
        $modulesString = implode('|', $modules);

        // Save permissions as JSON string (better structure)
        $permissionsJson = json_encode($permissions);

        $user->accountAccessModule = $modulesString;
        $user->accountAccessPrivilege = $permissionsJson;
        $user->save();

        return back()->with('message','Admin Create Successfully');
    }

    public function edit($id)
    {
        if (!has_permission('admin_menu', 'update')) {
            abort(403);
        }
        if(!has_module_access('admin_menu')) {
            abort(403);
        }

        $edit = admin::findOrFail($id);
        $list = array($edit);

        $AccessPrivilege = $edit->accountAccessPrivilege;
        $AccessModule = $edit->accountAccessModule;

        $modules = Module::all();
        $moduleIcons = [
            'app_menu' => 'mobile-alt',
            'category_menu' => 'folder-tree',
            'batch_menu' => 'layer-group',
            'quiz_menu' => 'coins',
            'admin_menu' => 'users',
        ];

        $existingModules = explode('|', $AccessModule);
        $existingPermissions = json_decode($AccessPrivilege, true);

        return view('admin.accounts.edit_admin', compact(
            'modules',
            'moduleIcons',
            'existingModules',
            'existingPermissions',
            'list'
        ));

    }

    public function editlist(Request $request,$id)
    {
        if (!has_permission('admin_menu', 'update')) {
            abort(403);
        }
        if(!has_module_access('admin_menu')) {
            abort(403);
        }

        $request->validate([
            'name' =>'required|min:8|string|max:25',
            'email'=>'required|email|string|max:255',
            'permissions'=>'required',
        ]);

        $user = admin::find($id);
        $user->role = $request->parent;
        $user->name = $request['name'];
        $user->email = $request['email'];

        if($request->password != null)
        {
            $request->validate([ "password" => 'required|confirmed|min:8'
            ],[
                'password.same'=>'password are not the same password must match same value',
                'password.min'=>'confirm-password length must be greater than 8 characters',
            ]);
            $user->password = Hash::make($request['password']);
        }

        $user->role = $request->parent;
        if($request->file_type == 1)
        {
            $user->image_type = $request->file_type;
            if($request->hasFile('file'))
            {
                $image = $request['file'];
                $image_name = $image->getClientOriginalName();
                $extension = pathinfo($image_name, PATHINFO_EXTENSION);
                $encrpt = round(microtime(true)*1000);
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $charactersLength; $i++)
                {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                $new_name = ($encrpt).'_'.$randomString.'.'.$extension;
                $image->move(public_path('user'),$new_name);
                $new_name_2= 'user/'.$new_name;
                $uploaded_file = $new_name_2 ?? '';
                $user->image = $uploaded_file;
            }
        }
        else if($request->file_type == 2)
        {
            $user->image = $request->url_image;
            $user->image_type = $request->file_type;
        }

        // Store selected modules
        $modules = $keyNames = array_keys($request->input('permissions', [])); // array

        // Store selected permissions
        $permissions = $request->input('permissions', []); // array

        // Save modules as pipe-separated string
        $modulesString = implode('|', $modules);

        // Save permissions as JSON string (better structure)
        $permissionsJson = json_encode($permissions);

        $user->accountAccessModule = $modulesString;
        $user->accountAccessPrivilege = $permissionsJson;

        LogActivity::addToLog();
        $user->save();
        return back()->with('message','Admin Updated Successfully');
    }

    public function active(Request $request)
    {
        if (!has_permission('admin_menu', 'status')) {
            abort(403);
        }
        if(!has_module_access('admin_menu')) {
            abort(403);
        }

        $parent_id = $request->user_id;
        $status = $request->status;
        LogActivity::addToLog();
        if($status == 0)
        {
            $app_active = admin::find($parent_id);
            $app_active->is_active ='1';
            $app_active->save();
            return back()->with('message','Admin Disabled Successfully');
        }
        if($status == 1)
        {
            $app_active = admin::find($parent_id);
            $app_active->is_active ='0';
            $app_active->save();
            return back()->with('message','Admin Enabled Successfully');
        }

    }

    public function delete(Request $request, $id)
    {
        if (!has_permission('admin_menu', 'delete')) {
            abort(403);
        }
        if(!has_module_access('admin_info')) {
            abort(403);
        }

        $Q1 = admin::find($id);
        $Q1->deleted_at = '1';
        LogActivity::addToLog();
        $Q1->save();
        return back()->with('message','Delete Record Successfully');

    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img('flat', ['characters' => '0123456789','class' => 'img-responsive'],'numeric', 6)]);
    }


    public function upload(Request $request)
    {
        
        if($request->hasFile('upload')) 
        {
            $image = $request->file('upload');
            $image_name = $image->getClientOriginalName();
            $extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $encrpt = round(microtime(true)*1000);
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $charactersLength; $i++) 
            {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $new_name = ($encrpt).'_'.$randomString.'.'.$extension;
            $image->move(public_path('upload'),$new_name);
            $new_name_2 = 'upload/'.$new_name;


            $url = asset($new_name_2);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $msg = 'Image successfully uploaded'; 
            LogActivity::addToLog();
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
}
