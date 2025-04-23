# Register Extensible Scripts and Styles

This snippet registers and enqueues WordPress scripts and styles using filterable arrays. Other plugins or themes can modify the scripts and styles list using the `maverick_register_scripts_styles` filter.

## 📌 Overview

This snippet provides a flexible solution for managing theme assets:

1. **Asset Registration**

   - Registers multiple scripts and styles
   - Provides default asset configurations
   - Handles dependencies automatically
   - Supports version control

2. **Extensibility**
   - Filterable asset list
   - Customizable asset parameters
   - Easy to add new assets
   - Flexible asset structure

## 🔄 Extensibility

The snippet uses a filterable array system that allows:

- Adding new scripts and styles
- Modifying existing assets
- Changing asset parameters
- Customizing asset behavior

## 📌 How to Use

1. Include `register-scripts-styles.php` in your theme or plugin.
2. To extend, use the filter shown in `sample-scripts-styles-extension.php`.

## 🔄 Hook Reference

**Filter:** `maverick_register_scripts_styles`  
**Usage:** Add/modify scripts and styles before they're registered.

## 🎯 Use Cases

### For Theme Developers

- Register default theme assets
- Manage script dependencies
- Control asset loading order
- Handle asset versioning

### For Plugin Developers

- Add custom scripts and styles
- Modify existing assets
- Extend asset functionality
- Integrate with theme assets

### For Site Administrators

- Control asset loading
- Manage asset dependencies
- Optimize asset delivery
- Customize asset behavior

## 🧪 Tested With

- WordPress 6.5+
