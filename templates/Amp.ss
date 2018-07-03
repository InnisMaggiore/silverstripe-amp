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
    </head>
    <body>
        <% if $SiteConfig.AmpLogo %>
            <div class="logo-container">
                <amp-img src="$SiteConfig.AmpLogo.URL"
                     width="$SiteConfig.AmpLogo.getWidth()"
                     height="$SiteConfig.AmpLogo.getHeight()"
                     layout="responsive"
                     alt="$SiteConfig.AmpLogo.Title"></amp-img>
            </div>
        <% end_if %>
        $Layout
    </body>
</html>
