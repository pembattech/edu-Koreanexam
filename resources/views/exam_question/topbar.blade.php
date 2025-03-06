<div class="topbar flex justify-between border text-xl p-4 bg-white">

    <div>
        <p class="font-medium">
            @if (auth()->guard('student')->check())
                {{ Str::limit(auth()->guard('student')->user()->name, 15) }}
            @else
                {{ Str::limit(auth()->user()->name, 15) }}
            @endif

        </p>
    </div>

    <div>
        <p class="modal_set_number font-medium">
            {{-- Auto Gen --}}
        </p>
    </div>

    <div>
        <p class="font-medium w-36">
            Remaining:
            <span class="remaining-num">40</span>
        </p>
    </div>

    <div>
        <p class="font-medium w-28">
            Attempt:
            <span class="attempted-num">0</span>
        </p>
    </div>

    <div>
        <p class="font-medium">
            <span class="exam-timer inline-block w-14"></span>
        </p>
    </div>

</div>
