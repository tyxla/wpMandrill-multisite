wpMandrill Multisite
====================

### About

Automatically propagates the wpMandrill settings from the main site to all subsites, still allowing each subsite to manually override them.

### Installation

1. Make sure you have the wpMandrill plugin installed and activated.
1. Install wpMandrill Multisite either via the WordPress.org plugin directory, or by uploading the files to your server.
1. Activate the plugin.
1. That's it. You're ready to go!

### Getting Started

Go to Settings -> Mandrill and setup at minimum your API key, FROM name and FROM email. This will have your Mandrill plugin enabled and connected. This is all that is necessary for the wpMandrill Multisite plugin to work. These settings will now be automatically be propagated to the subsites that have no Mandrill settings. You can then manually override them for each site, if you prefer. 

### Further customization for developers

The plugin offers several hooks that allow developers to modify the default plugin behavior.

#### wpmandrill\_multisite\_site\_id

**$site_id** *(int)*. The ID of the current site.

This filter allows you to modify the ID of the current site. Unless the network is a multi-network (a network of multisite networks), this will usually be `1`.

#### wpmandrill\_multisite\_propagation

**$propagate** *(bool)*. Whether the settings should be propagated.

**$blog_id** *(int)*. The ID of the currently iterated blog. Allows custom logic to be built.

This filter allows you to specify whether the wpMandrill settings should be propagated to the subsites. Using the `$blog_id` you can build a custom logic to disable propagation only for a certain blog. Or if you ignore `$blog_id`, you can globally disable the propagation.

#### wpmandrill\_multisite\_settings

**$mandrill_settings** *(array)*. An array of all wpMandrill settings that will be propagated.

**$blog_id** *(int)*. The ID of the currently iterated blog. Allows custom logic to be built.

This filter allows you to modify the wpMandrill settings that will be propagated to the subsites. Using `$blog_id`, you can use custom logic to change the settings only for a certain blog.