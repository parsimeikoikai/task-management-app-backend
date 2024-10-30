# Simple API for a Task Management System

## Project Overview

This is a simple RESTful API using Lumen that allows users to manage tasks. The API handles basic CRUD (Create, Read, Update, Delete) operations for tasks.

### Requirements:

1. **Task Model**:
   - Fields: `id`, `title`, `description`, `status` (e.g., pending, completed), `due_date`, `created_at`, `updated_at`.
   - The `title` field should be required and unique.
   - The `status` field should have a default value of "pending".
   - The `due_date` should be a date in the future.

2. **API Endpoints**:
   - Create a Task
   - Get All Tasks
   - Get a Specific Task
   - Update a Task
   - Delete a Task

3. **Validation**:
   - Ensure all incoming requests are validated for required fields and correct data types.
   - Return appropriate error messages for invalid requests.

4. **Database**:
   - Use PostgreSQL for database storage.
   - Include a migration to create the tasks table.

5. **Bonus Features**:
   - Implement task filtering by status and due_date.
   - Add pagination to the task listing endpoint.
   - Add a search functionality to find tasks by title.

## Setup Instructions

1. **Clone the repository**:

   ```bash
   git clone git remote add origin https://github.com/parsimeikoikai/task-management-app-backend.git
   
   cd task-management-app-backend

2. **Install dependencies:**:

   ```bash
   composer install

3. **Clone the repository**:

   ```bash
   cp .env.example .env

4. **Generate an application key:**:

   ```bash
   php artisan key:generate


5. **Run the database migration:**:

   ```bash
   Copy code
   php artisan migrate

6. **Start the server: :**:
    ```bash
   php -S localhost:8000 -t public

API Access: The API will be accessible at http://localhost:8000

NB : I have also included a screenshots folder with sample screenshots of how to run the different requests