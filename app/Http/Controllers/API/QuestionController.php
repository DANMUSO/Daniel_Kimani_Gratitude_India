<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Question::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = new Question;
        $question -> question = $request->question;
        $question -> category = $request-> category;
        $question -> option1 = $request-> option1;
        $question -> option2 = $request-> option2;
        $question -> option3 = $request-> option3;
        $question -> option4 = $request-> option4;
        $question -> save();

        echo json_encode($question);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $question -> question = $request->question;
        $question -> category = $request-> category;
        $question -> option1 = $request-> option1;
        $question -> option2 = $request-> option2;
        $question -> option3 = $request-> option3;
        $question -> option4 = $request-> option4;
        $question -> update();
        echo json_encode($question);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $question = Question::findOrFail($id);
      $question->delete();
    }
}
