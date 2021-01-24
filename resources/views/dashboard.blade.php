<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    添加新管理员？<a href="/register">点这里</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Mount point for vue -->
    <div id="app">
        <admin></admin>
    </div>

    <script>
        window.Laravel = <?php echo json_encode(['api_token' => (Auth::user())->api_token]); ?>
    </script>
    <!-- Mounting code -->
    <script src="{{ mix('js/app.js') }}"></script>

{{--    <!-- Markdown UI -->--}}
{{--    <script src="https://unpkg.com/vue"></script>--}}
{{--    <script src="https://unpkg.com/marked@0.3.6"></script>--}}
{{--    <script src="https://unpkg.com/lodash@4.16.0"></script>--}}

</x-app-layout>
