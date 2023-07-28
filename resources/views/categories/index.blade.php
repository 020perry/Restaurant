@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-4">All Categories</h1>

        <a href="{{ route('categories.create') }}" class="inline-block mb-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New Category</a>

        @foreach ($categories as $category)
            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-4">
                <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                    <a href="{{ route('categories.show', $category) }}" class="text-lg leading-6 font-medium text-gray-900">{{ $category->name }}</a>
                    <div>
                        <a href="{{ route('categories.edit', $category) }}" class="inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Edit</a>

                        <form method="POST" action="{{ route('categories.destroy', $category) }}" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
