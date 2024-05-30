@props([
    'action',
    'post' => null,
    'put' => null,
    'delete' => null
])

<form action="{{ route('question.store') }}" method="post" class="max-w">
    @csrf

    @if($put)
        @method('PUT')
    @endif

    @if($delete)
        @method('DELETE')
    @endif

    {{ $slot }}

</form>
