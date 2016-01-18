=== Admin Bar Button ===
Contributors: duck__boy
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=3DPCXL86N299A
Tags: admin bar, admin, bar, jquery ui, jquery, ui, widget factory, widget, factory, plugin, button, toggle, duck__boy
Requires at least: 3.8
Tested up to: 4.3
Stable tag: 3.2.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Replace the default WordPress Admin Bar on the front end with a simple button.

== Description ==

Admin Bar Button is a plugin that will create a simple button to replace the default WordPress Admin Bar on the front end.
When using this plugin, the full height of the page is used by your site, which is particularly handy if you have fixed headers.
Please see the [Screenshots tab](http://wordpress.org/plugins/admin-bar-button/screenshots/ "Admin Bar Button &raquo; Screenshots") to see how the Admin Bar Button looks.

After activating the plugin, if you wish you can change how the Admin Bar Button looks and works by visiting the **Settings** page (*Settings &raquo; Admin Bar Button*).
However, **no user interaction is required** by the plugin; if you wish, you can simply install and activate Admin Bar Button and it'll work right away.

This plugin has been tested with the built in **Twenty Fourteen**, **Twenty Thirteen** and **Twenty Twelve** themes.
Should you find a theme with which it does not work, please open a new topic on the [Support tab](https://wordpress.org/support/plugin/admin-bar-button "Admin Bar Button &raquo; Support").

== Installation ==

= If you install the plugin via your WordPress blog =
1. Click 'Install Now' underneath the plugin name
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Job done!

= If you download from http://wordpress.org/plugins/ =

1. Upload the folder `admin-bar-button` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. That's it!

== Frequently Asked Questions ==

= Can I change how the Admin Bar Button looks and works? =

Yes, there are several settings that you can alter if you so wish.
To do this, simply visit the **Settings** page (*Settings &raquo; Admin Bar Button*), set the options as you wish them to be and click **Save Changes**

= What do all of the options mean? =

***The Admin Bar Button, added by this plugin***

* **Button Text:**		>  The text to display in the Admin Bar Button.  You can set this to anything you want, the button will resize appropriately.
* **Text Direction:**		>  The direction of the Admin Bar Button text.  Default is left-to-right, but you can use right-to-left if appropriate for you language.
* **Position on the Screen:**	>  Where on the screen to position the Admin Bar Button.  You can place the button in any of the four corners.  If you choose 'Bottom left' or 'Bottom right' then the WordPress Admin Bar will also be shown on the bottom of the screen.
* **Button Activated On:**	>  The actions that will activate the Admin Bar.  Currently you can choose between when the user clicks the button, when they hover over it, or both.
* **Animate:**			>  Whether or not to animate the show/hide of the Admin Bar Button.
* **Slide Duration:**		>  The time (in milliseconds) that it takes for the Admin Bar Button to slide off of the screen (and back on to it when the WordPress Admin Bar is hidden again).  Any positive value is acceptable, and setting it to '0' will disable the animation.
* **Slide Direction:**		>  The direction from which the Admin Bar Button will slide off of the screen (and back on to it when the WordPress Admin Bar is hidden again).  This option is irrelevant and so ignored if either 'Animate' is set to 'No' or 'Slide Duration' is set to '0'.

***The WordPress Admin Bar***

* **Reserve Space:**		>  Whether or not reserve space at the top of the page for the WordPress Admin Bar.
* **Animate:**			>  Whether or not to animate the show/hide of the WordPress Admin Bar.
* **Slide Duration:**		>  The time (in milliseconds) that it takes for the WordPress Admin Bar to slide on to the screen (and back off of it when the Admin Bar Button is shown again).  Any positive value is acceptable, and setting it to '0' will disable the animation.
* **Slide Direction:**		>  The direction from which the WordPress Admin Bar will slide on to the screen (and back off of it when the Admin Bar Button is shown again).  This option is irrelevant and so ignored if either 'Animate' is set to 'No' or 'Slide Duration' is set to '0'.
* **Admin Bar Behaviour:**	>  Whether the WordPress Admin Bar should close automatically after the time defined in 'Show Time', or remain open.
* **Show Time:**		>  The time (in milliseconds) that the Admin Bar will be visible for, when shown.  The minimum time is 2000 (2 seconds), and setting this option to less than that will result in the default being used.  This option is irrelevant and so ignored if either 'Admin Bar Behaviour' is set to 'Always remain open'.
* **Show the Hide Button:**	>  Whether or not to show the 'Hide' button on the WordPress Admin Bar.
* **Show the WordPress Menu:**	>  Whether or not to include the WordPress menu on the Admin Bar when it is shown.

***Colours***

* **Background Colour:**		> The background colour of the Admin Bar Button and the WordPress Admin Bar.
* **Background Colour (Hover):**	> The background hover hover colour of the Admin Bar Button and the WordPress Admin bar. Also changes the WordPress Admin Bar sub-menus background colour. Note that only the colour of buttons which are hovered will change, not the entire WordPress Admin Bar.
* **Text Colour:**			> The colour of the text for the Admin Bar Button and the WordPress Admin Bar.
* **Text Colour (Hover):**		> The hover colour of the text for the Admin Bar Button and the WordPress Admin Bar.

= What are the option defaults? =

***The Admin Bar Button, added by this plugin***

* **Button Text**		>  Admin bar
* **Text Direction**		>  Left to right
* **Position on the Screen**	>  Top left
* **Button Activated On**	>  Hover and click
* **Animate:**			>  Yes
* **Slide Duration**		>  500 milliseconds (0.5 seconds)
* **Slide Direction**		>  Left

***The WordPress Admin Bar***

* **Reserve Space:**		>  No
* **Animate:**			>  Yes
* **Slide Duration**		>  500 milliseconds (0.5 seconds)
* **Slide Direction**		>  Right
* **Admin Bar Behaviour:**	>  Hide after a defined time
* **Show Time**			>  5000 milliseconds (5 seconds)
* **Show the Hide Button:**	>  Yes
* **Show the WordPress menu:**	>  Yes

***Colours***

* **Background Colour:**		> #23282D
* **Background Colour (Hover):**	> #32373C
* **Text Colour:**			> #9EA3A8
* **Text Colour (Hover):**		> #00B9EB

= Can I prevent the Admin Bar Button and/or the Admin Bar being animated when it is shown or hidden? =

Yes, you simply have to set the **Slide Duration** option to **0**.
There is a separate option for both the **Admin Bar Button** and the **Admin Bar**, so you can animate only one or the other if you so choose.

= Can I restore the default settings? =

Of course. Simply visit the **Settings** page (*Settings &raquo; Admin Bar Button*), scroll to the bottom and click **Restore Defaults**.
You'll be asked to confirm that you wish to do this, and then all of the defaults will be restored.

== Screenshots ==

1. The minimised Admin Bar Button, shown when the Admin Bar is not active.
2. The regular Admin Bar, as shown here, is still available when the Admin Bar Button is clicked on or hovered over.
3. The 'Admin Bar Buttons' options of the plugin settings page.
4. The 'WordPress Admin Bar' options of the plugin settings page.
5. The 'Colours' options of the plugin settings page.

== Changelog ==

= 3.2.2 =
* Include transparency when changing the background and text colours of the Admin Bar Button and the WordPress Admin Bar

= 3.2.1 =
* Add colour options for background and text (including hover) for the Admin Bar Button and the WordPress Admin Bar

*Please visit the [FAQ tab](http://wordpress.org/plugins/admin-bar-button/faq/ "Admin Bar Button &raquo; "FAQ") if you have questions about the latest features.*

= 3.1.1 =
* Fix issue of front end scripts/styles being included when not logged in.

= 3.1 =
* Fix an issue where space reserved by the WordPress Admin Bar was still being added.
* Add a new option to allow the reservation of space by the WordPress Admin Bar if required.

= 3.0 =
* New 'Hide' button to the Admin Bar.
* Better control over the animations to show/hide the WordPress Admin Bar and the Admin Bar Button.
* New menu layout on the settings page in the Admin area.

= 2.2.1 =
* Fix a z-index issue that was causing the Admin Bar Button to be hidden behind fixed headers

= 2.2 =
* New option to choose the action upon which Admin Bar Button shows the WordPress Admin Bar; click and hover, click, or hover.
* The Admin Bar Button can now be positioned bottom left and bottom right, as well as top left and top right; the WordPress Admin Bar will also be moved to the bottom if the Admin Bar Button is placed there.
* The animation of the Admin Bar Button and the Admin Bar being shown/hidden is now optional.
* Added a 'Restore Defaults' button.
* Contextual help added to the settings page.

= 2.1.1 =
* Fix error where sometimes the space originally occupied by the admin bar was still being added to the page.

= 2.1 =
* **Critical Fix** - Fix a possible JS error when a visitor to the site is not logged in.
* Creation a text domain for future foreign language support.
* Updates to the FAQ's.

= 2.0 =
* New admin menu available for setting Admin Bar Button options; now there is no need to edit any JS or PHP to get the button the way you want it.
* Minor bug fix to the adminBar jQuery UI widget.

= 1.1 =
* Minor changes to function names to avoid possible clashes.
* Minor changes to the adminBar jQuery UI widget.
* Addition of screen shots.
* Updates to the FAQ's.
* Important update to the installation instructions.

= 1.0 =
* First release on the WordPress repository.

== Upgrade Notice ==

Now includes an option to hide the WordPress menu from the Admin Bar, as well as options for changing background and text colours of the Admin Bar Button and the WordPress Admin Bar (including transparency).