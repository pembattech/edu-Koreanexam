<!-- Popup Overlay -->
<div id="live_result_popup_overlay" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 z-50"></div>

<!-- Popup Modal -->
<div id="live_result_popup" class="hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Live Exam Results</h2>

        <div class="mb-4">
            <p class="text-gray-700">Total Answered: <span id="live_result_total_answered" class="font-bold">0</span></p>
        </div>

        <div class="mb-4">
            <p class="text-gray-700">Total Correct: <span id="live_result_total_correct" class="font-bold">0</span></p>
        </div>

        <!-- Close Button -->
        <button id="live_result_close_popup" class="bg-red-600 hover:bg-red-800 text-white py-2 px-4 rounded">
            Close
        </button>

        <button id="live_result_review_answer" class="text-white bg-blue-700 hover:bg-blue-800 rounded px-4 py-2">
            Review Answer
        </button>
    </div>
</div>
