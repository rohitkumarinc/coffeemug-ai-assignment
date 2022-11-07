<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/bootstrap.css', 'resources/js/app.js'])
        <!-- Styles -->
        @livewireStyles

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <style>
        .ck-editor__editable_inline {
            min-height: 280px;
        }
        </style>

    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        <script src="{{ asset('plugin/ckeditor5/ckeditor.js') }}"></script>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <script type="text/javascript">
            // allEditors
            var allEditors = document.querySelectorAll('.crud-richtext');
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor
                .create(allEditors[i], {
                    ckfinder: {
                        uploadUrl: '{{route('ck_editor_image_upload', ['_token' => csrf_token() ])}}'
                    }
                })
                .catch(error => {
                    console.error(error);
                });
            }
            // allEditors

            // daterangepicker
            $('.daterangepicker-input').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                // startDate: moment().add(10, 'days'),
                locale: {
                    format: 'YYYY-MM-DD HH:mm:00'
                }
            });
            // daterangepicker
        </script>
    </body>
</html>
