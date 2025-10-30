# N8N Manager - Laravel Application

A modern Laravel application for managing n8n workflows and scripts with multi-user support.

## Features

### 🔐 Authentication
- **Laravel Sanctum** API authentication
- **Laravel Breeze** web authentication
- **UUID-based** user identification
- **Multi-user support** with isolated data

### 📊 Dashboard
- **Modern responsive design** with Tailwind CSS v4
- **Collapsed sidebar navigation** with tooltips
- **Mobile-responsive** with hamburger menu
- **Real-time statistics** for workflows and scripts

### 🔄 N8N Integration
- **API endpoints** for n8n communication
- **Workflow management** (CRUD operations)
- **Script storage** and management
- **Execution tracking** and history

### 📱 Mobile Support
- **Responsive design** for all devices
- **Touch-friendly** navigation
- **Slide-out sidebar** on mobile
- **Optimized user experience**

## Tech Stack

- **Laravel 12** - Latest PHP framework
- **Tailwind CSS v4** - Modern utility-first CSS
- **Laravel Sanctum** - API authentication
- **MySQL** - Database with UUID primary keys
- **Vite** - Modern build tool
- **Pest** - Testing framework

## API Endpoints

### Authentication
- `POST /api/register` - User registration
- `POST /api/login` - User login
- `POST /api/logout` - User logout
- `GET /api/profile` - Get user profile

### Workflows
- `GET /api/workflows` - List user workflows
- `POST /api/workflows` - Create workflow
- `GET /api/workflows/{id}` - Get workflow
- `PUT /api/workflows/{id}` - Update workflow
- `DELETE /api/workflows/{id}` - Delete workflow
- `POST /api/workflows/{id}/execute` - Execute workflow

### Scripts
- `GET /api/scripts` - List user scripts
- `POST /api/scripts` - Store script (from n8n)

### N8N Webhooks
- `POST /api/n8n/webhook/{user_id}` - Receive n8n data
- `POST /api/n8n/execution-result` - Execution results

## Installation

1. **Clone the repository**
```bash
git clone <repository-url>
cd musamin.app
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database setup**
```bash
# Create database: musamin.app (or update DB_DATABASE in .env)
php artisan migrate
```

5. **Build assets**
```bash
npm run build
```

6. **Start development server**
```bash
php artisan serve
```

## Database Schema

### Users Table (UUID)
- `id` - UUID primary key
- `name` - User full name
- `email` - Unique email address
- `password` - Hashed password
- `timestamps`

### Workflows Table (UUID)
- `id` - UUID primary key
- `user_id` - Foreign UUID to users
- `name` - Workflow name
- `description` - Optional description
- `workflow_data` - JSON workflow definition
- `n8n_workflow_id` - N8N internal ID
- `status` - draft|active|inactive
- `execution_history` - JSON execution logs
- `timestamps`

### Scripts Table (UUID)
- `id` - UUID primary key
- `user_id` - Foreign UUID to users
- `topic` - Script topic/title
- `script` - Script content
- `status` - Script status (default: generated)
- `timestamps`

## Configuration

### N8N Integration
Update your n8n instance to connect to this Laravel API:
- **Base URL**: `http://your-domain.com/api`
- **Authentication**: Bearer token from login endpoint
- **Webhooks**: Configure n8n to send data to webhook endpoints

### Environment Variables
```env
DB_DATABASE="musamin.app"
DB_USERNAME=root
DB_PASSWORD=

# API Configuration
SANCTUM_STATEFUL_DOMAINS=localhost,127.0.0.1
```

## Development

### Running Tests
```bash
php artisan test
```

### Code Style
```bash
./vendor/bin/pint
```

### Building for Production
```bash
npm run build
php artisan optimize
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run tests
5. Submit a pull request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support and questions, please open an issue in the GitHub repository.