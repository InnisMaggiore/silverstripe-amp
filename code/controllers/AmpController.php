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
        if($this->getOwner()->hasMethod('IsAmplified') && !$this->getOwner()->IsAmplified()) {
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

    public function NavIconURL() {
        return $this->getIcon('hamburger.gif');
    }

    public function CloseNavIconURL() {
        return $this->getIcon('close.png');
    }

    private function getIcon($filename) {
        $docRoot = $_SERVER['DOCUMENT_ROOT'] . '/';
        $themeDir = $this->getOwner()->themeDir() . '/images/';

        if (file_exists($docRoot . $themeDir . $filename)) {
            return $themeDir . $filename;
        } else {
            return '/' . AMP_DIR . '/images/' . $filename;
        }
    }
}
