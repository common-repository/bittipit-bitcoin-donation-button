=== Bittip.It - Bitcoin Donation Button ===
Contributors: bpj50
Donate link: http://bittip.it
Tags: bitcoin, flickr, donate
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Version: 1.0.1

Adds a Bitcoin donation button (like on http://bittip.it) to your posts/pages.

Bittip.It Plugin

== Description ==

Enter your Bitcoin address via the settings page and choose whether you want it to appear on posts/pages. A button will appear and, when clicked, an iframe is loaded with a qr code allowing your readers to donate to you.

100% goes to you and does so directly.

== Installation ==
1. Install by uploading the file to your plugin directory.
2. Activate.
3. Configure settings


== Frequently Asked Questions ==

= How do I get a Bitcoin address =
A) For all Bitcoin related questions, please contact the internet

= Why is it showing the same counter on every page? = 
A) Bittip.It uses the Bitcoin address to count donations, not the url (like Flattr). Generate a new address if you want the counter to reset to 0.


== External Files ==
The plugin adds 4 externally hosted files to the DOM:

2 Image files
1 CSS File
1 (of two possible) Javascript files

https://bitcoinsberlin.com/wp-content/uploads/2013/01/button-loader.js

OR

http://bittip.it/cdn/button-loader.js

The files are identical. The file that is loaded depends on your protocol. If your site uses 'https' then the 'https' version must be loaded.

The button works like any normal web button including Twitter and Flattr buttons. You copy a code snippet into your project and when the project is run, CSS and Javascript is added to your head to activate the buttons.

The CSS is for styling the button. The Javascript performs several tasks.

= What the Javascript does = 
1) Loads the ammount of donations via an ajax function performed on "htt://bittip.it"
2) Attaches a click event to the button to open the iframe for donating
3) Creates the outer frame of the popup

While these files could be hosted on wordpress, it is neater if they are hosted off site as the majority of users will have copied the snippit directly from the site, opposed to installing the Wordpress plugin.

Full Support:
http://bittip.it/wordpress-plugin/

