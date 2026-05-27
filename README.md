# PHP User Authentication System

A secure, procedural PHP user registration and login system utilizing **MySQLi** with prepared statements, robust session management, and password hashing defenses.

---

## 🚀 Features

- **SQL Injection Protection:** Complete isolation of database logic and user inputs via MySQLi Prepared Statements (`prepare`, `bind_param`, `execute`).
- **Secure Authentication:** Passwords are encrypted dynamically using PHP's native `password_hash()` with the `PASSWORD_DEFAULT` algorithm and verified via `password_verify()`.
- **Session Hardening:** Mitigates Session Fixation and Hijacking attacks through automated ID rotation (`session_regenerate_id(true)`) and strict, server-side HTTP-only cookie configurations.
- **Cross-Site Scripting (XSS) Mitigation:** Context-aware output escaping using `htmlspecialchars()` on all dynamic user data rendered in views.
- **Asynchronous UX Routing:** Client-side registration delays managed dynamically via JavaScript runtime timeouts to ensure accurate front-end validation rendering.

---

## 🛠️ Tech Stack

- **Backend:** PHP 8.x
- **Database:** MySQL
- **Frontend:** HTML5 / CSS3 / JavaScript (ES6)

---

## 📂 Project Structure

```text
├── database.php      # Database connection configuration using MySQLi object
├── login.php         # Secure user authentication processing & login interface
├── signup.php      # User registration logic, validation, & password hashing
├── welcome.php       # Protected user dashboard view (Session restricted)
└── logout.php        # Session termination and token destruction handler

```

---

## ⚙️ Installation & Setup

### 1. Prerequisites

- A local PHP/MySQL server environment running **XAMPP**, **WampServer**, or **MAMP**.
- PHP 8.0 or higher enabled.

### 2. Database Configuration

Create a database named `project1DB` (or update your preference in `database.php`) and execute the following SQL schema blueprint to generate the user table structure:

```sql
CREATE DATABASE IF NOT EXISTS project1DB;
USE project1DB;

CREATE TABLE IF NOT EXISTS userInfo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

```

### 3. Deploying Locally

1. Clone this repository to your local server directory (e.g., `htdocs` for XAMPP):

```bash
git clone https://github.com/YOUR_USERNAME/YOUR_REPOSITORY_NAME.git

```

2. Open your environment control panel and ensure **Apache** and **MySQL** services are actively running.
3. Open your browser and navigate to:

```text
http://localhost/YOUR_REPOSITORY_NAME/register.php

```

---

## 📄 License

This project is open-source and available under the [MIT License](https://www.google.com/search?q=LICENSE).
