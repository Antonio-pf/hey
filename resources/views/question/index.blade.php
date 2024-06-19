<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Questions') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-form :action="route('question.store')">
                <x-textarea label='Question' name="question"/>
                <div class="flex gap-2 justify-end">
                    <x-btn.primary>Save</x-btn.primary>
                    <x-btn.reset>Cancel</x-btn.reset>
                </div>
            </x-form>
            <hr class="border-gray-700 my-4">
            <div class="dark:text-gray-100 uppercase font-bold mb-1">
                Draft
            </div>
            <div class="dark:text-gray-100 uppercase font-bold mb-1">
                <x-table>
                    <x-table.thead>
                        <tr>
                            <x-table.th>
                                Question
                            </x-table.th>

                            <x-table.th>
                                Actions
                            </x-table.th>
                        </tr>
                    </x-table.thead>
                    <tbody>
                    @foreach($questions->where('draft', true) as $question)
                        <x-table.tr>
                            <x-table.td>
                                {{ $question->question }}
                            </x-table.td>

                            <x-table.td>
                                <div class="flex items-center gap-2">
                                    <x-form :action="route('question.publish', $question)" put>
                                        <x-btn.primary type="submit">
                                            Publicar
                                        </x-btn.primary>
                                    </x-form>
                                    <x-form :action="route('question.destroy', $question)" delete>
                                        <x-btn.primary type="submit">
                                            Deletar
                                        </x-btn.primary>
                                    </x-form>

                                    <a href="{{ route('question.edit', $question) }}" class="hover:underline text-blue-500"> Edit</a>
                                </div>

                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                    </tbody>
                </x-table>
            </div>

            <div class="dark:text-gray-100 uppercase font-bold mb-1">
                My questions
            </div>
            <div class="dark:text-gray-100 uppercase font-bold mb-1">
                <x-table>
                    <x-table.thead>
                        <tr>
                            <x-table.th>
                                Question
                            </x-table.th>

                            <x-table.th>
                                Actions
                            </x-table.th>
                        </tr>
                    </x-table.thead>
                    <tbody>
                    @foreach($questions->where('draft', false) as $question)
                        <x-table.tr>
                            <x-table.td>
                                {{ $question->question }}
                            </x-table.td>
                            <x-table.td>
                                <x-form :action="route('question.destroy', $question)" delete>
                                    <x-btn.primary type="submit">
                                        Deletar
                                    </x-btn.primary>
                                </x-form>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                    </tbody>
                </x-table>
            </div>
        </div>
    </div>
</x-app-layout>
