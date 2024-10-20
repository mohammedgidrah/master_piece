@if (auth()->check() && $errors->has(auth()->user()->role . '.' . auth()->user()->name))
    <div class="text-danger">
        {{ $errors->first(auth()->user()->role . '.' . auth()->user()->name) }}
    </div>
@endif
