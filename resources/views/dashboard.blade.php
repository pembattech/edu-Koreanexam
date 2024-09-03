<x-app-layout>

    <div class="z-0 p-1 flex flex-wrap items-center justify-center">

        <div
            class="z-0 w-fit bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg rounded-lg p-6 shadow-lg border border-white border-opacity-30 text-white m-4">


            <div>
                <img class="w-40 h-40" src="{{ asset('assets/ubt.jpeg') }}" alt="">

            </div>
        </div>

        <div
            class="z-0 w-fit bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg rounded-lg p-6 shadow-lg border border-white border-opacity-30 text-white m-4">


            <div>
                <img class="w-40" src="{{ asset('assets/ubt.jpeg') }}" alt="">

            </div>
        </div>

    </div>


    <script>
        $("#navbar").removeClass('hidden');
    </script>

</x-app-layout>
