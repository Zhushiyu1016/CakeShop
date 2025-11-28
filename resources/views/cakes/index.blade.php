<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Cake Shop') }}
            </h2>
            @auth
                <a href="{{ route('cakes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add New Cake
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($cakes->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($cakes as $cake)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            @if($cake->image_path)
                                <img src="{{ asset('storage/' . $cake->image_path) }}" alt="{{ $cake->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                    <span class="text-gray-400">No Image</span>
                                </div>
                            @endif
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $cake->title }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-3">{{ $cake->description }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">By {{ $cake->user->name }}</span>
                                    <a href="{{ route('cakes.show', $cake) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                                        View
                                    </a>
                                </div>
                                @auth
                                    @can('update', $cake)
                                        <div class="mt-4 flex space-x-2">
                                            <a href="{{ route('cakes.edit', $cake) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded text-sm">
                                                Edit
                                            </a>
                                            @can('delete', $cake)
                                                <form action="{{ route('cakes.destroy', $cake) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this cake?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-sm">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    @endcan
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                        <p class="text-lg">No cakes available yet.</p>
                        @auth
                            <a href="{{ route('cakes.create') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add Your First Cake
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Register to Add Cakes
                            </a>
                        @endauth
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

