<?php

/**
 * Google AMP Pages
 *
 * Renders Pages conforming to Google's AMP HTML stnadard
 *
 *
 * @package amp
 */

use Lullabot\AMP\AMP;
use Lullabot\AMP\Validate\Scope;

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
        $page = $this->fixImageTags($page);
        return $this->AmplfyHTML($page);
    }

    public function AmplfyHTML($html)
    {
        if (!$html) {
            return false;
        }

        $amp = new AMP();

        $amp->loadHtml($html, ['scope' => Scope::HTML_SCOPE]);

        $amp_html = $amp->convertToAmpHtml();

        return $amp_html;
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

    private function fixImageTags($html){
        preg_match_all('/<img[^>]+>/i', $html, $images);
        foreach ($images[0] as $image) {
            preg_match("/src\s*=\s*\"(.+?)\"/i", $image, $matches);
            $src = $matches[1];

            if (strpos($src,"http") !== 0 && strpos($src,"/") !== 0) {
                $newImage = str_replace($src, "/".$src, $image);
                $html = str_replace($image, $newImage, $html);
            }
        }

        return $html;
    }
}
