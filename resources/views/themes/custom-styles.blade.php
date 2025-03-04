<style>
    /* Light theme CSS */
    .fi-sidebar {
        background-color: {{ $settings->sidebar_color_bg_light }} !important;
    }
    .fi-sidebar-item-label {
        color: {{ $settings->site_theme_light }} !important;
    }
    .footer {
        background-color: {{ $settings->footer_color_bg_light }} !important;
    }
    .footer-text {
        color: {{ $settings->site_theme_light }} !important;
    }
    /* Dark theme CSS */
    .dark .fi-sidebar-header {
        background-color: {{ $settings->logo_color_bg_dark }};
    }
    .dark .fi-icon-btn-icon {
        color: {{ $settings->footer_label_color_dark }} !important;
    }
    .dark .fi-sidebar {
        background-color: {{ $settings->sidebar_color_bg_dark }} !important;
    }
    .dark .fi-sidebar-item-label {
        color: {{ $settings->sidebar_label_color_dark }} !important;
    }
    .dark .footer {
        background-color: {{ $settings->footer_color_bg_dark }} !important;
    }
    .dark .footer-text {
        color: {{ $settings->footer_label_color_dark }} !important;
    }
</style>
