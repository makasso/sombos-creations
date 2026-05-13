<p align="center">
  <img src="public/images/logo/logo.svg" alt="Sombos Creations Logo" width="200">
</p>

<h1 align="center">Sombos Creations</h1>

<p align="center">
  <em>A modern African fashion e-commerce platform built with Laravel 11, Livewire 3, and Filament 3.</em>
</p>

![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat-square&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-3-FB70A9?style=flat-square&logo=livewire&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-3-FDAE4B?style=flat-square&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white)

---

## 📋 Table of Contents

- [About](#about)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Seeding](#database-seeding)
- [Admin Panel](#admin-panel)
- [Project Structure](#project-structure)
- [Payment Integration](#payment-integration)
- [Email Notifications](#email-notifications)
- [Deployment (CI/CD)](#deployment-cicd)
- [Screenshots](#screenshots)
- [License](#license)

---

## 📖 About

**Sombos Creations** is a full-featured e-commerce platform specializing in African fashion — including dresses, jewelry, accessories, hats, and more. The platform supports both registered users and guest checkout, with integrated payment processing via PayPal and Stripe.

---

## ✨ Features

### 🛍️ Storefront (Frontend)
- **Product Catalog** — Browse products by categories, collections, and tags
- **Advanced Filtering** — Filter by category, collection, tag, price range, attributes (color, size), and availability
- **Product Search & Sorting** — A-Z, price, best selling, date
- **Product Detail Pages** — Image gallery, dynamic attributes display, stock indicator
- **Customer Reviews** — Star ratings and comments on products
- **Shopping Cart** — Real-time cart modal (Livewire), quantity management
- **Dual Cart System** — Database-backed for logged-in users, session-based for guests
- **Guest Checkout** — Full checkout without account creation
- **Wishlist** — Save favorites (registered users)
- **Coupon System** — Percentage discount codes with validity dates and usage limits
- **Shipping Methods** — Multiple shipping options with costs and estimated delivery
- **Order Tracking** — Guests can track orders by order number + email
- **Responsive Design** — Mobile-first Bootstrap 5 layout
- **Quick View Modal** — Preview products without leaving the page

### 💳 Payments
- **PayPal** integration (checkout redirect flow)
- **Stripe** integration (modal card element)
- Automatic stock decrement after successful payment
- Cart auto-clear after payment

### 👤 Customer Account
- Registration & Login (with session-based modal)
- Order history & details
- Account details management (name, email, phone, password)
- Wishlist management
- Address management

### 🔔 Notifications & Emails
- **Admin notification** (Filament database notification with sound) on new order
- **Admin email** on new order (order details, customer info, link to admin)
- **Customer email** on order status change (processing, shipped, delivered, cancelled)
- Real-time notification polling (every 15s) in admin panel

### 🛠️ Admin Panel (Filament 3)
- **Dashboard** — Stats overview, revenue chart, orders chart, latest orders widget
- **Products** — CRUD with image upload, category, stock, description (rich editor)
- **Categories** — CRUD with image and slug
- **Collections** — CRUD, pivot relationship with products
- **Orders** — View/Edit with status management, items & payments relation managers
- **Coupons** — CRUD with validity dates, max uses, usage tracking
- **Reviews** — Manage customer reviews
- **Tags** — CRUD, many-to-many with products
- **Attributes & Values** — Dynamic attributes (color, size, etc.) with product pivot
- **Shipping Methods** — Name, cost, estimated delivery
- **Users** — Manage customers with role control
- **Admin Self-Protection** — Cannot delete own admin account
- **Navigation Groups** — Shop, Sales, Customers, Settings
- **Violet Theme** — Custom branding with Plus Jakarta Sans font

---

## 🧰 Tech Stack

| Layer | Technology |
|-------|------------|
| **Backend** | Laravel 11, PHP 8.2+ |
| **Frontend** | Blade, Livewire 3, Bootstrap 5 |
| **Admin Panel** | Filament 3 (Tailwind CSS) |
| **Database** | MySQL / MariaDB |
| **Payments** | PayPal SDK (`srmklive/paypal`), Stripe (`stripe/stripe-php`) |
| **Notifications** | Laravel Mail (Markdown), Filament Database Notifications |
| **Alerts** | LivewireAlert (`jantinnerezo/livewire-alert`), SweetAlert2 |
| **Assets** | Vite, PostCSS |
| **Fonts** | Playfair Display SC (titles), Playfair Display (body), Plus Jakarta Sans (admin) |

---

## 📦 Requirements

- PHP >= 8.2
- Composer
- MySQL >= 5.7 or MariaDB >= 10.3
- Node.js >= 18 & npm
- Apache (XAMPP) or Nginx

---

## 🚀 Installation

### 1. Clone the repository

```bash
git clone https://github.com/your-username/sombos-creations.git
cd sombos-creations
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install Node.js dependencies

```bash
npm install
```

### 4. Environment setup

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure your `.env`

```env
APP_NAME="Sombos Creations"
APP_URL=http://localhost/sombos-creations

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sombos_creations
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=your@email.com
MAIL_PASSWORD=your-password
MAIL_FROM_ADDRESS=noreply@somboscreations.com
MAIL_FROM_NAME="Sombos Creations"

PAYPAL_MODE=sandbox
PAYPAL_SANDBOX_CLIENT_ID=your-paypal-client-id
PAYPAL_SANDBOX_CLIENT_SECRET=your-paypal-secret

# Production PayPal (used when PAYPAL_MODE=live)
PAYPAL_LIVE_CLIENT_ID=your-live-paypal-client-id
PAYPAL_LIVE_CLIENT_SECRET=your-live-paypal-secret

# Test Stripe (used when APP_ENV != production)
STRIPE_KEY=pk_test_xxx
STRIPE_SECRET=sk_test_xxx

# Production Stripe (used when APP_ENV = production)
STRIPE_LIVE_KEY=pk_live_xxx
STRIPE_LIVE_SECRET=sk_live_xxx
```

### 6. Run migrations

```bash
php artisan migrate
```

### 7. Create storage symlink

```bash
php artisan storage:link
```

### 8. Build frontend assets

```bash
npm run build
```

### 9. Seed the database (optional)

```bash
php artisan db:seed
```

### 10. Start the development server

```bash
php artisan serve
```

Or use XAMPP/Apache pointing to the `public/` directory.

---

## ⚙️ Configuration

### Payment Gateways

Configure PayPal and Stripe credentials in your `.env` file. The application supports both sandbox and live modes.

### Mail

For local development, you can use `MAIL_MAILER=log` to send emails to `storage/logs/laravel.log`. For production, configure SMTP (Gmail, Mailgun, SendGrid, etc.).

### File Storage

Product images are stored in `storage/app/public/products/`. Make sure the symlink exists:

```bash
php artisan storage:link
```

---

## 🌱 Database Seeding

The application includes seeders for products across 6 categories:
- Dresses
- Women
- Jewelries
- Accessories
- Men
- African Hat

```bash
php artisan db:seed
```

---

## 🔐 Admin Panel

Access the admin panel at: **`/admin`**

### Default Admin Credentials

Create an admin user via tinker:

```bash
php artisan tinker
```

```php
App\Models\User::create([
    'firstname' => 'Admin',
    'lastname' => 'User',
    'email' => 'admin@somboscreations.com',
    'password' => bcrypt('password'),
    'role' => 'admin',
]);
```

### Admin Features
- 📊 Dashboard with stats, charts, and recent orders
- 📦 Full product management (CRUD, images, categories, attributes)
- 🛒 Order management with status updates (auto-emails to customers)
- 🎟️ Coupon management
- ⭐ Review moderation
- 👥 User management
- 🔔 Real-time notifications with sound on new orders

---

## 📁 Project Structure

```
sombos-creations/
├── app/
│   ├── Filament/
│   │   ├── Resources/          # Filament admin resources (Product, Order, etc.)
│   │   └── Widgets/            # Dashboard widgets (Stats, Charts)
│   ├── Http/Controllers/       # Frontend controllers
│   ├── Listeners/              # Event listeners (MergeGuestCart)
│   ├── Livewire/               # Livewire components
│   │   ├── CartItem.php
│   │   ├── CartRow.php
│   │   ├── ProductCard.php
│   │   ├── SingleProduct.php
│   │   └── Modals/ShoppingCart.php
│   ├── Mail/                   # Mailable classes
│   ├── Models/                 # Eloquent models
│   ├── Notifications/          # Notification classes
│   ├── Observers/              # Model observers (OrderObserver)
│   ├── Providers/              # Service providers
│   └── Services/               # Business logic (PaymentService)
├── database/
│   ├── migrations/             # Database migrations
│   └── seeders/                # Data seeders
├── resources/views/
│   ├── layouts/                # Main layout
│   ├── livewire/               # Livewire component views
│   ├── modals/                 # Bootstrap modals (cart, filters, quick view)
│   ├── partials/               # Header, footer, etc.
│   ├── emails/                 # Email templates (markdown)
│   ├── my-account/             # Account pages
│   └── ...                     # Page views (shop, checkout, etc.)
├── public/
│   ├── images/                 # Static images
│   ├── css/                    # Compiled CSS
│   ├── js/                     # JavaScript
│   └── storage -> ../storage/app/public
├── routes/
│   └── web.php                 # All frontend routes
└── config/                     # Configuration files
```

---

## 💳 Payment Integration

### PayPal
- Uses `srmklive/paypal` package
- Redirect-based flow: user is sent to PayPal, then returns to success/cancel URL
- Order is created before redirect, payment recorded on success callback

### Stripe
- Uses `stripe/stripe-php` package
- In-page card element via Stripe.js
- Token-based payment (create token → charge)
- Modal-based card form in checkout page

---

## 📧 Email Notifications

| Event | Recipient | Template |
|-------|-----------|----------|
| New order placed | Admin(s) | `emails.new-order-admin` |
| Order status updated | Customer | `emails.order-status-updated` |

Emails use Laravel Markdown Mailables with `x-mail::message` components for consistent styling.

---

## 🗺️ Routes Overview

| Route | Description |
|-------|-------------|
| `/` | Homepage (best sellers, collections, categories, new arrivals) |
| `/shop` | Shop with filters (category, collection, tag, price, attributes) |
| `/products/{slug}` | Single product page |
| `/collections` | All collections grid |
| `/cart` | Cart page |
| `/checkout` | Checkout (guest + authenticated) |
| `/checkout/success` | Order confirmation |
| `/order/track` | Guest order tracking |
| `/my-account` | Customer dashboard |
| `/my-account/orders` | Order history |
| `/my-account/wishlist` | Wishlist |
| `/about` | About us page |
| `/contacts` | Contact page |
| `/admin` | Filament admin panel |

---

## 🚀 Deployment (CI/CD)

This project uses **GitHub Actions** for automated deployment to **Hostinger** shared hosting.

### How it works

On every push to `main`, the workflow:
1. ✅ Installs PHP & Composer dependencies
2. ✅ Installs Node.js & builds frontend assets (Vite)
3. ✅ Deploys to Hostinger via SSH (or SFTP as fallback)
4. ✅ Runs migrations, caches config/routes/views

### GitHub Secrets Required

Add these in your GitHub repo → **Settings** → **Secrets and variables** → **Actions**:

| Secret | Description |
|--------|-------------|
| `HOSTINGER_HOST` | Your Hostinger server IP (e.g., `154.41.xx.xx`) |
| `HOSTINGER_USERNAME` | SSH username (from Hostinger hPanel → SSH Access) |
| `HOSTINGER_SSH_KEY` | Your private SSH key (content of `id_rsa`) |
| `HOSTINGER_PORT` | SSH port (usually `65002` on Hostinger) |
| `HOSTINGER_DOMAIN` | Your domain (e.g., `somboscreations.com`) |

### Initial Server Setup (one-time)

```bash
# 1. SSH into your Hostinger server
ssh -p 65002 u123456789@154.41.xx.xx

# 2. Navigate to your domain's public directory
cd ~/domains/somboscreations.com/public_html

# 3. Clone the repo
git clone https://github.com/your-username/sombos-creations.git .

# 4. Set up environment
cp .env.example .env
nano .env  # Configure production values (APP_ENV=production, DB, mail, payments...)

# 5. Generate app key
php artisan key:generate

# 6. Run migrations
php artisan migrate

# 7. Create storage symlink
php artisan storage:link

# 8. Set permissions
chmod -R 775 storage bootstrap/cache
```

### Production `.env` Checklist

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://somboscreations.com

PAYPAL_MODE=live
PAYPAL_LIVE_CLIENT_ID=your-live-client-id
PAYPAL_LIVE_CLIENT_SECRET=your-live-secret

STRIPE_LIVE_KEY=pk_live_xxx
STRIPE_LIVE_SECRET=sk_live_xxx
```

### Workflows Available

- **`.github/workflows/deploy.yml`** — Deploy via SSH (recommended, requires SSH access on your Hostinger plan)
- **`.github/workflows/deploy-sftp.yml`** — Deploy via SFTP (fallback if SSH commands unavailable)

> ⚠️ Use only **one** workflow at a time. Rename or delete the one you don't use.

---

## 🖼️ Screenshots

> Add screenshots of the storefront, product page, checkout, and admin panel here.

---

## 📄 License

This project is proprietary software developed for Sombos Creations.
