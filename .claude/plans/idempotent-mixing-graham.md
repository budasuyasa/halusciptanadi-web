# Add Supplier Resource

## Context
The admin needs a Supplier (Suplier) entity to track which suppliers provide which products. Products must have at least one supplier (many-to-many relationship). This adds a full Filament resource with model, migration, factory, and updates the Product form/table to show suppliers.

## Files to Create

### 1. Migration: `create_suppliers_table`
- `id`, `name` (string, required), `slug` (string, unique), `contact_person` (string, nullable), `email` (string, nullable), `phone` (string, nullable), `address` (text, nullable), `is_active` (boolean, default true), `timestamps`
- Command: `php artisan make:migration create_suppliers_table`

### 2. Migration: `create_product_supplier_table` (pivot)
- `id`, `product_id` (FK, cascadeOnDelete), `supplier_id` (FK, cascadeOnDelete), `timestamps`
- Unique constraint on `[product_id, supplier_id]`
- Command: `php artisan make:migration create_product_supplier_table`

### 3. Model: `app/Models/Supplier.php`
- `$fillable`: name, slug, contact_person, email, phone, address, is_active
- `casts()`: is_active => boolean
- `belongsToMany(Product::class)` relationship
- `scopeActive`, `scopeOrdered` scopes

### 4. Factory: `database/factories/SupplierFactory.php`
- Realistic Indonesian supplier data
- `inactive()` state

### 5. Update: `app/Models/Product.php`
- Add `belongsToMany(Supplier::class)` relationship

### 6. Filament Resource: `app/Filament/Resources/Suppliers/`
- `SupplierResource.php` — navigation icon, Indonesian labels
- `Schemas/SupplierForm.php` — name, slug (auto), contact_person, email, phone, address, is_active
- `Tables/SuppliersTable.php` — name, contact_person, phone, products_count, is_active
- `Pages/ListSuppliers.php`, `CreateSupplier.php`, `EditSupplier.php`

### 7. Update: `app/Filament/Resources/Products/Schemas/ProductForm.php`
- Add `Select::make('suppliers')` with `->relationship('suppliers', 'name')->multiple()->searchable()->preload()` in "Informasi Produk" section

### 8. Update: `app/Filament/Resources/Products/Tables/ProductsTable.php`
- Add `TextColumn::make('suppliers.name')` to show supplier names

## Verification
1. `docker compose exec app php artisan migrate` — new tables created
2. `docker compose exec app php artisan test --compact` — all tests pass
3. `docker compose exec app vendor/bin/pint --dirty --format agent` — formatting clean
