# Register Extensible REST API Endpoints

This snippet registers WordPress REST API endpoints using filterable arrays. Other plugins or themes can modify the endpoints list using the `maverick_register_rest_endpoints` filter.

## 📌 Overview

This snippet provides a flexible solution for managing REST API endpoints:

1. **Endpoint Registration**

   - Registers multiple custom endpoints
   - Provides default endpoint configurations
   - Handles endpoint permissions
   - Supports various HTTP methods

2. **Response Management**

   - Structured response format
   - Error handling
   - Data validation
   - Response filtering

3. **Extensibility**
   - Filterable endpoint list
   - Customizable endpoint parameters
   - Easy to add new endpoints
   - Flexible endpoint structure

## 🔄 Extensibility

The snippet uses filterable array systems that allow:

- Adding new endpoints
- Modifying existing endpoints
- Changing endpoint parameters
- Customizing response behavior
- Managing endpoint permissions

## 📌 How to Use

1. Include `register-rest-api.php` in your theme or plugin.
2. To extend, use the filters shown in `sample-rest-api-extension.php`.

## 🔄 Hook Reference

**Filters:**

- `maverick_register_rest_endpoints`  
  **Usage:** Add/modify REST API endpoints before they're registered.
- `rest_prepare_post`  
  **Usage:** Modify the response data for post endpoints.

## 🎯 Use Cases

### For Theme Developers

- Register default endpoints
- Create theme-specific endpoints
- Define endpoint behavior
- Structure API responses

### For Plugin Developers

- Add custom endpoints
- Modify existing endpoints
- Extend API functionality
- Create API relationships

### For Site Administrators

- Manage API access
- Control endpoint permissions
- Customize API responses
- Monitor API usage

## 🧪 Tested With

- WordPress 6.5+
