# 🧪 Experiments Overview - Student Experiment Portal

All experiments have been rewritten to work **LIVE** inside the iframe when you click "Run Code". Each experiment is self-contained and functional.

---

## ✅ Experiment 1: HTML/CSS Navigation Menu
**File**: `Experiment1.php`

**What it does:**
- Displays a fully responsive navigation menu
- Shows hover effects and modern styling
- Demonstrates Flexbox layout

**Features:**
- Pure HTML/CSS (no server-side processing)
- Smooth transitions and animations
- Mobile-responsive design

**How to run:** Click "Run Code" - displays immediately

---

## ✅ Experiment 2: 5-Star Rating System
**File**: `Experiment2.php`

**What it does:**
- Interactive star rating interface
- JavaScript-based interactivity
- Visual feedback on click/hover

**Features:**
- Click stars to rate (1-5)
- Hover effects for visual feedback
- Simulates AJAX submission to server

**How to run:** Click "Run Code" - click on stars to test

---

## ✅ Experiment 3: Sort Associative Arrays
**File**: `Experiment3.php`

**What it does:**
- Demonstrates PHP array sorting functions
- Shows original array and multiple sorted variations
- Educational examples

**Features:**
- asort() - sort by value ascending
- arsort() - sort by value descending  
- ksort() - sort by key alphabetically

**How to run:** Click "Run Code" - see sorted arrays displayed

---

## ✅ Experiment 4: Sign Up Form with Validation
**File**: `Experiment4.php`

**What it does:**
- Server-side form validation
- Checks name, email, password requirements
- Shows validation errors inline

**Features:**
- Required field validation
- Email format validation
- Password length check (min 8 chars)
- Password confirmation match
- Success message on valid submission

**How to run:** Click "Run Code" - fill form and submit to see validation

**Test data:**
- Name: John Doe (min 3 chars)
- Email: john@example.com (valid format)
- Password: password123 (min 8 chars)

---

## ✅ Experiment 5: File System Functions
**File**: `Experiment5.php`

**What it does:**
- Demonstrates PHP file operations
- Creates, reads, writes files
- Shows file information

**Features:**
- Create/write files with `file_put_contents()`
- Read files with `file_get_contents()`
- List directory contents
- Show file permissions and metadata
- Copy, rename, delete operations

**How to run:** Click "Run Code" - all operations execute immediately

**Note:** Uses `demo_uploads/` folder for file operations

---

## ✅ Experiment 6: CAPTCHA Contact Form
**File**: `Experiment6.php`

**What it does:**
- Generates CAPTCHA image using PHP GD
- Validates CAPTCHA on form submission
- Session-based security

**Features:**
- Random 6-character CAPTCHA
- Image generation with PHP GD library
- Form validation
- Success/error messages

**How to run:** Click "Run Code" - enter CAPTCHA and submit

**Requirements:** PHP GD library must be enabled

---

## ✅ Experiment 7: Multiple Image Upload
**File**: `Experiment7.php`

**What it does:**
- Upload multiple images simultaneously
- Display uploaded images in gallery
- File type validation

**Features:**
- Multiple file selection
- Image validation (jpg, png, gif, jpeg)
- Gallery view of uploaded images
- File naming with timestamps

**How to run:** Click "Run Code" - select images and upload

**Note:** Uploads saved to `demo_uploads/` folder

**Requirements:** Upload folder must be writable

---

## ✅ Experiment 8: CRUD Operations
**File**: `Experiment8.php`

**What it does:**
- Create, Read, Delete operations on demo_students table
- MySQL database integration
- Dynamic table display

**Features:**
- Add new students to database
- Read and display all students
- Delete students by ID
- Prepared statements for security

**How to run:** Click "Run Code" - add/delete students

**Database:** Uses `demo_students` table in `student_experiments` database

**Test data:**
- Name: Alice Smith
- Email: alice@example.com
- Grade: A

---

## ✅ Experiment 9: Login & Authentication
**File**: `Experiment9.php`

**What it does:**
- Session-based login system
- Password hashing/verification
- User authentication flow

**Features:**
- Secure password handling with `password_hash()`
- Session management
- Login/logout functionality
- Protected content display

**How to run:** Click "Run Code" - login with demo credentials

**Demo Accounts:**
1. Email: john@example.com | Password: password123
2. Email: jane@example.com | Password: hello123

---

## ✅ Experiment 10: Session Management
**File**: `Experiment10.php`

**What it does:**
- Demonstrates PHP session operations
- Set, update, destroy session data
- Display session information

**Features:**
- Set session variables
- Update session data
- Destroy session
- Show session configuration
- Display current session state

**How to run:** Click "Run Code" - use buttons to manage session

**Operations:**
- Set Session Data - Creates user session
- Update Session Data - Modifies role
- Destroy Session - Clears all session data

---

## 🎯 Common Features Across All Experiments

### ✅ All Working Features:
- ✅ Execute in iframe (no redirect)
- ✅ Self-contained code
- ✅ No external dependencies
- ✅ Beautiful Bootstrap styling
- ✅ Responsive design
- ✅ Form validation where needed
- ✅ Error handling
- ✅ User-friendly messages
- ✅ Educational comments

### 🔧 Technical Requirements:

**Server-side:**
- PHP 7.4+ with standard extensions
- MySQL database (for Experiments 8-9)
- PHP GD library (for Experiment 6)
- File upload enabled (for Experiment 7)

**Client-side:**
- Modern web browser
- JavaScript enabled
- Bootstrap 5 CDN (loaded in view_experiment.php)
- CodeMirror 5 CDN (loaded in view_experiment.php)

### 📁 File Structure:
```
experiments/
├── Experiment1.php    ← HTML/CSS Menu
├── Experiment2.php    ← 5-Star Rating
├── Experiment3.php    ← Array Sorting
├── Experiment4.php    ← Sign Up Form
├── Experiment5.php    ← File System
├── Experiment6.php    ← CAPTCHA Form
├── Experiment7.php    ← Image Upload
├── Experiment8.php    ← CRUD Operations
├── Experiment9.php    ← Login System
└── Experiment10.php   ← Session Management
```

### 🚀 Testing Instructions:

1. **Start Server**
   ```bash
   php -S localhost:8000
   # OR
   # Start XAMPP/WAMP
   ```

2. **Import Database**
   ```bash
   mysql -u root -p < database.sql
   ```

3. **Login to Portal**
   - Go to login.php
   - Register or login
   - Go to dashboard

4. **Test Each Experiment**
   - Click "View" on any experiment
   - Click "Run Code" in the editor
   - Output appears on the right
   - Try editing code and re-running

### 🎨 Styling Consistency:
All experiments use:
- Modern gradient backgrounds
- White content cards
- Rounded corners (10-15px)
- Box shadows
- Smooth transitions
- Poppins/Segoe UI fonts
- Color scheme: #667eea, #764ba2

### 💡 Educational Value:

Each experiment teaches:
1. **HTML/CSS** - Layout, styling, responsive design
2. **JavaScript** - DOM manipulation, event handling
3. **PHP Basics** - Variables, arrays, functions
4. **PHP Forms** - POST handling, validation
5. **PHP Files** - Create, read, write, delete
6. **PHP Sessions** - State management
7. **PHP Images** - GD library basics
8. **MySQL** - Database operations
9. **Security** - Prepared statements, hashing

---

## 🐛 Troubleshooting

### Issue: Code not executing
**Solution:** Check `execute_code.php` permissions and PHP errors

### Issue: Upload not working
**Solution:** Set `demo_uploads/` folder to writable (777)

### Issue: CAPTCHA not showing
**Solution:** Enable PHP GD library: `extension=gd` in php.ini

### Issue: Database errors
**Solution:** Import `database.sql` and check credentials in `config.php`

### Issue: Session not working
**Solution:** Check `session_start()` is called and PHP sessions enabled

---

## 📝 Notes

- All experiments are **standalone** - no external config needed
- Each experiment can be copied and used independently
- Code is **well-commented** for learning
- Follows **PHP best practices** (PSR standards)
- **Security-focused** (prepared statements, validation, sanitization)

---

**✅ All 10 experiments are fully functional and tested!**

Happy coding! 🎉

