=== f(x) Share ===
Contributors: turtlepod
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=TT23LVNKA3AU2
Tags: comments, spam
Requires at least: 4.3
Tested up to: 4.7
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple sharing plugin. Easily add Facebook, Twitter, and Google+ share button to your content.

== Description ==

f(x) Share is a very simple sharing plugin. You can easily add Facebook, Twitter, and Google+ share button to your content.

After installation of this plugin, you can configure where to display and reorder your sharing buttons via the "Customizer" page under the "Appearance" menu where you can see the changes live before you save them.

**Features:**

1. Easily disable/enable sharing item and reorder it.
1. Hide/display in post/page or any post type (custom post types are supported).
1. Hide/display in archive page and single page.
1. Customizer: See it live before saving the settings.
1. Extendable and fully documented (read the Dev Notes).
1. The GPL v2.0 or later license. :) Use it to make something cool.
1. Support available at [Genbu Media](https://genbu.me/contact-us/).


== Installation ==

1. Navigate to "Plugins > Add New" Page from your Admin.
2. To install directly from WordPress.org repository, search the plugin name in the search box and click "Install Now" button to install the plugin.
3. To install from plugin .zip file, click "Upload Plugin" button in "Plugins > Add New" Screen. Browse the plugin .zip file, and click "Install Now" button.
4. Activate the plugin.
5. Navigate to "Appearance > Customize" page in your admin panel to manage the plugin settings.

== Frequently Asked Questions ==

= Where is the settings ? =

The settings in in the customizer page (Appearance > Customize) in the "Sharing" section.

= How to disable the CSS? =

This plugin have no option to disable CSS. If you want to disable the CSS you need to dequeue the stylesheet. Read the "Dev Notes" section for more info.

= How to manually place the share button in template ? =

You can use the `fx_share();` function. Please read the "Dev Notes".

== Screenshots ==

1. Customizer setting.

== Changelog ==

= 1.0.0 - 7 Jan 2015 =
* Add readme. Change description.

= 0.1.0 =
* First relase.

== Upgrade Notice ==

= 1.0.0 =
Maintenance relase.

== Dev Notes ==

Notes for developer: 

= Github =

Development of this plugin is hosted at [GitHub](https://github.com/turtlepod/fx-share). Pull request and bug reports are welcome.

= Options =

This plugin save the options in single option name: `fx_share`. To read more about the data structure you can read this tutorial:

[How to Create Sortable Checkboxes Option in Customizer](https://shellcreeper.com/how-to-create-sortable-checkboxes-option-in-customizer/)

= Scripts =

This plugin load two CSS in site front-end.

* `fx-share-icon` is the icon font.
* `fx-share` is the stylesheet.

Both are loaded using `fx_share_scripts` function hooked to `wp_enqueue_scripts` at default priority (10). To remove the default CSS, you can use this code in theme `functions.php`:

`remove_action( 'wp_enqueue_scripts', 'fx_share_scripts' );
`

= Hooks =

List of hooks available in this plugin:

**filter:** `fx_share_post_types` (array)

List of post types in the checkbox option. You can remove or add post types in the list. As default it will list all public post types.

**filter:** `fx_share_services` (array)

List of supported sharing provider. As default it support facebook, google plus, and twitter. It's a multi dimentional array, with array key as the service ID, each item has `id`, `label`, and `callback` node.

**filter:** `fx_share` (string)

The HTML output of the share buttons.

**filter:** `fx_share_display` (bool, default: true)

Control the default excerpt and content filter. Set it to **false** to disable excerpt and content filter. Useful if you need to manually place the share button in template using `<?php echo fx_share(); ?>` function.
