# Assignment 1
## Files that have enhanced
### 1. Model
1. User.php
### 2.  View
1. profile/edit.blade.php
### 3. Controller
1. TodoController.php
2. ProfileController.php
3. RegisterController.php
4. LoginController.php
## Enhancements that have made
1. User can update profile
2. Dropdown Edit Profile
3. Allow user to register and login

# Assignment 2 (Authentication)
## Files that have enhanced
1. User.php added 'salt'
2. Actions/Fortify/CreateNewUser.php added hash with salt
3. Actions/Fortify/AuthenticateUser.php override login check with salt
4. MFAController.php handles MFA
5. views/auth/verify-mfa.blade.php view for MFA
6. FortifyServiceProvider.php add limit 3 attempts



## Enhancements that have made
1. Multi-Factor Authentication (MFA) via email using notification
2. Password hashing using + random salt stored
3. Rate limiting login attempts (max 3)
4. Laravel Fortify used as authentication scaffolding
