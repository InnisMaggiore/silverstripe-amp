<!doctype html>
<html ⚡ lang="$ContentLocale">

    <head>
        <meta charset="utf-8">
        <title>$Title</title>
        <link rel="canonical" href="$AbsoluteLink" />
        <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
        <% include AmpSchema %>
        <% include AmpStyle %>
        <script async src="https://cdn.ampproject.org/v0.js"></script>
        <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
        <script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
        <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
        <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
        <% include AmpCustomScripts %>
    </head>

    <body>
        <% include AmpNav %>

        <div class="top-container">
            <% if $SiteConfig.AmpLogo %>
                <% include AmpLogo %>
            <% end_if %>
            <div class="hamburger">
                <% include AmpNavToggle %>
            </div>
        </div>

        <% include AmpBelowNav %>

        $Layout

        <% include AmpAnalytics %>
    </body>
</html>
