<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Auth;
use App\Models\Quiz;
use App\Models\Module;
Use App\Models\Admin;
use App\Models\NestedCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Helpers\LogActivity;
use DataTables;
use Goutte\Client;


class QuizController extends Controller
{
    public function show(Request $request)
    {
        if (!has_permission('quiz_menu', 'read')) {
            abort(403);
        }
        if (!has_module_access('quiz_menu')) {
            abort(403);
        }

        if(Auth::guard('admin')->user()->role == "SuperAdmin"){
            $quizzes = Quiz::with(['category'])->where('quizzes.deleted_at',0);
        }else{
            $quizzes = Quiz::with(['category'])->where('quizzes.deleted_at',0)->where('quizzes.admin_id', Auth::guard('admin')->user()->id);
        }

        if($request->ajax())
        {
            return DataTables::of($quizzes)
                ->addColumn('checkbox', function ($items) {
                    // Checkbox is ENABLED only when quiz_type == 5
                    if ($items->quiz_type == 5) {
                        return '<input type="checkbox"
                                       class="row-checkbox"
                                       value="' . $items->id . '"
                                       title="Select this row">';
                    }
                 
                    // quiz_type ≠ 5 → render as disabled so the user can see it but not tick it
                    return '<input type="checkbox"
                                   class="row-checkbox"
                                   value="' . $items->id . '"
                                   disabled
                                   title="Only Quiz Type 5 rows can be selected">';
                })
                ->addColumn('question_name', function ($items) {
                    return "<div id=".$items->id.">".$items->question_name."</div>";
                })
                ->addColumn('quiz_answer_value', function ($items) {

                    if($items->option_format_type == 2)
                    {
                        if($items->quiz_answer_value != null)
                        {
                            $quiz_answer_value = '<center><img  src="'.url('storage/'.$items->quiz_answer_value).'" style="width: 55px !important;height: 55px !important; border-radius: 10px !important;box-shadow: 0px 0px 15px #405189 !important;border:2px !important;opacity: 85% !important;"></center>';
                        }
                    }
                    else
                    {
                        $quiz_answer_value = "<span class='text-success fw-bold'>".$items->quiz_answer_value ?? "-"."</span>";
                    }
                    return $quiz_answer_value ?? '';
                })
                ->addColumn('option_1', function ($items) {
                    if($items->option_format_type == 2)
                    {
                        if($items->option_1 != null)
                        {
                            $option_1 = '<center><img  src="'.url('storage/'.$items->option_1).'" style="width: 55px !important;height: 55px !important; border-radius: 10px !important;box-shadow: 0px 0px 15px #405189 !important;border:2px !important;opacity: 85% !important;"></center>';
                        }
                    }
                    else
                    {
                        $option_1 = "<span class='fw-bold'>".$items->option_1 ?? "-"."</span>";
                    }
                    return $option_1 ?? '';
                })
                ->addColumn('option_2', function ($items) {
                    if($items->option_format_type == 2)
                    {
                        if($items->option_2 != null)
                        {
                            $option_2 = '<center><img  src="'.url('storage/'.$items->option_2).'" style="width: 55px !important;height: 55px !important; border-radius: 10px !important;box-shadow: 0px 0px 15px #405189 !important;border:2px !important;opacity: 85% !important;"></center>';
                        }
                    }
                    else
                    {
                        $option_2 = "<span class='fw-bold'>".$items->option_2 ?? "-"."</span>";
                    }
                    return $option_2 ?? '';
                })
                ->addColumn('option_3', function ($items) {
                    if($items->option_format_type == 2)
                    {
                        if($items->option_3 != null)
                        {
                            $option_3 = '<center><img  src="'.url('storage/'.$items->option_3).'" style="width: 55px !important;height: 55px !important; border-radius: 10px !important;box-shadow: 0px 0px 15px #405189 !important;border:2px !important;opacity: 85% !important;"></center>';
                        }
                    }
                    else
                    {
                        $option_3 = "<span class='fw-bold'>".$items->option_3 ?? "-"."</span>";
                    }
                    return $option_3 ?? '';
                })
                ->addColumn('option_4', function ($items) {
                    if($items->option_format_type == 2)
                    {
                        if($items->option_4 != null)
                        {
                            $option_4 = '<center><img  src="'.url('storage/'.$items->option_4).'" style="width: 55px !important;height: 55px !important; border-radius: 10px !important;box-shadow: 0px 0px 15px #405189 !important;border:2px !important;opacity: 85% !important;"></center>';
                        }
                    }
                    else
                    {
                        $option_4 = "<span class='fw-bold'>".$items->option_4 ?? "-"."</span>";
                    }
                    return $option_4 ?? "";
                })
                ->addColumn('option_5', function ($items) {
                    if($items->option_format_type == 2)
                    {
                        if($items->option_5 != null)
                        {
                            $option_5 = '<center><img  src="'.url('storage/'.$items->option_5).'" style="width: 55px !important;height: 55px !important; border-radius: 10px !important;box-shadow: 0px 0px 15px #405189 !important;border:2px !important;opacity: 85% !important;"></center>';
                        }
                    }
                    else
                    {
                        $option_5 = "<span class='fw-bold'>".$items->option_5 ?? "-"."</span>";
                    }
                    return $option_5 ?? '';
                })
                ->addColumn('option_6', function ($items) {
                    if($items->option_format_type == 2)
                    {
                        if($items->option_6 != null)
                        {
                            $option_6 = '<center><img  src="'.url('storage/'.$items->option_6).'" style="width: 55px !important;height: 55px !important; border-radius: 10px !important;box-shadow: 0px 0px 15px #405189 !important;border:2px !important;opacity: 85% !important;"></center>';
                        }
                    }
                    else
                    {
                        $option_6 = "<span class='fw-bold'>".$items->option_6 ?? "-"."</span>";
                    }
                    return $option_6 ?? '';
                })
                ->addColumn('created_at', function ($items) {
                    $admin_id = Admin::find($items->admin_id);
                    $colorCode = '#FF5733';
                    return '<div class="quiz-info">
                                <span style="font-weight: 600; color: #333;">'. $items->created_at->addHours(5)->addMinutes(30)->format('D d, M Y -') . "<br>" . $items->created_at->addHours(5)->addMinutes(30)->format('h:i A') .'</span><br><hr>
                            </div>';
                })
                ->addColumn('status', function ($items) {
                    return $items->is_active == '0' ? '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Active</span>' : '<span class="badge bg-danger rounded-fill"><i class="bi bi-exclamation-octagon me-1"></i> Deactivate</span>';
                })
                ->addColumn('action', function ($items) {
                    $editUrl = url("admin/edit_quiz/".$items->id);
                    $deleteUrl = url("admin/delete_quiz/".$items->id);

                    return '<div class="btn-group">
                                <form action="'.$editUrl.'" method="POST">'.csrf_field().'
                                    <button  type="submit" class="btn btn-icon btn-circle btn-sm btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit App" style="background: #012970cf;border-color:#012970cf;color:#ffffff !important;"><i class="fa fa-edit"></i></button>
                                </form>
                                <form  id="form_submit_'.$items->id.'"   action="'.$deleteUrl.'" method="POST" style="padding-left:5px;">'.csrf_field().'
                                    <input id="disable_'.$items->id.'" type="hidden" name="ad_app_type"  class="form-control" />
                                    <button  type="button" class="btn btn-icon btn-circle btn-sm btn-outline-danger"  onclick="return validateform('.$items->id.')"  data-bs-toggle="tooltip" data-bs-placement="top" title="Delete App" style="background: #EE4B2B;border-color:#EE4B2B;color:#ffffff !important"><i class="fa fa-trash-can-arrow-up"></i></button>
                                </form>
                            </div>';
                })
                ->addColumn('status_update', function ($items) {
                    $statusUpdateUrl = url('admin/quiz_status_update');
                    $statusText = $items->is_active == '0' ? 'Enable' : 'Disable';
                    $statusValue = $items->is_active == '0' ? '0' : '1';
                    if($statusValue == 1)
                    {
                        return '<center><form action="'.$statusUpdateUrl.'" method="POST">'.
                                csrf_field().
                                '<input type="hidden" name="Quiz_id" value="'.$items->id.'">'.
                                ($items->is_active == '0' ? '<input type="hidden" name="status" value="0">' : '<input type="hidden" name="status" value="1">').
                                '<button type="submit" data-toggle="tooltip" data-original-title="'.$statusText.'" id="status_btn" name="status_btn" title="" class="btn_status btn btn-success btn-sm '.($items->is_active == '0' ? 'enable' : '').'" style="background: #ffad46!important;border-color: #ffad46!important;color: #fff!important;">
                                    <i class="fa fa-solid fa-ban"></i>
                                </button>
                            </form></center>';
                    }else{

                    return '<center><form action="'.$statusUpdateUrl.'" target="_top" method="POST">'.
                                csrf_field().
                                '<input type="hidden" name="Quiz_id" value="'.$items->id.'">'.
                                ($items->is_active == '0' ? '<input type="hidden" name="status" value="0">' : '<input type="hidden" name="status" value="1">').
                                '<button type="submit" data-toggle="tooltip" data-original-title="'.$statusText.'" id="status_btn" name="status_btn" title="" class="btn_status btn btn-success btn-sm '.($items->is_active == '0' ? 'enable' : '').'" >
                                    <i class="fa fa-solid fa-circle"></i>
                                </button>
                            </form></center>';
                    }
                })
                ->rawColumns(['checkbox','option_1','option_2','option_3','option_4','option_5','option_6','quiz_answer_value','question_name','created_at','app_link', 'status', 'action', 'status_update'])
                ->filterColumn('question_name', function($query, $keyword) {
                    $keyword = trim($keyword);
                    $query->where('question_name', 'like', "%{$keyword}%")
                            ->orWhere('option_1', 'like', "%{$keyword}%")
                            ->orWhere('option_2', 'like', "%{$keyword}%")
                            ->orWhere('option_3', 'like', "%{$keyword}%")
                            ->orWhere('option_4', 'like', "%{$keyword}%")
                            ->orWhere('option_5', 'like', "%{$keyword}%")
                            ->orWhere('option_6', 'like', "%{$keyword}%")
                            ->orWhere('quiz_answer_value', 'like', "%{$keyword}%")
                            ->orWhere('created_at', 'like', "%{$keyword}%");

                })
                ->make(true);
        }

        return view('admin.quiz.quiz_list');

    }
    
    public function directionValue(Request $request)
    {
        if (!has_permission('quiz_menu', 'update')) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to perform this action.',
            ], 403);
        }
    
        $request->validate([
            'quiz_ids'        => 'required|array|min:1',
            'quiz_ids.*'      => 'integer|exists:quizzes,id',
            'direction_value' => 'required|string',
        ]);
    
        $quizIds        = $request->input('quiz_ids');
        $directionValue = trim($request->input('direction_value'));
    
        // Base query — only quiz_type = 5, not deleted
        $baseQuery = Quiz::whereIn('id', $quizIds)
                         ->where('quiz_type', 5)
                         ->where('deleted_at', 0);
    
        if (Auth::guard('admin')->user()->role !== 'SuperAdmin') {
            $baseQuery->where('admin_id', Auth::guard('admin')->user()->id);
        }
    
        $selectedQuizzes = $baseQuery->get();
    
        if ($selectedQuizzes->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No eligible records were found. Make sure selected rows have Quiz Type = 5.',
            ]);
        }
    
        // Get the current max quiz_type_value (for new assignments only)
        $lastNumber = Quiz::where('quiz_type', 5)
                          ->where('deleted_at', 0)
                          ->whereNotNull('quiz_type_value')
                          ->where('quiz_type_value', '>', 0)
                          ->max('quiz_type_value') ?? 0;
    
        $updatedCount   = 0;
        $newValueCount  = 0;
        $existingCount  = 0;
    
        foreach ($selectedQuizzes as $quiz) {
    
            // ── Already has a quiz_type_value → only update description ──────
            if (!empty($quiz->quiz_type_value) && $quiz->quiz_type_value > 0) {
                $quiz->direction_description = $directionValue;
                $quiz->save();
                $existingCount++;
    
            // ── No quiz_type_value yet → assign next increment ───────────────
            } else {
                $lastNumber++;
                $quiz->quiz_type_value       = $lastNumber;
                $quiz->direction_description = $directionValue;
                $quiz->save();
                $newValueCount++;
            }
    
            $updatedCount++;
        }
    
        // Build a clear message so the admin knows what happened
        $messageParts = [];
        if ($newValueCount > 0) {
            $messageParts[] = $newValueCount . ' record(s) assigned a new quiz_type_value';
        }
        if ($existingCount > 0) {
            $messageParts[] = $existingCount . ' record(s) had direction description updated only (value kept)';
        }
    
        return response()->json([
            'success' => true,
            'message' => implode('; ', $messageParts) . '.',
            'updated' => $updatedCount,
        ]);
    }

    function add()
    {
        if (!has_permission('quiz_menu', 'create')) {
            abort(403);
        }
        if (!has_module_access('quiz_menu')) {
            abort(403);
        }
        LogActivity::addToLog();

        $category = NestedCategory::where('deleted_at','0')->get();
        return view('admin.quiz.add_quiz', ['category' => $category]);

    }

    public function active(Request $request)
    {
        if (!has_permission('quiz_menu', 'status')) {
            abort(403);
        }
        if (!has_module_access('quiz_menu')) {
            abort(403);
        }

        LogActivity::addToLog();

        $cat_id = $request->Quiz_id;
        $status = $request->status;
        if($status == 0)
        {
            $app_active = Quiz::find($cat_id);
            $app_active->is_active ='1';
            $app_active->save();
            return back()->with('message','Quiz Disabled Successfully');
        }
        if($status == 1)
        {
            $app_active = Quiz::find($cat_id);
            $app_active->is_active ='0';
            $app_active->save();
            return back()->with('message','Quiz Enabled Successfully');
        }
    }

    public function store(Request $request)
    {
        if (!has_permission('quiz_menu', 'create')) {
            abort(403);
        }
        if (!has_module_access('quiz_menu')) {
            abort(403);
        }

        $rules=[
            'category_id' => 'required',
            'option_count' => 'required',
            'quiz_answer' => 'required',
            'direction_based' => 'required',
        ];

        if($request->option_format_type == 0)
        {
            $rules['option_1'] = 'required_if:option_count,1,2,3,4,5,6';
            $rules['option_2'] = 'required_if:option_count,2,3,4,5,6';
            $rules['option_3'] = 'required_if:option_count,3,4,5,6';
            $rules['option_4'] = 'required_if:option_count,4,5,6';
            $rules['option_5'] = 'required_if:option_count,5,6';
            $rules['option_6'] = 'required_if:option_count,6';
        }

        if($request->option_format_type == 1)
        {
            $rules['option_1_html'] = 'required_if:option_count,1,2,3,4,5,6';
            $rules['option_2_html'] = 'required_if:option_count,2,3,4,5,6';
            $rules['option_3_html'] = 'required_if:option_count,3,4,5,6';
            $rules['option_4_html'] = 'required_if:option_count,4,5,6';
            $rules['option_5_html'] = 'required_if:option_count,5,6';
            $rules['option_6_html'] = 'required_if:option_count,6';
        }

        if($request->option_format_type == 2)
        {
            $rules['quiz_option1_file'] = 'required_if:option_count,1,2,3,4,5,6';
            $rules['quiz_option2_file'] = 'required_if:option_count,2,3,4,5,6';
            $rules['quiz_option3_file'] = 'required_if:option_count,3,4,5,6';
            $rules['quiz_option4_file'] = 'required_if:option_count,4,5,6';
            $rules['quiz_option5_file'] = 'required_if:option_count,5,6';
            $rules['quiz_option6_file'] = 'required_if:option_count,6';
        }

        if($request->option_format_type == 3)
        {
            $rules['jumpled_words'] = 'required';
            $rules['rearranging_words'] = 'required';
        }

        $request->validate($rules);
        $quiz = new Quiz;

        $quiz->category_id = $request->category_id;
        $quiz->question_format_type = $request->question_format_type;

        $quiz->option_format_type = $request->option_format_type;

        if($request->question_format_type == 1)
        {
            $rules['question_name'] = 'required';
            $quiz->question_name = $request->question_name;
        }

        if($request->question_format_type == 2)
        {
            $rules['question_name_html'] = 'required';
            $quiz->question_name = $request->question_name_html;
        }

        if($request->question_format_type == 3)
        {
            $rules['question_name'] = 'required';
            $rules['image_file'] = 'required';

            if($request->hasFile('image_file'))
            {
                $image = $request['image_file'];

                $uploaded_file_2 = $new_name_3 ?? '';
                $quiz->question_content = $request->file('image_file')->store('image_file', 'public');
                $quiz->question_name = $request->question_name_image;
            }
        }

        if($request->question_format_type == 4)
        {
            $rules['question_name'] = 'required';
            $rules['video_file'] = 'required';

            if($request->hasFile('video_file'))
            {
                $video = $request['video_file'];
                $quiz->question_content = $request->file('video_file')->store('video_file', 'public');
                $quiz->question_name = $request->question_name_video;
            }
        }

        if($request->option_format_type == 0){
            $quiz->option_1 = $request->option_1;
            $quiz->option_2 = $request->option_2;
            $quiz->option_3 = $request->option_3;
            $quiz->option_4 = $request->option_4;
            $quiz->option_5 = $request->option_5;
            $quiz->option_6 = $request->option_6;
        }

        if($request->option_format_type == 1){
            $quiz->option_1 = $request->option_1_html;
            $quiz->option_2 = $request->option_2_html;
            $quiz->option_3 = $request->option_3_html;
            $quiz->option_4 = $request->option_4_html;
            $quiz->option_5 = $request->option_5_html;
            $quiz->option_6 = $request->option_6_html;
        }

        if($request->option_format_type == 2){
            if ($request->hasFile('quiz_option1_file')) {
                $quiz->option_1 = $request->file('quiz_option1_file')->store('uploads', 'public');
            }
            if ($request->hasFile('quiz_option2_file')) {
                $quiz->option_2 = $request->file('quiz_option2_file')->store('uploads', 'public');
            }
            if ($request->hasFile('quiz_option3_file')) {
                $quiz->option_3 = $request->file('quiz_option3_file')->store('uploads', 'public');
            }
            if ($request->hasFile('quiz_option4_file')) {
                $quiz->option_4 = $request->file('quiz_option4_file')->store('uploads', 'public');
            }
            if ($request->hasFile('quiz_option5_file')) {
                $quiz->option_5 = $request->file('quiz_option5_file')->store('uploads', 'public');
            }
            if ($request->hasFile('quiz_option6_file')) {
                $quiz->option_6 = $request->file('quiz_option6_file')->store('uploads', 'public');
            }

        }

        if($request->option_format_type == 3){
            $quiz->jumpled_words = $request->jumpled_words ?? '' ;
            $quiz->rearranging_words = $request->rearranging_words ?? '' ;
        }

        $quiz->quiz_answer = $request->quiz_answer;
        if($request->quiz_answer == 1)
        {
            if(empty($quiz->quiz_answer_value = $request->option_1))
            {
                if(empty($quiz->quiz_answer_value = $request->option_1_html)){
                    $quiz->quiz_answer_value = $quiz->option_1;
                }
            }
        }
        if($request->quiz_answer == 2)
        {
            if(empty($quiz->quiz_answer_value = $request->option_2))
            {
                if(empty($quiz->quiz_answer_value = $request->option_2_html)){
                    $quiz->quiz_answer_value = $quiz->option_2;
                }
            }
        }

        if($request->quiz_answer == 3)
        {
            if(empty($quiz->quiz_answer_value = $request->option_3))
            {
                if(empty($quiz->quiz_answer_value = $request->option_3_html)){
                    $quiz->quiz_answer_value = $quiz->option_3;
                }
            }
        }

        if($request->quiz_answer == 4)
        {
            if(empty($quiz->quiz_answer_value = $request->option_4))
            {
                if(empty($quiz->quiz_answer_value = $request->option_4_html)){
                    $quiz->quiz_answer_value = $quiz->option_4;
                }
            }
        }

        if($request->quiz_answer == 5)
        {
            if(empty($quiz->quiz_answer_value = $request->option_5))
            {
                if(empty($quiz->quiz_answer_value = $request->option_5_html)){
                    $quiz->quiz_answer_value = $quiz->option_5;
                }
            }
        }

        if($request->quiz_answer == 6)
        {
            if(empty($quiz->quiz_answer_value = $request->option_6))
            {
                if(empty($quiz->quiz_answer_value = $request->option_6_html)){
                    $quiz->quiz_answer_value = $quiz->option_6;
                }
            }
        }
        $quiz->quiz_hint = $request->quiz_hint;
        $quiz->quiz_exp = $request->quiz_exp;
        $quiz->option_count = $request->option_count;
        $quiz->quiz_type = $request->direction_based;
        $quiz->admin_id = Auth::guard('admin')->user()->id;

        if($request->file_type == 1)
        {
            $quiz->image_type = $request->file_type;
            if($request->hasFile('file'))
            {
                $quiz->quiz_image = $request->file('file')->store('quiz_image', 'public');
            }
        }
        else if($request->file_type == 2)
        {
            $quiz->quiz_image = $request->url_image;
            $quiz->image_type = $request->file_type;
        }

        $quiz->save();

        return back()->with('message','Quiz Added Successfully');

    }

    public function delete(Request $request, $id)
    {
        if (!has_permission('quiz_menu', 'delete')) {
            abort(403);
        }
        if (!has_module_access('quiz_menu')) {
            abort(403);
        }

        LogActivity::addToLog();

        $Q1 = Quiz::find($id);
        $Q1->deleted_at = '1';
        $Q1->save();
        return back()->with('message','Delete Record Successfully');

    }
    public function EditQuestion($id)
    {
        if (!has_permission('quiz_menu', 'update')) {
            abort(403);
        }
        if (!has_module_access('quiz_menu')) {
            abort(403);
        }

        $edit = Quiz::find($id);
        $category = NestedCategory::where('deleted_at','0')->get();
        return view('admin.quiz.edit_quiz_list', ['edit'=> $edit],['category_id' => $category]);

    }

    public function EditQuestionList(Request $request, $id)
    {
        if (!has_permission('quiz_menu', 'update')) {
            abort(403);
        }
        if (!has_module_access('quiz_menu')) {
            abort(403);
        }

        $rules=[
            'category_id' => 'required',
            'option_count' => 'required',
            'quiz_answer' => 'required',
            'direction_based' => 'required',
        ];

        if($request->option_format_type == 0)
        {
            $rules['option_1'] = 'required_if:option_count,1,2,3,4,5,6';
            $rules['option_2'] = 'required_if:option_count,2,3,4,5,6';
            $rules['option_3'] = 'required_if:option_count,3,4,5,6';
            $rules['option_4'] = 'required_if:option_count,4,5,6';
            $rules['option_5'] = 'required_if:option_count,5,6';
            $rules['option_6'] = 'required_if:option_count,6';
        }

        if($request->option_format_type == 1)
        {
            $rules['option_1_html'] = 'required_if:option_count,1,2,3,4,5,6';
            $rules['option_2_html'] = 'required_if:option_count,2,3,4,5,6';
            $rules['option_3_html'] = 'required_if:option_count,3,4,5,6';
            $rules['option_4_html'] = 'required_if:option_count,4,5,6';
            $rules['option_5_html'] = 'required_if:option_count,5,6';
            $rules['option_6_html'] = 'required_if:option_count,6';
        }

        if($request->option_format_type == 3)
        {
            $rules['jumpled_words'] = 'required';
            $rules['rearranging_words'] = 'required';
        }

        $request->validate($rules);
        $quiz = Quiz::find($id);

        $quiz->category_id = $request->category_id;
        $quiz->question_format_type = $request->question_format_type;

        $quiz->option_format_type = $request->option_format_type;

        if($request->question_format_type == 1)
        {
            $rules['question_name'] = 'required';
            $quiz->question_name = $request->question_name;
        }

        if($request->question_format_type == 2)
        {
            $rules['question_name_html'] = 'required';
            $quiz->question_name = $request->question_name_html;
        }

        if($request->question_format_type == 3)
        {
            $rules['question_name'] = 'required';
            $rules['image_file'] = 'required';
            if($request->hasFile('image_file'))
            {
                $quiz->question_content = $request->file('image_file')->store('image_file', 'public');
                $quiz->question_name = $request->question_name_image;
            }
        }

        if($request->question_format_type == 4)
        {
            $rules['question_name'] = 'required';
            $rules['video_file'] = 'required';

            if($request->hasFile('video_file'))
            {
                $quiz->question_content = $request->file('video_file')->store('video_file', 'public');
                $quiz->question_name = $request->question_name_video;
            }
        }


        if($request->option_format_type == 0){
            $quiz->option_1 = $request->option_1;
            $quiz->option_2 = $request->option_2;
            $quiz->option_3 = $request->option_3;
            $quiz->option_4 = $request->option_4;
            $quiz->option_5 = $request->option_5;
            $quiz->option_6 = $request->option_6;
        }

        if($request->option_format_type == 1){
            $quiz->option_1 = $request->option_1_html;
            $quiz->option_2 = $request->option_2_html;
            $quiz->option_3 = $request->option_3_html;
            $quiz->option_4 = $request->option_4_html;
            $quiz->option_5 = $request->option_5_html;
            $quiz->option_6 = $request->option_6_html;
        }

        if($request->option_format_type == 2){
            if ($request->hasFile('quiz_option1_file')) {
                $quiz->option_1 = $request->file('quiz_option1_file')->store('uploads', 'public');
            }
            if ($request->hasFile('quiz_option2_file')) {
                $quiz->option_2 = $request->file('quiz_option2_file')->store('uploads', 'public');
            }
            if ($request->hasFile('quiz_option3_file')) {
                $quiz->option_3 = $request->file('quiz_option3_file')->store('uploads', 'public');
            }
            if ($request->hasFile('quiz_option4_file')) {
                $quiz->option_4 = $request->file('quiz_option4_file')->store('uploads', 'public');
            }
            if ($request->hasFile('quiz_option5_file')) {
                $quiz->option_5 = $request->file('quiz_option5_file')->store('uploads', 'public');
            }
            if ($request->hasFile('quiz_option6_file')) {
                $quiz->option_6 = $request->file('quiz_option6_file')->store('uploads', 'public');
            }

        }

        if($request->option_format_type == 3){
            $quiz->jumpled_words = $request->jumpled_words ?? '' ;
            $quiz->rearranging_words = $request->rearranging_words ?? '' ;
        }

        $quiz->quiz_answer = $request->quiz_answer;
        if($request->quiz_answer == 1)
        {
            if(empty($quiz->quiz_answer_value = $request->option_1))
            {
                if(empty($quiz->quiz_answer_value = $request->option_1_html)){
                    $quiz->quiz_answer_value = $quiz->option_1;
                }
            }
        }
        if($request->quiz_answer == 2)
        {
            if(empty($quiz->quiz_answer_value = $request->option_2))
            {
                if(empty($quiz->quiz_answer_value = $request->option_2_html)){
                    $quiz->quiz_answer_value = $quiz->option_2;
                }
            }
        }

        if($request->quiz_answer == 3)
        {
            if(empty($quiz->quiz_answer_value = $request->option_3))
            {
                if(empty($quiz->quiz_answer_value = $request->option_3_html)){
                    $quiz->quiz_answer_value = $quiz->option_3;
                }
            }
        }

        if($request->quiz_answer == 4)
        {
            if(empty($quiz->quiz_answer_value = $request->option_4))
            {
                if(empty($quiz->quiz_answer_value = $request->option_4_html)){
                    $quiz->quiz_answer_value = $quiz->option_4;
                }
            }
        }

        if($request->quiz_answer == 5)
        {
            if(empty($quiz->quiz_answer_value = $request->option_5))
            {
                if(empty($quiz->quiz_answer_value = $request->option_5_html)){
                    $quiz->quiz_answer_value = $quiz->option_5;
                }
            }
        }

        if($request->quiz_answer == 6)
        {
            if(empty($quiz->quiz_answer_value = $request->option_6))
            {
                if(empty($quiz->quiz_answer_value = $request->option_6_html)){
                    $quiz->quiz_answer_value = $quiz->option_6;
                }
            }
        }
        
        $quiz->quiz_hint = $request->quiz_hint;
        $quiz->quiz_exp = $request->quiz_exp;
        $quiz->option_count = $request->option_count;
        $quiz->quiz_type = $request->direction_based;

        if($request->file_type == 1)
        {
            $quiz->image_type = $request->file_type;
            if($request->hasFile('file'))
            {
                $quiz->quiz_image = $request->file('file')->store('quiz_image', 'public');
            }
        }
        else if($request->file_type == 2)
        {
            $quiz->quiz_image = $request->url_image;
            $quiz->image_type = $request->file_type;
        }

        $quiz->save();

        return redirect()->to(url('admin/quiz_list') . '#' . $quiz->id)
                 ->with('message', 'Quiz Edited successfully!');

    }
}
