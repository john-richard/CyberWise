<!DOCTYPE html>
<html lang="en">

    @include('components.head', [
        'title' => $title ?? 'Default Title',
        'metaDescription' => $metaDescription ?? 'Default Description',
        'metaKeywords' => $metaKeywords ?? 'Default Keywords'
    ])

    <body class="{{ $bodyClass ?? '' }}">

        <!-- Main Content -->
        @yield('content')

        <!-- Additional Scripts -->
        @stack('scripts')
    </body>
</html>
