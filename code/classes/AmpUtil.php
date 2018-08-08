<?php
/**
 * Created by IntelliJ IDEA.
 * User: dave
 * Date: 8/8/18
 * Time: 11:57 AM
 */

class AmpUtil
{
    public function IsSupportedAmpClass($className) {
        $unsupportedClasses = Config::inst()->get('AmpSiteTreeExtension', 'unsupported');

        $unsupported = array_search(
            $className,
            $unsupportedClasses
        );

        return $unsupported === false;
    }
}
