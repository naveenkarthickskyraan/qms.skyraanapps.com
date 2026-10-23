<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppList;
use App\Models\NestedCategory;
use App\Models\Batch;
use App\Models\Quiz;

use App\Shop;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function check(Request $request)
    {
        $key = $request->_key;
        if($key == 'ijklmn')
        {
            $value = 'poyVeWVAWoGXuKZxeCgQYlaYdOvUxCoQKczaj36T';
            return view('admin.api.api_route_list')->with('key', $value);
        }
        abort(404);
    }

    public function App()
    {
        $resArr=[];
        $responseArr = array('result' => '0' ,'message'=>'failed','data'=> []);

        $app = AppList::where('deleted_at','0')->get();

        if(!empty($app) && count($app) )
        {
            foreach($app as $row)
            {
                $temp['app_id'] = (string) $row->id ?? '';
                $temp['app_name'] = $row->app_name ?? '';
                array_push($resArr, $temp);
            }

            if(!empty($resArr)){
                $responseArr = array('result'=>'1', 'data'=> $resArr, 'message'=>'Success');
            }else{
                $responseArr = array('result'=>'0', 'data'=> $resArr, 'message'=>'No Data Found');
            }
        }
        else
        {
            $responseArr = array('result' => '0' ,'data'=> [] ,'message'=>'No Data Found',);
        }
        return response()->json($responseArr);
    }


    public function get_categories_using_app_id_and_category_id(Request $request){

        try {
            $app_id = $request->app_id;
            $category_id = $request->category_id;
            $batch_id = $request->batch_id;

            // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'app_id' =>'required|string',
                'category_id' =>'required_unless:batch_id,0',
                'batch_id' =>'required|string',
            ]);


            if ($validator->fails()) {
                // Return the first error message for each field
                return response()->json([
                    'result' => '0',
                    'data' => [],
                    'message' => $validator->errors()->first(),
                ], 422);
            }


            // Retrieve the BibleVerseApp based on the app_id
            $AppList = AppList::where('id', $app_id)
                                ->where('deleted_at',0)
                                ->latest()
                                ->first();

            // Check if the BibleVerseApp exists
            if (!$AppList) {
                return response()->json([
                    'result' => '0',
                    'data' => [],
                    'message' => 'App not found',
                ], 404);
            }

            // Retrieve commands for the given Command table
            $Batch = Batch::where('app_id', $AppList->id)->get();

            if(count($Batch) == 0){
                return response()->json(['result' => '0', 'data' => [], 'message' => 'No Categories Found']);
            }

            $resArr = [];

            if($request->batch_id == 0){
                foreach($Batch as $row){
                    $temp = [];
                    $starting_point_id = $row->starting_point_id;

                    $batchesIds = json_decode($row->selected_ids);

                    $NestedCategory = NestedCategory::where('id', $starting_point_id)->first();
                    if($NestedCategory != null){
                        $temp['batch_id'] = (string) ($row->id ?? "");
                        $temp['category_id'] = (string) ($NestedCategory->id ?? "");
                        $temp['category_name'] = (string) ($NestedCategory->name ?? "");
                        $temp['category_description'] = (string) ($NestedCategory->description ?? "");
                        $temp['category_image'] = (string) ($NestedCategory->image ? asset('storage/'.$NestedCategory->image) : "");
                        $temp['read_more'] = (int) count($batchesIds);


                        $CategoryStatus = NestedCategory::orderBy('created_at')
                                            ->where('parent_id',$NestedCategory->id)
                                            ->where('deleted_at', 0)
                                            ->get();
                        if($CategoryStatus->isNotEmpty()){
                            $CategoryIds = $CategoryStatus->pluck('id')->toArray();
                            //in the array of $batchesIds array list to check CategoryIds in the list of $batchesIds
                            $CategoryIds = array_intersect($batchesIds, $CategoryIds);
                            $temp['ViewMoreCategoryStatus'] = count($CategoryIds) > 0 ? 1 : 0;
                        }else{
                            $temp['ViewMoreCategoryStatus'] = 0;
                        }

                        $temp['is_direction_based_category'] = $NestedCategory->is_direction_based_category ?? 0;

                        $resArr[] = $temp;
                    }
                }

                return response()->json(['result' => '1', 'data' => $resArr, 'message' => 'Success']);
            }

            if($request->batch_id != 0){
                $resArr = [];
                $Batch = Batch::where('app_id', $AppList->id)
                            ->where('id', $request->batch_id)
                            ->first();

                if($Batch == null){
                    return response()->json(['result' => '0', 'data' => [], 'message' => 'No Categories Found']);
                }

                $starting_point_id = $category_id;

                $batchesIds = json_decode($Batch->selected_ids);


                $NestedCategory = NestedCategory::where('parent_id', $starting_point_id)->whereIn('id',$batchesIds)->get();
                if($NestedCategory->isNotEmpty()){
                    foreach($NestedCategory as $NestedCategory){
                        $temp = [];

                        $temp['batch_id'] = (string) ($Batch->id ?? "");
                        $temp['category_id'] = (string) ($NestedCategory->id ?? "");
                        $temp['category_name'] = (string) ($NestedCategory->name ?? "");
                        $temp['category_description'] = (string) ($NestedCategory->description ?? "");
                        $temp['category_image'] = (string) ($NestedCategory->image ? asset('storage/'.$NestedCategory->image) : "");
                        $temp['read_more'] = (int) count($batchesIds);

                        $CategoryStatus = NestedCategory::orderBy('created_at')
                                            ->where('parent_id',$NestedCategory->id)
                                            ->where('deleted_at', 0)
                                            ->get();
                                            
                        $temp['is_direction_based_category'] = $NestedCategory->is_direction_based_category ?? 0;

                        if($CategoryStatus->isNotEmpty()){
                            $CategoryIds = $CategoryStatus->pluck('id')->toArray();
                            //in the array of $batchesIds array list to check CategoryIds in the list of $batchesIds
                            $CategoryIds = array_intersect($batchesIds, $CategoryIds);
                            $temp['ViewMoreCategoryStatus'] = count($CategoryIds) > 0 ? 1 : 0;

                            $resArr[] = $temp;
                        }else{
                            if(in_array($NestedCategory->id, $batchesIds)){
                                $temp['ViewMoreCategoryStatus'] = 0;
                                $resArr[] = $temp;
                            }else{
                                $temp['ViewMoreCategoryStatus'] = 0;
                            }
                        }
                    }

                }
                // Return the response with the result
                if(count($resArr) == 0){
                    return response()->json(['result' => '0', 'data' => [], 'message' => 'No Categories Found']);
                }
                return response()->json(['result' => '1', 'data' => $resArr, 'message' => 'Success']);
            }
        } catch (\Exception $e) {
            // Log the error for investigation
            \Log::error('Error in getCommandList: '. $e->getMessage());

            // Return error response
            return response()->json(['result' => '0', 'data' => [], 'total' => "", 'currentPage' => "", 'perPage' => "", 'lastPage' => "",'message' => $e->getMessage()]);
        }
    }

    public function get_questions_using_category_id(Request $request){
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|string',
        ]);
        if ($validator->fails()) {
            // Return the first error message for each field
            return response()->json([
                'result' => '0',
                'data' => [],
                'total' => "",
                'currentPage' => "",
                'perPage' => "",
                'lastPage' => "",
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $category_id = $request->category_id;
        $resArr = [];
        $responseArr = array('result' => '0' ,'message'=>'failed','data'=> []);
        $Quiz = Quiz::where('category_id',$category_id)
                    ->where('deleted_at',0);
        if($request->page == ""){
            $Quiz = $Quiz->get();
        }else{
            $Quiz = $Quiz->paginate(150);
        }

        if(!empty($Quiz) && count($Quiz) ){
            foreach($Quiz as $row)
            {
                $temp = [];
                $temp['quiz_id'] = (string) $row->id ?? '';
                if($row->question_format_type == 1)
                {
                    $temp['question_name'] = $row->question_name ?? '';
                    $temp['quiz_name'] = $row->question_name ?? '';
                    $temp['quiz_content'] = $row->quiz_content ?? '';
                }
                if($row->question_format_type == 2)
                {
                    $temp['question_name'] = $row->question_name ?? '';
                    $temp['quiz_name'] = $row->question_name ?? '';
                    $temp['quiz_content'] = $row->quiz_content ?? '';
                }
                if($row->question_format_type == 3)
                {
                    $temp['question_name'] = $row->question_name ?? '';
                    $temp['quiz_name'] = $row->question_name ?? '';
                    $temp['quiz_content'] = asset('storage/'.$row->question_content) ?? '';
                }
                if($row->question_format_type == 4)
                {
                    $temp['question_name'] = $row->question_name ?? '';
                    $temp['quiz_name'] = $row->question_name ?? '';
                    $temp['quiz_content'] = asset('storage/'.$row->question_content) ?? '';
                }

                $temp['option_count'] = $row->option_count;
                $temp['question_format_type'] = $row->question_format_type;
                $temp['option_format_type'] = $row->option_format_type;
                $temp['option_1'] = $row->option_1 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_1) : trim($row->option_1) : '';
                $temp['option_2'] = $row->option_2 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_2) : trim($row->option_2) : '';
                $temp['option_3'] = $row->option_3 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_3) : trim($row->option_3) : '';
                $temp['option_4'] = $row->option_4 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_4) : trim($row->option_4) : '';
                $temp['option_5'] = $row->option_5 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_5) : trim($row->option_5) : '';
                $temp['option_6'] = $row->option_6 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_6) : trim($row->option_6) : '';
                $temp['quiz_answer'] = $row->quiz_answer ?? '';
                $temp['quiz_answer_value']= $row->quiz_answer_value != null ? $row->option_format_type == 2 ? asset('storage/'.$row->quiz_answer_value) : $row->quiz_answer_value : '';
                $temp['quiz_hint'] = $row->quiz_hint ?? '';
                $temp['quiz_explanation'] = $row->quiz_exp ?? '';

                if($row['image_type'] == 1)
                {
                    $temp['quiz_image'] = $row->quiz_image != null ? asset('storage/'.$row->quiz_image) : '';
                }
                else
                {
                    $temp['quiz_image'] = $row->quiz_image ?? '';
                }
                $temp['category_id'] = $row->category_id ?? '';
                $temp['category_name'] = $row->category->name ?? '';
                $temp['quiz_type'] = $row->quiz_type ?? '';
                $temp['quiz_type_value'] = $row->quiz_type_value ?? '';
                $temp['direction_description'] = $row->direction_description ?? '';
                $resArr[] = $temp;
            }

            if(!empty($resArr)){
                if ($Quiz instanceof LengthAwarePaginator) {
                    // Paginated response
                    $responseArr = array(
                        'result' => '1',
                        'data' => $resArr ?? [],
                        'total' => $Quiz->total(),
                        'currentPage' => $Quiz->currentPage(),
                        'perPage' => $Quiz->perPage(),
                        'lastPage' => $Quiz->lastPage(),
                        'message' => 'Success'
                    );
                } else {
                    // Not paginated - fallback values
                    $responseArr = array(
                        'result' => '1',
                        'data' => $resArr ?? [],
                        'total' => count($resArr),
                        'currentPage' => 1,
                        'perPage' => count($resArr),
                        'lastPage' => 1,
                        'message' => 'Success (Not Paginated)'
                    );
                }
            }else{
                $responseArr = array('result'=>'0', 'data'=> [],
                                        'total' => "",
                                        'currentPage' => "",
                                        'perPage' => "",
                                        'lastPage' => "", 'message'=>'No Data Found');
            }
        }
        else
        {
            $responseArr = array('result' => '0' ,'data'=> [] ,'message'=>'No Data Found',);

        }
        return response()->json($responseArr);
    }

    public function get_direction_based_questions_using_category_id(Request $request){
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|string',
        ]);
        if ($validator->fails()) {
            // Return the first error message for each field
            return response()->json([
                'result' => '0',
                'data' => [],
                'total' => "",
                'currentPage' => "",
                'perPage' => "",
                'lastPage' => "",
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $category_id = $request->category_id;
        $resArr = [];
        $responseArr = array('result' => '0' ,'message'=>'failed','data'=> []);
        
        $Quiz = Quiz::where('category_id',$category_id)
                    ->where('deleted_at',0)->where('quiz_type',5);
                    
        if($request->page == ""){
            $Quiz = $Quiz->get();
        }else{
            $Quiz = $Quiz->paginate(150);
        }

        if(!empty($Quiz) && count($Quiz) ){
            foreach($Quiz as $row)
            {
                $temp = [];
                $temp['quiz_id'] = (string) $row->id ?? '';
                if($row->question_format_type == 1)
                {
                    $temp['question_name'] = $row->question_name ?? '';
                    $temp['quiz_name'] = $row->question_name ?? '';
                    $temp['quiz_content'] = $row->quiz_content ?? '';
                }
                if($row->question_format_type == 2)
                {
                    $temp['question_name'] = $row->question_name ?? '';
                    $temp['quiz_name'] = $row->question_name ?? '';
                    $temp['quiz_content'] = $row->quiz_content ?? '';
                }
                if($row->question_format_type == 3)
                {
                    $temp['question_name'] = $row->question_name ?? '';
                    $temp['quiz_name'] = $row->question_name ?? '';
                    $temp['quiz_content'] = asset('storage/'.$row->question_content) ?? '';
                }
                if($row->question_format_type == 4)
                {
                    $temp['question_name'] = $row->question_name ?? '';
                    $temp['quiz_name'] = $row->question_name ?? '';
                    $temp['quiz_content'] = asset('storage/'.$row->question_content) ?? '';
                }

                $temp['option_count'] = $row->option_count;
                $temp['question_format_type'] = $row->question_format_type;
                $temp['option_format_type'] = $row->option_format_type;
                $temp['option_1'] = $row->option_1 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_1) : trim($row->option_1) : '';
                $temp['option_2'] = $row->option_2 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_2) : trim($row->option_2) : '';
                $temp['option_3'] = $row->option_3 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_3) : trim($row->option_3) : '';
                $temp['option_4'] = $row->option_4 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_4) : trim($row->option_4) : '';
                $temp['option_5'] = $row->option_5 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_5) : trim($row->option_5) : '';
                $temp['option_6'] = $row->option_6 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_6) : trim($row->option_6) : '';
                $temp['quiz_answer'] = $row->quiz_answer ?? '';
                $temp['quiz_answer_value']= $row->quiz_answer_value != null ? $row->option_format_type == 2 ? asset('storage/'.$row->quiz_answer_value) : $row->quiz_answer_value : '';
                $temp['quiz_hint'] = $row->quiz_hint ?? '';
                $temp['quiz_explanation'] = $row->quiz_exp ?? '';

                if($row['image_type'] == 1)
                {
                    $temp['quiz_image'] = $row->quiz_image != null ? asset('storage/'.$row->quiz_image) : '';
                }
                else
                {
                    $temp['quiz_image'] = $row->quiz_image ?? '';
                }
                $temp['category_id'] = $row->category_id ?? '';
                $temp['category_name'] = $row->category->name ?? '';
                $temp['quiz_type'] = $row->quiz_type ?? '';
                $temp['quiz_type_value'] = $row->quiz_type_value ?? '';
                $temp['direction_description'] = $row->direction_description ?? '';
                $resArr[] = $temp;
            }

            if(!empty($resArr)){
                if ($Quiz instanceof LengthAwarePaginator) {
                    // Paginated response
                    $responseArr = array(
                        'result' => '1',
                        'data' => $resArr ?? [],
                        'total' => $Quiz->total(),
                        'currentPage' => $Quiz->currentPage(),
                        'perPage' => $Quiz->perPage(),
                        'lastPage' => $Quiz->lastPage(),
                        'message' => 'Success'
                    );
                } else {
                    // Not paginated - fallback values
                    $responseArr = array(
                        'result' => '1',
                        'data' => $resArr ?? [],
                        'total' => count($resArr),
                        'currentPage' => 1,
                        'perPage' => count($resArr),
                        'lastPage' => 1,
                        'message' => 'Success (Not Paginated)'
                    );
                }
            }else{
                $responseArr = array('result'=>'0', 'data'=> [],
                                        'total' => "",
                                        'currentPage' => "",
                                        'perPage' => "",
                                        'lastPage' => "", 'message'=>'No Data Found');
            }
        }
        else
        {
            $responseArr = array('result' => '0' ,'data'=> [] ,'message'=>'No Data Found',);

        }
        return response()->json($responseArr);
    }


    public function get_questions_search_using_app_id(Request $request){
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'app_id' => 'required|string',
            'search' => 'required|string',
        ]);
        if ($validator->fails()) {
            // Return the first error message for each field
            return response()->json([
                'result' => '0',
                'data' => [],
                'total' => "",
                'currentPage' => "",
                'perPage' => "",
                'lastPage' => "",
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $app_id = $request->app_id;
        $resArr = [];
        $responseArr = array('result' => '0' ,'message'=>'failed','data'=> []);
        $search = $request->search;

        if($app_id){
            $Batch = Batch::where('app_id', $app_id)->get();

            $allIds = [];

            foreach ($Batch as $row) {
                $selected = json_decode($row->selected_ids, true) ?? [];

                // Merge starting_point_id + selected_ids
                $merged = array_merge([$row->starting_point_id], $selected);

                // Add to the master array
                $allIds = array_merge($allIds, $merged);
            }

            // Remove duplicates and re-index
            $uniqueIds = array_values(array_unique($allIds));

        }


        $Quiz = Quiz::where('question_name','like','%'.$search.'%')->whereIn('category_id',$uniqueIds)
                    ->where('deleted_at',0)
                    ->paginate(500);

        if(!empty($Quiz) && count($Quiz) ){
            foreach($Quiz as $row)
            {
                $temp = [];
                $temp['quiz_id'] = (string) $row->id ?? '';
                if($row->question_format_type == 1)
                {
                    $temp['question_name'] = $row->question_name ?? '';
                    $temp['quiz_name'] = $row->question_name ?? '';
                    $temp['quiz_content'] = $row->quiz_content ?? '';
                }
                if($row->question_format_type == 2)
                {
                    $temp['question_name'] = $row->question_name ?? '';
                    $temp['quiz_name'] = $row->question_name ?? '';
                    $temp['quiz_content'] = $row->quiz_content ?? '';
                }
                if($row->question_format_type == 3)
                {
                    $temp['question_name'] = $row->question_name ?? '';
                    $temp['quiz_name'] = $row->question_name ?? '';
                    $temp['quiz_content'] = asset('storage/'.$row->question_content) ?? '';
                }
                if($row->question_format_type == 4)
                {
                    $temp['question_name'] = $row->question_name ?? '';
                    $temp['quiz_name'] = $row->question_name ?? '';
                    $temp['quiz_content'] = asset('storage/'.$row->question_content) ?? '';
                }

                $temp['option_count'] = $row->option_count;
                $temp['question_format_type'] = $row->question_format_type;
                $temp['option_format_type'] = $row->option_format_type;
                $temp['option_1'] = $row->option_1 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_1) : trim($row->option_1) : '';
                $temp['option_2'] = $row->option_2 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_2) : trim($row->option_2) : '';
                $temp['option_3'] = $row->option_3 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_3) : trim($row->option_3) : '';
                $temp['option_4'] = $row->option_4 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_4) : trim($row->option_4) : '';
                $temp['option_5'] = $row->option_5 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_5) : trim($row->option_5) : '';
                $temp['option_6'] = $row->option_6 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_6) : trim($row->option_6) : '';
                $temp['quiz_answer'] = $row->quiz_answer ?? '';
                $temp['quiz_answer_value']= $row->quiz_answer_value != null ? $row->option_format_type == 2 ? asset('storage/'.$row->quiz_answer_value) : $row->quiz_answer_value : '';
                $temp['quiz_hint'] = $row->quiz_hint ?? '';
                $temp['quiz_explanation'] = $row->quiz_exp ?? '';

                if($row['image_type'] == 1)
                {
                    $temp['quiz_image'] = $row->quiz_image != null ? asset('storage/'.$row->quiz_image) : '';
                }
                else
                {
                    $temp['quiz_image'] = $row->quiz_image ?? '';
                }
                $temp['category_id'] = $row->category_id ?? '';
                $temp['category_name'] = $row->category->name ?? '';
                $temp['quiz_type'] = $row->quiz_type ?? '';
                $temp['quiz_type_value'] = $row->quiz_type_value ?? '';
                $temp['direction_description'] = $row->direction_description ?? '';
                $resArr[] = $temp;
            }

            if(!empty($resArr)){
                $responseArr = array('result'=>'1', 'data'=> $resArr ?? [],
                                        'total' => $Quiz->total(),
                                        'currentPage' => $Quiz->currentPage(),
                                        'perPage' => $Quiz->perPage(),
                                        'lastPage' => $Quiz->lastPage(), 'message'=>'Success');
            }else{
                $responseArr = array('result'=>'0', 'data'=> [],
                                        'total' => "",
                                        'currentPage' => "",
                                        'perPage' => "",
                                        'lastPage' => "", 'message'=>'No Data Found');
            }
        }
        else
        {
            $responseArr = array('result' => '0' ,'data'=> [] ,'message'=>'No Data Found',);

        }
        return response()->json($responseArr);
    }

    public function get_questions_detail(Request $request){
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'quiz_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            // Return the first error message for each field
            return response()->json([
                'result' => '0',
                'data' => [],
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $quiz_id = $request->quiz_id;
        $resArr = [];
        $responseArr = array('result' => '0' ,'message'=>'failed','data'=> []);

        $Quiz = Quiz::where('id',$quiz_id)
                    ->where('deleted_at',0)
                    ->first();

        if(!empty($Quiz)){

            $temp = [];
            $temp['quiz_id'] = (string) $Quiz->id ?? '';
            if($Quiz->question_format_type == 1)
            {
                $temp['question_name'] = $Quiz->question_name ?? '';
                $temp['quiz_name'] = $Quiz->question_name ?? '';
                $temp['quiz_content'] = $Quiz->quiz_content ?? '';
            }
            if($Quiz->question_format_type == 2)
            {
                $temp['question_name'] = $Quiz->question_name ?? '';
                $temp['quiz_name'] = $Quiz->question_name ?? '';
                $temp['quiz_content'] = $Quiz->quiz_content ?? '';
            }
            if($Quiz->question_format_type == 3)
            {
                $temp['question_name'] = $Quiz->question_name ?? '';
                $temp['quiz_name'] = $Quiz->question_name ?? '';
                $temp['quiz_content'] = asset('storage/'.$Quiz->question_content) ?? '';
            }
            if($Quiz->question_format_type == 4)
            {
                $temp['question_name'] = $Quiz->question_name ?? '';
                $temp['quiz_name'] = $Quiz->question_name ?? '';
                $temp['quiz_content'] = asset('storage/'.$Quiz->question_content) ?? '';
            }

            $temp['option_count'] = $Quiz->option_count;
            $temp['question_format_type'] = $Quiz->question_format_type;
            $temp['option_format_type'] = $Quiz->option_format_type;
            $temp['option_1'] = $Quiz->option_1 != null ? $Quiz->option_format_type == 2 ? asset('storage/'.$Quiz->option_1) : trim($Quiz->option_1) : '';
            $temp['option_2'] = $Quiz->option_2 != null ? $Quiz->option_format_type == 2 ? asset('storage/'.$Quiz->option_2) : trim($Quiz->option_2) : '';
            $temp['option_3'] = $Quiz->option_3 != null ? $Quiz->option_format_type == 2 ? asset('storage/'.$Quiz->option_3) : trim($Quiz->option_3) : '';
            $temp['option_4'] = $Quiz->option_4 != null ? $Quiz->option_format_type == 2 ? asset('storage/'.$Quiz->option_4) : trim($Quiz->option_4) : '';
            $temp['option_5'] = $Quiz->option_5 != null ? $Quiz->option_format_type == 2 ? asset('storage/'.$Quiz->option_5) : trim($Quiz->option_5) : '';
            $temp['option_6'] = $Quiz->option_6 != null ? $Quiz->option_format_type == 2 ? asset('storage/'.$Quiz->option_6) : trim($Quiz->option_6) : '';
            $temp['quiz_answer'] = $Quiz->quiz_answer ?? '';
            $temp['quiz_answer_value']= $Quiz->quiz_answer_value != null ? $Quiz->option_format_type == 2 ? asset('storage/'.$Quiz->quiz_answer_value) : $Quiz->quiz_answer_value : '';
            $temp['quiz_hint'] = $Quiz->quiz_hint ?? '';
            $temp['quiz_explanation'] = $Quiz->quiz_exp ?? '';

            if($Quiz['image_type'] == 1)
            {
                $temp['quiz_image'] = $Quiz->quiz_image != null ? asset('storage/'.$Quiz->quiz_image) : '';
            }
            else
            {
                $temp['quiz_image'] = $Quiz->quiz_image ?? '';
            }
            $temp['category_id'] = $Quiz->category_id ?? '';
            $temp['category_name'] = $Quiz->category->name ?? '';
            $temp['quiz_type'] = $row->quiz_type ?? '';
            $temp['quiz_type_value'] = $row->quiz_type_value ?? '';
            $temp['direction_description'] = $row->direction_description ?? '';
            
            $resArr[] = $temp;
            if(!empty($resArr)){
                $responseArr = array('result'=>'1', 'data'=> $resArr ?? [], 'message'=>'Success');
            }else{
                $responseArr = array('result'=>'0', 'data'=> [],'message'=>'No Data Found');
            }

            return response()->json($responseArr);

        }
        else
        {
            $responseArr = array('result' => '0' ,'data'=> [] ,'message'=>'No Data Found',);
        }
        return response()->json($responseArr);
    }

    public function get_last_fetched_questions_using_quiz_id(Request $request){
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'app_id' => 'required|string',
            'category_id' => 'required|string',
            'quiz_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            // Return the first error message for each field
            return response()->json([
                'result' => '0',
                'data' => [],
                'total' => "",
                'currentPage' => "",
                'perPage' => "",
                'lastPage' => "",
                'message' => $validator->errors()->first(),
            ], 422);
        }
        $app_id = $request->app_id;
        $category_id = $request->category_id;
        $quiz_id = $request->quiz_id;
        $resArr = [];
        $responseArr = array('result' => '0' ,'message'=>'failed','total' => "", 'currentPage' => "", 'perPage' => "", 'lastPage' => "", 'data'=> []);

        $Quiz = Quiz::where('id','>',$quiz_id)
                    ->where('category_id',$category_id)
                    ->where('deleted_at',0)
                    ->get();


        if(!empty($Quiz) && count($Quiz) ){
            foreach($Quiz as $row)
            {
                $temp = [];
                $temp['quiz_id'] = (string) $row->id ?? '';
                if($row->question_format_type == 1)
                {
                    $temp['question_name'] = $row->question_name ?? '';
                    $temp['quiz_name'] = $row->question_name ?? '';
                    $temp['quiz_content'] = $row->quiz_content ?? '';
                }
                if($row->question_format_type == 2)
                {
                    $temp['question_name'] = $row->question_name ?? '';
                    $temp['quiz_name'] = $row->question_name ?? '';
                    $temp['quiz_content'] = $row->quiz_content ?? '';
                }
                if($row->question_format_type == 3)
                {
                    $temp['question_name'] = $row->question_name ?? '';
                    $temp['quiz_name'] = $row->question_name ?? '';
                    $temp['quiz_content'] = asset('storage/'.$row->question_content) ?? '';
                }
                if($row->question_format_type == 4)
                {
                    $temp['question_name'] = $row->question_name ?? '';
                    $temp['quiz_name'] = $row->question_name ?? '';
                    $temp['quiz_content'] = asset('storage/'.$row->question_content) ?? '';
                }

                $temp['option_count'] = $row->option_count;
                $temp['question_format_type'] = $row->question_format_type;
                $temp['option_format_type'] = $row->option_format_type;
                $temp['option_1'] = $row->option_1 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_1) : trim($row->option_1) : '';
                $temp['option_2'] = $row->option_2 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_2) : trim($row->option_2) : '';
                $temp['option_3'] = $row->option_3 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_3) : trim($row->option_3) : '';
                $temp['option_4'] = $row->option_4 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_4) : trim($row->option_4) : '';
                $temp['option_5'] = $row->option_5 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_5) : trim($row->option_5) : '';
                $temp['option_6'] = $row->option_6 != null ? $row->option_format_type == 2 ? asset('storage/'.$row->option_6) : trim($row->option_6) : '';
                $temp['quiz_answer'] = $row->quiz_answer ?? '';
                $temp['quiz_answer_value']= $row->quiz_answer_value != null ? $row->option_format_type == 2 ? asset('storage/'.$row->quiz_answer_value) : $row->quiz_answer_value : '';
                $temp['quiz_hint'] = $row->quiz_hint ?? '';
                $temp['quiz_explanation'] = $row->quiz_exp ?? '';

                if($row['image_type'] == 1)
                {
                    $temp['quiz_image'] = $row->quiz_image != null ? asset('storage/'.$row->quiz_image) : '';
                }
                else
                {
                    $temp['quiz_image'] = $row->quiz_image ?? '';
                }
                $temp['category_id'] = $row->category_id ?? '';
                $temp['category_name'] = $row->category->name ?? '';
                $temp['quiz_type'] = $row->quiz_type ?? '';
                $temp['quiz_type_value'] = $row->quiz_type_value ?? '';
                $temp['direction_description'] = $row->direction_description ?? '';
                $resArr[] = $temp;
            }

            if(!empty($resArr)){
                if ($Quiz instanceof LengthAwarePaginator) {
                    // Paginated response
                    $responseArr = array(
                        'result' => '1',
                        'data' => $resArr ?? [],
                        'total' => $Quiz->total(),
                        'currentPage' => $Quiz->currentPage(),
                        'perPage' => $Quiz->perPage(),
                        'lastPage' => $Quiz->lastPage(),
                        'message' => 'Success'
                    );
                } else {
                    // Not paginated - fallback values
                    $responseArr = array(
                        'result' => '1',
                        'data' => $resArr ?? [],
                        'total' => count($resArr),
                        'currentPage' => 1,
                        'perPage' => count($resArr),
                        'lastPage' => 1,
                        'message' => 'Success (Not Paginated)'
                    );
                }
            }else{
                $responseArr = array('result'=>'0', 'data'=> [],
                                        'total' => "",
                                        'currentPage' => "",
                                        'perPage' => "",
                                        'lastPage' => "", 'message'=>'No Data Found');
            }
        }
        else
        {
            $responseArr = array('result' => '0' ,'data'=> [] ,'message'=>'No Data Found',);
        }
        return response()->json($responseArr);

    }



}
