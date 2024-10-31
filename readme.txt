=== Post Status Scheduler ===
Contributors: farne
Tags: posts, pages, categories, tags, postmeta, poststatus, change, schedule, scheduling
Requires at least: 3.9
Tested up to: 4.7.3
Stable tag: 1.3.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Change status, categories/tags or postmeta of any post type at a scheduled timestamp. 

== Description ==

Post Status Scheduler allows for scheduling of post status changes, category/tag adding or removing and 
removing of postmeta on any given date or time. It can be activated on any post type and shows 
up on the post edit screen in the publish section. From version 1.0.0 it has a feature for sending
an email notification to the post author on the scheduled update.

= Shortcodes =

* [pss_scheduled_time post_id="<your post id>"] can be used to get the post's scheduled date and time.

= Filters =
Scheduled Update:
* post_status_scheduler_before_execution
* post_status_scheduler_after_execution

Email Notification ( version 1.0.0 ):
* post_status_scheduler_email_notification_recipient_email
* post_status_scheduler_email_notification_subject
* post_status_scheduler_email_notification_date
* post_status_scheduler_email_notification_body

== Installation ==

1. Upload `post-status-scheduler` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure the Post Status Scheduler in Settings > Post Status Scheduler menu.

== Screenshots ==

1. Settings page.
2. Edit page with no options activated.
3. Edit page without post meta option activated.
4. Edit page with post meta option activated.
5. Edit page with email notification option.

= What Translations are included? =

* English
* Swedish

== Changelog ==

= 1.3.1 =
* Bugfix for language translation.

= 1.3.0 =
* New feature to schedule sticky posts or schedule unsticking of post.

= 1.2.11 =
* Fixed bug on when creating new posts and no previous post object exists.
* Fix so loading of jquery ui is managed through https.

= 1.2.9 =
* Fixed bug where previous scheduled time was not fetched properly
* Fixed bug where if no tag taxonomies where found, tags from other taxonomies where showed in dropdown. This was on custom post types.

= 1.2.7 =
* Add option on settings page to show just tags or categories when scheduling.
* Add optgroups for categories and tags in dropdown.
* Fixed bug where email and extra column option where always checked on the first save.

= 1.0.5 =
* Bugfix to make the make it possible to chose month even though there are multiple datepickers on the same page.

= 1.0.4 =
* Both tags and categories are now changed correctly. Previously tags were changed to their id and not the name.
* Changing categories and tags now work on custom posttypes. There seems to have been a bug here before even though not reported.

= 1.0.2 = 
* Fixed to use the correct textdomain. Translations should now work correctly.

= 1.0.1 =
* Fixed bug where, in settings, you could only choose public post types to show scheduler on (Reported on Github).

= 1.0.0 =
* New feature for sending email notification to post author when executing a scheduled update.
* New feature makes it possible to show/remove the "Scheduled date" column on posttype edit page.
* Code cleanup.

= 0.3.0 =
* Rewritten plugin to support setting multiple categories on scheduled time. I have tried to make sure that it will still work with previously scheduled changes in previous versions of the plugin.
* A little bit of code clean up and refactoring.

= 0.2.1 = 
* Added shortcode for getting the date and time for the scheduled post change

= 0.1.1 =
* Removed unnecessary assets folder.

= 0.1 =
* Initial version

== Upgrade Notice ==

= 1.3.1 =
* This fix is only necessary if using other language than english. There was a broken translation string.

= 1.3.0 =
* If you wish to have the possibility to schedule sticky posts or unsticking of sticky posts then 1.3.0 is for you.

= 1.2.11 =
* Now loads jquery ui through https.

= 1.2.7 =
* It is now possible to display either both categories and tags or just one of them in the dropdown when scheduling a change.
* There is now optgroups in dropdown to make it easier to separate the terms.

= 1.0.5 =
* If you have problems with picking a month in the datepicker, 1.0.5 will fix this issue. It was a problem with multiple datepickers included from other plugins on the same page. Mainly ACF it seems. The theme of the datepicker is still overridden. The functionality however is ok.

= 1.0.4 = 
* Upgrade to this version to keep tags from being set to their id instead of the name.
* Now works correctly with custom post types.

= 1.0.2 =
* Upgrade to this version to get translations to work 100%.

= 1.0.1 =
* Gives you more post types to choose from.
