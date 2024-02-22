## Installation

Follow these steps to set up and run the project locally:

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/izazdhiya/purchase-return.git

2. **Install Dependencies:**
   ```bash
   composer install

3. **Copy Environment File:**
   ```bash
   cp .env.example .env

4. **Generate Aplication Key:**
   ```bash
   php artisan key:generate

5. **Configure Database:**
   - Create a new database for the project.
   - Update the .env file with your database credentials.

6. **Run Migration and Seeder:**
   ```bash
   php artisan migrate && php artisan db:seed

7. **Install Node Dependencies:**
   ```bash
   npm install && npm run dev

8. **Serve The Application:**
   ```bash
   php artisan serve

##
**Admin**
email: admin@example.com
pass: admin

**Gudang**
email: gudang@example.com
pass: admin

**Kurir**
email: kurir@example.com
pass: admin






