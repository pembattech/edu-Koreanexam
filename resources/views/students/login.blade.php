<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex justify-center">

        <form method="POST" action="{{ route('student.login') }}">
            @csrf
            <div class=" py-3 sm:max-w-xl sm:mx-auto">

                <div class=" px-4 py-10 bg-white sm:rounded-3xl sm:p-16">

                    <div class="max-w-md mx-auto">
                        <div>
                            <h1 class="text-2xl font-semibold">Student Login</h1>
                        </div>
                        <div class="divide-y divide-gray-200">
                            <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                <div class="">
                                    <x-input-label for="email" :value="__('Email')" />
                                </div>

                                <div class="">
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                        :value="old('email')" required autofocus autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>


                                <!-- Password -->
                                <div class="mt-4">
                                    <x-input-label for="password" :value="__('Password')" />

                                    <x-text-input id="password" class="block mt-1 w-full" type="password"
                                        name="password" required autocomplete="current-password" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <div class="flex items-center mt-4">

                                    <x-primary-button>
                                        {{ __('Log in') }}
                                    </x-primary-button>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </form>


    </div>

</x-guest-layout>
