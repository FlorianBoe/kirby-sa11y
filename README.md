# Kirby Sa11y

## Overview

This plugin is a tiny wrapper to easily add a user-friendly automatic content accessibility checker to the frontend of a website built with [Kirby CMS](https://getkirby.com/).

The plugin integrates [Sa11y](https://sa11y.netlify.app/). Sa11y is specifically developed to assist content editors to not break a site's accessibility as they create content and is not full-fledged accessibility validators, but tools that nudge editors to follow accessibility guidelines.

## Installation

Download and copy this repository to `/site/plugins/kirby-sa11y`

<!-- Or use Composer:

```bash
composer require florianboegner/kirby-sa11y
``` -->

Or install as Git submodule

```bash
git submodule add https://github.com/FlorianBoe/kirby-sa11y site/plugins/kirby-sa11y
```

## Setup

There is only one step needed to get started. Add the following to the template or snippet rendering the end of your HTML body (like `site/snippets/footer.php` in the Kirby Starterkit, for example), just before the closing `</body>` tag:

```php
<?= snippet('sa11y') ?>
```

This will render the required `<script>` and `<style>` tags to include the checker tool in the page; by default, one of the two tools is chosen at random – think of it as a kind of "tryout" mode (while pretty similar, both tools have different UI and feature sets, so this might be handy to find your preferred solution).

The tool is only displayed when loading a web page as a logged-in user – careful if Kirby's built-in page cache is in use; you may want to disable page caching for logged-in users.

You should now be ready to go – make sure you are logged in to your Kirby website and open any page on the frontend that is rendered using the template/snippet with this code.

## Configuration

Additional configuration variables can be included in the snippet call to customize the setup. The `$data` variable is expected to be an associative array, as with any other [Kirby snippet](https://getkirby.com/docs/reference/templates/helpers/snippet):

```php
<?= snippet('sa11y', $data) ?>
```

### Template limitation

By default, the checker tool is shown on every page that contains the template with this snippet. To limit, you may hand an array of template names to the snippet:

| Value | Description |
|-------|-------------|
| `templates` => array | An array of template IDs that will include the checker tool, e.g. `'templates' => ['article']` |

### Access control

By default, the checker tool is shown to every logged-in user. You can limit this further by setting one of the following arrays in the `$data` variable:

| Value | Description |
|-------|-------------|
| `'users' => ` array | An array of user IDs that will see the checker tool, e.g. `'users' => ['ascd1234', 'b2cy82t5']` |
| `'roles' => ` array | An array of user roles that will see the checker tool, e.g. `'roles' => ['admin']` |

For example, a complete setup with template and access limitations could look like this:

```php
<?= snippet('sa11y', [
  'templates' => ['article', 'note'],
  'roles'     => ['admin', 'leadeditor'],
]) ?>
```

### Script options

To override selected default settings of the checker script, overwrite them using the options array:


Or, to override the Sa11y default prop `checkRoot` (the DOM scope the checker examines) from its default value of `body` to `main`, use:

```php
<?= snippet('sa11y', [
  'options'  => [
    'checkRoot' => 'main',
  ],
]) ?>
```
Take a look at the various config variables of both scripts – they each enable a great (but different) amount of customization, from including/excluding certain areas to other interface settings.

An array of properties for Sa11y; see https://sa11y.netlify.app/developers/props/

Probably the most important setting is the limitation of the tested area to a specific DOM element (e.g. to only target the area that can be edited by authors, not the rest of page, usually rendered from fixed templates); default is the entire `body`:

| Option |
|-------|
| `'checkRoot' => 'main'` |

## Credits

This plugin is merely a reduced fork of [kirby-a11yprompter](https://codeberg.org/sebastiangreger/kirby-a11yprompter) by [Sebastian Greger](https://sebastiangreger.net) a little helper to easily embed different accessibility checkers into websites built with Kirby 3.

## License

Kirby sa11y is open-sourced software licensed under the [GPLv2 license](https://www.gnu.org/licenses/old-licenses/gpl-2.0.html). Sa11y is licensed under the [MIT license](https://opensource.org/license/MIT), which is permitting inclusion in GPLv2-licensed software.

It is discouraged to use this plugin in any project that promotes the destruction of our planet, racism, sexism, homophobia, animal abuse, violence or any other form of hate speech.