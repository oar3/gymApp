<x-layout>
    <x-slot:heading>
        Log in
    </x-slot:heading>

    <form method="POST" action="/login">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="email">Email Address</x-form-label>

                        <div class="mt-2">
                            <x-form-input name="email" id="email" type="email" :value="old('email')" placeholder="name@provider.com" required />

                            <x-form-error name="email" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="password">Password</x-form-label>

                        <div class="mt-2">
                            <x-form-input name="password" id="password" type="password" required />

                            <x-form-error name="password" />
                        </div>
                    </x-form-field>
                </div>
            </div>
        </div>

        <div>
            <div class="mt-6 flex items-center justify-start gap-x-6">
                <p>Don't have an account?</p>
                <a href="/register" class="block text-blue-900">Sign up here</a>
            </div>

            <div class="-mt-7 flex items-center justify-end gap-x-6">
                <a href="/" class="text-sm/6 font-semibold text-white-900">Cancel</a>
                <x-form-button>Log in</x-form-button>
            </div>
        </div>
    </form>
</x-layout>
