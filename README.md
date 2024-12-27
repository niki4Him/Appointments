
# Laravel Appointment Application

A Laravel-based application for managing appointments with features like CRUD operations, API endpoints, and user authentication using Sanctum.

## Requirements

- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL Database
- Laravel 11

## Installation

1. Clone the repository:
   ```
   git clone https://github.com/your-username/appointment-app.git
   cd appointment-app
   ```

2. Install PHP dependencies:
   ```
   composer install
   ```

3. Install Node.js dependencies:
   ```
   npm install
   ```

4. Configure the environment:
   - Copy the `.env.example` file to `.env`:
     ```
     cp .env.example .env
     ```
   - Open `.env` and set your database credentials:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=appointments
     DB_USERNAME=root
     DB_PASSWORD=your-password
     ```

5. Generate the application key:
   ```
   php artisan key:generate
   ```

6. Run migrations and seed the database:
   ```
   php artisan migrate --seed
   ```

7. Install and compile frontend assets:
   ```
   npm run dev
   ```

8. Start the Laravel development server:
   ```
   php artisan serve
   ```

9. Access the application in your browser:
   ```
   http://127.0.0.1:8000
   ```

## API Endpoints

### Authentication
- **Login:** `POST /api/login`
  ```json
  {
      "email": "user@example.com",
      "password": "password"
  }
  ```

- **Logout:** `POST /api/logout`

### Appointments
- **List Appointments:** `GET /api/appointments`
- **Create Appointment:** `POST /api/appointments`
  ```json
  {
      "appointment_date": "2024-12-30T10:00:00",
      "client_name": "Иван Иванов",
      "egn": "1234567890",
      "description": "Редовен преглед.",
      "notification_method": "Email"
  }
  ```
- **Show Appointment:** `GET /api/appointments/{id}`
- **Update Appointment:** `PUT /api/appointments/{id}`
  ```json
  {
      "appointment_date": "2024-12-31T14:00:00",
      "client_name": "Мария Петрова",
      "egn": "0987654321",
      "description": "Контролен преглед.",
      "notification_method": "SMS"
  }
  ```
- **Delete Appointment:** `DELETE /api/appointments/{id}`

For all authenticated requests, include the Bearer token in the `Authorization` header:
```
Authorization: Bearer {your-token}
```

## Testing

- Test the API endpoints using [Postman](https://www.postman.com/).
- Ensure the web interface works by visiting `http://127.0.0.1:8000`.
