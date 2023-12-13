<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Exam;
use App\Models\ExamQuestionList;
use App\Models\Question;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //create exam
    public function createExam(Request $request)
    {
        //generate 20  question number random unique
        $questionNumeric = Question::where('category', 'Numeric')->inRandomOrder()->limit(20)->get();
        $questionVerbal = Question::where('category', 'Verbal')->inRandomOrder()->limit(20)->get();
        $questionLogika = Question::where('category', 'Logika')->inRandomOrder()->limit(20)->get();

        //create exam
        $exam = Exam::create([
            'user_id' => $request->user()->id,
        ]);

        //create exam detail
        foreach ($questionNumeric as $question) {
            ExamQuestionList::create([
                'exam_id' => $exam->id,
                'question_id' => $question->id,
            ]);
        }

        foreach ($questionVerbal as $question) {
            ExamQuestionList::create([
                'exam_id' => $exam->id,
                'question_id' => $question->id,
            ]);
        }

        foreach ($questionLogika as $question) {
            ExamQuestionList::create([
                'exam_id' => $exam->id,
                'question_id' => $question->id,
            ]);
        }

        return response()->json([
            'message' => 'Exam created successfully',
            'exam' => $exam,
        ]);
    }

    //get exam by category
    public function getListSoalByCategory(Request $request)
    {
        $exam = Exam::where('user_id', $request->user()->id)->first();
        if (!$exam) {
            return response()->json([
                'message' => 'Exam not found',
                'data' => [],
            ], 200);
        }

        $examQuestionList = ExamQuestionList::where('exam_id', $exam->id)->get();
        $examQuestionListId = $examQuestionList->pluck('question_id');

        $question = Question::whereIn('id', $examQuestionListId)->where('category', $request->category)->get();
        //timer by category
        $timer = $exam->timer_numeric;
        if ($request->category == 'Verbal') {
            $timer = $exam->timer_verbal;
        } else if ($request->category == 'Logika') {
            $timer = $exam->timer_logika;
        }

        return response()->json([
            'message' => 'Get question successfully',
            'timer' => $timer,
            'data' => QuestionResource::collection($question),
        ], 200);
    }

    //answer question
    public function answerQuestion(Request $request)
    {
        $validatedData = $request->validate([
            'question_id' => 'required',
            'answer' => 'required',
        ]);

        $exam = Exam::where('user_id', $request->user()->id)->first();
        if (!$exam) {
            return response()->json([
                'message' => 'Exam not found',
                'data' => [],
            ], 200);
        }
        $examQuestionList = ExamQuestionList::where('exam_id', $exam->id)->where('question_id', $validatedData['question_id'])->first();
        $question = Question::where('id', $validatedData['question_id'])->first();

        //check answer
        if ($question->answer == $validatedData['answer']) {
            $examQuestionList->update(
                ['answer' => true]
            );
        } else {
            $examQuestionList->update(
                ['answer' => false]
            );
        }

        return response()->json([
            'message' => 'Answer question successfully',
            'answer' => $examQuestionList->answer,
        ]);
    }

    //calculate exam scores by category
    public function calculateScoreByCategory(Request $request)
    {
        $category =  $request->category;
        $exam = Exam::where('user_id', $request->user()->id)->first();
        if (!$exam) {
            return response()->json([
                'message' => 'Exam not found',
                'data' => [],
            ], 200);
        }
        $examQuestionList = ExamQuestionList::where('exam_id', $exam->id)->get();
        //questionlist by category
        $examQuestionList = $examQuestionList->filter(function ($value, $key) use ($category) {
            return $value->question->category == $category;
        });

        //calculate score
        $totalCorrectAnswer = $examQuestionList->where('answer', true)->count();
        $totalIncorrectAnswer = $examQuestionList->where('answer', false)->count();

        $totalQuestion = $examQuestionList->count();
        $score = ($totalCorrectAnswer / $totalQuestion) * 100;
        $category_field = 'score_verbal';
        $status_field = 'status_verbal';
        $timer_field = 'timer_verbal';
        if ($category == 'Numeric') {
            $category_field = 'score_numeric';
            $status_field = 'status_numeric';
            $timer_field = 'timer_numeric';
        } else if ($category == 'Logika') {
            $category_field = 'score_logika';
            $status_field = 'status_logika';
            $timer_field = 'timer_logika';
        }
        $exam->update([
            $category_field => $score,
            $status_field => 'done',
            $timer_field => 0,
        ]);

        return response()->json([
            'message' => 'Get score successfully',
            'score' => $score,
            'CorrectAnswer' => $totalCorrectAnswer,
            'IncorrectAnswer' => $totalIncorrectAnswer,
        ], 200);
    }
}
