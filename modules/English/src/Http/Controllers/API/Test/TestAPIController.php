<?php

namespace English\Http\Controllers\API\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestAPIController extends Controller
{
    protected $repository, $doView, $doneView;

    public function index(Request $request)
    {
        $params = $request->all();
        $params['orderBy'] = ['id' => 'ASC'];
        $questions = $this->repository->myPaginate($params);
        return view($this->doView, compact('questions'));
    }

    public function done(Request $request)
    {
        $params = $request->all();
        $page = $request->get('page');
        $replies = $request->except(['_token']);
        $questions = $this->repository->myPaginate($params);
        $score = 0;
        $exactly = [];
        $questionCount = count($questions);
        foreach ($questions as $question) {
            $answerKey = 'answer' . $question->id;
            $exactly[$question->id] = false;
            if (isset($params[$answerKey])) {
                if ($question->answer == $params[$answerKey]) {
                    ++$score;
                    $exactly[$question->id] = true;
                }
            }
        }
        session()->flash('success', "Bạn trả lời đúng {$score}/{$questionCount} câu hỏi");
        return view($this->doneView, compact('questions', 'exactly', 'replies', 'page'));
    }
}
