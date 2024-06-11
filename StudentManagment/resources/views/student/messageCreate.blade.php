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
                    <div class="container mt-5">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h4 class="mb-0">Send Messages to Admin</h4>
                                    </div>
                                    <div class="card-body">
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                        <form action="{{ route('user_messages.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Enter title">
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="content">Content</label>
                                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" placeholder="Enter content">{{ old('content') }}</textarea>
                                                @error('content')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-lg btn-block">Send Messages</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




            </div>
        </div>
    </div>
</x-app-layout>
