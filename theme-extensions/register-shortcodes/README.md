# Register Extensible Custom Shortcodes

This snippet registers WordPress Custom Shortcodes using filterable arrays. Other plugins or themes can modify the shortcodes list and their attributes using the `maverick_register_shortcodes` filter and individual shortcode attribute filters.

## 📌 Overview

This snippet provides a flexible solution for managing custom shortcodes:

1. **Shortcode Registration**

   - Registers multiple custom shortcodes
   - Provides default shortcode configurations
   - Handles shortcode attributes
   - Supports shortcode nesting

2. **Attribute Management**

   - Filterable shortcode attributes
   - Default attribute values
   - Attribute validation
   - Custom attribute processing

3. **Extensibility**
   - Filterable shortcode list
   - Customizable shortcode parameters
   - Easy to add new shortcodes
   - Flexible shortcode structure

## 🔄 Extensibility

The snippet uses filterable array systems that allow:

- Adding new shortcodes
- Modifying existing shortcodes
- Changing shortcode parameters
- Customizing attribute behavior
- Managing shortcode output

## 📌 How to Use

1. Include `register-shortcodes.php` in your theme or plugin.
2. To extend, use the filters shown in `sample-shortcodes-extension.php`.

## 🔄 Hook Reference

**Filters:**

- `maverick_register_shortcodes`  
  **Usage:** Add/modify shortcodes before they're registered.
- `maverick_shortcode_{tag}_atts`  
  **Usage:** Modify attributes for a specific shortcode (e.g., `maverick_shortcode_button_atts`).
- `maverick_{tag}_shortcode_output`  
  **Usage:** Modify the output HTML for a specific shortcode (e.g., `maverick_button_shortcode_output`).

## 🎯 Use Cases

### For Theme Developers

- Register default shortcodes
- Create theme-specific shortcodes
- Define shortcode behavior
- Structure shortcode output

### For Plugin Developers

- Add custom shortcodes
- Modify existing shortcodes
- Extend shortcode functionality
- Create shortcode relationships

### For Site Administrators

- Use custom shortcodes
- Customize shortcode output
- Control shortcode behavior
- Manage shortcode content

## 🧪 Tested With

- WordPress 6.5+
