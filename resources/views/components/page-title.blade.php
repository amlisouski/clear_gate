<div class="d-flex justify-content-between w-100 flex-wrap mb-3">
    <div class="mb-3 mb-lg-0">
        @isset($title)
            <h1 class="h3">
                @php
                    if( is_array($title) ) {
                        echo \Illuminate\Support\Arr::last($title);
                    } else {
                        echo $title;
                    }
                @endphp
            </h1>
        @endisset
    </div>

    {{ $slot }}

</div>
