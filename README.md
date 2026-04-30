# TradeNest - Technical Documentation & User Guide  
TradeNest is a full-stack local online marketplace platform designed for users to buy and sell products seamlessly with secure transactions and a scalable architecture.

---

## 1. Technical Stack  

| Layer | Technology |
|------|-----------|
| Frontend | HTML5, CSS3, Bootstrap 5 (Responsive UI) |
| Interactivity | JavaScript (ES6+), AJAX (Fetch API) |
| Backend | PHP 8.x (Object-Oriented Programming) |
| Database | MySQL 8.x |
| Architecture | MVC-Patterned OOP |

---

## 2. Database Schema  

The database **tradenest_db** consists of 4 main relational tables:

- **users**: Stores user account information and credentials  
- **products**: Stores product listings created by users  
- **orders**: Stores purchase transactions  
- **order_items**: Stores individual items within each order  

### ER Diagram (Textual Representation)


[Users] 1 ------- N [Products]

[Users] 1 ------- N [Orders]

[Orders] 1 ------- N [Order_Items]

[Products] N ------- N [Orders] (via Order_Items)


---

## 3. Setup & Installation (Localhost)  

### Prerequisites  

- PHP 8.0 or higher  
- MySQL Server  
- Web Server (XAMPP / WAMP / Laragon recommended)  

### Step-by-Step Installation  

1. **Clone/Copy the Project**  
   Place the `TradeNest` folder inside:  

C:/xampp/htdocs/


2. **Database Setup**  
- Open phpMyAdmin  
- Create a database named:  
  ```
  tradenest_db
  ```
- Import the SQL file from:  
  ```
  TradeNest/sql/schema.sql
  ```

3. **Configuration**  
Open:  

TradeNest/config/database.php

Update credentials:

DB_USER = root
DB_PASS = (leave empty or your password)


4. **Launch Project**  
Open browser:  

http://localhost/TradeNest


---

## 4. User Guide & Features  

### A. Authentication System  
- Secure registration with BCRYPT password hashing  
- Session-based login system  
- Protected routes with automatic redirection  

---

### B. Product Management (CRUD)  
- Add new product listings with image upload  
- Edit or delete products from dashboard  
- Search products using keywords  
- View all listings on homepage  

---

### C. Shopping Cart System  
- Session-based cart (no database dependency before checkout)  
- Add/remove/update items dynamically  
- Cart persists across pages  
- O(1) lookup for product existence  

---

### D. Order Management  
- Checkout converts cart into permanent orders  
- Stores price snapshot at purchase time  
- Buyers can view order history  
- Sellers can view received orders  

---

### E. Image Upload System  
- Unique filename generation using `time()`  
- Stored in:

assets/uploads/

- Only filename saved in database (optimized storage)  

---

## 5. Security Implementations  

- **SQL Injection Protection**: PDO Prepared Statements  
- **XSS Protection**: `htmlspecialchars()`  
- **Password Security**: BCRYPT hashing  
- **Authentication Guard**: Session-based access control  
- **File Upload Safety**: Unique naming to prevent conflicts  

---

## 6. Folder Structure  


/api → Backend endpoints (AJAX handlers)
/assets → CSS, JS, uploaded images
/classes → Core OOP logic (User, Product, Order)
/config → Database configuration
/includes → Reusable UI components
/pages → Application views
/sql → Database schema
index.php → Central router (entry point)


---

## 7. System Architecture  

- Centralized routing via `index.php`  
- MVC-inspired separation of concerns  
- Modular OOP design for scalability  
- Session-based state management  

---

## 8. Key Features Summary  

- Full-stack marketplace system  
- Buyer & Seller unified roles  
- Dynamic product search  
- Secure checkout with transaction safety  
- Real-time cart system using sessions  
- Clean MVC-based architecture  
