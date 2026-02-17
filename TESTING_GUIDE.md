# Testing Guide - Professional Features

## 🚀 Quick Start
Server is running at: **http://127.0.0.1:8000**

---

## 1️⃣ Product Image Zoom (✨ READY TO TEST)

### Test Steps:
1. **Go to any product page:**
   - http://127.0.0.1:8000/products/asil-571
   - http://127.0.0.1:8000/products/zomorrod-zmrrd
   - http://127.0.0.1:8000/products/deem-dym

2. **Test Zoom Functionality:**
   - Hover your mouse over the main product image
   - You should see:
     - ✅ A circular lens overlay (gold border) following your cursor
     - ✅ A zoom result window appearing on the right side
     - ✅ 2.5x magnified view of the area under the lens
   
3. **Test Thumbnail Switching:**
   - Click on different thumbnail images
   - The zoom should update to the new image

4. **Test Mobile Behavior:**
   - Resize browser window to < 992px width
   - Zoom should be disabled on mobile

### Expected Results:
- ✅ Smooth cursor tracking
- ✅ Lens stays within image boundaries
- ✅ Zoom window shows magnified detail
- ✅ No console errors

---

## 2️⃣ Order Tracking System (✨ READY TO TEST)

### Test Steps:

**Option A: Test with Recent Order**
1. Check database for recent order ID:
   ```powershell
   php artisan tinker --execute="echo App\Models\Order::latest()->first()->id ?? 'No orders yet';"
   ```

2. Visit tracking page with order ID:
   - http://127.0.0.1:8000/orders/track/1
   - http://127.0.0.1:8000/orders/track/2

**Option B: Create New Test Order**
1. Add product to cart: http://127.0.0.1:8000/products
2. Click "Add to Cart" on any product
3. Go to Cart: http://127.0.0.1:8000/cart
4. Click "Proceed to Checkout"
5. Fill checkout form with test data:
   - Name: Test User
   - Email: test@example.com
   - Phone: 01012345678
   - Address: 123 Test Street
   - City: Cairo
6. Complete order
7. Note the order ID from success page
8. Click "Track Your Order" button

### Expected Results:
- ✅ Professional status timeline showing order progress
- ✅ Order details with product images
- ✅ Shipping information display
- ✅ Payment method shown
- ✅ Animated pulse effect on current status
- ✅ "Continue Shopping" button works

### Test Authentication:
- **Logged-in users**: Can only view their own orders
- **Guest users**: Can view orders with valid token
- **Invalid access**: Should show 403 Forbidden

---

## 3️⃣ Email Notifications (⚙️ REQUIRES CONFIGURATION)

### Configuration Steps:

1. **Update .env file:**
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your-email@gmail.com
   MAIL_PASSWORD=your-app-password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=noreply@sitrin.com
   MAIL_FROM_NAME="SITRIN"
   ```

2. **For Gmail:**
   - Enable 2-factor authentication
   - Generate App Password: https://myaccount.google.com/apppasswords
   - Use app password in MAIL_PASSWORD

3. **Clear config cache:**
   ```powershell
   php artisan config:clear
   php artisan cache:clear
   ```

### Test Steps:
1. Create a new order (see Order Tracking steps above)
2. Use your real email address in checkout
3. Complete the order
4. Check your email inbox for "Order Confirmation - SITRIN #X"

### Expected Email Contents:
- ✅ Order number in subject line
- ✅ Product list with quantities and prices
- ✅ Subtotal, shipping, and total
- ✅ Shipping address and contact info
- ✅ Payment method display
- ✅ "Track Your Order" button (links to tracking page)
- ✅ Professional SITRIN branding

### Troubleshooting Email:
```powershell
# Check Laravel logs
Get-Content storage\logs\laravel.log -Tail 20

# Test email manually in tinker
php artisan tinker
>>> Mail::raw('Test email from SITRIN', function($m) { $m->to('your-email@example.com')->subject('Test'); });
>>> exit
```

---

## 4️⃣ Stock Notification System (✨ READY TO TEST)

### Setup: Create Out-of-Stock Product

**Option A: Update existing product via Admin**
1. Login to admin: http://127.0.0.1:8000/login
   - Email: abdelnabymohamed277@gmial.com
   - Password: Nouran15@01/2002
2. Go to Products: http://127.0.0.1:8000/admin/products
3. Edit any product (e.g., "ASIL")
4. Set Stock to: 0
5. Click "Update Product"

**Option B: Update via Database**
```powershell
php artisan tinker --execute="App\Models\Product::find(1)->update(['stock' => 0]); echo 'Product 1 stock set to 0';"
```

### Test Subscription:
1. Visit the out-of-stock product page:
   - http://127.0.0.1:8000/products/asil-571

2. Scroll down - you should see:
   - ⚠️ "This product is currently out of stock" alert
   - 📧 "Get Notified When Available" form

3. Enter your email and click "Notify Me"

4. Test scenarios:
   - ✅ **First subscription**: Success message shown
   - ✅ **Duplicate subscription**: Info message about already subscribed
   - ✅ **Invalid email**: Validation error shown

### Test Notification Triggering (Admin):

1. **Check subscriptions in database:**
   ```powershell
   php artisan tinker --execute="echo json_encode(App\Models\StockNotification::with('product')->get()->toArray(), JSON_PRETTY_PRINT);"
   ```

2. **Update stock back to positive:**
   ```powershell
   php artisan tinker
   ```
   Then run:
   ```php
   $product = App\Models\Product::find(1);
   $product->update(['stock' => 10]);
   
   // Trigger notifications
   $notifications = App\Models\StockNotification::where('product_id', $product->id)
       ->notNotified()
       ->get();
   
   foreach ($notifications as $notification) {
       Mail::to($notification->email)->send(
           new App\Mail\StockNotification($product, $notification->token)
       );
       $notification->markAsNotified();
   }
   
   echo "Sent " . $notifications->count() . " notifications\n";
   exit
   ```

### Expected Notification Email:
- ✅ Subject: "[Product Name] is Back in Stock! - SITRIN"
- ✅ Product details (price, size, availability)
- ✅ "View Product" button
- ✅ Unsubscribe link at bottom

### Test Unsubscribe:
1. Open notification email
2. Click unsubscribe link at bottom
3. Should see: "Successfully Unsubscribed" page
4. Verify record deleted from database

---

## 🔍 Database Verification

### Check Orders:
```powershell
php artisan tinker --execute="echo json_encode(App\Models\Order::with('items')->latest()->first()->toArray(), JSON_PRETTY_PRINT);"
```

### Check Stock Notifications:
```powershell
php artisan tinker --execute="echo App\Models\StockNotification::count() . ' notifications in database';"
```

### Check Email Queue (if using queue):
```powershell
php artisan queue:work --once
```

---

## 🐛 Troubleshooting

### Server Not Running:
```powershell
php artisan serve
```

### Clear All Caches:
```powershell
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### Check Logs:
```powershell
Get-Content storage\logs\laravel.log -Tail 50
```

### Database Connection Issues:
```powershell
php artisan migrate:status
```

### JavaScript Errors:
- Open browser console (F12)
- Check for errors in Console tab
- Verify image paths are loading

---

## ✅ Success Criteria

### Product Image Zoom:
- [ ] Lens appears on hover
- [ ] Zoom window shows magnified image
- [ ] Works on all product pages
- [ ] Disabled on mobile
- [ ] No console errors

### Order Tracking:
- [ ] Timeline displays correctly
- [ ] Order details are accurate
- [ ] Authentication works properly
- [ ] Token access works for guests
- [ ] Mobile responsive

### Email Notifications:
- [ ] Email received after order
- [ ] All order details correct
- [ ] Links work properly
- [ ] Professional formatting
- [ ] No errors in logs

### Stock Notifications:
- [ ] Form appears on out-of-stock products
- [ ] Subscription saves to database
- [ ] Duplicate prevention works
- [ ] Email validation works
- [ ] Notification emails send
- [ ] Unsubscribe works
- [ ] notified_at timestamp updates

---

## 📊 Test Results Template

Copy this to document your testing:

```
## Test Session: [Date/Time]

### 1. Product Image Zoom
- Product tested: _______
- Hover zoom: ✅ / ❌
- Lens positioning: ✅ / ❌
- Thumbnail switching: ✅ / ❌
- Mobile detection: ✅ / ❌
- Notes: _______

### 2. Order Tracking
- Order ID: _______
- Timeline display: ✅ / ❌
- Order details: ✅ / ❌
- Authentication: ✅ / ❌
- Mobile responsive: ✅ / ❌
- Notes: _______

### 3. Email Notifications
- Email configured: ✅ / ❌
- Email received: ✅ / ❌
- Content accurate: ✅ / ❌
- Links working: ✅ / ❌
- Notes: _______

### 4. Stock Notifications
- Product ID: _______
- Subscription form: ✅ / ❌
- Email validation: ✅ / ❌
- Duplicate prevention: ✅ / ❌
- Notification sent: ✅ / ❌
- Unsubscribe: ✅ / ❌
- Notes: _______

### Overall Issues:
_______

### Performance Notes:
_______
```

---

## 🎯 Quick Test Commands

```powershell
# Start server
php artisan serve

# Set product out of stock
php artisan tinker --execute="App\Models\Product::find(1)->update(['stock' => 0]);"

# Check notifications
php artisan tinker --execute="echo App\Models\StockNotification::count();"

# View latest order
php artisan tinker --execute="echo json_encode(App\Models\Order::latest()->first()->toArray(), JSON_PRETTY_PRINT);"

# Clear caches
php artisan optimize:clear

# Check logs
Get-Content storage\logs\laravel.log -Tail 20
```

---

## 📞 Need Help?

If you encounter issues:
1. Check the troubleshooting section above
2. Review `storage/logs/laravel.log`
3. Verify database connections
4. Clear all caches
5. Restart development server

Happy Testing! 🚀
