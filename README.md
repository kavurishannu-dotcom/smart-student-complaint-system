# Smart Student Complaint Management System (SSCMS)

The **Smart Student Complaint Management System (SSCMS)** is a web-based platform for handling student complaints in an organized, transparent, and efficient way. Students can submit complaints and follow their status, departments can manage and resolve complaints, and administrators can oversee users, departments, and complaints.

## Features

- **Student Portal** — student login, complaint submission, and complaint-status tracking.
- **Department Portal** — department login to view and manage complaints assigned to the department.
- **Admin Portal** — administrative access for managing students, departments, and complaints.
- **Complaint Tracking** — follow complaint progress through the system.
- **Notifications** — complaint-related updates.
- **Role-based access** — separate login pages for students, departments, and administrators.
- **Responsive web interface** — built with HTML, CSS, and PHP.

## Technology Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Local development:** XAMPP (Apache and MySQL)
- **Icons:** Font Awesome

## Project Structure

```text
smart-student-complaint-system/
├── index.php       # Main landing page and portal links
├── admin/          # Admin login and management pages
├── student/        # Student portal pages
├── department/     # Department portal pages
├── database/       # Database scripts
├── config/         # Database/application configuration
├── css/            # Stylesheets
├── images/         # Logos and image assets
└── welcome/        # Welcome and start pages
```

## Requirements

Install the following before running the project:

- PHP 8.x or a PHP version compatible with the project
- MySQL or MariaDB
- Apache web server
- A web browser

**Recommended for beginners:** [XAMPP](https://www.apachefriends.org/), which includes Apache, PHP, and MySQL/MariaDB.

## Installation and Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/kavurishannu-dotcom/smart-student-complaint-system.git
   ```

2. **Move the project into the web server directory**

   For XAMPP on Windows, copy or clone the project into:
   `C:\\xampp\\htdocs\\smart-student-complaint-system`

3. **Start the services**

   Open the XAMPP Control Panel and start **Apache** and **MySQL**.

4. **Create and import the database**

   - Open [phpMyAdmin](http://localhost/phpmyadmin/).
   - Create the database using the name expected by the project's database configuration.
   - Open the `database/` folder and import the project's provided SQL file into that database, if one is included.

5. **Configure the database connection**

   Open the relevant file in `config/` and set the MySQL host, database name, username, and password to match your local setup. For a standard local XAMPP installation, the host is often `localhost` and the username is often `root`; use the password configured on your machine.

6. **Run the application**

   Visit:
   [http://localhost/smart-student-complaint-system/](http://localhost/smart-student-complaint-system/)

## Using the System

1. Open the application in your browser.
2. Choose the appropriate portal: **Student Login**, **Department Login**, or **Admin Login**.
3. Sign in using accounts configured in the database.
4. Students can submit complaints and check their progress.
5. Department users can review and manage complaints.
6. Administrators can oversee complaints, students, and departments.

> Login credentials are not listed here. Use existing project credentials or create accounts through the application's supported workflow.

## Troubleshooting

- **Database connection error:** Check the database name and credentials in `config/`, and confirm that MySQL is running.
- **Page not found:** Make sure the project folder is inside XAMPP's `htdocs` directory and use the URL shown above.
- **Database/table errors:** Confirm that the correct SQL file from `database/` has been imported into the configured database.
- **Styles or images missing:** Confirm that the `css/` and `images/` folders remain in the project directory.

## Contributing

Contributions and suggestions are welcome. Fork the repository, create a branch for your change, and submit a pull request.

## Repository

Source code: https://github.com/kavurishannu-dotcom/smart-student-complaint-system

## License

No license has been specified in this README. Please check the repository for licensing terms before redistributing or reusing the project.
