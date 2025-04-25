<x-layout>
    <x-slot:heading>
        Your Profile
    </x-slot:heading>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-6">
        <div class="bg-white/5 rounded-xl p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Your Account</h2>
                <a href="{{ route('profile.edit') }}" class="text-indigo-600 hover:text-indigo-500">
                    Edit Profile
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="font-bold text-gray-400 text-sm">First Name</p>
                    <p class="font-medium">{{ auth()->user()->first_name }}</p>
                </div>

                <div>
                    <p class="font-bold text-gray-400 text-sm">Last Name</p>
                    <p class="font-medium">{{ auth()->user()->last_name }}</p>
                </div>

                <div>
                    <p class="font-bold text-gray-400 text-sm">Email</p>
                    <p class="font-medium">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-700">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-medium">Password</h3>
                        <p class="mt-2 text-gray-500 text-sm">Update the password for your account</p>
                    </div>
                    <a href="{{ route('password.edit') }}" class="text-indigo-600 hover:text-indigo-500">
                        Change Password
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
