<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

use App\Imports\QuizImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\LogActivity;



class QuizImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);
        
        $file = $request->file;
        
        $path = $file->getRealPath();

        $data = array_map('str_getcsv', file($path));
    
        // heading remove
        $header = array_shift($data);
    
        $directions = [];
    
        foreach ($data as $row) {
            
            $row = array_combine($header, $row);
    
            $groupKey = $row['quiz_type'].'_'.$row['quiz_type_value'];
    
            // store direction
            if (!empty($row['direction_description'])) {
                $directions[$groupKey] = $row['direction_description'];
            }
    
            $direction = $directions[$groupKey] ?? null;
    
            Quiz::updateOrCreate(
                [
                    'question_name'    => $row['question_name'],
                    'category_id'      => $row['category_id'],
                    'quiz_type'        => $row['quiz_type'],
                    'option_1'         => $row['option_1'],
                    'option_2'         => $row['option_2'],
                    'option_3'         => $row['option_3'],
                    'option_4'         => $row['option_4'],
                    'quiz_type_value'  => $row['quiz_type_value'],
                ],
                [
                    'question_name' => $row['question_name'],
    
                    'option_1' => $row['option_1'],
                    'option_2' => $row['option_2'],
                    'option_3' => $row['option_3'],
                    'option_4' => $row['option_4'],
                    'option_5' => $row['option_5'] ?? null,
                    'option_6' => $row['option_6'] ?? null,
    
                    'quiz_answer' => $row['quiz_answer'] ?? null,
                    'quiz_answer_value' => $row['quiz_answer_value'] ?? null,
                    'quiz_hint' => $row['quiz_hint'] ?? null,
                    'quiz_exp' => $row['quiz_exp'] ?? null,
    
                    'option_count' => $row['option_count'] ?? 4,
    
                    'category_id' => $row['category_id'],
                    'quiz_type' => $row['quiz_type'],
                    'quiz_type_value' => $row['quiz_type_value'],
    
                    'direction_description' => $direction,
    
                    'question_format_type' => 1,
                    'option_format_type' => 0,
                    'image_type' => 1,
    
                    'admin_id' => auth()->guard('admin')->user()->id,
                ]
            );
        }

        // Excel::import(new QuizImport, $request->file('file'));
        LogActivity::addToLog();

        return back()->with('message', 'Quiz imported successfully!');
    }
}
