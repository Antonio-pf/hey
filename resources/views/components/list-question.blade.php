@props([
    'question',
])
<div class="
        rounded dark:bg-gray-800/50 shadow
        shadow-pink-500/50 p-3 dark:text-gray-200
        flex justify-between items-center"
>
    <span>
        {{ $question->question }}
    </span>

        <section>
            <x-form :action="route('question.like', $question)">
                <button class="flex items-center space-x-2 text-yellow-500" type="submit">
                    <x-icons.thumbs-up class="w-5 h-5 text-yellow-500 hover:text-yellow-300 cursor-pointer" id="thumbs-up"/>
                    <span>{{ $question->votes_sum_like ?: 0}}</span>
                </button>
            </x-form>

            <x-form :action="route('question.unlike', $question)">

                <button class="text-red-600 flex items-center space-x-2" type="submit">
                    <x-icons.thumbs-down class="w-5 h-5  hover:text-red-400 cursor-pointer" id="thumbs-up"/>
                    <span>{{ $question->votes_sum_unlike ?: 0}}</span>
                </button>
            </x-form>

        </section>

</div>
