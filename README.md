# Kirby Analytics Plugin Readme

![Version](https://img.shields.io/badge/version-1.0.0-green.svg) ![License](https://img.shields.io/badge/license-MIT-green.svg) ![Kirby Version](https://img.shields.io/badge/Kirby-2.5.5%2B-red.svg)

*Version 1.0.0*

Plugin for Kirby CMS to add all kinds of analytics services with different options. [Google Analytics](https://www.google.de/analytics/), [Piwik](https://piwik.org/), [Open Web Analytics](http://www.openwebanalytics.com/) and [Mixpanel](https://mixpanel.com/). With the default option to honor [Do Not Track](http://donottrack.us/) Opt Outs.

## Installation

Use one of the alternatives below.

### 1. Kirby CLI

If you are using the [Kirby CLI](https://github.com/getkirby/cli) you can install this plugin by running the following commands in your shell:

```
$ cd path/to/kirby
$ kirby plugin:install l4ci/kirby-analytics-plugin
```

### 2. Clone or download

1. [Clone](https://github.com/l4ci/kirby-analytics-plugin.git) or [download](https://github.com/l4ci/kirby-analytics-plugin/archive/master.zip)  this repository.
2. Unzip the archive if needed and rename the folder to `analytics`.

**Make sure that the plugin folder structure looks like this:**

```
site/plugins/analytics/
```

### 3. Git Submodule

If you know your way around Git, you can download this plugin as a submodule:

```
$ cd path/to/kirby
$ git submodule add https://github.com/l4ci/kirby-analytics-plugin site/plugins/analytics
```

## Setup

### 1. Blueprint

To make it work as expected, add the following code to your blueprints, where you want the analytics options to show up in the panel.

```
fields:
  analytics:
    extends: analytics
```

### 2. Snippet

Add the following code to your `footer.php` snippet (or the fitting one) just before your closing`</body>`.

```php
snippet('analytics');
```


### 3. Config

Enable the plugin by adding the following to your `site/config/config.php` and choose a service below.

```php
c::set('analytics', true);
```

## Services

The following services can be set in your `/site/config/config.php` file:

```php
// En/disable the whole plugin
//  - Disabled by default
c::set('analytics', true);

// Track logged in users
// - Disabled by default
c::get('analytics.trackloggedinuser', false);

// Google Analytics
c::get('analytics.google'             , false);
c::get('analytics.google.ua'          , false);
// Anonymize Ip Adresses
// - Enabled by default
c::get('analytics.google.anonymizeip' , true);

// Piwik
c::get('analytics.piwik'     , false);
c::get('analytics.piwik.url' , false);
c::get('analytics.piwik.id'  , false);

// Open Webanalytics
c::get('analytics.owa'     , false);
c::get('analytics.owa.url' , false);
c::get('analytics.owa.id'  , false);

// Mixpanel
c::get('analytics.mix'       , false);
c::get('analytics.mix.token' , false);

// Honor Do Not Track Opt Outs
// <http://donottrack.us/>
// - Enabled by default
c::get('analytics.dnt', true);

```

## Usage

Once the snippets and blueprints are added, and the plugin is enabled and configured in your `config.php`, your analytics service of choice should be filling up with data.


## Changelog

**1.0.0**

- Initial release

## Todo

- [x] Piwik support
- [x] Google Analytics support
- [x] add optout function for google analytics
- [x] Mixpanel support
- [x] Open Web Analytics support
- [x] Honor Do Not Track header
- [x] add option to disable analytics on page level
- [ ] add neutral event tracking function
- [ ] add optout for piwik
- [ ] add optout link as field for piwik
- [ ] add optout link as field for google analytics


## Requirements

- [**Kirby**](https://getkirby.com/) 2.5.5+

## Disclaimer

This plugin is provided "as is" with no guarantee. Use it at your own risk and always test it yourself before using it in a production environment. If you find any issues, please [create a new issue](https://github.com/l4ci/kirby-analytics-plugin/issues/new).

## License

[MIT](https://opensource.org/licenses/MIT)

It is discouraged to use this plugin in any project that promotes racism, sexism, homophobia, animal abuse, violence or any other form of hate speech.
