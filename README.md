# 🛒 Marketplace System

A full-stack marketplace web application built with Laravel.

---

## 🚀 Tech Stack

- **Backend:** Laravel
- **Frontend:** Livewire + Blade
- **Styling:** Tailwind CSS
- **Database:** MySQL
- **Admin Panel:** Orchid

---

## 👥 User Roles

- Admin
- Vendor
- Customer
- Delivery Staff

---

## 🧱 Database Structure

### Core Tables

- Users
- Vendors
- Customers
- Categories
- Products
- Orders
- Order Items
- Payments
- Deliveries
- Reviews
- Vendor Payouts

---

## 🔗 Relationships

- One User → One Vendor / Customer
- Vendor → Many Products
- Customer → Many Orders
- Order → Many Order Items
- Product → Many Order Items
- Order → One Payment
- Order → One Delivery
- Product → Many Reviews
- Vendor → Many Payouts

---

## 📦 Features (Current Progress)

### ✅ Completed

- Laravel project setup
- Livewire installed
- Orchid admin panel installed
- Database migrations created
- Model relationships implemented

### 🚧 In Progress

- Authentication customization
- Product management (CRUD)
- Vendor dashboard

### 🔜 Planned

- Shopping cart
- Checkout system
- Payment integration
- Delivery tracking
- Review system
- Admin analytics dashboard

---

## ⚙️ Installation

```bash
git clone https://github.com/your-username/marketplace.git
cd marketplace

composer install
npm install

cp .env.example .env
php artisan key:generate

# configure database in .env

php artisan migrate

npm run dev
php artisan serve
```

---

## 🔐 Admin Access (Orchid)

```bash
php artisan orchid:admin admin admin@example.com password
```

Access admin panel:

```
http://127.0.0.1:8000/admin
```

---

## 🧠 Development Workflow

```text
Code → Test → Commit → Push → Update README
```

---

## 📌 Notes

- Uses Laravel conventions (`id` as primary key)
- Foreign keys follow relational structure
- Designed for scalability (multi-vendor marketplace)

---

## 📅 Progress Log

### Day 1
- Project initialized
- Installed Livewire + Orchid
- Created database schema
- Fixed migration ordering issues
- Implemented model relationships

---

## 📄 License

This project is for learning purposes.
