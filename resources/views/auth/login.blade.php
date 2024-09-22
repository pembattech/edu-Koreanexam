<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex justify-center">

        <div class="flex items-center">
            <div class="ml-8 bg-indigo-600 text-white p-8 rounded-lg h-fit w-80">

                <h2 class="text-3xl font-bold mb-4">Test Your Skills for Free!</h2>
                <p class="mb-6">Not ready to register? Take a free practice test to see where you stand!</p>
                <a href="/free-test" class="bg-white text-indigo-600 font-bold py-2 px-4 rounded-full">Start Free
                    Test</a>
            </div>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class=" py-3 sm:max-w-xl sm:mx-auto">

                <div class=" px-4 py-10 bg-white sm:rounded-3xl sm:p-16">

                    <div class="max-w-md mx-auto">
                        <div>
                            <h1 class="text-2xl font-semibold">Login</h1>
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

                                <!-- Remember Me -->
                                <div class="block mt-4">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                            name="remember">
                                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif

                                    <x-primary-button class="ms-3">
                                        {{ __('Log in') }}
                                    </x-primary-button>
                                </div>

                            </div>
                        </div>

                        <p
                            class="text-gray-600 text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Don't have an account?
                            <a class="underline  hover:text-gray-900" href="{{ route('register') }}">
                                <span>
                                    Register here?
                                </span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>

        </form>


    </div>

</x-guest-layout>
