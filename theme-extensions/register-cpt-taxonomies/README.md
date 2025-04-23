# Register Extensible Custom Post Types and Taxonomies

This snippet registers WordPress Custom Post Types and Taxonomies using filterable arrays. Other plugins or themes can modify the CPTs and Taxonomies list using the `maverick_register_post_types` and `maverick_register_taxonomies` filters.

## 📌 Overview

This snippet provides a flexible solution for managing custom content types:

1. **Post Type Registration**

   - Registers multiple custom post types
   - Provides default post type configurations
   - Handles post type relationships
   - Supports custom post type features

2. **Taxonomy Registration**

   - Registers multiple taxonomies
   - Links taxonomies to post types
   - Provides default taxonomy configurations
   - Supports hierarchical and non-hierarchical taxonomies

3. **Extensibility**
   - Filterable post types and taxonomies
   - Customizable post type parameters
   - Easy to add new content types
   - Flexible content structure

## 🔄 Extensibility

The snippet uses filterable array systems that allow:

- Adding new post types and taxonomies
- Modifying existing content types
- Changing post type parameters
- Customizing taxonomy behavior
- Managing post type relationships

## 📌 How to Use

1. Include `register-cpt-taxonomies.php` in your theme or plugin.
2. To extend, use the filters shown in `sample-cpt-taxonomies-extension.php`.

## 🔄 Hook Reference

**Filters:**

- `maverick_register_post_types`  
  **Usage:** Add/modify Custom Post Types before they're registered.
- `maverick_register_taxonomies`  
  **Usage:** Add/modify Taxonomies before they're registered.

## 🎯 Use Cases

### For Theme Developers

- Register default content types
- Create theme-specific post types
- Define content relationships
- Structure content hierarchy

### For Plugin Developers

- Add custom content types
- Modify existing post types
- Extend content functionality
- Create content relationships

### For Site Administrators

- Manage custom content
- Organize content with taxonomies
- Customize content structure
- Control content visibility

## 🧪 Tested With

- WordPress 6.5+
