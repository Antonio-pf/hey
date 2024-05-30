<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form action="{{ route('question.store') }}" method="post" class="max-w">
                @csrf
                <div class="mb-4">
                    <label for="question" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Question
                    </label>
                    <textarea id="question" rows="4" name="question"
                              class="block p-2.5 w-full
                              text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300
                              focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                              dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                              placeholder="Ask me anything...">{{ old('question') }}</textarea>


                    @error('question')
                    <span class="text-purple-400">
                            {{ $message }}
                        </span>

                    @enderror
                </div>

                <div class="flex gap-2 justify-end">
                    <button
                        type="submit"
                        class=
                            "focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium
                             rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                        Save
                    </button>

                    <button type="reset" class="py-2.5 px-5 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400
                dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Cancel
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
