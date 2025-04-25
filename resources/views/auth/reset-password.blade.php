<x-layout>
    <x-slot:heading>
        Set New Password
    </x-slot:heading>

    <form method="POST" action="/reset-password">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <p class="mt-1 text-sm leading-6 text-gray-400">
                    Please set your new password below.
                </p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="email">Email Address</x-form-label>

                        <div class="mt-2">
                            <x-form-input name="email" id="email" type="email" :value="old('email', $email)" placeholder="name@provider.com" required readonly />

                            <x-form-error name="email" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="password">New Password</x-form-label>

                        <div class="mt-2">
                            <x-form-input name="password" id="password" type="password" required />

                            <x-form-error name="password" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="password_confirmation">Confirm Password</x-form-label>

                        <div class="mt-2">
                            <x-form-input name="password_confirmation" id="password_confirmation" type="password" required />

                            <x-form-error name="password_confirmation" />
                        </div>
                    </x-form-field>
                </div>
            </div>
        </div>

        <div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="/login" class="text-sm/6 font-semibold text-white-900">Cancel</a>
                <x-form-button>Reset Password</x-form-button>
            </div>
        </div>
    </form>
</x-layout>
