<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ request()->routeIs('trashed.index') ?  __('Trashed Notes') : __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @session('success')
            <x-alert class="bg-green-600 text-green-50">
                {{ $value }}
            </x-alert>
            @endsession
            @session('error')
            <x-alert class="bg-red-600 text-red-50">
                {{ $value }}
            </x-alert>
            @endsession
            @if (!request()->routeIs('trashed.index') )
            <x-link-button class="mb-5" :href="route('notes.create')">
                + New note
            </x-link-button>
            @endif
            @forelse ($notes as $note)
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-2xl text-indigo-600">
                    <a href={{ route(request()->routeIs('trashed.index') ? 'trashed.show' : 'notes.show', $note->uuid) }}>
                    {{ $note->title }}
                    </a>
                </h2>
                <p class="mt-2">{{ Str::limit($note->text,200, '...') }}</p>
                <span class="block mt-4 text-sm opacity-70">{{ $note->updated_at->diffForHumans() }}</span>
            </div>
            @empty
                <p>You have not {{ request()->routeIs('trashed.index') ? 'trashed ': '' }}notes yet!</p>
            @endforelse 
            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>
