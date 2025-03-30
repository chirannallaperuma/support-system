# Support Ticket App

Online Support System is a web application which helps service providers and sellers to
provide after-sales support for their customers. Customers are allowed to open a ticket when
they need assistance on something related to the product or service they purchased. Support
agents get in contact with the ticket owner to help resolve their issues.

## Features

- Laravel 12
- Submit support tickets
- View ticket status and history
- Ticket Management Dashboard
- Email integration for ticket acknowledgements and update

## Installation

Follow the steps below to set up the project on your local machine:

### Prerequisites

- PHP (>=8.1)
- Composer
- Node.js & NPM (for frontend assets)

### Setup Instructions

1. **Clone the Repository**  
    git clone https://github.com/chirannallaperuma/support-system
    cd <project-folder>

2. **Install Dependencies**  
    composer install
    npm install

3. **Environment Setup**  
    cp .env.example .env
    php artisan key:generate

4. **Run Migrations and Seeders**
    php artisan migrate

5. **Start Development Server**
    php artisan serve
