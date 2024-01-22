@props(['status', 'message'])

@push('footer-scripts')
    <script type="text/javascript">
        const notyf = new Notyf();
        notyf.{{$status?'success':'error'}}('{{__($message)}}');
    </script>
@endpush

