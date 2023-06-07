<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        try {
            $answer = Answer::where('id', $request->answer_id)->first();
            if (isset($answer)) {
                $answer->update([
                    'answer' => $request->answer
                ]);
                return response()->json(array('status' => true));
            } else {
                return response()->json(array('status' => false));
            }
        } catch (\Exception $th) {
            return response()->json(array('status' => false));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }

    public function fetchAnswers(Request $request)
    {
        try {
            $answer = Answer::where('question_id', $request->question_id)->first();
            if (isset($answer)) {
                return response()->json(['status' => true, 'msg' => 'Data found', 'data' => $answer]);
            } else {
                return response()->json(['status' => false, 'msg' => 'No answer found', 'data' => []]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => 'Something went wrong', 'data' => []]);
        }
    }
}
