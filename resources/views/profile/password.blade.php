<x-layout>
    <x-slot:heading>
        Change Password
    </x-slot:heading>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="current_password">Current Password</x-form-label>
                        <div class="mt-2">
                            <x-form-input
                                name="current_password"
                                id="current_password"
                                type="password"
                                required
                            />
                            <x-form-error name="current_password" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="password">New Password</x-form-label>
                        <div class="mt-2">
                            <x-form-input
                                name="password"
                                id="password"
                                type="password"
                                required
                            />
                            <x-form-error name="password" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="password_confirmation">Confirm New Password</x-form-label>
                        <div class="mt-2">
                            <x-form-input
                                name="password_confirmation"
                                id="password_confirmation"
                                type="password"
                                required
                            />
                            <x-form-error name="password_confirmation" />
                        </div>
                    </x-form-field>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">
            <a href="{{ route('profile.show') }}" class="text-sm/6 font-semibold text-gray-600">Cancel</a>
            <x-form-button>Update Password</x-form-button>
        </div>
    </form>
</x-layout>
