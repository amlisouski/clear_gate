<x-app-layout>
    <x-slot name="title">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="row w-100">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <p>Services provided in the amount of</p>
                    <h2 class="h2 total_provided_amount"></h2>
                </div>
                <div class="card-body">
                    <div class="provided_amount_chart"></div>
                </div>
            </div>

        </div>
    </div>

    @section('footer-scripts')
        <script src="{{ mix('js/dashboard.js') }}"></script>
        <script>
            let dashboard = new Dashboard();
            dashboard.init();
        </script>
    @endsection
</x-app-layout>
