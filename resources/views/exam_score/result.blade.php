<x-app-layout>
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-sm text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Exam Date Time
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Set Number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Answered
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Correct
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="text-base">
                    @foreach ($exams_score as $exam_score)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <th scope="row" class="px-6 py-4 font-medium  whitespace-nowrap">
                                {{ $exam_score->exam_start_time }}
                            </th>
                            <td class="px-6 py-4">
                                Set {{ str_replace('set_', '', $exam_score->set_number) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $exam_score->korean_score }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $exam_score->correct_answers_count }}
                            </td>
                            <td class="px-6 py-4">

                                <form action="{{ route('exam_score.detail_result') }}" method="GET">
                                    <input type="hidden" name="exam_start_time"
                                        value="{{ $exam_score->exam_start_time }}">
                                    <button
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Show</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

</x-app-layout>
