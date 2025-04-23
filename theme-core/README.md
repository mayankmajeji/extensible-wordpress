# Theme Core

This directory contains the core functionality required for any WordPress theme. These components are essential for basic theme operation and should be included in every theme.

## Components

1. **Navigation Menus** (`register-nav-menus/`)

   - Registers theme navigation menus
   - Provides extensibility for menu locations

2. **Widget Areas** (`register-widget-areas/`)

   - Registers theme widget areas
   - Provides extensibility for sidebar locations

3. **Scripts & Styles** (`enqueue-scripts-styles/`)
   - Manages theme assets
   - Provides extensibility for scripts and styles

## Usage

Include these components in your theme's `functions.php` or load them individually as needed. Each component is designed to be modular and extensible.
