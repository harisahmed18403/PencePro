# PencePro
I buy and sell guitars as a hobby and, after handling so many transactions, I built this PencePro.


PencePro is a Laravel 12 application designed to help users manage their buying and selling activities.


Access the site here <a href='harisahmed.uk/pencepro'>harisahmed.uk/pencepro</a>


The application uses the terms **Lick** for purchases and **Spit** for sales. Users can record their transactions and view detailed statistics.


The application is responsive, supporting both mobile and desktop devices, and can be installed as a Progressive Web App (PWA).


![Home Page Mobile](readme/mobile_home.png.png)
![Home Page Desktop](readme/desktop_home.png.png)
## Features

- Record **Licks** (purchases) and **Spits** (sales)
- View statistics
- Responsive design for mobile and desktop
- Installable as a PWA

![Stats Page](readme/mobile_stats.png.png)

## Technologies

- Laravel 12
- SQLite
- Blade templates with DaisyUI
- Progressive Web App support

## Installation

1. Clone the repository:

```bash
git clone <repository-url>
cd pencepro
```

2. Install dependencies:

```bash
composer install
npm install
npm run build
```

3. Configure environment:

```bash
cp .env.example .env
php artisan key:generate
```

4. Run migrations:

```bash
php artisan migrate
```

5. Serve the application:

```bash
php artisan serve
```

## Usage

Access the app in your browser or install it as a PWA.

Create Licks to store purchases.

Add Spits to track sales.

View statistics to analyze your transactions.
