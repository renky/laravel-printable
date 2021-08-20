@if ($orientation === 'portrait')

    @section('header')
        <style>
            @page {
                size: A4;
                margin: {{ $margin ?? '45mm 20mm 22mm 22mm'}};
            }

            @page :first {
                size: A4;
                margin: {{ $margin ?? '51mm 20mm 45mm 22mm'}};
            }

        </style>
    @endsection

@else
    @section('header')
        <style>
            @page {
                size: A4 landscape;
                margin: {{ $margin ?? '20mm 10mm 20mm 10mm'}};
            }

        </style>
    @endsection
@endif

<div class="page  {{ $orientation }}">
    <main>
        {{ $slot }}
    </main>
</div>
