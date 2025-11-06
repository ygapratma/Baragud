-- ============================================
-- STORED PROCEDURES: RFQ WORKFLOW
-- Baragud Vendor Management System
-- ============================================
-- File: 02_SP_RFQ_Workflow.sql
-- Purpose: Stored procedures untuk workflow RFQ (Request for Quotation)
-- ============================================

USE baragud;
GO

-- ============================================
-- SP 1: Insert RFQ Header
-- ============================================
IF OBJECT_ID('SP_Insert_RFQ_Header', 'P') IS NOT NULL
    DROP PROCEDURE SP_Insert_RFQ_Header;
GO

CREATE PROCEDURE SP_Insert_RFQ_Header
    @nomor_rfq NVARCHAR(50),
    @kode_vendor NVARCHAR(50),
    @tanggal_rfq DATE,
    @tanggal_jatuh_tempo DATE,
    @keterangan NVARCHAR(500) = NULL
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        -- Validate vendor exists
        IF NOT EXISTS (SELECT 1 FROM TB_S_MST_VENDOR WHERE kode_vendor = @kode_vendor)
        BEGIN
            PRINT 'ERROR: Vendor ' + @kode_vendor + ' not found!';
            ROLLBACK TRANSACTION;
            RETURN;
        END

        -- Check if RFQ already exists
        IF EXISTS (SELECT 1 FROM TB_S_MST_RFQ_BARANG_HEAD WHERE nomor_rfq = @nomor_rfq AND kode_vendor = @kode_vendor)
        BEGIN
            PRINT 'RFQ ' + @nomor_rfq + ' for vendor ' + @kode_vendor + ' already exists';
            ROLLBACK TRANSACTION;
            RETURN;
        END

        -- Insert RFQ Header
        INSERT INTO TB_S_MST_RFQ_BARANG_HEAD (
            nomor_rfq,
            kode_vendor,
            tanggal_rfq,
            tanggal_jatuh_tempo,
            keterangan,
            modified_date,
            modified_by
        )
        VALUES (
            @nomor_rfq,
            @kode_vendor,
            @tanggal_rfq,
            @tanggal_jatuh_tempo,
            @keterangan,
            GETDATE(),
            'SAP'  -- From SAP system
        );

        COMMIT TRANSACTION;
        PRINT 'RFQ Header ' + @nomor_rfq + ' created for vendor ' + @kode_vendor;

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

-- ============================================
-- SP 2: Insert RFQ Detail (Item)
-- ============================================
IF OBJECT_ID('SP_Insert_RFQ_Detail', 'P') IS NOT NULL
    DROP PROCEDURE SP_Insert_RFQ_Detail;
GO

CREATE PROCEDURE SP_Insert_RFQ_Detail
    @nomor_rfq NVARCHAR(50),
    @kode_barang NVARCHAR(50),
    @deskripsi_barang NVARCHAR(500),
    @deskripsi_material NVARCHAR(500) = NULL,
    @jumlah_permintaan DECIMAL(18,2),
    @satuan NVARCHAR(10),
    @mata_uang NVARCHAR(10) = 'IDR',
    @dipakai_untuk NVARCHAR(500) = NULL,
    @nomor_sr NVARCHAR(50) = NULL,
    @kode_kebun NVARCHAR(50) = NULL
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        -- Validate RFQ exists
        IF NOT EXISTS (SELECT 1 FROM TB_S_MST_RFQ_BARANG_HEAD WHERE nomor_rfq = @nomor_rfq)
        BEGIN
            PRINT 'ERROR: RFQ ' + @nomor_rfq + ' not found!';
            ROLLBACK TRANSACTION;
            RETURN;
        END

        -- Insert RFQ Detail
        INSERT INTO TB_S_MST_RFQ_BARANG_DTL (
            nomor_rfq,
            kode_barang,
            deskripsi_barang,
            deskripsi_material,
            jumlah_permintaan,
            satuan,
            mata_uang,
            harga_satuan,
            per_harga_satuan,
            konversi,
            jumlah_konversi,
            satuan_konversi,
            ketersediaan_barang,
            masa_berlaku_harga,
            keterangan,
            dibuat_oleh,
            modified_date,
            modified_by,
            jumlah_tersedia,
            jumlah_inden,
            lama_inden,
            dipakai_untuk,
            nomor_sr,
            kode_kebun
        )
        VALUES (
            @nomor_rfq,
            @kode_barang,
            @deskripsi_barang,
            @deskripsi_material,
            @jumlah_permintaan,
            @satuan,
            @mata_uang,
            0,  -- To be filled by vendor
            0,  -- To be filled by vendor
            0,  -- To be filled by vendor
            NULL,
            NULL,
            0,  -- To be filled by vendor
            NULL,
            NULL,
            'SAP',
            NULL,  -- Will be filled when vendor submits quotation
            NULL,  -- Will be filled when vendor submits quotation
            0,  -- To be filled by vendor
            0,  -- To be filled by vendor
            0,  -- To be filled by vendor
            @dipakai_untuk,
            @nomor_sr,
            @kode_kebun
        );

        COMMIT TRANSACTION;
        PRINT 'RFQ Detail added: ' + @nomor_rfq + ' - ' + @kode_barang;

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

-- ============================================
-- SP 3: Vendor Submit RFQ Quotation (Update Detail)
-- ============================================
IF OBJECT_ID('SP_Submit_RFQ_Quotation', 'P') IS NOT NULL
    DROP PROCEDURE SP_Submit_RFQ_Quotation;
GO

CREATE PROCEDURE SP_Submit_RFQ_Quotation
    @nomor_rfq NVARCHAR(50),
    @kode_barang NVARCHAR(50),
    @harga_satuan DECIMAL(18,2),
    @per_harga_satuan DECIMAL(18,2) = 1,
    @konversi DECIMAL(18,2) = 1,
    @jumlah_konversi DECIMAL(18,2) = NULL,
    @satuan_konversi NVARCHAR(10) = NULL,
    @ketersediaan_barang INT = 1,  -- 1=Ready, 2=Indent
    @masa_berlaku_harga DATE = NULL,
    @keterangan NVARCHAR(500) = NULL,
    @jumlah_tersedia DECIMAL(18,2) = 0,
    @jumlah_inden DECIMAL(18,2) = 0,
    @lama_inden INT = 0
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        -- Update RFQ Detail with vendor quotation
        UPDATE TB_S_MST_RFQ_BARANG_DTL
        SET
            harga_satuan = @harga_satuan,
            per_harga_satuan = @per_harga_satuan,
            konversi = @konversi,
            jumlah_konversi = @jumlah_konversi,
            satuan_konversi = @satuan_konversi,
            ketersediaan_barang = @ketersediaan_barang,
            masa_berlaku_harga = @masa_berlaku_harga,
            keterangan = @keterangan,
            jumlah_tersedia = @jumlah_tersedia,
            jumlah_inden = @jumlah_inden,
            lama_inden = @lama_inden,
            modified_date = GETDATE(),
            modified_by = 'WEB'  -- From vendor portal
        WHERE
            nomor_rfq = @nomor_rfq
            AND kode_barang = @kode_barang;

        IF @@ROWCOUNT = 0
        BEGIN
            PRINT 'ERROR: RFQ item not found: ' + @nomor_rfq + ' - ' + @kode_barang;
            ROLLBACK TRANSACTION;
            RETURN;
        END

        COMMIT TRANSACTION;
        PRINT 'Quotation submitted for: ' + @nomor_rfq + ' - ' + @kode_barang;

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

-- ============================================
-- SP 4: Insert RFQ Equivalent Product
-- ============================================
IF OBJECT_ID('SP_Insert_RFQ_Equivalent', 'P') IS NOT NULL
    DROP PROCEDURE SP_Insert_RFQ_Equivalent;
GO

CREATE PROCEDURE SP_Insert_RFQ_Equivalent
    @nomor_rfq NVARCHAR(50),
    @kode_barang NVARCHAR(50),  -- Original item code
    @ekuivalen INT,  -- 1, 2, 3, or 4
    @kode_barang_eqiv NVARCHAR(50),
    @deskripsi_barang NVARCHAR(500),
    @spesifikasi NVARCHAR(500) = NULL,
    @merek NVARCHAR(200) = NULL,
    @tipe NVARCHAR(200) = NULL,
    @buatan NVARCHAR(200) = NULL,
    @jumlah_permintaan DECIMAL(18,2),
    @satuan NVARCHAR(10),
    @harga_satuan DECIMAL(18,2),
    @ketersediaan_barang INT = 1,
    @masa_berlaku_harga DATE = NULL
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        -- Validate original RFQ item exists
        IF NOT EXISTS (
            SELECT 1 FROM TB_S_MST_RFQ_BARANG_DTL
            WHERE nomor_rfq = @nomor_rfq AND kode_barang = @kode_barang
        )
        BEGIN
            PRINT 'ERROR: Original RFQ item not found!';
            ROLLBACK TRANSACTION;
            RETURN;
        END

        -- Get data from original item
        DECLARE @mata_uang NVARCHAR(10), @nomor_sr NVARCHAR(50), @kode_kebun NVARCHAR(50);
        SELECT
            @mata_uang = mata_uang,
            @nomor_sr = nomor_sr,
            @kode_kebun = kode_kebun
        FROM TB_S_MST_RFQ_BARANG_DTL
        WHERE nomor_rfq = @nomor_rfq AND kode_barang = @kode_barang;

        -- Insert equivalent product
        INSERT INTO TB_S_MST_RFQ_BARANG_EQIV (
            nomor_rfq,
            ekuivalen,
            kode_barang,
            deskripsi_barang,
            deskripsi_material,
            spesifikasi,
            merek,
            tipe,
            buatan,
            jumlah_permintaan,
            satuan,
            mata_uang,
            harga_satuan,
            per_harga_satuan,
            konversi,
            ketersediaan_barang,
            masa_berlaku_harga,
            nomor_sr,
            kode_kebun,
            modified_date,
            modified_by
        )
        VALUES (
            @nomor_rfq,
            @ekuivalen,
            @kode_barang,  -- Reference to original item
            @deskripsi_barang,
            'Produk Ekuivalen ' + CAST(@ekuivalen AS NVARCHAR),
            @spesifikasi,
            @merek,
            @tipe,
            @buatan,
            @jumlah_permintaan,
            @satuan,
            @mata_uang,
            @harga_satuan,
            1,
            1,
            @ketersediaan_barang,
            @masa_berlaku_harga,
            @nomor_sr,
            @kode_kebun,
            GETDATE(),
            'WEB'
        );

        COMMIT TRANSACTION;
        PRINT 'Equivalent product ' + CAST(@ekuivalen AS NVARCHAR) + ' added for: ' + @nomor_rfq + ' - ' + @kode_barang;

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

-- ============================================
-- SP 5: Insert RFQ Additional Charges
-- ============================================
IF OBJECT_ID('SP_Insert_RFQ_Additional_Charges', 'P') IS NOT NULL
    DROP PROCEDURE SP_Insert_RFQ_Additional_Charges;
GO

CREATE PROCEDURE SP_Insert_RFQ_Additional_Charges
    @nomor_rfq NVARCHAR(50),
    @jenis_biaya NVARCHAR(200),  -- e.g., "Delivery", "Packaging", "Insurance"
    @nilai_biaya DECIMAL(18,2),
    @mata_uang NVARCHAR(10) = 'IDR',
    @keterangan NVARCHAR(500) = NULL
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        -- Validate RFQ exists
        IF NOT EXISTS (SELECT 1 FROM TB_S_MST_RFQ_BARANG_HEAD WHERE nomor_rfq = @nomor_rfq)
        BEGIN
            PRINT 'ERROR: RFQ ' + @nomor_rfq + ' not found!';
            ROLLBACK TRANSACTION;
            RETURN;
        END

        -- Insert additional charges
        INSERT INTO TB_S_MST_RFQ_BIAYA_TAMBAHAN (
            nomor_rfq,
            jenis_biaya,
            nilai_biaya,
            mata_uang,
            keterangan,
            modified_date,
            modified_by
        )
        VALUES (
            @nomor_rfq,
            @jenis_biaya,
            @nilai_biaya,
            @mata_uang,
            @keterangan,
            GETDATE(),
            'WEB'
        );

        COMMIT TRANSACTION;
        PRINT 'Additional charge added: ' + @jenis_biaya + ' = ' + CAST(@nilai_biaya AS NVARCHAR);

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

PRINT '=========================================';
PRINT 'RFQ Workflow Stored Procedures Created!';
PRINT '=========================================';
