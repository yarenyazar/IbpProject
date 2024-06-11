<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <div class="mt-8 space-y-6">
                        <!-- Student Messages Section -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow d-flex justify-content-center align-items-center flex-column">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Student Messages</h3>
                            <button onclick="location.href='{{ route('student.messages.index') }}'" class="btn btn-primary btn-lg">
                                View Student Messages
                            </button>
                        </div>

                        <!-- Send Messages to Students Section -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow d-flex justify-content-center align-items-center flex-column">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Send Messages to Admin</h3>
                            <button onclick="location.href='{{ route('admin.messages.create') }}'"
                            class="btn btn-secondary btn-lg">
                                Send Message to Students
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
