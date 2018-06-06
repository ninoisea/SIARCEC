@extends('layouts.base.app')

@section('end')
<body class="app">
    @include('layouts.partials._partials.loader')

    <div>
        @include('layouts.partials.backend.sidebar')
        {{-- #Main ============================ --}}
        <div class="page-container">
            @include('layouts.partials.backend.header')

            {{-- ### $App Screen Content ### --}}
            <div id='app' class='main-content bgc-grey-100'>
                <change-password></change-password>
                @yield('content', 'contenido')
            </div>

            @include('layouts.partials._partials.footer')
        </div>
    </div>
</body>
@endsection
