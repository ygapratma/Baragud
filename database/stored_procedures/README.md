# Baragud Stored Procedures Documentation

## 📚 Daftar Isi
1. [Pengenalan](#pengenalan)
2. [Struktur File](#struktur-file)
3. [Cara Install](#cara-install)
4. [Workflow Aplikasi](#workflow-aplikasi)
5. [Daftar Stored Procedures](#daftar-stored-procedures)
6. [Contoh Penggunaan](#contoh-penggunaan)

---

## Pengenalan

Repository ini berisi **Stored Procedures** untuk aplikasi **Baragud Vendor Management System**. Stored procedures ini dibuat untuk:

✅ **Mempelajari** konsep stored procedures di SQL Server
✅ **Inject data** sesuai alur workflow aplikasi
✅ **Otomasi** proses bisnis RFQ → Negotiation → Confirmation → PO
✅ **Testing** dan development

---

## Struktur File

```
database/stored_procedures/
├── README.md                           # Dokumentasi ini
├── 00_Execute_All_Create_SPs.sql      # Script untuk create semua SP
├── 01_SP_Master_Data.sql              # SP Master Data
├── 02_SP_RFQ_Workflow.sql             # SP RFQ Workflow
├── 03_SP_Negotiation_Workflow.sql     # SP Negotiation Workflow
├── 04_SP_Confirmation_Workflow.sql    # SP Confirmation Workflow
├── 05_SP_PO_Workflow.sql              # SP Purchase Order Workflow
└── 06_Data_Injection_Example.sql      # Contoh inject data lengkap
```

---

## Cara Install

### Metode 1: Execute All (Recommended)

Buka SQL Server Management Studio (SSMS), kemudian jalankan:

```bash
# Di SSMS, gunakan SQLCMD Mode (Query -> SQLCMD Mode)
# Atau gunakan sqlcmd di command line:

cd /path/to/Baragud/database/stored_procedures
sqlcmd -S YOGA -d baragud -i 00_Execute_All_Create_SPs.sql
```

### Metode 2: Execute Satu Per Satu

Buka dan execute file-file berikut secara berurutan di SSMS:

1. `01_SP_Master_Data.sql`
2. `02_SP_RFQ_Workflow.sql`
3. `03_SP_Negotiation_Workflow.sql`
4. `04_SP_Confirmation_Workflow.sql`
5. `05_SP_PO_Workflow.sql`

### Inject Sample Data

Setelah semua SP dibuat, inject data contoh:

```sql
-- Execute di SSMS
:r 06_Data_Injection_Example.sql
GO
```

---

## Workflow Aplikasi

```
┌──────────┐    ┌─────────┐    ┌────────────┐    ┌──────────────┐    ┌───────┐
│  MASTER  │ -> │   RFQ   │ -> │ NEGOTIATION│ -> │ CONFIRMATION │ -> │  PO   │
│   DATA   │    │         │    │            │    │              │    │       │
└──────────┘    └─────────┘    └────────────┘    └──────────────┘    └───────┘
     │               │                 │                  │                │
     v               v                 v                  v                v
  Vendor         Buyer sends      Buyer request     Buyer request    PO issued
  & User         RFQ to vendor    negotiation      price confirm    to vendor
  created        ↓                ↓                ↓                ↓
                 Vendor submits   Vendor submits   Vendor confirms  Vendor tracks
                 quotation        new price        price            & uploads batch
```

### Penjelasan Workflow:

#### 1. **MASTER DATA**
   - Create vendor
   - Create user account
   - Setup currency & UOM

#### 2. **RFQ (Request for Quotation)**
   - Buyer create RFQ untuk vendor
   - Vendor lihat RFQ di portal
   - Vendor input harga (quotation)
   - Vendor bisa tambah produk equivalent
   - Vendor bisa tambah biaya additional (ongkir, dll)

#### 3. **NEGOTIATION**
   - RFQ yang sudah lewat deadline → masuk negosiasi
   - Vendor bisa submit harga baru (lebih rendah)
   - Update biaya additional
   - Revisi quotation

#### 4. **CONFIRMATION**
   - **Stage 1 - REQUEST**: Buyer tanya vendor apakah bisa supply di harga X
     - Vendor jawab: YA (pesan_ulang=1) atau TIDAK (pesan_ulang=0)
   - **Stage 2 - CONFIRM**: Buyer minta vendor submit harga baru
     - Vendor submit harga yang dia bisa

#### 5. **PO (Purchase Order)**
   - Buyer issue PO ke vendor
   - Vendor download PO
   - Vendor upload data batch
   - System track outstanding delivery

---

## Daftar Stored Procedures

### 📦 Master Data (01_SP_Master_Data.sql)

| SP Name | Purpose | Parameters |
|---------|---------|-----------|
| `SP_Insert_Vendor` | Insert vendor baru | kode_vendor, nama_perusahaan, alamat, email, dll |
| `SP_Insert_User` | Create user account | kode_vendor, nama, password |
| `SP_Insert_Currency` | Insert mata uang | kode_uang, deskripsi |
| `SP_Insert_UOM` | Insert satuan | satuan, deskripsi_satuan |

### 📋 RFQ Workflow (02_SP_RFQ_Workflow.sql)

| SP Name | Purpose | Parameters |
|---------|---------|-----------|
| `SP_Insert_RFQ_Header` | Create RFQ header | nomor_rfq, kode_vendor, tanggal_rfq, deadline |
| `SP_Insert_RFQ_Detail` | Add RFQ item | nomor_rfq, kode_barang, qty, satuan |
| `SP_Submit_RFQ_Quotation` | Vendor submit harga | nomor_rfq, kode_barang, harga, availability |
| `SP_Insert_RFQ_Equivalent` | Add produk ekuivalen | nomor_rfq, ekuivalen (1-4), harga |
| `SP_Insert_RFQ_Additional_Charges` | Add biaya tambahan | nomor_rfq, jenis_biaya, nilai |

### 💬 Negotiation Workflow (03_SP_Negotiation_Workflow.sql)

| SP Name | Purpose | Parameters |
|---------|---------|-----------|
| `SP_Create_Negotiation_From_RFQ` | Copy RFQ → Negotiation | nomor_rfq, kode_vendor |
| `SP_Submit_Negotiation_Price` | Submit harga negosiasi | nomor_rfq, kode_barang, harga_nego |
| `SP_Update_Negotiation_Equivalent` | Update harga equivalent | nomor_rfq, kode_barang, ekuivalen |
| `SP_Update_Negotiation_Charges` | Update biaya tambahan | nomor_rfq, jenis_biaya, nilai |

### ✅ Confirmation Workflow (04_SP_Confirmation_Workflow.sql)

| SP Name | Purpose | Parameters |
|---------|---------|-----------|
| `SP_Create_Confirmation_Request` | Create confirmation (status=1) | kode_konfirmasi, vendor, harga |
| `SP_Respond_Confirmation_Request` | Vendor respond (status=1) | kode_konfirmasi, pesan_ulang (1/0) |
| `SP_Create_Price_Quote_Request` | Create price quote (status=2) | kode_konfirmasi, vendor, material |
| `SP_Submit_Price_Quote` | Vendor submit harga (status=2) | kode_konfirmasi, harga |
| `SP_Send_Confirmation_To_SAP` | Send confirmation to SAP | kode_vendor, status |

### 📦 PO Workflow (05_SP_PO_Workflow.sql)

| SP Name | Purpose | Parameters |
|---------|---------|-----------|
| `SP_Create_PO_Header` | Create PO header | nomor_po, vendor, tanggal |
| `SP_Insert_PO_Detail` | Add PO item | nomor_po, item_po, material, qty, harga |
| `SP_Create_PO_Batch` | Vendor upload batch | nomor_po, batch_number, qty |
| `SP_Create_PO_Outstanding` | Track outstanding | purchasing_doc, qty, outstanding |
| `SP_Close_PO` | Close PO | nomor_po |

---

## Contoh Penggunaan

### Scenario 1: Membuat Vendor Baru

```sql
-- Step 1: Create Vendor
EXEC SP_Insert_Vendor
    @kode_vendor = 'V999',
    @nama_perusahaan = 'PT. Supplier Baru',
    @alamat_perusahaan = 'Jl. Baru No. 123',
    @kode_negara = 'ID',
    @email_perusahaan = 'info@supplierbaru.com',
    @telepon_perusahaan = '021-9999999';

-- Step 2: Create User Account
EXEC SP_Insert_User
    @kode_vendor = 'V999',
    @nama = 'User Baru',
    @sandi = '123456',
    @first_login = 1;

-- Verify
SELECT * FROM TB_S_MST_VENDOR WHERE kode_vendor = 'V999';
SELECT * FROM TB_S_MST_PENGGUNA WHERE kode_vendor = 'V999';
```

### Scenario 2: Complete RFQ Workflow

```sql
-- Step 1: Buyer creates RFQ
EXEC SP_Insert_RFQ_Header
    @nomor_rfq = 'RFQ-TEST-001',
    @kode_vendor = 'V999',
    @tanggal_rfq = '2025-11-06',
    @tanggal_jatuh_tempo = '2025-11-20';

-- Step 2: Add items to RFQ
EXEC SP_Insert_RFQ_Detail
    @nomor_rfq = 'RFQ-TEST-001',
    @kode_barang = 'TEST-001',
    @deskripsi_barang = 'Test Product',
    @jumlah_permintaan = 100.00,
    @satuan = 'KG',
    @mata_uang = 'IDR';

-- Step 3: Vendor submits quotation
EXEC SP_Submit_RFQ_Quotation
    @nomor_rfq = 'RFQ-TEST-001',
    @kode_barang = 'TEST-001',
    @harga_satuan = 50000.00,
    @ketersediaan_barang = 1,
    @jumlah_tersedia = 100.00;

-- Step 4: Add equivalent product
EXEC SP_Insert_RFQ_Equivalent
    @nomor_rfq = 'RFQ-TEST-001',
    @kode_barang = 'TEST-001',
    @ekuivalen = 1,
    @kode_barang_eqiv = 'TEST-001-ALT',
    @deskripsi_barang = 'Alternative Product',
    @jumlah_permintaan = 100.00,
    @satuan = 'KG',
    @harga_satuan = 45000.00;

-- Verify
SELECT * FROM TB_S_MST_RFQ_BARANG_HEAD WHERE nomor_rfq = 'RFQ-TEST-001';
SELECT * FROM TB_S_MST_RFQ_BARANG_DTL WHERE nomor_rfq = 'RFQ-TEST-001';
SELECT * FROM TB_S_MST_RFQ_BARANG_EQIV WHERE nomor_rfq = 'RFQ-TEST-001';
```

### Scenario 3: Negotiation Process

```sql
-- Step 1: Create negotiation from existing RFQ
EXEC SP_Create_Negotiation_From_RFQ
    @nomor_rfq = 'RFQ-TEST-001',
    @kode_vendor = 'V999';

-- Step 2: Vendor submits negotiated price
EXEC SP_Submit_Negotiation_Price
    @nomor_rfq = 'RFQ-TEST-001',
    @kode_barang = 'TEST-001',
    @harga_satuan_nego = 47000.00,
    @keterangan_nego = 'Harga khusus untuk pembelian >100KG';

-- Verify
SELECT * FROM TB_S_MST_NEGO_BARANG_HEAD WHERE nomor_rfq = 'RFQ-TEST-001';
SELECT * FROM TB_S_MST_NEGO_BARANG_DTL WHERE nomor_rfq = 'RFQ-TEST-001';
```

### Scenario 4: Price Confirmation

```sql
-- Type 1: Confirmation Request (Buyer asks: Can you supply at price X?)
EXEC SP_Create_Confirmation_Request
    @kode_konfirmasi = 'CONF-TEST-001',
    @kode_vendor = 'V999',
    @nama_vendor = 'PT. Supplier Baru',
    @nomor_pr = 'PR-TEST-001',
    @item_pr = '00010',
    @kode_material = 'TEST-001',
    @deskripsi = 'Test Product',
    @jumlah = 100.00,
    @satuan = 'KG',
    @harga_po_terakhir = 47000.00;

-- Vendor responds: YES or NO
EXEC SP_Respond_Confirmation_Request
    @kode_konfirmasi = 'CONF-TEST-001',
    @kode_vendor = 'V999',
    @pesan_ulang = 1,  -- 1 = YES, 0 = NO
    @jumlah_tersedia = 100.00;

-- Type 2: Price Quote Request (Buyer asks: What's your price?)
EXEC SP_Create_Price_Quote_Request
    @kode_konfirmasi = 'CONF-TEST-002',
    @kode_vendor = 'V999',
    @nama_vendor = 'PT. Supplier Baru',
    @nomor_pr = 'PR-TEST-002',
    @item_pr = '00020',
    @kode_material = 'TEST-002',
    @deskripsi = 'Another Product',
    @jumlah = 200.00,
    @satuan = 'L',
    @harga_po_terakhir = 100000.00;

-- Vendor submits price
EXEC SP_Submit_Price_Quote
    @kode_konfirmasi = 'CONF-TEST-002',
    @kode_vendor = 'V999',
    @harga = 95000.00,
    @mata_uang = 'IDR',
    @jumlah_tersedia = 200.00;

-- Send to SAP
EXEC SP_Send_Confirmation_To_SAP 'V999', 1;  -- Status 1
EXEC SP_Send_Confirmation_To_SAP 'V999', 2;  -- Status 2

-- Verify
SELECT * FROM TB_S_MST_KONFIRMASI WHERE kode_vendor = 'V999';
```

### Scenario 5: Purchase Order

```sql
-- Step 1: Create PO
EXEC SP_Create_PO_Header
    @nomor_po = 'PO-TEST-001',
    @kode_vendor = 'V999',
    @tanggal_document = '2025-11-06',
    @jatuh_tempo = '2025-12-06';

-- Step 2: Add PO items
EXEC SP_Insert_PO_Detail
    @nomor_po = 'PO-TEST-001',
    @item_po = '00010',
    @kode_material = 'TEST-001',
    @deskripsi_material = 'Test Product',
    @jumlah_po = 100.00,
    @satuan = 'KG',
    @harga_satuan = 47000.00,
    @mata_uang = 'IDR';

-- Step 3: Vendor uploads batch data
EXEC SP_Create_PO_Batch
    @nomor_po = 'PO-TEST-001',
    @item_po = '00010',
    @batch_number = 'BATCH-20251106-001',
    @quantity = 100.00,
    @tanggal_kadaluarsa = '2026-11-06';

-- Step 4: Track outstanding
EXEC SP_Create_PO_Outstanding
    @purchasing_document = 'PO-TEST-001',
    @posnr = '00010',
    @vendor = 'V999',
    @vendor_name = 'PT. Supplier Baru',
    @estate = 'Test Estate',
    @item_code = 'TEST-001',
    @description = 'Test Product',
    @order_unit = 'KG',
    @qty = 100.00,
    @outstanding = 0,  -- All delivered
    @unitprice = 47000.00,
    @total_price = 0,
    @posting_date = '2025-11-06',
    @deadline_date = '2025-12-06';

-- Verify
SELECT * FROM TB_S_TR_PO_HEAD WHERE nomor_po = 'PO-TEST-001';
SELECT * FROM TB_S_TR_PO_DTL WHERE nomor_po = 'PO-TEST-001';
SELECT * FROM TB_S_TR_BATCH WHERE nomor_po = 'PO-TEST-001';
SELECT * FROM TB_S_TR_PO_OUTSTANDING WHERE purchasing_document = 'PO-TEST-001';
```

---

## Tips & Best Practices

### 🎯 Tips Menggunakan Stored Procedures

1. **Selalu cek data existing** sebelum inject
   ```sql
   SELECT * FROM TB_S_MST_VENDOR WHERE kode_vendor = 'V999';
   ```

2. **Gunakan BEGIN TRANSACTION** untuk operasi multiple
   ```sql
   BEGIN TRANSACTION;
   EXEC SP_Insert_Vendor ...;
   EXEC SP_Insert_User ...;
   COMMIT;
   ```

3. **Backup database** sebelum inject data besar
   ```sql
   BACKUP DATABASE baragud TO DISK = 'C:\backup\baragud_backup.bak';
   ```

4. **Gunakan parameter default** untuk simplicity
   ```sql
   -- Minimal params
   EXEC SP_Insert_Vendor 'V999', 'PT. Baru', 'Alamat', 'ID', NULL, 'email@test.com';
   ```

### ⚠️ Common Errors & Solutions

| Error | Cause | Solution |
|-------|-------|----------|
| `Vendor not found` | Insert RFQ sebelum vendor dibuat | Create vendor dulu dengan `SP_Insert_Vendor` |
| `RFQ already exists` | Nomor RFQ duplicate | Gunakan nomor RFQ yang unik |
| `FK constraint violation` | Data parent tidak ada | Pastikan master data sudah dibuat |
| `Permission denied` | User tidak punya akses | Login dengan user yang punya permission CREATE PROCEDURE |

---

## Query Utilities

### Cek Semua Stored Procedures

```sql
-- List all stored procedures
SELECT
    SCHEMA_NAME(schema_id) AS schema_name,
    name AS procedure_name,
    create_date,
    modify_date
FROM sys.procedures
WHERE name LIKE 'SP_%'
ORDER BY name;
```

### Drop Semua Stored Procedures

```sql
-- Drop all SPs (hati-hati!)
DECLARE @sql NVARCHAR(MAX) = '';
SELECT @sql += 'DROP PROCEDURE ' + QUOTENAME(name) + ';' + CHAR(13)
FROM sys.procedures
WHERE name LIKE 'SP_%';

PRINT @sql;
-- EXEC sp_executesql @sql;  -- Uncomment to execute
```

### View SP Definition

```sql
-- View SP code
EXEC sp_helptext 'SP_Insert_Vendor';
```

---

## 📝 Notes

- Semua SP menggunakan `TRY-CATCH` untuk error handling
- Semua SP menggunakan `TRANSACTION` untuk data integrity
- Modified_by selalu diset: `'SAP'` (from SAP) atau `'WEB'` (from vendor portal)
- Tanggal menggunakan format `DATE` dan `DATETIME`
- Currency default: `IDR`

---

## 🤝 Contributing

Jika ada improvement atau bug fix, silakan update stored procedures dan dokumentasi ini.

---

## 📞 Support

Untuk pertanyaan atau issue:
- Buka issue di repository
- Hubungi tim development

---

**Happy Learning Stored Procedures! 🚀**
