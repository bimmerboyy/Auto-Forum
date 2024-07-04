<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PollController extends Controller
{ public function create($topicId)
    {
        return view('polls.create', compact('topicId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'topic_id' => 'required|exists:topics,id',
            'questions' => 'required|array',
            'questions.*' => 'required|string|max:255',
            'options' => 'required|array',
            'options.*' => 'required|array',
            'options.*.*' => 'required|string|max:255',
        ]);

        $poll = new Poll();
        $poll->topic_id = $request->topic_id;
        $poll->save();

        foreach ($request->questions as $index => $questionText) {
            $question = new Question();
            $question->poll_id = $poll->id;
            $question->text = $questionText;
            $question->save();

            foreach ($request->options[$index] as $optionText) {
                $option = new Option();
                $option->question_id = $question->id;
                $option->text = $optionText;
                $option->save();
            }
        }

        return redirect()->route('topics.show', $poll->topic_id)->with('success', 'Poll created successfully.');
    }
}
