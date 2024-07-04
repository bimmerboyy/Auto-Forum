@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Poll</h1>
        <form action="{{ route('polls.store') }}" method="POST">
            @csrf
            <input type="hidden" name="topic_id" value="{{ $topicId }}">
            <div class="form-group">
                <label for="number_of_questions">Broj Pitanja</label>
                <input type="number" class="form-control" id="number_of_questions" name="number_of_questions" min="1" max="10" required>
            </div>
            <button type="button" class="btn btn-primary mt-3" id="generateForm">Fromiraj Anketu</button>

            <div id="poll-form"></div>

            <button type="submit" class="btn btn-success mt-3">Napravi Anketu</button>
        </form>
    </div>

    <script>
        document.getElementById('generateForm').addEventListener('click', function () {
            const numberOfQuestions = document.getElementById('number_of_questions').value;
            const pollForm = document.getElementById('poll-form');
            pollForm.innerHTML = '';

            for (let i = 0; i < numberOfQuestions; i++) {
                pollForm.innerHTML += `
                    <div class="form-group mt-3">
                        <label for="questions[${i}]">Question ${i + 1}</label>
                        <input type="text" class="form-control" name="questions[${i}]" required>
                    </div>
                    <div class="form-group">
                        <label>Options for Question ${i + 1}</label>
                        <input type="text" class="form-control mt-2" name="options[${i}][]" placeholder="Option 1" required>
                        <input type="text" class="form-control mt-2" name="options[${i}][]" placeholder="Option 2" required>
                        <input type="text" class="form-control mt-2" name="options[${i}][]" placeholder="Option 3" required>
                    </div>
                `;
            }
        });
    </script>
@endsection
