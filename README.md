# 🛒 Multi-Vendor Marketplace System

A full-stack multi-vendor marketplace web application built with **Laravel**, **Livewire**, **Tailwind CSS**, **MySQL**, and **Orchid Admin Panel**.

The platform supports complete marketplace operations including:

- Customer shopping flow
- Vendor product management
- Delivery management
- Admin moderation
- Vendor payouts
- Product reviews

---

# 🚀 Tech Stack

| Technology | Usage |
|---|---|
| Laravel | Backend Framework |
| Livewire | Dynamic Frontend Components |
| Blade | Templating Engine |
| Tailwind CSS | UI Styling |
| MySQL | Database |
| Orchid Platform | Admin Dashboard |
| Vite | Frontend Asset Bundler |

---

# 👥 User Roles

## 🛍 Customer

- Browse products
- Filter by categories
- Add to cart
- Checkout orders
- Track deliveries
- Leave reviews

---

## 🏪 Vendor

- Vendor dashboard
- Product CRUD
- Upload product images
- Manage orders
- Update order statuses
- View payouts

---

## 🚚 Delivery Staff

- View assigned deliveries
- Update delivery statuses
- Complete deliveries

---

## 🛠 Admin

- Approve vendors
- Assign delivery staff
- Release vendor payouts
- Manage users and roles
- Monitor marketplace operations

---

# ✨ Features

# ✅ Customer Features

- Product listing page
- Product detail page
- Category browsing
- Shopping cart
- Quantity management
- Checkout system
- Payment method selection
- Order success page
- Order history
- Product reviews

---

# ✅ Vendor Features

- Vendor dashboard
- Product management
- Inventory tracking
- Vendor orders page
- Earnings / payouts page

---

# ✅ Delivery Features

- Delivery dashboard
- Delivery assignment
- Delivery status updates
- Order auto-completion

---

# ✅ Admin Features

- Orchid admin panel
- Vendor approval system
- Delivery assignment system
- Vendor payout management
- System user management

---

# 🎨 UI Improvements

- Modern marketplace navbar
- Shared marketplace layout
- Card-based product design
- Improved checkout experience
- Responsive marketplace UI
- Enhanced category browsing
- Modern vendor dashboard

---

# 🧱 Database Structure

## Core Tables

- users
- vendors
- customers
- categories
- products
- orders
- order_items
- payments
- deliveries
- reviews
- vendor_payouts

---

# 🔗 Relationships

| Relationship | Type |
|---|---|
| User → Vendor | One-to-One |
| User → Customer | One-to-One |
| Vendor → Products | One-to-Many |
| Customer → Orders | One-to-Many |
| Order → Order Items | One-to-Many |
| Product → Order Items | One-to-Many |
| Order → Payment | One-to-One |
| Order → Delivery | One-to-One |
| Product → Reviews | One-to-Many |
| Vendor → Vendor Payouts | One-to-Many |

---

# 📂 Main Routes

| Route | Description |
|---|---|
| `/` | Product Listing |
| `/categories` | Category Page |
| `/cart` | Cart & Checkout |
| `/orders` | Customer Order History |
| `/vendor/dashboard` | Vendor Dashboard |
| `/vendor/products` | Vendor Products |
| `/vendor/orders` | Vendor Orders |
| `/vendor/payouts` | Vendor Earnings |
| `/delivery/dashboard` | Delivery Dashboard |
| `/admin` | Orchid Admin Panel |

---

# 🔐 Demo Accounts

All demo accounts use:

```text
password
```

---

## 👑 Admin

```text
admin@example.com
```

---

## 🏪 Vendor

```text
vendor@example.com
```

---

## 🛍 Customer

```text
customer@example.com
```

---

## 🚚 Delivery Staff

```text
delivery@example.com
```

---

# ⚙️ Installation

## 1. Clone Repository

```bash
git clone https://github.com/your-username/marketplace.git
cd marketplace
```

---

## 2. Install Dependencies

```bash
composer install
npm install
```

---

## 3. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Configure database inside `.env`

---

## 4. Run Migrations & Seeders

```bash
php artisan migrate:fresh --seed
```

---

## 5. Start Development Server

```bash
npm run dev
php artisan serve
```

---

# 🛠 Orchid Admin Setup

If admin access is not available:

```bash
php artisan orchid:admin admin admin@example.com password
```

Admin panel URL:

```text
http://127.0.0.1:8000/admin
```

---

# 📸 Suggested Future Improvements

## 🔜 Planned Upgrades

- PDF receipt export
- Email notifications
- Invoice generation
- Buy Now payment flow
- Order detail pages
- Admin analytics dashboard
- Charts and reporting
- Mobile optimization
- Notification system
- Real payment integration
- Advanced delivery tracking

---

# 🧠 Development Workflow

```text
Plan
→ Build
→ Test
→ Commit
→ Push
→ Improve UI
→ Update README
```

---

# 📅 Project Progress

## ✅ Phase 1

- Laravel setup
- Livewire setup
- Orchid installation
- Database schema design
- Authentication system
- Role system

---

## ✅ Phase 2

- Product management
- Vendor management
- Shopping cart
- Checkout flow
- Order system
- Payment records

---

## ✅ Phase 3

- Delivery workflow
- Vendor payouts
- Admin approval system
- Review system
- Marketplace UI redesign

---

# 📄 License

This project is built for learning, portfolio, and educational purposes.
