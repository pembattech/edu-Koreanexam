<x-app-layout>
    <h1>Result</h1>

    @foreach ($exams_score as $exam_score)
        {{ $exam_score }}
    @endforeach
</x-app-layout>