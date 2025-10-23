<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="max-w-2xl bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <form action={{ route('notes.update', $note) }} method="post">
                    @csrf
                    @method('put')
                    <x-text-input class="w-full" name="title" placeholder="Note title" :value="old('title', $note->title)"></x-text-input>
                    @error('title')
                        <div class="text-sm mt-1 text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                    <x-textarea class="w-full mt-6" name="text" placeholder="Type your note" rows="8" >
                        {{ old('text', $note->text) }}
                    </x-textarea>
                    @error('text')
                        <div class="text-sm mt-1 text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                    <select class="w-full mt-6" name="note_book_id">
                        <option value="">Select</option>
                        @foreach ($notebooks as $book)
                            @if ($book->id === old('note_book_id', $note->note_book_id))
                                <option selected value={{ $book->id }}>{{ $book->name }}</option>
                            @else
                                <option value={{  $book->id }}>{{ $book->name }}</option>
                            @endif    
                        @endforeach
                    </select>
                    <x-primary-button class="mt-6" type="submit">Save Note</x-primary-button>
                </form>
            </div>     
           
        </div>
    </div>
</x-app-layout>