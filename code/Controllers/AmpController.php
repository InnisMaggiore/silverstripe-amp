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

    public function amp()
    {
        Requirements::clear();

        $class = Controller::curr()->ClassName;
        $page = $this->owner->renderWith(array("$class"."_amp", "Amp"));

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

    public function updateInit() {
        $should_redirect = false;  // of course you add your own condition here to decide whether to redirect or not

        if($this->owner->AmpContent == "" || $this->owner->AmpImageID ==""){
            $should_redirect = true;
        }

        if ($should_redirect) {
            $this->owner->redirectFromAmp();
        }
    }
}
