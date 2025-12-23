# GoRest Enterprise Portal

A robust PHP-based web application for managing users and posts, utilizing the [GoRest Public API](https://gorest.co.in/).

## Features

### 👤 User Management
- **List Users**: Browse users with pagination.
- **Search**: Find users by name.
- **View Details**: See comprehensive user information.
- **Create User**: Add new users to the system.

### 📝 Post Management
- **List Posts**: Browse posts with pagination.
- **Search**: Filter posts by title.
- **View Details**: Read full post content.
- **Create Post**: Publish new posts linked to a user.



## Technical Overview

- **Public API Integration**: Integrates with GoRest for dynamic data management.
- **Bespoke Styling**: Features a custom-built, high-fidelity Windows Vista interface using pure CSS.
- **Data Processing**: Implements efficient search logic and array filtering for precise data retrieval.
- **Pagination**: Optimized data display with server-side pagination limiting results per page.
- **Error Handling**: Comprehensive exception handling to manage API connectivity states gracefully.
- **Modular Architecture**: Clean, organized codebase separating logic, views, and configuration.

## Technology Stack

- **Backend**: Native PHP (No framework dependencies)
- **Frontend**: HTML5, Vanilla CSS3
- **API**: [GoRest V2 API](https://gorest.co.in/)

## Setup & Installation

1.  **Clone the Repository**
    ```bash
    git clone https://github.com/alyasherly/gorest_portal.git
    ```

2.  **Web Server Setup**
    - Ensure you have a PHP environment ready (e.g., [XAMPP](https://www.apachefriends.org/), MAMP, or native PHP).
    - Place the project folder into your server's document root (e.g., `htdocs` for XAMPP).

3.  **Configuration**
    > **Note**: This project uses a configuration file that is not included in the repository for security.

    - Navigate to the `config/` directory.
    - Duplicate the file named `api.example.php` and rename the copy to `api.php`.
    - Open your newly created `config/api.php` file in a text editor.
    - Locate the line `define('API_TOKEN', 'YOUR_ACCESS_TOKEN_HERE');`.
    - Replace `'YOUR_ACCESS_TOKEN_HERE'` with your actual GoRest OAuth Access Token.

4.  **Run**
    - Open your browser and navigate to:
      `http://localhost/gorest_portal/`

## Project Structure

```
gorest_portal/
├── assets/
│   └── style.css
├── config/
│   └── api.php         # API Configuration & Wrapper
├── posts/              # Post Management Module
├── users/              # User Management Module
├── index.php           # Main Dashboard
└── README.md           # Documentation
```

## Author

**Alya Sherly Al Azmy**
- [GitHub Profile](https://github.com/alyasherly)
