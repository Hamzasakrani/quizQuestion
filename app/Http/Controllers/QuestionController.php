<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function getQuetions()
    {
        return Question::all();
    }
    public function responseQuetions(Request $request)
    {
        foreach ($request->data as $item) {
            $answer = new Answer();
            $answer->question_id = $item["question_id"];
            $answer->value = $item["value"];
            $answer->user_id = Auth::id();
            $answer->save();
        }
        return $request->data;
    }
    public function getAnswersByQuestion()
    {

        $questiondatas = [];

        $listequestion =    Question::all();
        foreach ($listequestion as $key => $questionvalue) {
            $answers = [];
            $answerzero = 0;
            $answerone = 0;
            $answertwo = 0;
            $answerthree = 0;
            $answerfour = 0;
            $answerfive = 0;
            foreach ($questionvalue->answers as $answer) {

                switch ($answer["value"]) {
                    case 0:
                        $answerzero++;
                        break;
                    case 1:
                        $answerone++;
                        break;
                    case 2:
                        $answertwo++;
                        break;
                    case 3:
                        $answerthree++;
                        break;
                    case 4:
                        $answerfour++;
                        break;

                    case 5:
                        $answerfive++;
                        break;
                }
            }
            array_push($answers, $answerzero, $answerone, $answertwo, $answerthree, $answerfour, $answerfive);

            $questiondatas[$key] = array("question" => $questionvalue["title"], "value" => $answers,);
        }

        return $questiondatas;
    }
}