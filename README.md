# Assignment 1
## Enhanced Files
1. RegisterRequest.php
2. LoginRequest.php
3. ProfileController.php
4. register.blade.php
5. login.blade.php
6. edit.blade.php
7. User.php
8. routes/web.php

## Enhancement Made
1. Implemented Form Request Validation using Laravel rules & regex
2. Added new Profile Page with:
  - Editable nickname
  - Profile picture upload
  - Editable email, password, phone, city
  - Delete Account function
-----------------------------------------
# Assignment 2 
## Enhanced Files
1. .env file for mailtrap/MFA but the code only can be get in artisan tinker
2. LoginController.php
3. SendMfaCode.php
4. MfaController.php
5. mfa.blade.php
6. config/fortify.php
7. app/Providers/FortifyServiceProvider.php

## Enhancement Made
1.  Integrated Laravel Fortify
2.  Generates 6-digit verification code
3.  Code expires after 5 minutes
4.  Implemented Rate Limiting (3 failed login attempts max)
5.  Enhanced password security with Random salt & hashing (bcrypt/argon2)
------------------------------------------------
# Assignment 3
## Enhanced Files
1. UserRole.php
2. RolePermission.php
3. Middleware/CheckRole.php
4. list.blade.php

## Enhancement Made
1. Store roles
2. View each user’s tasks
3. user can to CRUD only


