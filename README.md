![Logo](public/img/logo.png)

# Packly

Open source travel packing checklist web app. Never forget anything when you travel.

🚧 **Project Status: Work in Progress**

Packly is an early-stage project currently under active development.  
The core features are implemented and working, but both backend and frontend require refactoring and improvements.

This project started as a rapid prototype (partially generated with AI) and is being progressively refined to align with clean code principles and Laravel best practices.

## Features

- Create trips with destination and date
- Packing checklist per trip, organized by category (Documents, Tech, Clothes, Hygiene)
- Track progress per trip
- Save and reuse packing templates (Beach, Business, Mountain, City Break...)
- Simple authentication (register / login)

## Tech Stack

- Laravel 13
- PHP 8.3+
- Node.js 18+
- SB Admin 2 (UI)

## Project Goals

- Refactor backend to follow clean architecture and Laravel best practices
- Improve frontend structure and UX
- Enhance code quality, maintainability, and scalability
- Add automated tests

## Contributing

Contributions, suggestions, and feedback are welcome.

Please note: the codebase is currently being refactored, so structure and conventions may change.

## Installation

```bash
git clone https://github.com/eugeniogiusti/Packly.git
cd Packly

composer install
npm install

cp .env.example .env
php artisan key:generate

# SQLite (default)
touch database/database.sqlite
php artisan migrate

npm run build
php artisan serve