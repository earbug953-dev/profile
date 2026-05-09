# Omuruka Michael — Laravel Portfolio

A full Laravel portfolio with an admin panel to manage projects and view client messages.

---

## 📁 File Map

```
laravel-portfolio/
├── routes/
│   └── web.php                          # All routes
├── app/
│   ├── Models/
│   │   ├── Project.php                  # Project model
│   │   └── Message.php                  # Message model (contact form)
│   └── Http/Controllers/
│       ├── PortfolioController.php      # Public portfolio
│       └── Admin/
│           └── ProjectController.php    # Admin CRUD
├── database/migrations/
│   ├── ..._create_projects_table.php
│   └── ..._create_messages_table.php
└── resources/views/
    ├── layouts/
    │   ├── app.blade.php                # Public layout
    │   └── admin.blade.php              # Admin layout
    ├── portfolio.blade.php              # Public portfolio page
    └── admin/
        ├── messages.blade.php           # Inbox
        └── projects/
            ├── index.blade.php          # Project list + dashboard
            ├── create.blade.php         # Add project form
            └── edit.blade.php           # Edit project form
```

---

## 🚀 Installation

### 1. Create a new Laravel project
```bash
composer create-project laravel/laravel my-portfolio
cd my-portfolio
```

### 2. Copy these files into your project
Copy each file from this package into the matching path inside your Laravel project.

### 3. Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Run migrations
```bash
php artisan migrate
```

### 5. Set up storage for images
```bash
php artisan storage:link
```

### 6. Install auth (for admin login)
```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build
php artisan migrate
```

### 7. Create your admin account
```bash
php artisan tinker
User::create(['name'=>'Michael','email'=>'me@email.com','password'=>bcrypt('yourpassword')]);
```

### 8. Serve the application
```bash
php artisan serve
```

---

## 🔗 Routes

| URL                        | Description                  |
|----------------------------|------------------------------|
| `/`                        | Public portfolio              |
| `/contact` (POST)          | Contact form submission       |
| `/admin`                   | Admin dashboard (auth required)|
| `/admin/projects/create`   | Add a new project             |
| `/admin/projects/{id}/edit`| Edit a project                |
| `/admin/messages`          | View client messages          |

---

## ✏️ Customization

### Update your personal details
In `resources/views/portfolio.blade.php`, search for:
- `omurukamichael@email.com` → your real email
- `upwork.com/freelancers/omuruka` → your Upwork profile URL
- `github.com/omurukamichael` → your GitHub URL

### Update stat numbers (hero section)
The `Years Coding` stat is hardcoded as `3+` — update it to match your actual experience.

---

## 🖼️ Adding Projects (Admin)

1. Go to `/login` and sign in
2. Visit `/admin`
3. Click **+ Add Project**
4. Fill in: title, type, description, tech stack, URLs, image
5. Check **Featured** to make it show large at the top of your portfolio
6. Save → it appears on your portfolio immediately

---

## 📬 Contact Form

Messages from the contact form are stored in the `messages` table.
View them at `/admin/messages`.

To also get email notifications, add this to `PortfolioController@contact`:
```php
\Mail::to('omurukamichael@email.com')->send(new \App\Mail\NewMessage($validated));
```
Then run: `php artisan make:mail NewMessage`
