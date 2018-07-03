<?php
/**
 * Created by IntelliJ IDEA.
 * User: dave
 * Date: 7/3/18
 * Time: 1:15 PM
 */

class AmpGlobalConfig extends DataExtension
{
    private static $has_one = [
        'AmpLogo' => 'Image'
    ];

    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldToTab("Root.AMP", new UploadField('AmpLogo', 'AMP Logo (Should be 60x600 px)'));
    }
}
