<div class="flex flex-col">
    <div>

        <strong class="font-semibold text-black">Toggle Korean Status:</strong>
        <span id="korean-status">{{ $student->is_korean ? 'Korean' : 'Not Korean' }}</span>

    </div>
    <button id="toggle-korean-btn"
        class="w-fit bg-slate-900 hover:bg-slate-700 text-white px-4 py-2 rounded-lg focus:ring focus:ring-slate-400">
        Toggle Korean Status
    </button>

</div>

<div id="status-message" class="text-center text-sm hidden mt-2"></div>

<script>
    $(document).ready(function() {
        $('#toggle-korean-btn').on('click', function() {
            const messageBox = $('#status-message');
            const koreanStatus = $('#korean-status');

            $.ajax({
                url: `{{ url('/students') }}/{{ $student->id }}/toggle-korean`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    messageBox.removeClass('hidden');
                    messageBox.removeClass('text-red-500 text-green-500');

                    if (data.success) {
                        messageBox.addClass('text-green-500');
                        messageBox.text(data.message);

                        // Update the displayed Korean status
                        koreanStatus.text(data.is_korean ? 'Korean' : 'Not Korean');

                        if (data.passwd != null ){

                            alert(data.passwd);
                        }

                    } else {
                        messageBox.addClass('text-red-500');
                        messageBox.text('An error occurred.');
                    }
                },
                error: function() {
                    messageBox.removeClass('hidden');
                    messageBox.removeClass('text-green-500').addClass('text-red-500');
                    messageBox.text('An error occurred. Please try again.');
                }
            });
        });
    });
</script>
