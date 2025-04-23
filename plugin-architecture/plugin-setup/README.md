# Plugin Setup

This snippet provides a foundation for building extensible WordPress plugins with proper initialization and structure.

## 📌 Overview

This snippet provides a flexible solution for plugin initialization:

1. **Plugin Structure**

   - Main plugin file
   - Namespace management
   - File organization
   - Directory structure

2. **Initialization**

   - Plugin activation
   - Plugin deactivation
   - Plugin uninstallation
   - Version management

3. **Database Management**

   - Configurable database tables
   - Extensible table structure
   - Custom columns and indexes
   - Table relationships

4. **Extensibility**
   - Action hooks for initialization
   - Filter hooks for configuration
   - Custom initialization points
   - Flexible structure

## 🔄 Extensibility

The snippet uses filterable systems that allow:

- Modifying plugin initialization
- Adding custom activation hooks
- Customizing deactivation behavior
- Managing plugin lifecycle
- Extending database structure

## 📌 How to Use

1. Include `plugin-setup.php` in your plugin's main file.
2. To extend, use the filters shown in `sample-plugin-setup-extension.php`.

## 🔄 Hook Reference

**Filters:**

- `maverick_plugin_init`  
  **Usage:** Modify plugin initialization parameters.
- `maverick_plugin_activation`  
  **Usage:** Add custom activation behavior.
- `maverick_plugin_deactivation`  
  **Usage:** Add custom deactivation behavior.
- `maverick_plugin_tables`  
  **Usage:** Modify database tables structure.

## 🎯 Use Cases

### For Plugin Developers

- Create new plugins
- Initialize plugin functionality
- Manage plugin lifecycle
- Handle plugin updates
- Extend database structure

### For Theme Developers

- Integrate with plugins
- Extend plugin functionality
- Customize plugin behavior
- Add theme-specific features
- Add custom database tables

### For Site Administrators

- Manage plugin activation
- Control plugin behavior
- Monitor plugin status
- Handle plugin updates
- Manage database structure

## 🧪 Tested With

- WordPress 6.5+
- PHP 7.4+
