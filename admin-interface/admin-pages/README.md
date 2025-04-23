# Register Extensible Admin Pages

This snippet registers WordPress Admin Pages using filterable arrays. Other plugins or themes can modify the admin pages list using the `maverick_register_admin_pages` filter.

## 📌 How to Use

1. Include `register-admin-pages.php` in your theme or plugin.
2. To extend, use the filter shown in `sample-admin-pages-extension.php`.

## 🔄 Hook Reference

**Filter:** `maverick_register_admin_pages`  
**Usage:** Add/modify admin pages before they're registered.

## 🧪 Tested With

- WordPress 6.5+
