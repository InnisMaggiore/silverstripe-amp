<?php
/**
 * Created by IntelliJ IDEA.
 * User: dave
 * Date: 8/9/18
 * Time: 12:53 PM
 */

class AmpSiteTreeShortCodeParser
{
    public static function link_shortcode_handler($arguments, $content = null, $parser = null) {
        if(!isset($arguments['id']) || !is_numeric($arguments['id'])) return;

        if (
            !($page = DataObject::get_by_id('SiteTree', $arguments['id']))         // Get the current page by ID.
            && !($page = Versioned::get_latest_version('SiteTree', $arguments['id'])) // Attempt link to old version.
            && !($page = DataObject::get_one('ErrorPage', array('"ErrorPage"."ErrorCode"' => 404)))   // Link to 404 page directly.
        ) {
            return; // There were no suitable matches at all.
        }

        $link = Convert::raw2att($page->Link());

        if ($page->hasMethod('isAmpified') && $page->isAmpified()) {
            return $link . 'amp.html';
        } else {
            return $link;
        }
    }
}
