# Costa Rica Interactive Map

A WordPress plugin that creates an interactive map of Costa Rica using Leaflet.js. The plugin allows you to manage tours and display them on an interactive map with custom zones.

## Features

- Interactive map using Leaflet.js
- Custom Post Type for Tours
- Custom Taxonomy for Zones
- Location coordinates for each tour
- AJAX-powered map markers
- Responsive design
- Mobile-friendly interface

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- Node.js 14 or higher
- Composer

## Installation

1. Clone this repository to your WordPress plugins directory:
   ```bash
   cd wp-content/plugins/
   git clone [repository-url] costa-rica-interactive-map
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install JavaScript dependencies:
   ```bash
   npm install
   ```

4. Build assets:
   ```bash
   npm run build
   ```

5. Activate the plugin through the WordPress admin panel.

## Usage

1. Add Tours:
   - Go to Tours > Add New in WordPress admin
   - Enter tour details and set coordinates
   - Assign to one or more zones

2. Manage Zones:
   - Go to Tours > Zones
   - Create and manage geographical zones

3. Display the Map:
   - Use shortcode `[costa_rica_map]` in any page or post
   - Map will display all tours with their markers
   - Click markers to view tour information

## Development

### Project Structure
```
costa-rica-interactive-map/
├── admin/              # Admin-related functionality
├── assets/            # Frontend assets
│   ├── css/          # Stylesheets
│   └── js/           # JavaScript files
├── includes/         # Core plugin functionality
├── languages/        # Translation files
└── templates/        # Template files
```

### Coding Standards

This project follows WordPress coding standards and includes several configuration files:

- `.cursorrules`: Project-specific development rules
- `.editorconfig`: Editor configuration
- `.prettierrc`: Code formatting rules
- `.vscode/settings.json`: VS Code/Cursor settings

Key standards:
- PHP: WordPress Coding Standards
- JavaScript: WordPress JavaScript guidelines
- CSS: WordPress CSS guidelines
- Text Domain: costa-rica-map
- Function Prefix: costa_rica_map_

### Development Commands

- `npm start`: Start development server with hot reloading
- `npm run build`: Build production assets
- `npm run lint:js`: Lint JavaScript files
- `npm run lint:css`: Lint CSS files
- `composer phpcs`: Check PHP code standards
- `composer phpcbf`: Fix PHP code standards automatically

### Security

All code must follow WordPress security best practices:
- Input validation
- Output escaping
- Nonce verification
- Capability checks
- Prepared SQL queries

## Contributing

1. Fork the repository
2. Create your feature branch: `git checkout -b feature/my-new-feature`
3. Follow the coding standards and rules in `.cursorrules`
4. Commit your changes: `git commit -am 'Add new feature'`
5. Push to the branch: `git push origin feature/my-new-feature`
6. Submit a pull request

## License

GPL v2 or later
