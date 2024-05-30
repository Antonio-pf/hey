

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-form post :action="route('question.store')">

                <x-textarea label='Question' name="question"/>

                <div class="flex gap-2 justify-end">
                    <x-btn.primary>Save</x-btn.primary>
                    <x-btn.reset>Cancel</x-btn.reset>
                </div>
            </x-form>

        </div>
    </div>
</x-app-layout>
