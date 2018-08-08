<?php

class AmpSiteTreeExtension extends SiteTreeExtension
{

    private static $db = array(
        'AmpHeader'     => 'Varchar',
        'AmpContent'    => 'HTMLText'
    );

    private static $has_one = array(
        'AmpImage'  => 'Image'
    );

    public function updateCMSFields(FieldList $fields) {
        if (!$this->IsAmpified()) {
            return;
        }

        $children = [
            new TextField("AmpHeader"),
            new HtmlEditorField("AmpContent", "AMP Content"),
            new UploadField("AmpImage", "AMP Image")
        ];

        $fields->addFieldToTab("Root.Main", new ToggleCompositeField("AMPContentSection", "AMP Content Section", $children));
    }

    public function MetaTags(&$tags)
    {
        if ($this->AmpContentForTemplate() != "") {

            if ($this->owner->class != "HomePage") {
                $ampLink = $this->owner->AbsoluteLink() . "amp.html";
            } else {
                $ampLink = $this->owner->AbsoluteLink() . "home/" . "amp.html";
            }

            $tags .= "<link rel='amphtml' href='$ampLink' /> \n";
        }
    }

    /*
     * Precedence:
     * 1.) fields in Amp Content Drawer
     * 2.) fields defined in the specific page type class's $amp_fields array
     * 3.) fields defined in any page type inherited from that has $amp_fields set
     * 4.) empty
     */
    public function AmpContentForTemplate() {
        return $this->TextFieldForTemplate('AmpContent');
    }

    public function AmpHeaderForTemplate() {
        return $this->TextFieldForTemplate('AmpHeader');
    }

    private function TextFieldForTemplate($field) {
        $content = $this->owner->$field;

        if (!empty($content)) {
            return $content;
        }

        $fields = Config::inst()->get($this->owner->class,
            'amp_fields',
            Config::INHERITED
        );

        if ($fields != null && !empty($fields[$field])) {
            $fieldName = $fields[$field];

            # ehhh
            return ShortcodeParser::get_active()
                ->parse($this->owner->$fieldName);
        }
    }

    /***
     * @return DataObject|Image
     */
    public function AmpImageForTemplate() {
        $imageID = $this->owner->AmpImageID;
        if ($imageID) {
            return Image::get()
                ->byId($imageID);
        }

        $fields = Config::inst()->get($this->owner->class,
            'amp_fields',
            Config::INHERITED
        );

        if ($fields != null && !empty($fields['AmpImage'])) {
            $fieldName = $fields['AmpImage'] . 'ID';
            $imageID = $this->owner->$fieldName;
            return Image::get()
                ->byId($imageID);
        }
    }

    public function IsAmpified() {
        return Injector::inst()->get('AmpUtil')
            ->IsSupportedAmpClass($this->getOwner()->class) && $this->AmpContentForTemplate() != "";
    }

    public function AmpifiedURL() {
        return $this->owner->Link() . 'amp.html';
    }
}
