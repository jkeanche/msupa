# m-Supa - SaaS E-commerce System for Supermarkets

## Overview
**m-Supa** is a cutting-edge SaaS eCommerce platform designed for supermarkets to create and manage their online stores. It provides a comprehensive solution for product listing, inventory management, order processing, and customer engagement. Supermarket owners can subscribe to different packages, feature products, and even run paid banner ads on the homepage. The system is built with modern technologies, ensuring responsiveness and an intuitive user experience.

## Key Features

### 🌐 **Online Store Management**
- Supermarkets can create and customize their online stores.
- Manage inventory with stock tracking and automated alerts.
- Bulk import and export of products via CSV.

### 🛒 **Order Processing & Invoicing**
- Customers can browse, add products to cart, and place orders.
- Automated invoice generation for both shop owners and customers.
- Order status tracking with real-time updates.

### 💳 **Subscription & Payment Integration**
- Multi-tier subscription packages with different features.
- Integration with **Sasapay** for secure subscription payments.
- Auto-renewal of subscriptions and notifications for expiring plans.

### 🎯 **Featured Products & Paid Ads**
- Owners can pay to feature products for a specified period.
- Automatic removal of featured products after expiration.
- Paid banner advertisements on the homepage.

### 🔥 **Coupons & Discounts**
- Owners can create discount coupons applicable to specific products.
- Customers can redeem coupons at checkout.

### 📢 **Notifications & Alerts**
- Email and database notifications for orders, payments, and more.
- Reminders for subscription expiry and stock alerts.

### 📊 **Reports & Analytics**
- Sales reports and revenue analytics for supermarket owners.
- Subscription and earnings dashboard for admin.

### 🔍 **Advanced Search & Filtering**
- Search products by name, category, and brand.
- Filters for price range, availability, and promotions.

### 👥 **Multi-User Role Management**
- **Admin Portal**: Manage supermarkets, subscriptions, and analytics.
- **Supermarket Owners Portal**: Manage store, orders, products, and finances.
- **Customer Portal**: Browse products, place orders, track deliveries.

### 📦 **Logistics & Delivery Management**
- Owners can set delivery zones and fees.
- Integration with third-party couriers.

### 🌍 **Modern UI & Responsiveness**
- Built with **Tailwind CSS** for a sleek, modern, and responsive design.
- Intuitive and user-friendly interface across all devices.

## Tech Stack
- **Frontend**: Laravel Blade with Tailwind CSS
- **Backend**: Laravel
- **Database**: MySQL / PostgreSQL
- **Payments**: Sasapay API Integration
- **Hosting**: AWS / DigitalOcean

## Getting Started
1. Clone the repository:  
   ```bash
   git clone https://github.com/yourrepo/m-supa.git
   ```
2. Install dependencies:  
   ```bash
   cd m-supa
   composer install  # For backend
   npm install  # For frontend assets
   ```
3. Configure `.env` with database and payment gateway settings.
4. Run migrations and start the server:
   ```bash
   php artisan migrate
   php artisan serve
   ```
5. Compile frontend assets:
   ```bash
   npm run dev
   ```

## Contribution & Support
Contributions are welcome! Submit a pull request or open an issue for any feature requests or bugs.

## License
MIT License

---
**m-Supa** - Empowering Supermarkets to Go Digital 🚀

