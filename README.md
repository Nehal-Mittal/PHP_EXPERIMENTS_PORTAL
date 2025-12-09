# Student Experiment Portal

A comprehensive web application built with PHP, MySQL, HTML, CSS, and JavaScript that allows students to register, login, view experiments, and run PHP code in an integrated code editor.

## 🎯 Features

- **User Authentication**: Secure registration and login system with QID validation (245100XXX format)
- **Dashboard**: View all experiments in a responsive table format
- **Code Editor**: Built-in CodeMirror editor with syntax highlighting for PHP code
- **Live Execution**: Run PHP code and view output in real-time
- **Experiment Management**: Add and delete experiments dynamically
- **10 Pre-built Experiments**: Ready-to-use PHP learning exercises
- **Responsive Design**: Modern UI with Bootstrap 5 and Poppins font
- **Session Management**: Secure session-based authentication

## 📋 Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- XAMPP/WAMP/LAMP (for local development)

## 🚀 Installation

### 1. Clone or Download Project

```bash
cd LAB_PHP
```

### 2. Set Up Database

1. Open phpMyAdmin or MySQL command line
2. Import the `database.sql` file:
   ```bash
   mysql -u root -p < database.sql
   ```
   Or manually import through phpMyAdmin interface

### 3. Configure Database Connection

Edit `config.php` and update database credentials:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');  // Your MySQL password
define('DB_NAME', 'student_experiments');
```

### 4. Set Permissions

Ensure the `experiments` folder has write permissions:

```bash
chmod 777 experiments
```

Or on Windows, give full control to the `experiments` folder

### 5. Start Server

**Using XAMPP:**
- Place project in `htdocs` folder
- Start Apache and MySQL from XAMPP control panel
- Open browser: `http://localhost/LAB_PHP/login.php`

**Using PHP Built-in Server:**
```bash
php -S localhost:8000
```
- Open browser: `http://localhost:8000/login.php`

## 📁 Project Structure

```
LAB_PHP/
├── config.php                  # Database configuration
├── register.php                # Student registration page
├── login.php                   # Student login page
├── logout.php                  # Logout handler
├── dashboard.php               # Main dashboard
├── view_experiment.php         # Experiment viewer with code editor
├── add_experiment.php          # Add new experiment (AJAX handler)
├── delete_experiment.php       # Delete experiment (AJAX handler)
├── execute_code.php            # Execute PHP code
├── database.sql                # Database schema and initial data
├── README.md                   # This file
├── experiments/                # Experiment PHP files
│   ├── Experiment1.php         # HTML/CSS Navigation Menu
│   ├── Experiment2.php         # 5 Star Rating System
│   ├── Experiment3.php         # Sort Associative Arrays
│   ├── Experiment4.php         # Sign Up Form with Validation
│   ├── Experiment5.php         # File System Functions
│   ├── Experiment6.php         # CAPTCHA Contact Form
│   ├── Experiment7.php         # Multiple Image Upload
│   ├── Experiment8.php         # CRUD Operations
│   ├── Experiment9.php         # Login & Authentication
│   └── Experiment10.php        # Session Management
└── assets/
    ├── css/
    │   └── style.css           # Custom styles
    └── js/
        └── dashboard.js        # Dashboard JavaScript
```

## 🧪 Available Experiments

1. **Create Menu using HTML and CSS** - Responsive navigation menu
2. **Build PHP MySQL 5 Star rating System** - Interactive rating system
3. **Sort associative array by value** - Array manipulation examples
4. **Create Sign Up form** - Server-side validation
5. **File System functions** - File and directory operations
6. **CAPTCHA in contact form** - Security implementation
7. **Upload multiple images** - File upload handling
8. **CRUD Operations** - Create, Read, Update, Delete
9. **Login and Authentication** - Session-based authentication
10. **Manage sessions** - Session operations

## 👤 User Guide

### Registration

1. Go to `register.php`
2. Fill in:
   - Name
   - QID (format: 245100XXX - 9 digits starting with 245100)
   - Email (optional)
   - Password (minimum 6 characters)
3. Click "Register"

### Login

1. Go to `login.php`
2. Enter QID and password
3. Click "Login"

### View Experiment

1. From dashboard, click "View" on any experiment
2. Code editor opens with the experiment code
3. Edit code if desired
4. Click "Run Code" to execute
5. Output appears on the right panel

### Add Experiment

1. From dashboard, scroll to "Add New Experiment" form
2. Fill in:
   - Experiment Number
   - Experiment Name
   - Code
3. Click "Add Experiment"
4. System creates both database entry and PHP file

### Delete Experiment

1. From dashboard, click "Delete" on any experiment
2. Confirm deletion
3. Both database entry and PHP file are removed

## 🔐 Security Features

- Password hashing using `password_hash()`
- SQL injection prevention with prepared statements
- XSS prevention with `htmlspecialchars()`
- Session management
- Input validation
- CSRF protection ready (can be added)

## 🎨 Technology Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Framework**: Bootstrap 5
- **Code Editor**: CodeMirror 5
- **Font**: Poppins (Google Fonts)

## 📝 Database Schema

### `students` Table
- `id` - Primary key (INT AUTO_INCREMENT)
- `name` - Student name (VARCHAR 100)
- `qid` - QID (VARCHAR 50, UNIQUE)
- `email` - Email (VARCHAR 100)
- `password` - Hashed password (VARCHAR 255)
- `created_at` - Timestamp

### `experiments` Table
- `id` - Primary key (INT AUTO_INCREMENT)
- `experiment_no` - Experiment number (INT, UNIQUE)
- `experiment_name` - Name (VARCHAR 255)
- `code` - PHP code (TEXT)
- `created_at` - Timestamp

## 🛠 Troubleshooting

### Database Connection Error
- Check MySQL credentials in `config.php`
- Ensure MySQL service is running
- Verify database exists

### Permission Denied
- Check folder permissions for `experiments/`
- On Linux/Mac: `chmod 777 experiments/`
- On Windows: Right-click → Properties → Security

### Code Not Executing
- Ensure PHP `eval()` is enabled (for code execution)
- Check PHP error logs
- Verify `execute_code.php` is accessible

### Session Issues
- Clear browser cookies
- Check `php.ini` session settings
- Ensure `session_start()` is called

## 📝 Notes

- **Google OAuth**: Placeholder included in `config.php`. To implement:
  1. Create Google OAuth credentials
  2. Update `GOOGLE_CLIENT_ID` and `GOOGLE_CLIENT_SECRET`
  3. Create `google_callback.php` handler
- **Code Execution**: Uses `eval()` for simplicity. For production, consider sandboxing or containerization
- **Styling**: Fully responsive, works on mobile/tablet/desktop

## 🤝 Contributing

Feel free to fork, improve, and submit pull requests!

## 📄 License

This project is for educational purposes.

## 👨‍💻 Author

Student Experiment Portal - Lab Project

## 📞 Support

For issues or questions, please refer to your instructor or course documentation.

---

**Happy Coding! 🎉**

