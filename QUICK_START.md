# 🚀 Quick Start Guide

Get your Student Experiment Portal running in 5 minutes!

## Prerequisites ✅

- XAMPP/WAMP installed
- PHP 7.4 or higher
- MySQL 5.7 or higher

## Installation Steps

### 1️⃣ Setup Database (2 minutes)

**Option A: Using phpMyAdmin**
1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Click "Import" tab
3. Choose `database.sql` file
4. Click "Go"

**Option B: Using Command Line**
```bash
mysql -u root -p < database.sql
```

### 2️⃣ Configure Connection (30 seconds)

Open `config.php`:
```php
define('DB_PASS', '');  // Your MySQL password (leave empty if none)
```

Save and close.

### 3️⃣ Set Permissions (30 seconds)

**Windows:**
- Right-click `experiments` folder → Properties → Security → Edit
- Give "Full control" to Users
- Apply

**Linux/Mac:**
```bash
chmod 777 experiments/
```

### 4️⃣ Start Server (1 minute)

**XAMPP:**
1. Start Apache and MySQL
2. Open: `http://localhost/LAB_PHP`

**PHP Built-in Server:**
```bash
php -S localhost:8000
```
Then: `http://localhost:8000`

### 5️⃣ Test Application (1 minute)

1. Click "Register"
2. QID: `245100123`
3. Password: `password123`
4. Click "Login"
5. Click "View" on any experiment
6. Click "Run Code"

## 🎉 Done!

You should now have a fully functional Student Experiment Portal!

---

## Common Issues

| Issue | Solution |
|-------|----------|
| "Connection failed" | Check MySQL is running |
| "Permission denied" | Fix experiments folder permissions |
| "Styles not loading" | Check asset paths |
| Blank page | Check PHP error logs |

---

## Next Steps

- Read `README.md` for full documentation
- Read `SETUP_INSTRUCTIONS.md` for detailed setup
- Try adding your own experiments
- Explore all 10 pre-built experiments

**Need Help?** Check the full setup guide in `SETUP_INSTRUCTIONS.md`

---

**Happy Coding! 📚**

