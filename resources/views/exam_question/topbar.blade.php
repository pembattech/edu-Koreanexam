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

<script>
    const MAX_QUESTION = 40;
    const MIN_QUESTION = 1;


    // Retrieve the JSON string from session storage
    let storedArray = sessionStorage.getItem("lst_choosen_option");

    // Convert the JSON string back to an array
    let myArray = JSON.parse(storedArray);

    // Count the number of elements in the array
    let count = myArray.length;

    console.log(count);

    $('#attempted-num').text(count);
    $('#remaining-num').text(MAX_QUESTION - count);
</script>
