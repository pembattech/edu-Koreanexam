<x-app-layout>

    <div class="grid grid-cols-3 gap-4">

        @foreach ($exam_sets as $exam_set)
        <div class="z-0 p-1 flex flex-wrap items-center justify-center">

            <div
                class="set-items z-0 w-fit bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg rounded-lg p-6 shadow-lg border border-white border-opacity-30 text-white">

                    <div class="flex flex-col items-center py-6 px-20 bg-gray-100 border border-gray-200 rounded-lg shadow">
                        <h5 class="mb-2 text-2xl cursor-default font-bold tracking-tight text-gray-900">UBT {{ $exam_set }}</h5>

                        <p id="attemptButton" data-set-number ="{{ $exam_set }}"
                            class="attemptButton cursor-pointer inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Attempt
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </p>
                    </div>
            </div>

        </div>

        @endforeach

    </div>


    @include('exam_question.exam_table')

    @include('exam_question.exam')


</x-app-layout>
