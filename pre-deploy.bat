@echo off
echo ========================================
echo PRE-DEPLOY SETUP - FILIA INTERIOR
echo ========================================
echo.

echo [1/5] Installing NPM dependencies...
call npm install
if %errorlevel% neq 0 (
    echo ERROR: NPM install failed!
    pause
    exit /b 1
)
echo DONE!
echo.

echo [2/5] Building production assets...
call npm run build
if %errorlevel% neq 0 (
    echo ERROR: Build failed!
    pause
    exit /b 1
)
echo DONE!
echo.

echo [3/5] Generating APP_KEY...
php artisan key:generate --show > temp_key.txt
set /p APP_KEY=<temp_key.txt
del temp_key.txt
echo.
echo ======================================
echo IMPORTANT: Copy this APP_KEY!
echo ======================================
echo %APP_KEY%
echo ======================================
echo.
echo Save this key for Vercel Environment Variables!
echo.

echo [4/5] Testing database connection...
php sync_to_aiven.php
echo.

echo [5/5] Optimization...
php artisan config:clear
php artisan cache:clear
php artisan view:clear
echo DONE!
echo.

echo ========================================
echo PRE-DEPLOY SETUP COMPLETED!
echo ========================================
echo.
echo Next steps:
echo 1. Install Vercel CLI: npm install -g vercel
echo 2. Login: vercel login
echo 3. Deploy: vercel
echo 4. Set APP_KEY in Vercel dashboard
echo 5. Deploy production: vercel --prod
echo.
echo Read DEPLOY_VERCEL.md for detailed instructions
echo.
pause
