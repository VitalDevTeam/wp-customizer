# WordPress Customizer

Adds font and color settings to the WordPress Customizer.

## Customizer Panels

### Fonts

Select fonts for headings and body text.

### Colors

Select colors for major theme elements as well as 12 custom colors. Custom colors 1 and 2 act as the primary and secondary CTA colors respectively.

## Helper Functions

* **`vtl_get_custom_logo()`** Gets the logo that has been set in the Site Identity panel in the Customizer.
* **`vtl_the_custom_logo()`** Prints the logo that has been set in the Site Identity panel in the Customizer.
* **`vtl_get_theme_colors()`** Gets the current theme color settings.

## How the fonts work

The fonts available in the Customizer are defined in `includes/customizer/fonts.php`. Create your list of fonts by adding them as items in the `font_choices` array.

**The array item key** should be equal to the Google Font's stylesheet URL parameters. Basically, everything after the `?` in the URL. For example, the stylesheet URL for Lato Regular and Bold is `https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap`. This means the item key should be `Lato:wght@400;700&display=swap`

**The array item value** should be the name of the font. For example, `Lato`. This is used for display in the fonts dropdowns but also in the `font-family` CSS rules.

```
$this->font_choices = [
	'Lato:ital,wght@0,300;0,400;0,700;1,400;1,700&display=swap'   => 'Lato',
	'Merriweather:ital,wght@0,400;0,700;1,400;1,700&display=swap' => 'Merriweather',
];
```

## How the colors work

The color pickers in the Customizer are defined in `/includes/config.php`. These colors are then registered as Customizer fields in `includes/customizer/colors.php`.

Like all Customizer settings, the values of the color fields are saved in the database as theme modifications (mods) rather than in the options table. These are retrieved using [`get_theme_mod`](https://developer.wordpress.org/reference/functions/get_theme_mod/).

If a color field has a value, inline CSS is printed into the site’s head. This is done via the `enqueue_styles` function in `includes/customizer/colors.php`.

### Using the colors on your elements

You have two options to add these Customizer colors to your elements.

#### Option 1: Use the default inline class

Each color field produces an inline CSS rule in the site’s head. Add these classes to your elements to inherit the default styling.

Each Custom Color field produces a set of three CSS classes you can use:

* `.has-custom-color-x` – Sets the `color` property.
* `.has-custom-background-color-x` – Sets the `background-color` property.
* `.has-custom-fill-color-x` – Sets the `fill` property.

Custom Colors 1 and 2 set the following two CSS classes that you can use on a standard button-style CTA:

* `.primary-cta` Styles the CTA button with a solid background color.
* `.secondary-cta` Styles the CTA button with a color outline and no background color.

#### Option 2: Add your own inline styles and/or classes

To do this you will use the `enqueue_styles` function in `includes/customizer/colors.php`.

1. Locate the appropriate theme mod block in `includes/customizer/colors.php`.
2. You can do two things here:
   * Add your custom CSS class to the list of existing classes in the first argument of `vtl_generate_css`.
   * Add a new item to the `$inline_style` array using the `vtl_generate_css` function. This will generate a new inline CSS rule in the site’s head exactly how you need it.

**DO NOT use inline styles for all of your CSS!** The inline styles are only intended to let you customize the site’s basic global color scheme. For custom layouts and features that have their own color schemes and styles, use the theme’s stylesheets as usual along with the existing CSS classes provided.
