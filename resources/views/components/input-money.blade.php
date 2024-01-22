@props(['hasError'])

<input type="text"
       step="100"
       placeholder="0.00"
       pattern="(\d{1,3}(,\d{3})*|\d+)(\.\d{2})?"
@if($hasError)
    {{ $attributes->merge(['class' => 'form-control is-invalid']) }} />
@else
    {{ $attributes->merge(['class' => 'form-control']) }} />
@endif

