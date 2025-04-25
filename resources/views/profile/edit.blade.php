<x-layout>
    <x-slot:heading>
        Edit Profile
    </x-slot:heading>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="first_name">First Name</x-form-label>
                        <div class="mt-2">
                            <x-form-input
                                name="first_name"
                                id="first_name"
                                :value="old('first_name', $user->first_name)"
                                required
                            />
                            <x-form-error name="first_name" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="last_name">Last Name</x-form-label>
                        <div class="mt-2">
                            <x-form-input
                                name="last_name"
                                id="last_name"
                                :value="old('last_name', $user->last_name)"
                                required
                            />
                            <x-form-error name="last_name" />
                        </div>
                    </x-form-field>

{{--                    <x-form-field>--}}
{{--                        <x-form-label for="email">Email Address</x-form-label>--}}
{{--                        <div class="mt-2">--}}
{{--                            <div class="py-1.5 px-3 bg-gray-700 rounded-md text-gray-400">--}}
{{--                                {{ $user->email }}--}}
{{--                            </div>--}}
{{--                            <p class="mt-1 text-sm text-gray-500">Email cannot be changed</p>--}}
{{--                        </div>--}}
{{--                    </x-form-field>--}}
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">
            <a href="{{ route('profile.show') }}" class="text-sm/6 font-semibold text-gray-600">Cancel</a>
            <x-form-button>Update Profile</x-form-button>
        </div>
    </form>
</x-layout>
