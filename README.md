# Sistem Pakar - PBP Kelas 5B

This repository contains a simple web application developed for the "Pemrograman Berbasis Platform" (Platform-Based Programming) course. The application is a user management system built with native PHP and a MySQL database. It demonstrates basic CRUD (Create, Read, Update, Delete) functionalities, user registration, and a modular page loading system.

## Features

*   **User Registration**: New users can register through a form. Passwords are securely hashed.
*   **Member Management (CRUD)**:
    *   **Create**: Add new members to the system via the registration page.
    *   **Read**: View a list of all registered members.
    *   **Update**: Edit the details of existing members.
    *   **Delete**: Remove members from the database.
*   **Search**: Find specific members by their username.
*   **Modular Content**: The main page dynamically loads content (e.g., gallery, schedule, member list) based on a URL parameter.

## Technologies Used

*   **Backend**: PHP
*   **Database**: MySQL (using the PDO extension for secure database operations)
*   **Frontend**: HTML, CSS

## Getting Started

To run this project on your local machine, follow the steps below.

### Prerequisites

You need a local server environment that supports PHP and MySQL, such as:
*   [XAMPP](https://www.apachefriends.org/index.html)
*   [WAMP](https://www.wampserver.com/en/)
*   [MAMP](https://www.mamp.info/en/windows/)

### Installation

1.  **Clone the repository** to your local machine.
    ```bash
    git clone https://github.com/r4amnauval/Pemrograman-Berbasis-Platform-5B.git
    ```
2.  **Move the project folder** into your web server's root directory (e.g., `htdocs/` for XAMPP).

3.  **Set up the database**:
    *   Open your database management tool (like phpMyAdmin).
    *   Create a new database named `unpam_db`.
    *   Run the following SQL query to create the `register` table:
        ```sql
        CREATE TABLE `register` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `namadep` varchar(255) DEFAULT NULL,
          `namabel` varchar(255) DEFAULT NULL,
          `username` varchar(255) NOT NULL,
          `password` varchar(255) NOT NULL,
          `usia` varchar(10) DEFAULT NULL,
          `jk` varchar(50) DEFAULT NULL,
          `ttl` varchar(255) DEFAULT NULL,
          `email` varchar(255) DEFAULT NULL,
          `notel` varchar(50) DEFAULT NULL,
          PRIMARY KEY (`id`),
          UNIQUE KEY `username` (`username`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ```

4.  **Configure the database connection**:
    The connection settings are located in `unpam/koneksi.php`. The default configuration is set to connect to a local MySQL server with user `root` and no password, which is standard for default XAMPP/WAMP installations. If your setup is different, update this file accordingly.
    ```php
    <?php
    $host = 'localhost';
    $db   = 'unpam_db'; 
    $user = 'root'; // Change if needed
    $pass = '';     // Change if needed
    ```

5.  **Run the application**:
    Open your web browser and navigate to `http://localhost/Pemrograman-Berbasis-Platform-5B/`.

## Project Structure

The repository is organized as follows:

```
.
├── index.php             # Main entry point and layout template
├── content/              # Contains individual page modules
│   ├── cari.php          # Search results page
│   ├── edit.php          # Form to edit a member
│   ├── edit2.php         # Script to process member updates
│   ├── gallery.php       # Gallery page
│   ├── hapus.php         # Script to delete a member
│   ├── home.php          # Default home page content
│   ├── insert.php        # Registration form page
│   ├── jadwal.php        # Schedule page
│   └── lihat.php         # Page to display all members
├── img/                  # Contains images used in the application
├── style/
│   └── style.css         # Main stylesheet for the application
└── unpam/
    ├── koneksi.php       # Database connection script (PDO)
    └── register.php      # Script to handle new user registration
```

## How It Works

The application uses a simple front-controller pattern where `index.php` serves as the single entry point.

1.  **Routing**: The `index.php` file checks for a `?module=` parameter in the URL.
2.  **Content Loading**: Based on the value of the `module` parameter, the corresponding PHP file from the `content/` directory is included. For example, `index.php?module=lihat` will load `content/lihat.php`.
3.  **Database Interaction**: All database operations are performed using PHP's PDO (PHP Data Objects) extension to prevent SQL injection vulnerabilities. The connection is established in `unpam/koneksi.php` and is included where needed.
4.  **CRUD Operations**:
    *   **Insert**: The form in `content/insert.php` submits data to `unpam/register.php`, which hashes the password and inserts the new user into the database.
    *   **Lihat/Cari**: `content/lihat.php` and `content/cari.php` fetch and display member data from the `register` table.
    *   **Edit**: `content/edit.php` pre-fills a form with an existing user's data. Submitting this form calls `content/edit2.php`, which runs an `UPDATE` query.
    *   **Hapus**: `content/hapus.php` receives a user ID and executes a `DELETE` query.
