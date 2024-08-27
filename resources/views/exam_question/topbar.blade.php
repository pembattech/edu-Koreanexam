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
            <span id="remaining-num"></span>
        </p>
    </div>

    <div>
        <p class="font-medium">
            Attempt:
            <span id="attempted-num"></span>
        </p>
    </div>

    <div>
        <p class="font-medium">39:34</p>
    </div>

</div>


