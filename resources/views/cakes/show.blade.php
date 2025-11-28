<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $cake->title }}
            </h2>
            <a href="{{ route('cakes.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if($cake->image_path)
                    <img src="{{ asset('storage/' . $cake->image_path) }}" alt="{{ $cake->title }}" class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                        <span class="text-gray-400 text-xl">No Image</span>
                    </div>
                @endif
                <div class="p-6">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ $cake->title }}</h1>
                    <div class="mb-4">
                        <p class="text-gray-600 dark:text-gray-400 whitespace-pre-line">{{ $cake->description }}</p>
                    </div>
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Created by <span class="font-semibold">{{ $cake->user->name }}</span> on {{ $cake->created_at->format('F d, Y') }}
                        </p>
                    </div>
                    @auth
                        @can('update', $cake)
                            <div class="mt-6 flex space-x-2">
                                <a href="{{ route('cakes.edit', $cake) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                    Edit
                                </a>
                                @can('delete', $cake)
                                    <form action="{{ route('cakes.destroy', $cake) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this cake?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Delete
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        @endcan
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

