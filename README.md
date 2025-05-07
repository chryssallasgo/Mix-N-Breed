# 🐶 MixNBreed - Getting Started

Welcome to the **MixNBreed** project!  
Follow these steps to set up the project on your local machine.

---

## 🚀 1. Clone the Repository

```bash
git clone https://github.com/your-username/mixnbreed.git
cd mixnbreed
```

---

## 🛠️ 2. Install Dependencies

```bash
composer install
npm install
npm run dev
```

---

## 🔑 3. Set Up Environment Variables

Copy the example environment file and update it:

```bash
cp .env.example .env
```

Edit your `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mixnbreed_db
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

---

## 🗝️ 4. Generate Application Key

```bash
php artisan key:generate
```

---

## 🗄️ 5. Run Migrations

```bash
php artisan migrate
```

---

## 🐬 6. Set Up MySQL Database

1. **Open MySQL Workbench** (install it if you don’t have it).
2. **Create a new connection** with the following settings:
![image](https://github.com/user-attachments/assets/64e62d0f-4865-4ab8-b276-cbf293877a14)
    - **Connection Name:** `mixnbreed`
    - **Database Name:** `mixnbreed_db`
    - **Username:** `root`
    - **Password:** (your MySQL password)

> **Tip:** Make sure the database name in MySQL matches the one in your `.env` file.

---

## 💡 Quick Reference

| Step                | Command / Setting                                 |
|---------------------|---------------------------------------------------|
| Clone repo          | `git clone ...`                                   |
| Install PHP deps    | `composer install`                                |
| Install JS deps     | `npm install`                                     |
| Build assets        | `npm run dev`                                     |
| Generate app key    | `php artisan key:generate`                        |
| Run migrations      | `php artisan migrate`                             |
| DB name             | `mixnbreed_db`                                    |
| DB user             | `root`                                            |
| DB password         | (your MySQL password)                             |

---

## 📸 MySQL Workbench Example

> _You can include a screenshot here for visual reference if you’d like!_

---

## 🎉 You’re All Set!

You can now run the project locally and start developing.  
If you run into issues, double-check your `.env` file and database settings.


