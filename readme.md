# SilverStripe AMP HTML
Converts pages to Google Amp HTML. For more information about AMP HTML see [Google AMP Project Homepage](https://www.ampproject.org).

## Requirements
* SilverStripe 3.6.x

## Installation
**Composer (recommended):**

`composer require innis-maggiore/silverstripe-amp`

If you prefer you may also install manually:

* Download the module from here LINK
* Extract the downloaded archive into your site root so that the destination folder is called silverstripe-amp, opening the extracted folder should contain _config.php in the root along with other files/folders
* Run dev/build?flush=all to regenerate the manifest

##  Usage
The module automatically adds a link to your MetaTags pointing to the AMP HTML version of the page `http://yousite.com/page-name/amp.html`.

A custom controller then renders your content using an AMP HTML version of the Page Template. `<img />` tags are automatically converted to `<amp-img />` before render.

A logo can be set in the "Settings" under the AMP tab. Recommendation for AMP logo size came from [here](https://medium.com/relay-media/amp-logo-best-practices-b096933dbc19) 

There are three basic content fields that can appear on every page (aside from the logo mentioned above)
- An image
- An H1
- Body Copy

These fields can set manually at the page level in the "Amp Content" drawer or specified per template in the using this in the
page model (the class that extends SiteTree, not the controller):

```
    private static $amp_fields = [
        'AmpImage'   => 'MyImageFieldName',
        'AmpHeader'  => 'H1',
        'AmpContent' => 'Content'
    ];
```

Note that the field on the left is used in the AMP template and the field on the right is a field in your template.

### Themes and Custom Page Types

The base Page type is `Amp.ss`, which can be overridden in your theme like any SilverStripe Template. Custom Page Types can be rendered using `ClassName_amp.ss` in your theme.

## To Do
This is an initial commit as proof of concept as such
* Add Base Styling to Match Simple Theme
* Create Modular Schema System
* Add Configurable Scripts for Common Amp Components

