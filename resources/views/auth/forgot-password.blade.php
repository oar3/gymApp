<x-layout>
    <x-slot:heading>
        Reset Password
    </x-slot:heading>

    <form method="POST" action="/forgot-password">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <p class="mt-1 text-sm leading-6 text-gray-400">
                    Forgot your password? No problem. Enter your email address and we'll send you a link to reset your password.
                </p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="email">Email Address</x-form-label>

                        <div class="mt-2">
                            <x-form-input name="email" id="email" type="email" :value="old('email')" placeholder="name@provider.com" required autofocus />

                            <x-form-error name="email" />
                        </div>
                    </x-form-field>
                </div>
            </div>
        </div>

        <div>
            <div class="mt-6 flex items-center justify-between gap-x-6">
                <div class="flex items-center">
                    <a href="/login" class="text-sm font-semibold text-blue-600 hover:text-blue-500">
                        Back to login
                    </a>
                </div>

                <x-form-button class="flex justify-start">
                    Email Password Reset Link
                </x-form-button>
            </div>

            @if (session('status'))
                <div class="mt-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </form>
</x-layout>
