<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Note Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex gap-6">
                @if ($note->trashed())
                <div class="flex gap-6 ml-auto">
                        <form class="flex" action={{ route('trashed.restore',$note) }} method="post">
                            @method('put')
                            @csrf
                            <x-primary-button class="inline-block" type="submit">Restore Note</x-danger-button>
                        </form>
                        
                        <form class="flex" action={{ route('trashed.destroy', $note) }} method="post">
                            @method('delete')
                            @csrf
                            <x-danger-button onclick="confirm('Are you sure to delete permanently?')" type="submit">Delete Note</x-danger-button>
                        </form>
                    </div>    
                @else
                    <p class="opacity-70"><strong>Created: {{ $note->created_at->diffForHumans() }}</strong></p>
                    <p class="opacity-70"><strong>Last Changed: </strong> {{ $note->updated_at->diffForHumans() }}</p>
                    <x-link-button class="ml-auto" :href="route('notes.edit',$note)">Edit</x-link-button>
                    <form class="flex" action={{ route('notes.destroy', $note) }} method="post">
                        @method('delete')
                        @csrf
                        <x-danger-button onclick="confirm('Are you sure to delete?')" type="submit">Delete</x-danger-button>
                    </form>
                @endif
            </div>
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
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-2xl text-indigo-600">
                    {{ $note->title }}
                </h2>
                <p class="mt-2">{{ $note->text }}</p>
                <span class="block mt-4 text-sm opacity-70"></span>
            </div>
        </div>
    </div>
</x-app-layout>
