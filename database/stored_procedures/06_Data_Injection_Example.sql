-- ============================================
-- DATA INJECTION SCRIPT - COMPLETE WORKFLOW
-- Baragud Vendor Management System
-- ============================================
-- File: 06_Data_Injection_Example.sql
-- Purpose: Inject sample data sesuai alur workflow aplikasi
-- ============================================
-- Workflow:
--   1. Master Data (Vendor, User, Currency, UOM)
--   2. RFQ Creation & Vendor Quotation
--   3. Negotiation
--   4. Price Confirmation
--   5. Purchase Order
-- ============================================

USE baragud;
GO

PRINT '=========================================';
PRINT 'DATA INJECTION - COMPLETE WORKFLOW';
PRINT 'Baragud Vendor Management System';
PRINT 'Started at: ' + CONVERT(NVARCHAR, GETDATE(), 120);
PRINT '=========================================';
PRINT '';

-- ============================================
-- STEP 1: MASTER DATA
-- ============================================
PRINT '=========================================';
PRINT 'STEP 1: INJECTING MASTER DATA';
PRINT '=========================================';
PRINT '';

-- Insert Currencies
PRINT '--- Inserting Currencies ---';
EXEC SP_Insert_Currency 'IDR', 'Indonesian Rupiah';
EXEC SP_Insert_Currency 'USD', 'US Dollar';
EXEC SP_Insert_Currency 'EUR', 'Euro';
PRINT '';

-- Insert Units of Measure
PRINT '--- Inserting Units of Measure ---';
EXEC SP_Insert_UOM 'KG', 'Kilogram';
EXEC SP_Insert_UOM 'L', 'Liter';
EXEC SP_Insert_UOM 'PCS', 'Pieces';
EXEC SP_Insert_UOM 'BOX', 'Box';
EXEC SP_Insert_UOM 'UNIT', 'Unit';
EXEC SP_Insert_UOM 'M', 'Meter';
PRINT '';

-- Insert Sample Vendors
PRINT '--- Inserting Vendors ---';
EXEC SP_Insert_Vendor
    @kode_vendor = 'V001',
    @nama_perusahaan = 'PT. Supplier Utama Indonesia',
    @alamat_perusahaan = 'Jl. Industri No. 123, Jakarta Utara',
    @kode_negara = 'ID',
    @kode_provinsi = '31',
    @email_perusahaan = 'vendor1@supplierutama.co.id',
    @telepon_perusahaan = '021-1234567',
    @npwp = '01.234.567.8-901.000';

EXEC SP_Insert_Vendor
    @kode_vendor = 'V002',
    @nama_perusahaan = 'CV. Mitra Sejahtera',
    @alamat_perusahaan = 'Jl. Raya Bogor KM 25, Cibinong',
    @kode_negara = 'ID',
    @kode_provinsi = '32',
    @email_perusahaan = 'info@mitrasejahtera.com',
    @telepon_perusahaan = '021-7654321',
    @npwp = '02.345.678.9-012.000';

EXEC SP_Insert_Vendor
    @kode_vendor = 'V003',
    @nama_perusahaan = 'PT. Global Trading',
    @alamat_perusahaan = 'Jl. Sudirman No. 456, Jakarta Selatan',
    @kode_negara = 'ID',
    @kode_provinsi = '31',
    @email_perusahaan = 'sales@globaltrading.co.id',
    @telepon_perusahaan = '021-9876543',
    @npwp = '03.456.789.0-123.000';
PRINT '';

-- Insert Users for Vendors
PRINT '--- Creating User Accounts ---';
EXEC SP_Insert_User 'V001', 'Ahmad Vendor 1', '123456', 1, 0;
EXEC SP_Insert_User 'V002', 'Budi Vendor 2', '123456', 1, 0;
EXEC SP_Insert_User 'V003', 'Citra Vendor 3', '123456', 1, 0;
PRINT '';

PRINT 'STEP 1 COMPLETED: Master Data Created';
PRINT '';

-- ============================================
-- STEP 2: RFQ WORKFLOW
-- ============================================
PRINT '=========================================';
PRINT 'STEP 2: RFQ WORKFLOW';
PRINT '=========================================';
PRINT '';

-- Create RFQ for Vendor V001
PRINT '--- Creating RFQ-001 for Vendor V001 ---';
EXEC SP_Insert_RFQ_Header
    @nomor_rfq = 'RFQ-2025-001',
    @kode_vendor = 'V001',
    @tanggal_rfq = '2025-01-01',
    @tanggal_jatuh_tempo = '2025-01-15',
    @keterangan = 'RFQ untuk kebutuhan bahan baku pabrik';

-- Add RFQ Items
PRINT '--- Adding RFQ Items ---';
EXEC SP_Insert_RFQ_Detail
    @nomor_rfq = 'RFQ-2025-001',
    @kode_barang = 'MAT-001',
    @deskripsi_barang = 'Bahan Kimia Industrial Grade A',
    @deskripsi_material = 'Chemical compound for manufacturing',
    @jumlah_permintaan = 1000.00,
    @satuan = 'KG',
    @mata_uang = 'IDR',
    @dipakai_untuk = 'Produksi Pupuk Organik',
    @nomor_sr = 'SR-2025-001',
    @kode_kebun = 'KBN-001';

EXEC SP_Insert_RFQ_Detail
    @nomor_rfq = 'RFQ-2025-001',
    @kode_barang = 'MAT-002',
    @deskripsi_barang = 'Pestisida Premium Quality',
    @deskripsi_material = 'Agricultural pesticide',
    @jumlah_permintaan = 500.00,
    @satuan = 'L',
    @mata_uang = 'IDR',
    @dipakai_untuk = 'Perlindungan Tanaman',
    @nomor_sr = 'SR-2025-001',
    @kode_kebun = 'KBN-001';
PRINT '';

-- Vendor Submits Quotation
PRINT '--- Vendor V001 Submits Quotation ---';
EXEC SP_Submit_RFQ_Quotation
    @nomor_rfq = 'RFQ-2025-001',
    @kode_barang = 'MAT-001',
    @harga_satuan = 25000.00,
    @per_harga_satuan = 1,
    @konversi = 1,
    @ketersediaan_barang = 1,  -- Ready stock
    @masa_berlaku_harga = '2025-06-30',
    @keterangan = 'Harga sudah termasuk packaging',
    @jumlah_tersedia = 1000.00,
    @jumlah_inden = 0,
    @lama_inden = 0;

EXEC SP_Submit_RFQ_Quotation
    @nomor_rfq = 'RFQ-2025-001',
    @kode_barang = 'MAT-002',
    @harga_satuan = 150000.00,
    @per_harga_satuan = 1,
    @konversi = 1,
    @ketersediaan_barang = 2,  -- Indent
    @masa_berlaku_harga = '2025-06-30',
    @keterangan = 'Memerlukan indent',
    @jumlah_tersedia = 200.00,
    @jumlah_inden = 300.00,
    @lama_inden = 14;
PRINT '';

-- Add Equivalent Products
PRINT '--- Adding Equivalent Products ---';
EXEC SP_Insert_RFQ_Equivalent
    @nomor_rfq = 'RFQ-2025-001',
    @kode_barang = 'MAT-001',
    @ekuivalen = 1,
    @kode_barang_eqiv = 'MAT-001-ALT1',
    @deskripsi_barang = 'Bahan Kimia Alternative Grade B',
    @spesifikasi = 'Grade B, kemurnian 98%',
    @merek = 'ChemCorp',
    @tipe = 'Type-B',
    @buatan = 'Indonesia',
    @jumlah_permintaan = 1000.00,
    @satuan = 'KG',
    @harga_satuan = 22000.00,
    @ketersediaan_barang = 1,
    @masa_berlaku_harga = '2025-06-30';
PRINT '';

-- Add Additional Charges
PRINT '--- Adding Additional Charges ---';
EXEC SP_Insert_RFQ_Additional_Charges
    @nomor_rfq = 'RFQ-2025-001',
    @jenis_biaya = 'Biaya Pengiriman',
    @nilai_biaya = 500000.00,
    @mata_uang = 'IDR',
    @keterangan = 'Ongkir Jakarta - Bogor';

EXEC SP_Insert_RFQ_Additional_Charges
    @nomor_rfq = 'RFQ-2025-001',
    @jenis_biaya = 'Biaya Packaging',
    @nilai_biaya = 250000.00,
    @mata_uang = 'IDR',
    @keterangan = 'Kemasan khusus bahan kimia';
PRINT '';

-- Create another RFQ for Vendor V002
PRINT '--- Creating RFQ-002 for Vendor V002 ---';
EXEC SP_Insert_RFQ_Header
    @nomor_rfq = 'RFQ-2025-002',
    @kode_vendor = 'V002',
    @tanggal_rfq = '2025-01-02',
    @tanggal_jatuh_tempo = '2025-01-16',
    @keterangan = 'RFQ untuk peralatan pertanian';

EXEC SP_Insert_RFQ_Detail
    @nomor_rfq = 'RFQ-2025-002',
    @kode_barang = 'TOOL-001',
    @deskripsi_barang = 'Hand Tractor Premium',
    @deskripsi_material = 'Agricultural equipment',
    @jumlah_permintaan = 10.00,
    @satuan = 'UNIT',
    @mata_uang = 'IDR',
    @dipakai_untuk = 'Persiapan Lahan',
    @nomor_sr = 'SR-2025-002',
    @kode_kebun = 'KBN-002';

EXEC SP_Submit_RFQ_Quotation
    @nomor_rfq = 'RFQ-2025-002',
    @kode_barang = 'TOOL-001',
    @harga_satuan = 15000000.00,
    @per_harga_satuan = 1,
    @konversi = 1,
    @ketersediaan_barang = 1,
    @masa_berlaku_harga = '2025-12-31',
    @keterangan = 'Garansi 2 tahun',
    @jumlah_tersedia = 10.00,
    @jumlah_inden = 0,
    @lama_inden = 0;
PRINT '';

PRINT 'STEP 2 COMPLETED: RFQ Created and Quotations Submitted';
PRINT '';

-- ============================================
-- STEP 3: NEGOTIATION WORKFLOW
-- ============================================
PRINT '=========================================';
PRINT 'STEP 3: NEGOTIATION WORKFLOW';
PRINT '=========================================';
PRINT '';

-- Create Negotiation from RFQ-001
PRINT '--- Creating Negotiation from RFQ-001 ---';
EXEC SP_Create_Negotiation_From_RFQ
    @nomor_rfq = 'RFQ-2025-001',
    @kode_vendor = 'V001';
PRINT '';

-- Vendor submits negotiated price
PRINT '--- Vendor Submits Negotiated Prices ---';
EXEC SP_Submit_Negotiation_Price
    @nomor_rfq = 'RFQ-2025-001',
    @kode_barang = 'MAT-001',
    @harga_satuan_nego = 23000.00,
    @keterangan_nego = 'Harga khusus untuk pembelian >1000 KG',
    @ketersediaan_barang = 1,
    @masa_berlaku_harga = '2025-06-30';

EXEC SP_Submit_Negotiation_Price
    @nomor_rfq = 'RFQ-2025-001',
    @kode_barang = 'MAT-002',
    @harga_satuan_nego = 145000.00,
    @keterangan_nego = 'Diskon 5% dari harga awal untuk indent',
    @ketersediaan_barang = 2,
    @masa_berlaku_harga = '2025-06-30';
PRINT '';

-- Update negotiation charges
PRINT '--- Updating Negotiation Charges ---';
EXEC SP_Update_Negotiation_Charges
    @nomor_rfq = 'RFQ-2025-001',
    @jenis_biaya = 'Biaya Pengiriman',
    @nilai_biaya = 450000.00,
    @keterangan = 'Diskon ongkir 10%';
PRINT '';

PRINT 'STEP 3 COMPLETED: Negotiation Prices Submitted';
PRINT '';

-- ============================================
-- STEP 4: CONFIRMATION WORKFLOW
-- ============================================
PRINT '=========================================';
PRINT 'STEP 4: CONFIRMATION WORKFLOW';
PRINT '=========================================';
PRINT '';

-- Create Confirmation Request (Status 1)
PRINT '--- Creating Confirmation REQUEST (Status 1) ---';
EXEC SP_Create_Confirmation_Request
    @kode_konfirmasi = 'CONF-2025-001',
    @kode_vendor = 'V001',
    @nama_vendor = 'PT. Supplier Utama Indonesia',
    @nomor_pr = 'PR-2025-001',
    @item_pr = '00010',
    @kode_material = 'MAT-001',
    @deskripsi = 'Bahan Kimia Industrial Grade A',
    @deskripsi_material = 'Chemical compound for manufacturing',
    @jumlah = 1000.00,
    @satuan = 'KG',
    @harga_po_terakhir = 23000.00,
    @mata_uang_po_terakhir = 'IDR';
PRINT '';

-- Vendor Responds to Confirmation Request
PRINT '--- Vendor Responds to Confirmation REQUEST ---';
EXEC SP_Respond_Confirmation_Request
    @kode_konfirmasi = 'CONF-2025-001',
    @kode_vendor = 'V001',
    @pesan_ulang = 1,  -- Can supply at this price
    @jumlah_tersedia = 1000.00,
    @jumlah_inden = 0,
    @lama_inden = 0,
    @keterangan = 'Harga sesuai, ready stock tersedia';
PRINT '';

-- Create Price Quote Request (Status 2)
PRINT '--- Creating Price Quote REQUEST (Status 2) ---';
EXEC SP_Create_Price_Quote_Request
    @kode_konfirmasi = 'CONF-2025-002',
    @kode_vendor = 'V002',
    @nama_vendor = 'CV. Mitra Sejahtera',
    @nomor_pr = 'PR-2025-002',
    @item_pr = '00020',
    @kode_material = 'TOOL-001',
    @deskripsi = 'Hand Tractor Premium',
    @deskripsi_material = 'Agricultural equipment',
    @jumlah = 10.00,
    @satuan = 'UNIT',
    @harga_po_terakhir = 16000000.00,
    @mata_uang_po_terakhir = 'IDR';
PRINT '';

-- Vendor Submits Price Quote
PRINT '--- Vendor Submits Price Quote ---';
EXEC SP_Submit_Price_Quote
    @kode_konfirmasi = 'CONF-2025-002',
    @kode_vendor = 'V002',
    @harga = 15500000.00,
    @mata_uang = 'IDR',
    @jumlah_tersedia = 10.00,
    @jumlah_inden = 0,
    @lama_inden = 0,
    @keterangan = 'Harga special untuk repeat order';
PRINT '';

-- Send confirmations to SAP
PRINT '--- Sending Confirmations to SAP ---';
DECLARE @sent_count INT;
EXEC @sent_count = SP_Send_Confirmation_To_SAP 'V001', 1;
EXEC @sent_count = SP_Send_Confirmation_To_SAP 'V002', 2;
PRINT '';

PRINT 'STEP 4 COMPLETED: Price Confirmations Processed';
PRINT '';

-- ============================================
-- STEP 5: PURCHASE ORDER WORKFLOW
-- ============================================
PRINT '=========================================';
PRINT 'STEP 5: PURCHASE ORDER WORKFLOW';
PRINT '=========================================';
PRINT '';

-- Create PO for Vendor V001
PRINT '--- Creating PO-001 for Vendor V001 ---';
EXEC SP_Create_PO_Header
    @nomor_po = 'PO-2025-001',
    @kode_vendor = 'V001',
    @tanggal_document = '2025-01-20',
    @tanggal_dibuat = '2025-01-20',
    @jatuh_tempo = '2025-02-20',
    @status = 0,
    @keterangan = 'PO based on RFQ-2025-001 negotiation';

EXEC SP_Insert_PO_Detail
    @nomor_po = 'PO-2025-001',
    @item_po = '00010',
    @kode_material = 'MAT-001',
    @deskripsi_material = 'Bahan Kimia Industrial Grade A',
    @jumlah_po = 1000.00,
    @satuan = 'KG',
    @harga_satuan = 23000.00,
    @mata_uang = 'IDR',
    @tanggal_pengiriman = '2025-02-10',
    @keterangan = 'Deliver to warehouse A';

EXEC SP_Insert_PO_Detail
    @nomor_po = 'PO-2025-001',
    @item_po = '00020',
    @kode_material = 'MAT-002',
    @deskripsi_material = 'Pestisida Premium Quality',
    @jumlah_po = 500.00,
    @satuan = 'L',
    @harga_satuan = 145000.00,
    @mata_uang = 'IDR',
    @tanggal_pengiriman = '2025-02-15',
    @keterangan = 'Deliver to warehouse B';
PRINT '';

-- Create PO for Vendor V002
PRINT '--- Creating PO-002 for Vendor V002 ---';
EXEC SP_Create_PO_Header
    @nomor_po = 'PO-2025-002',
    @kode_vendor = 'V002',
    @tanggal_document = '2025-01-21',
    @tanggal_dibuat = '2025-01-21',
    @jatuh_tempo = '2025-02-21',
    @status = 0,
    @keterangan = 'PO for agricultural equipment';

EXEC SP_Insert_PO_Detail
    @nomor_po = 'PO-2025-002',
    @item_po = '00010',
    @kode_material = 'TOOL-001',
    @deskripsi_material = 'Hand Tractor Premium',
    @jumlah_po = 10.00,
    @satuan = 'UNIT',
    @harga_satuan = 15500000.00,
    @mata_uang = 'IDR',
    @tanggal_pengiriman = '2025-02-25',
    @keterangan = 'Include warranty certificate';
PRINT '';

-- Vendor Upload Batch Data
PRINT '--- Vendor Uploads Batch Data ---';
EXEC SP_Create_PO_Batch
    @nomor_po = 'PO-2025-001',
    @item_po = '00010',
    @batch_number = 'BATCH-20250101-001',
    @quantity = 500.00,
    @tanggal_kadaluarsa = '2026-01-01',
    @keterangan = 'First shipment batch';

EXEC SP_Create_PO_Batch
    @nomor_po = 'PO-2025-001',
    @item_po = '00010',
    @batch_number = 'BATCH-20250108-002',
    @quantity = 500.00,
    @tanggal_kadaluarsa = '2026-01-08',
    @keterangan = 'Second shipment batch';
PRINT '';

-- Create Outstanding Records
PRINT '--- Creating PO Outstanding Records ---';
EXEC SP_Create_PO_Outstanding
    @purchasing_document = 'PO-2025-001',
    @posnr = '00010',
    @vendor = 'V001',
    @vendor_name = 'PT. Supplier Utama Indonesia',
    @estate = 'Kebun Bogor',
    @item_code = 'MAT-001',
    @description = 'Bahan Kimia Industrial Grade A',
    @order_unit = 'KG',
    @qty = 1000.00,
    @outstanding = 0,  -- All delivered
    @unitprice = 23000.00,
    @total_price = 0,
    @posting_date = '2025-01-20',
    @deadline_date = '2025-02-10',
    @gr_late_in_day = 0;

EXEC SP_Create_PO_Outstanding
    @purchasing_document = 'PO-2025-001',
    @posnr = '00020',
    @vendor = 'V001',
    @vendor_name = 'PT. Supplier Utama Indonesia',
    @estate = 'Kebun Bogor',
    @item_code = 'MAT-002',
    @description = 'Pestisida Premium Quality',
    @order_unit = 'L',
    @qty = 500.00,
    @outstanding = 300.00,  -- Still 300L pending
    @unitprice = 145000.00,
    @total_price = 43500000.00,
    @posting_date = '2025-01-20',
    @deadline_date = '2025-02-15',
    @gr_late_in_day = 5;

EXEC SP_Create_PO_Outstanding
    @purchasing_document = 'PO-2025-002',
    @posnr = '00010',
    @vendor = 'V002',
    @vendor_name = 'CV. Mitra Sejahtera',
    @estate = 'Kebun Cibinong',
    @item_code = 'TOOL-001',
    @description = 'Hand Tractor Premium',
    @order_unit = 'UNIT',
    @qty = 10.00,
    @outstanding = 2.00,  -- 2 units pending
    @unitprice = 15500000.00,
    @total_price = 31000000.00,
    @posting_date = '2025-01-21',
    @deadline_date = '2025-02-25',
    @gr_late_in_day = 0;
PRINT '';

PRINT 'STEP 5 COMPLETED: Purchase Orders Created';
PRINT '';

-- ============================================
-- SUMMARY
-- ============================================
PRINT '=========================================';
PRINT 'DATA INJECTION COMPLETED SUCCESSFULLY!';
PRINT '=========================================';
PRINT '';
PRINT 'Summary of Injected Data:';
PRINT '- Vendors: 3';
PRINT '- Users: 3';
PRINT '- Currencies: 3';
PRINT '- Units of Measure: 6';
PRINT '- RFQs: 2';
PRINT '- RFQ Items: 3';
PRINT '- Negotiation Records: 1 RFQ with 2 items';
PRINT '- Price Confirmations: 2';
PRINT '- Purchase Orders: 2';
PRINT '- PO Items: 3';
PRINT '- Batch Records: 2';
PRINT '- Outstanding Records: 3';
PRINT '';
PRINT 'Completed at: ' + CONVERT(NVARCHAR, GETDATE(), 120);
PRINT '=========================================';
PRINT '';

-- Display some sample data
PRINT 'Sample Verification Queries:';
PRINT '';
PRINT '-- View all vendors:';
PRINT 'SELECT * FROM TB_S_MST_VENDOR;';
PRINT '';
PRINT '-- View RFQ with details:';
PRINT 'SELECT h.*, d.* FROM TB_S_MST_RFQ_BARANG_HEAD h';
PRINT 'JOIN TB_S_MST_RFQ_BARANG_DTL d ON h.nomor_rfq = d.nomor_rfq;';
PRINT '';
PRINT '-- View PO Outstanding:';
PRINT 'SELECT * FROM TB_S_TR_PO_OUTSTANDING ORDER BY vendor, purchasing_document;';
PRINT '';
