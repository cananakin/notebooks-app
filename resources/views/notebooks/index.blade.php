<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notebooks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-link-button class="mb-5" :href="route('notebooks.create')">
                + New Notebook
            </x-link-button>
            @session('success')
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <p>{{ $value }}</p>
            </div>
            @endsession
            @forelse ($books as $book)
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-2xl text-indigo-600">
                    <a href={{ route('notebooks.show', $book->id) }}>
                    {{ $book->name }}
                    </a>
                </h2>
            </div>
            @empty
                <p>You have not notebooks yet!</p>
            @endforelse 
            {{ $books->links() }}
        </div>
    </div>
</x-app-layout>
