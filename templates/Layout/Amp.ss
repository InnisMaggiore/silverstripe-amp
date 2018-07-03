<article>
    <% if $AmpImageForTemplate %>
        <amp-img src="$AmpImageForTemplate.URL"
                 width="$AmpImageForTemplate.getWidth()"
                 height="$AmpImageForTemplate.getHeight()"
                 layout="responsive"
                 alt="$AmpImageForTemplate.Title"></amp-img>
    <% end_if %>
    <div class="content-container">
        <% if $AmpHeaderForTemplate %>
            <h1>$AmpHeaderForTemplate</h1>
        <% end_if %>

        $AmpContentForTemplate
    </div>
</article>
