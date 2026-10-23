<?php

namespace App\Imports;

use App\Models\Quiz;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuizImport implements ToModel, WithHeadingRow
{
    // store direction for each group
    private static $directions = [];

    public function model(array $row)
    {
        $groupKey = $row['quiz_type'].'_'.$row['quiz_type_value'];

        // if direction exists in excel row, store it
        if(!empty($row['direction_description'])) {
            self::$directions[$groupKey] = $row['direction_description'];
        }

        // get stored direction for this group
        $direction = self::$directions[$groupKey] ?? null;

        $quiz = Quiz::updateOrCreate(
            [
                'question_name' => $row['question_name'],
                'category_id'   => $row['category_id'],
                'quiz_type'     => $row['quiz_type'],
                'quiz_type_value' => $row['quiz_type_value'],
            ], 
            [
                'question_name'         => $row['question_name'],
                'question_format_type'  => 1,
                'option_format_type'    => 0,

                'option_1'  => $row['option_1'],
                'option_2'  => $row['option_2'],
                'option_3'  => $row['option_3'],
                'option_4'  => $row['option_4'],
                'option_5'  => $row['option_5'],
                'option_6'  => $row['option_6'],

                'quiz_answer'           => $row['quiz_answer'],
                'quiz_answer_value'     => $row['quiz_answer_value'],
                'quiz_hint'             => $row['quiz_hint'],
                'quiz_exp'              => $row['quiz_exp'],

                'option_count'          => $row['option_count'],
                'category_id'           => $row['category_id'],

                'quiz_type'             => $row['quiz_type'],
                'quiz_type_value'       => $row['quiz_type_value'],

                // COMMON DIRECTION
                'direction_description' => $direction,

                'image_type'            => 1,
                'admin_id'              => auth()->guard('admin')->user()->id,
            ]
        );

        return $quiz;
    }
}