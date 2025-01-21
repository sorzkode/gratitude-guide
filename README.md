# 📝 Gratitude Letter Generator

A web form that helps users craft meaningful letters of gratitude. Users can create, preview, print, and download personalized letters while optionally sharing them with the community.

## 🌟 Features

- Real-time letter preview
- Customizable themes with different colors
- Multiple greeting and closing options
- Structured sections for meaningful content
- Print functionality
- Download as Word document (.docx)
- Optional community sharing
- Responsive design
- Cross-browser compatibility

## 🛠️ Technologies Used

- PHP 8.2+
- MySQL/MariaDB
- JavaScript (Vanilla)
- HTML5
- CSS3
- PHPWord Library
- Apache Server

## 📋 Prerequisites

- PHP 8.2 or higher
- MySQL/MariaDB database
- Apache web server
- Composer (for PHP dependencies)
- mod_rewrite enabled

## 🚀 Installation

1. Clone the repository:

```bash
git clone https://github.com/yourusername/gratitude-letter-generator.git
```

2. Install PHP dependencies:

```bash
composer install
```

3. Create a new MySQL database and run the following SQL:

```sql
CREATE TABLE gratitude_letters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    letter_title VARCHAR(50) NOT NULL,
    theme_color VARCHAR(7) NOT NULL,
    greeting VARCHAR(20) NOT NULL,
    recipient_name VARCHAR(50) NOT NULL,
    relationship_to VARCHAR(50) NOT NULL,
    history_together TEXT NOT NULL,
    shared_memories TEXT NOT NULL,
    impact_statement TEXT NOT NULL,
    admired_qualities TEXT NOT NULL,
    thanks_for TEXT NOT NULL,
    formal_closing VARCHAR(20) NOT NULL,
    signature VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_recipient (recipient_name),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

4. Configure database connection:
   - Copy `db_config.example.php` to `db_config.php`
   - Update the database credentials in `db_config.php`

## 🔧 Configuration

Update the database configuration in `db_config.php`:

```php
define('DB_HOST', 'your_host');
define('DB_NAME', 'your_database_name');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
```

## 📁 Project Structure

```
gratitude-letter-generator/
│
├── .private/
│   └── db_config.php
│
├── vendor/
│   └── [composer dependencies]
│
├── db_config.php
├── form_processing.php
├── index.php
├── error.php
├── composer.json
├── style.css
├── gratitude-form.js
└── README.md
```

## 🔒 Security Features

- CSRF Protection
- Input Sanitization
- Prepared SQL Statements
- XSS Prevention
- Error Logging
- Secure File Downloads
- Private/Public Toggle for Letters

## 🎨 Customization

### Adding New Theme Colors

Add new radio buttons to the theme section in `index.php`:

```html
<input type="radio" id="theme-custom" name="letterTheme" value="#YOUR_COLOR">
<label for="theme-custom">Custom Color</label>
```

### Modifying Letter Sections

Edit the letter structure in both `form_processing.php` and `gratitude-form.js` to add or modify sections.

## 🚧 Error Handling

The application includes comprehensive error handling:

- Database connection errors
- Form submission errors
- File processing errors
- CSRF token validation
- Input validation

## 📱 Responsive Design

The application is fully responsive and works on:

- Desktop browsers
- Tablets
- Mobile devices
- Different screen sizes

## 🔍 Testing

1. Local Testing:

```bash
# Using PHP's built-in server
php -S localhost:8000
```

2. Database Testing:

```sql
-- Test query to verify letter storage
SELECT * FROM gratitude_letters ORDER BY created_at DESC LIMIT 1;
```

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 🤝 Contributing

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 👏 Acknowledgments

- PHPWord library for document generation
- Font Awesome for icons
- Inter font family
- Community contributors

## 📞 Support

For support, open an issue in the GitHub repository.

## 🔮 Future Enhancements

- TBD