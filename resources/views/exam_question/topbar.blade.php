<div class="topbar flex justify-between border text-xl p-4 bg-white">

    <div>
        <p class="font-medium">{{ auth()->user()->name }}</p>
    </div>

    <div>
        <p class="modal_set_number font-medium">
            {{-- Auto Gen --}}
        </p>
    </div>

    <div>
        <p class="font-medium">
            Remaining:
            <span class="remaining-num">40</span>
        </p>
    </div>

    <div>
        <p class="font-medium">
            Attempt:
            <span class="attempted-num">0</span>
        </p>
    </div>

    <div>
        <p class="font-medium">
            <span class="exam-timer"></span>
        </p>
    </div>

</div>
