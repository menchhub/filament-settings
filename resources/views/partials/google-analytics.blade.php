@if(!empty($google_analytics['tracking_id']))
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $google_analytics['tracking_id'] }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{ $google_analytics['tracking_id'] }}');
    </script>
    <!-- End Google Analytics -->
@endif
