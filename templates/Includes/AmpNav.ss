<amp-sidebar id="sidebar"
             layout="nodisplay"
             side="right">

    <amp-img class="amp-close-image"
             src="$CloseNavIconURL"
             width="20"
             height="20"
             alt="close sidebar"
             on="tap:sidebar.close"
             role="button"
             tabindex="0"></amp-img>
    <nav>
        <ul>
            <% loop $Menu(1) %>
                <% if $IsAmpified %>
                    <li class="$LinkingMode">
                        <a href="$AmpifiedURL" title="$Title.XML">$MenuTitle.XML</a>
                        <% if $Children %>
                            <ul class="secondary">
                                <% loop $Children %>
                                    <% if $IsAmpified %>
                                        <li class="<% if $isCurrent %>current<% else_if $isSection %>section<% end_if %>">
                                            <a href="$AmpifiedURL">$MenuTitle</a>
                                        </li>
                                    <% end_if %>
                                <% end_loop %>
                            </ul>
                        <% end_if %>
                    </li>
                <% end_if %>
            <% end_loop %>
        </ul>
    </nav>
</amp-sidebar>
