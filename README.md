# CRM Application

A web-based Customer Relationship Management (CRM) application built using Laravel and MySQL. The application helps manage leads, sales follow-ups, and basic user authentication through a simple and structured interface.

## 📌 Project Overview

The CRM application is designed to manage customer leads throughout the sales process. It provides functionality to create, view, update, and delete leads, track follow-ups, search and filter leads, and manage user authentication.

The project focuses on practical implementation of:

* Laravel MVC architecture
* CRUD operations
* MySQL database management
* Eloquent ORM and relationships
* Form validation
* Authentication and authorization
* Search and filtering
* Follow-up management
* Blade templating
* Tailwind CSS

## ✨ Features

### 🔐 Authentication

* User registration
* User login
* User logout
* Protected application routes
* Profile information management
* Password update
* Account deletion option

### 👥 Lead Management

Users can:

* Add new leads
* View all leads
* View individual lead details
* Edit lead information
* Delete leads

Each lead contains:

* Lead Name
* Company Name
* Email
* Phone Number
* Lead Source
* Status
* Assigned Salesperson
* Expected Deal Value
* Follow-up Date
* Notes
* Created Date

### 📊 Lead Status

The application supports the following lead statuses:

* New
* Contacted
* Follow-up
* Qualified
* Proposal Sent
* Won
* Lost

### 🔎 Search & Filtering

Leads can be searched using:

* Lead Name
* Company Name
* Phone Number

Leads can also be filtered by:

* Status
* Lead Source
* Assigned Salesperson

Multiple search and filter conditions can be used together.

### 📅 Follow-up Management

Users can:

* Add follow-ups for leads
* View upcoming follow-ups
* View overdue follow-ups
* Edit follow-up information
* Delete follow-ups
* Add follow-up notes
* Update follow-up dates

The application automatically separates follow-ups into **Upcoming** and **Overdue** based on the current date.

### ✅ Validation

The application includes server-side form validation for:

* Required fields
* Email format
* Numeric deal value
* Valid dates
* Existing database records
* Allowed lead statuses

Validation errors are displayed to the user through the application interface.

## 🛠️ Technologies Used

| Technology     | Purpose                    |
| -------------- | -------------------------- |
| PHP            | Backend programming        |
| Laravel        | Web application framework  |
| MySQL          | Database                   |
| Blade          | Server-side templating     |
| Tailwind CSS   | UI styling                 |
| Vite           | Frontend asset development |
| Laravel Breeze | Authentication             |
| Eloquent ORM   | Database interaction       |
| Git & GitHub   | Version control            |

## 🏗️ Application Architecture

The application follows the Laravel MVC architecture.

```text
User
  ↓
Browser
  ↓
Laravel Route
  ↓
Controller
  ↓
Model / Eloquent ORM
  ↓
MySQL Database
  ↓
Model / Eloquent ORM
  ↓
Controller
  ↓
Blade View
  ↓
Browser
```

### Main Components

**Routes**

Define application URLs and connect requests to controllers.

**Controllers**

Handle application logic and process user requests.

**Models**

Represent database tables and manage database relationships using Eloquent ORM.

**Blade Views**

Display application pages and user interface components.

**MySQL**

Stores users, leads, lead sources, and follow-up information.

## 🗄️ Database Relationships

The application uses Eloquent relationships between its main models.

### Lead

A Lead:

* Belongs to a Lead Source
* Belongs to an assigned Salesperson/User
* Has many Follow-ups

### Lead Source

A Lead Source:

* Has many Leads

### User

A User:

* Can be assigned many Leads
* Can create many Follow-ups

### Follow-up

A Follow-up:

* Belongs to a Lead
* Belongs to the User who created it

## 📁 Project Structure

Important Laravel directories:

```text
crm/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   └── Models/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│
├── routes/
│   └── web.php
│
├── public/
├── storage/
├── tests/
├── .env.example
├── artisan
├── composer.json
├── package.json
└── vite.config.js
```

## 🚀 Installation & Setup

### 1. Clone the Repository

```bash
git clone <your-github-repository-url>
```

### 2. Navigate to the Project

```bash
cd crm
```

### 3. Install PHP Dependencies

```bash
composer install
```

### 4. Install Frontend Dependencies

```bash
npm install
```

### 5. Create Environment File

Copy `.env.example` and create a `.env` file.

```bash
cp .env.example .env
```

On Windows, you can also manually copy `.env.example` and rename the copy to:

```text
.env
```

### 6. Generate Application Key

```bash
php artisan key:generate
```

### 7. Configure Database

Create a MySQL database, for example:

```text
crm_db
```

Then configure the database details in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crm_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 8. Run Database Migrations

```bash
php artisan migrate
```

### 9. Start Laravel Development Server

```bash
php artisan serve
```

The application will be available at:

```text
http://localhost:8000
```

### 10. Start Vite

In another terminal:

```bash
npm run dev
```

## 🧪 Testing

The following application functionality has been manually tested:

### Authentication

* User registration
* Valid login
* Invalid login
* Empty login validation
* Logout
* Protected routes
* Dashboard access protection
* Leads access protection
* Follow-ups access protection

### Lead Management

* Lead creation
* Required field validation
* Invalid email validation
* Invalid deal value validation
* Invalid date validation
* Lead viewing
* Lead editing
* Lead deletion
* Search by lead name
* Search by company name
* Search by phone
* Status filtering
* Lead source filtering
* Salesperson filtering
* Combined search and filtering
* Clear filters

### Follow-up Management

* Follow-up creation
* Required field validation
* Upcoming follow-up classification
* Overdue follow-up classification
* Follow-up editing
* Follow-up date update
* Dynamic upcoming/overdue classification
* Follow-up deletion

### Profile

* Profile information update
* Password update

## 🔒 Security

The application includes:

* Laravel authentication
* Protected routes using authentication middleware
* CSRF protection
* Server-side validation
* Password hashing
* Database existence validation
* Environment configuration using `.env`

Sensitive environment information such as database credentials is not included in the repository.

## 📸 Screenshots

Screenshots demonstrating the main application features can be added here.

Suggested screenshots:

* Login page
* Dashboard
* Leads page
* Add Lead page
* View Lead page
* Edit Lead page
* Follow-ups page
* Add Follow-up page
* Profile page

Example:

```text
screenshots/
├── login.png
├── dashboard.png
├── leads.png
├── add-lead.png
├── view-lead.png
├── edit-lead.png
├── follow-ups.png
└── profile.png
```

## 🎯 Learning Outcomes

This project provided practical experience with:

* Laravel MVC architecture
* PHP backend development
* MySQL database design
* CRUD operations
* Eloquent ORM
* Model relationships
* Form validation
* Authentication
* Middleware
* Search and filtering
* Business logic implementation
* Blade templates
* Tailwind CSS
* Git and GitHub

## 🔮 Future Improvements

Possible future improvements include:

* Role-based access control
* Pagination for large lead datasets
* Lead activity history
* Sales pipeline dashboard
* Export leads to CSV/Excel
* Email notifications for follow-ups
* Advanced reporting and analytics

## 👨‍💻 Author

**Yash Chaudhari**

Computer Engineering Graduate

GitHub: 

LinkedIn: 

## 📄 License

This project is developed for learning and internship assignment purposes.
