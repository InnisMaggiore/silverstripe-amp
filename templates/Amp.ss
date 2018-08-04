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
    </head>

    <body>
        <% include AmpNav %>

        <div class="top-container">
            <% if $SiteConfig.AmpLogo %>
                <div class="logo-container">
                    <amp-img src="$SiteConfig.AmpLogo.URL"
                         width="$SiteConfig.AmpLogo.getWidth()"
                         height="$SiteConfig.AmpLogo.getHeight()"
                         layout="responsive"
                         alt="$SiteConfig.AmpLogo.Title">
                    </amp-img>
                </div>
            <% end_if %>
            <div class="hamburger">
                <a href="#" on="tap:sidebar.toggle">
                    <amp-img
                        src="$NavIconUrl"
                        width="30"
                        height="30"
                        alt="Navigation">
                    </amp-img>
                </a>
            </div>
        </div>

        $Layout
    </body>
</html>
