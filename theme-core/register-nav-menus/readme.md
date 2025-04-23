# Register Extensible Navigation Menus

This snippet registers WordPress navigation menus using filterable arrays. Other plugins or themes can modify the menu list using the `maverick_register_nav_menus` filter.

## 📌 Overview

This snippet provides a flexible solution for managing navigation menus in WordPress themes:

1. **Menu Registration**

   - Registers multiple menu locations
   - Provides default menu locations
   - Allows for easy menu management
   - Supports theme customization

2. **Extensibility**
   - Filterable menu locations
   - Customizable menu parameters
   - Easy to add new menu locations
   - Flexible menu structure

## 🔄 Extensibility

The snippet uses a filterable array system that allows:

- Adding new menu locations
- Modifying existing menu locations
- Changing menu parameters
- Customizing menu behavior

## 📌 How to Use

1. Include `register-nav-menus.php` in your theme or plugin.
2. To extend, use the filter shown in `sample-nav-menus-extension.php`.

## 🔄 Hook Reference

**Filter:** `maverick_register_nav_menus`  
**Usage:** Add/modify nav menus before they're registered.

## 🎯 Use Cases

### For Theme Developers

- Register default menu locations
- Provide theme-specific menus
- Create custom menu structures

### For Plugin Developers

- Add new menu locations
- Modify existing menus
- Extend menu functionality

### For Site Administrators

- Manage menu locations
- Assign menus to locations
- Customize menu structure

## 🧪 Tested With

- WordPress 6.5+
