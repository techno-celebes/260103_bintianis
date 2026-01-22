#!/bin/bash
# Testing script untuk Bintianis PKL

echo "================================"
echo "Bintianis PKL - Testing Script"
echo "================================"
echo ""

# Check PHP version
echo "1. Checking PHP Version..."
php --version | head -1
echo ""

# Check Laravel version
echo "2. Checking Laravel Installation..."
php artisan --version
echo ""

# Check Database Connection
echo "3. Checking Database Connection..."
php artisan migrate:status --no-ansi | head -10
echo ""

# Check if users table has data
echo "4. Checking User Data..."
echo "Running: php artisan tinker"
echo "Type these commands:"
echo ""
echo "  User::count()                          // Should show: 7"
echo "  User::where('role','admin')->first()   // Should show: admin@bintianis.com"
echo "  Booking::count()                       // Should show bookings count"
echo ""

# Instructions
echo "================================"
echo "NEXT STEPS FOR TESTING"
echo "================================"
echo ""
echo "1. Start Laravel Server:"
echo "   php artisan serve"
echo ""
echo "2. In another terminal, start Vite:"
echo "   npm run dev"
echo ""
echo "3. Open browser and go to:"
echo "   http://localhost:8000"
echo ""
echo "4. Test Login with:"
echo "   Admin:"
echo "   - Email: admin@bintianis.com"
echo "   - Password: admin123"
echo ""
echo "   User:"
echo "   - Email: test@example.com"
echo "   - Password: password"
echo ""
echo "================================"
