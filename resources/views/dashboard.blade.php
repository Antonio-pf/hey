

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Votes') }}
        </h2>
    </x-slot>
        <div id="app">
            <App/>
        </div>
    <form action="{{ route('dashboard') }}"  method="get" class="max-w-md mx-auto mt-5">
        @csrf
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" id="search" name="search" value="{{ request()->search }}" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg
                bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search question..." />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4
                focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
    </form>

    @if($questions->count() > 0)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:text-gray-100 uppercase font-bold mb-1" >
                List of questions
            </div>
            <div class="dark:text-gray-400 space-y-4">
            @foreach($questions->where('draft', false) as $question)
                    <x-list-question :question="$question"/>
                @endforeach
                {{ $questions->withQueryString()->links() }}
            </div>
        </div>
    </div>
    @else
        <div class="flex flex-col justify-center text-center">

            <div class="flex justify-center">
                <x-draw.searching class="w-56" width="400" height="200"/>
            </div>
            <div class="mt-3 text:dark dark:text-gray-100 font-bold"> Question not found</div>
        </div>
    @endif
</x-app-layout>


