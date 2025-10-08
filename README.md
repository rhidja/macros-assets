# Macros Assets Bundle

![GitHub release (latest SemVer)](https://img.shields.io/github/v/release/rhidja/macros-assets?style=flat-square)
![GitHub issues](https://img.shields.io/github/issues/rhidja/macros-assets?style=flat-square)
![GitHub license](https://img.shields.io/github/license/rhidja/macros-assets?style=flat-square)

**A Symfony bundle for registering and rendering Twig macro assets in your templates.**

## Table of Contents

* [Description](#description)
* [Installation](#installation)
* [Usage](#usage)
* [Contributing](#contributing)
* [License](#license)

## Description

This bundle allows to track Twig macros usage at runtime across your Symfony application,
so CSS and JS can be loaded dynamically depending on the macros used in the rendered template.

## Installation

### Requirements

* Symfony 6.0 or higher
* PHP 8.1 or higher

### Step 1: Add the project repository

In the main `composer.json`, add:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/rhidja/macros-assets.git"
    }
]
```

### Step 2: Install via Composer

```bash
composer require rhidja/macros-assets
```

### Step 3: Register the bundle

Add the bundle to your `config/bundles.php` file:

```php
return [
    // ...
    Rahid\MacrosAssets\RahidMacrosAssets::class => ['all' => true],
];
```

### Step 4: Configure macros

Create `config/packages/macros_assets.yaml`:

```yaml
rahid_macros_assets:
    input:
        css:
            - build/css/style-1.css
            - https://style-2.css
        js:
            - build/js/script-1.js
            - build/js/script-2.js
    textarea:
        css:
            - build/css/style-3.css
            - https://style-4.css
        js:
            - build/js/script-5.js
            - build/js/script-3.js
```

## Usage

### Define your macros with logging

```twig
{# templates/macros/form_macros.twig #}

{% macro input(name, value = '', type = 'text') %}
    {{ _log_macro('input') }}
    <input type="{{ type }}" name="{{ name }}" value="{{ value }}">
{% endmacro %}

{% macro textarea(name, value = '') %}
    {{ _log_macro('textarea') }}
    <textarea name="{{ name }}" id="{{ name }}" cols="30" rows="10">{{ value }}</textarea>
{% endmacro %}
```

### Use macros in your template

```twig
{% import 'macros/form_macros.twig' as forms %}

<form method="post">
    {{ forms.input('username') }}
    {{ forms.textarea('description') }}
    <button type="submit">Submit</button>
</form>
```

### Render assets after all macros are called

Place this at the end of your layout (after all macro calls):

```twig
{{ render_assets() }}
```

This will dynamically insert the CSS and JS associated with the macros used in the template.

## Contributing

Contributions are welcome! To propose improvements or report issues, please open an issue or submit a pull request.

## License

This project is licensed under the **MIT License** – see the [LICENSE](LICENSE) file for details.
