=== Staunch ===
Contributors: l3rady, robmiller
Tags: plugin, updates, themes, core, git, svn, version, control
Requires at least: 3.1
Tested up to: 3.5.1
Stable tag: 2.0

A WordPress plugin to prevent automatic updates on your live sites.

== Description ==

Automatic upgrades on live sites are, we think most people would agree,
a Bad Idea. You can't test them before they go live; they'll play havoc
with your version control system, if you're using one; and if they fail
or screw up, your live site is broken. Bad. Idea.

Enter Staunch. Staunch makes you stick to best practice for upgrades, by
preventing even admins and superadmins from running WordPress's
automatic upgrade processes on your live site.

When you want to upgrade WordPress, you can do so on a local or
development install of your site; after you've tested it and made sure
everything's okay, you can then deploy the site as you usually would
— through version control, FTP, or something else.

== Installation ==

* Install Plugin
* Activate plugin
* Place `define( 'CAN_UPDATE', true );` in the config file of your
  development site. Sites that don't have this line will be prevented
  from upgrading.

== Changelog ==

= 2.0 =
* Supports Multisite installs

= 1.0 =
* Initial release.
