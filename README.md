# Packly

Open source travel packing checklist web app. Never forget anything when you travel.

Built with Laravel 13 + SB Admin 2.

## Features

- Create trips with destination and date
- Packing checklist per trip, organized by category (Documents, Tech, Clothes, Hygiene)
- Track progress per trip
- Save and reuse packing templates (Beach, Business, Mountain, City Break...)
- Simple auth (register / login)

## Requirements

- PHP >= 8.3
- Composer
- Node.js >= 18

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
```

## License

MIT — [Eugenio Giusti](https://github.com/eugeniogiusti)
