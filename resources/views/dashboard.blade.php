<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-red-600 leading-tight retro-header">
            {{ __('Welcome, ') }}<span class="text-yellow-400">{{ Auth::user()->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- User Profile Information -->
            <div class="bg-black text-white shadow-md rounded-lg p-6 retro-box flex items-start space-x-6">
                <!-- Profile Picture -->
                <div class="bg-gray-800 p-4 rounded-full border-4 border-red-500">
                    @if (Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="rounded-full w-24 h-24 object-cover">
                    @else
                        <div class="w-24 h-24 bg-gray-700 rounded-full flex items-center justify-center text-white border-4 border-red-500">No Image</div>
                    @endif
                </div>

                <!-- User Info -->
                <div class="flex flex-col space-y-4 w-full">
                    <!-- User Information Display -->
                    @foreach (['name', 'email', 'birthday', 'age', 'gender', 'address', 'occupation', 'nationality'] as $field)
                        @if(Auth::user()->$field)
                            <div class="bg-gray-800 p-4 rounded-lg border-2 border-red-500">
                                <p class="text-md"><strong>{{ ucfirst($field) }}:</strong> {{ Auth::user()->$field }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Buttons -->
            <div class="mt-6 text-center">
                <a href="{{ route('profile.edit') }}" class="bg-red-600 text-white px-6 py-3 rounded-full shadow-md hover:bg-red-700 transition duration-300">
                    Edit Profile
                </a>
             <!-- Link to Index Page -->
<a href="{{ route('posts.index') }}" class="bg-red-600 text-white px-6 py-3 rounded-full shadow-md hover:bg-red-700 transition duration-300">
                     Go to Newsfeed
</a>

                </a>
            </div>
        </div>
    </div>

    <style>
        .retro-header {
            font-family: 'Courier New', Courier, monospace;
            color: #f00;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .retro-box {
            border: 1px solid #f00;
            background-color: #111;
            color: #eee;
        }
    </style>
</x-app-layout>
