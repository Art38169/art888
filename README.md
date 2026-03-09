# ART888 — The House of Chance

## Description

A casino-style web application where users play **Dice** and **Coin Flip** games using virtual credits. No real money involved. Built with Laravel 12, Livewire, and Fortify.

New users start with **1,000 credits**. Coin flips pay 2×. Dice rolls pay 2× (under/over 7) or 5× (exact 7).

## Installation

Clone the repository:

```bash
git clone https://github.com/Art38169/art888.git
cd art888
```

Install dependencies:

```bash
composer install
```

Set up the environment:

```bash
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
```

Run migrations and seed:

```bash
php artisan migrate:fresh --seed
```

Start the development server:

```bash
php artisan serve
```

## Usage

The seeder creates one user:

- **Email:** `test@example.com`
- **Password:** `password`

## Data Structure

The application uses four models:

- **User** — has credits, can play games and view transaction history. Supports two-factor authentication.
- **CoinGame** — a coin flip result (heads/tails, wager, payout).
- **DiceGame** — a dice roll result (two dice, pick under/exact/over 7, wager, payout).
- **Transaction** — pivot table linking Users and Games. Records every wager and payout with extra columns (type, amount, balance_after).

### Relationships

- A **User** has many CoinGames, DiceGames, and Transactions.
- A **CoinGame** belongs to a User and has many Transactions (morphMany).
- A **DiceGame** belongs to a User and has many Transactions (morphMany).
- A **Transaction** belongs to a User and belongs to a game (morphTo — CoinGame or DiceGame).
- **User ↔ Game** is a polymorphic many-to-many relationship through the Transactions table.
