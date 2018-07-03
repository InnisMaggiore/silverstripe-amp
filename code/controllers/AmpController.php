<?php

/**
 * Google AMP Pages
 *
 * Renders Pages conforming to Google's AMP HTML stnadard
 *
 *
 * @package amp
 */

class AmpController extends Extension
{
    private static $allowed_actions = array('amp');

    private static $url_handlers = array(
        'amp.html' => 'amp'
    );

    public function onAfterInit() {
        // if no amp content, redirect to original page
        if($this->getOwner()->hasMethod('AmpContentForTemplate')
            && $this->getOwner()->AmpContentForTemplate() == "") {

            $url = $this->getOwner()->request->getURL();
            if (strpos($url, 'amp') !== false) {
                $this->getOwner()->redirect($this->getOwner()->AbsoluteLink());
            }
        }
    }

    public function amp()
    {
        Requirements::clear();

        $class = Controller::curr()->ClassName;
        $page = $this->owner->renderWith(["$class"."_amp", "Amp"]);

        return $this->AmplfyHTML($page);
    }

    public function AmplfyHTML($content)
    {
        if (!$content) {
            return false;
        }

        $content = preg_replace('/style=\\"[^\\"]*\\"/', '', $content);
        $content = str_replace("<img", "<amp-img", $content);

        return $content;
    }
}
