@if(app(\Menchhub\FilamentSettings\Settings\SiteSettings::class)->enable_pusher)
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher("{{ app(\Menchhub\FilamentSettings\Settings\SiteSettings::class)->pusher_app_key }}", {
            cluster: "{{ app(\Menchhub\FilamentSettings\Settings\SiteSettings::class)->pusher_app_cluster }}",
            encrypted: true
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            alert(JSON.stringify(data));
        });
    </script>
@endif
