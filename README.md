# Asset Management App

**⚠️ DRAFT VERSION - WORK IN PROGRESS**

A comprehensive Laravel application for managing assets, maintenance tickets, projects, and employee documentation with modern UI built with Filament. This application is currently in development and may contain incomplete features or bugs.

## Features

- **Asset Management**: Track and manage company assets with detailed information
- **Maintenance Tickets**: Create and track maintenance requests and tickets
- **Project Management**: Manage projects and assign assets
- **Employee Management**: Employee profiles with document management
- **Document Management**: Upload and manage documents for assets and employees
- **User Authentication**: Secure authentication with Laravel Fortify
- **Modern UI**: Beautiful admin panel built with Filament
- **Responsive Design**: Works seamlessly on desktop and mobile devices

## Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Livewire, Flux UI
- **Database**: MySQL/PostgreSQL
- **File Storage**: AWS S3
- **Admin Panel**: Filament
- **Testing**: Pest PHP
- **Styling**: Tailwind CSS v4

## System Requirements

- PHP 8.3+
- Composer
- Node.js & NPM
- MySQL/PostgreSQL
- Redis (optional)
- AWS S3 account (for file storage)

## Installation

### 1. Clone Repository

```bash
git clone <repository-url>
cd asset-management-app
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Setup

Copy the environment file and configure your settings:

```bash
cp .env.example .env
php artisan key:generate
```

Configure the following environment variables in `.env`:

```env
# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=asset_management
DB_USERNAME=your_username
DB_PASSWORD=your_password

# AWS S3 Configuration
AWS_ACCESS_KEY_ID=your_access_key
AWS_SECRET_ACCESS_KEY=your_secret_key
AWS_DEFAULT_REGION=your_region
AWS_BUCKET=your_bucket_name
AWS_USE_PATH_STYLE_ENDPOINT=false

# Application Configuration
APP_NAME="Asset Management"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Mail Configuration (optional)
MAIL_MAILER=smtp
MAIL_HOST=your_mail_host
MAIL_PORT=587
MAIL_USERNAME=your_mail_username
MAIL_PASSWORD=your_mail_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 4. Database Setup

Create the database and run migrations:

```bash
php artisan migrate
```

### 5. Seed Database (optional)

Run seeders to populate default data:

```bash
php artisan db:seed
```

### 6. Build Assets

Compile frontend assets:

```bash
npm run build
```

### 7. Link Storage

Create the symbolic link for public storage:

```bash
php artisan storage:link
```

### 8. Start Development Server

Start the Laravel development server:

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Usage

### Admin Panel Access

- Navigate to `/admin` to access the Filament admin panel
- Login with your admin credentials
- Create and manage assets, maintenance tickets, projects, and employees

### Asset Management

1. Navigate to Assets section
2. Create new assets with detailed information
3. Upload documents for each asset (PDFs, images)
4. Track asset status and assignments

### Maintenance Tickets

1. Create maintenance tickets for assets
2. Track ticket status through the workflow
3. Assign tickets to technicians
4. Update ticket status and resolution details

### Project Management

1. Create projects and assign assets
2. Track project progress
3. Manage project timelines and deadlines

### Employee Management

1. Create employee profiles
2. Upload employee documents
3. Track employee assignments and roles

## Testing

Run the test suite:

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/AssetTest.php

# Run with coverage
php artisan test --coverage
```

## Deployment

### Production Setup

1. Set environment to production:
```env
APP_ENV=production
APP_DEBUG=false
```

2. Optimize application:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

3. Set up proper file permissions:
```bash
chmod -R 755 storage bootstrap/cache
```

4. Configure your web server to point to the `public` directory

### Scheduler Setup

Add the Laravel scheduler to your crontab:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## File Structure

```
├── app/
│   ├── Enums/              # Enum classes
│   ├── Filament/           # Filament resources and pages
│   ├── Models/             # Eloquent models
│   ├── Observers/          # Model observers
│   └── Providers/          # Service providers
├── database/
│   ├── factories/          # Model factories
│   ├── migrations/         # Database migrations
│   └── seeders/           # Database seeders
├── resources/
│   ├── css/              # Tailwind CSS
│   ├── js/               # JavaScript files
│   └── views/            # Blade templates
├── storage/
│   ├── app/              # Application files
│   └── framework/        # Framework files
└── tests/
    ├── Feature/          # Feature tests
    └── Unit/            # Unit tests
```

## Support

For support and questions, please create an issue in the repository.

## Development Status

This project is currently in **DRAFT** status. The following features are implemented but may still have issues:

- ✅ Asset Management (Basic CRUD)
- ✅ Maintenance Tickets (Status tracking)
- ✅ Project Management (Basic functionality)
- ✅ Employee Management (Basic CRUD)
- ✅ Document Management (Upload to S3)
- ⚠️ Authentication (Basic setup, needs refinement)
- ❌ Role-based Access Control (Not implemented)
- ❌ Reporting & Analytics (Not implemented)
- ❌ Email Notifications (Not implemented)
- ❌ API Endpoints (Not implemented)

## Known Issues

- Some forms may have validation issues
- File upload may need additional security measures
- Database migrations may need further refinement
- Test coverage is incomplete
- Performance optimization needed

## Roadmap

- [ ] Complete role-based access control
- [ ] Add email notifications
- [ ] Implement reporting dashboard
- [ ] Add API endpoints
- [ ] Improve test coverage
- [ ] Performance optimization
- [ ] Security audit
- [ ] Multi-language support
- [ ] Mobile app development

## Changelog

### v0.1.0 (DRAFT)
- Initial draft version
- Basic CRUD operations for all main entities
- Filament admin panel setup
- S3 file storage integration
- Basic asset and maintenance ticket workflows