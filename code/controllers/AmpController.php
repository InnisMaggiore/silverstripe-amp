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
        if ($this->getOwner()->hasMethod('IsAmplified') && !$this->getOwner()->IsAmplified()) {
            return $this->redirectToNonAmp();
        }

        $supported = Injector::inst()
            ->get('AmpUtil')
            ->IsSupportedAmpClass($this->getOwner()->class);

        if (!$supported) {
            return $this->redirectToNonAmp();
        }
    }

    private function redirectToNonAmp() {
        $url = $this->getOwner()->request->getURL();
        if (strpos($url, 'amp') !== false) {
            $this->getOwner()->redirect($this->getOwner()->AbsoluteLink());
        }
    }

    public function amp()
    {
        Requirements::clear();
        ShortcodeParser::get_active()->unregister('sitetree_link');
        ShortcodeParser::get_active()->register('sitetree_link', ['AmpSiteTreeShortCodeParser', 'link_shortcode_handler']);

        $class = Controller::curr()->ClassName;
        $page = $this->getOwner()->renderWith(["$class"."_amp", "Amp"]);
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
            return '/' . $themeDir . $filename;
        } else {
            return '/' . AMP_DIR . '/images/' . $filename;
        }
    }

    // Maybe make this set-able in the YAML config so it's not so tied
    // to the way we manage GA account ids
    public function getGAAccountID() {
        $siteConfig = SiteConfig::current_site_config();
        return $siteConfig->GAAccount;
    }
}
