<?php

/**
 * Created by PhpStorm.
 * User: rick
 * Date: 2015-12-15
 * Time: 12:25 PM
 */
class AmpSiteTreeExtension extends SiteTreeExtension
{

    public function MetaTags(&$tags)
    {
        if ($this->owner->AmpContent != "" && $this->owner->AmpImageID != "") {

            if ($this->owner->class != "HomePage") {
                $ampLink = $this->owner->AbsoluteLink() . "amp.html";
            } else {
                $ampLink = $this->owner->AbsoluteLink() . "home/" . "amp.html";
            }

            $tags .= "<link rel='amphtml' href='$ampLink' /> \n";
        }

    }
}
