<% if $getGAAccountID %>
    <amp-analytics type="googleanalytics">
        <script type="application/json">
            {
                "vars": {
                    "account": "$getGAAccountID"
                },
                "triggers": {
                    "trackPageview": {
                        "on": "visible",
                        "request": "pageview"
                    }
                }
            }
        </script>
    </amp-analytics>
<% end_if %>
