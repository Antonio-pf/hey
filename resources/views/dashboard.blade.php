

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Votes') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:text-gray-100 uppercase font-bold mb-1" >
                List of questions
            </div>
            <div class="dark:text-gray-400 space-y-4">
                @foreach($questions->where('draft', false) as $question)
                    <x-list-question :question="$question"/>
                @endforeach

                {{ $questions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
