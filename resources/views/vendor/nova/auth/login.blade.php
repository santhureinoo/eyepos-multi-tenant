<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
                EyesPOS
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        {{-- <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="/v2/password/reset">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <div class="flex mb-6">
                    <label class="flex items-center text-xl font-bold">
                        <input class="" type="checkbox" name="remember">
                        <span class="text-base ml-2">Remember Me</span>
                    </label>


                    <div class="ml-auto">
                        <a class="text-primary dim font-bold no-underline"
                            href="http://127.0.0.1:8000/v2/password/reset">
                            Forgot Your Password?
                        </a>
                    </div>
                </div>

                <button class="w-full hover:bg-primary-dark" style="background-color: #4099de, color: ##fff">
                    {{ __('Log in') }}
                </button>

            </div>
        </form> --}}


        <form class="bg-white shadow rounded-lg p-8 max-w-login mx-auto" method="POST"
            {{-- action="/v2/login"> --}}
            action="{{ route('login') }}">

            @csrf

            <h2 class="text-2xl text-center font-normal mb-6 text-90">EyesPOS</h2>
            <svg class="block mx-auto mb-6" xmlns="http://www.w3.org/2000/svg" width="100" height="2"
                viewBox="0 0 100 2">
                <path fill="#D8E3EC" d="M0 0h100v2H0z"></path>
            </svg>


            <div class="mb-6 ">
                <label class="block font-bold mb-2" for="email">Email Address</label>
                <input class="form-control form-input form-input-bordered w-full" id="email" type="email"
                    name="email" value="" required="" autofocus="">
            </div>

            <div class="mb-6 ">
                <label class="block font-bold mb-2" for="password">Password</label>
                <input class="form-control form-input form-input-bordered w-full" id="password" type="password"
                    name="password" required="">
            </div>

            <div class="flex mb-6">
                <label class="flex items-center text-xl font-bold">
                    <input class="" type="checkbox" name="remember">
                    <span class="text-base ml-2">Remember Me</span>
                </label>


                <div class="ml-auto">
                    <a class="text-primary dim font-bold no-underline" href="/v2/password/reset">
                        Forgot Your Password?
                    </a>
                </div>
            </div>

            <button class="w-full btn btn-default btn-primary hover:bg-primary-dark" type="submit">
                Login
            </button>
        </form>
    </x-auth-card>
</x-guest-layout>
