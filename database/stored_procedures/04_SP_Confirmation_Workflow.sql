-- ============================================
-- STORED PROCEDURES: CONFIRMATION WORKFLOW
-- Baragud Vendor Management System
-- ============================================
-- File: 04_SP_Confirmation_Workflow.sql
-- Purpose: Stored procedures untuk workflow Konfirmasi Harga
-- ============================================

USE baragud;
GO

-- ============================================
-- SP 1: Create Price Confirmation Request
-- ============================================
IF OBJECT_ID('SP_Create_Confirmation_Request', 'P') IS NOT NULL
    DROP PROCEDURE SP_Create_Confirmation_Request;
GO

CREATE PROCEDURE SP_Create_Confirmation_Request
    @kode_konfirmasi NVARCHAR(50),
    @kode_vendor NVARCHAR(50),
    @nama_vendor NVARCHAR(200),
    @nomor_pr NVARCHAR(50),
    @item_pr NVARCHAR(50),
    @kode_material NVARCHAR(50),
    @deskripsi NVARCHAR(500),
    @deskripsi_material NVARCHAR(500) = NULL,
    @jumlah DECIMAL(18,2),
    @satuan NVARCHAR(10),
    @harga_po_terakhir DECIMAL(18,2),
    @mata_uang_po_terakhir NVARCHAR(10) = 'IDR',
    @tanggal_kirim DATE = NULL
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        -- Set default tanggal_kirim to today if not provided
        IF @tanggal_kirim IS NULL
            SET @tanggal_kirim = CAST(GETDATE() AS DATE);

        -- Validate vendor exists
        IF NOT EXISTS (SELECT 1 FROM TB_S_MST_VENDOR WHERE kode_vendor = @kode_vendor)
        BEGIN
            PRINT 'ERROR: Vendor ' + @kode_vendor + ' not found!';
            ROLLBACK TRANSACTION;
            RETURN;
        END

        -- Insert Confirmation Request (Status = 1)
        INSERT INTO TB_S_MST_KONFIRMASI (
            kode_konfirmasi,
            tanggal_kirim,
            kode_vendor,
            nama_vendor,
            harga_po_terakhir,
            mata_uang_po_terakhir,
            nomor_pr,
            item_pr,
            kode_material,
            deskripsi,
            deskripsi_material,
            jumlah,
            harga,
            mata_uang,
            satuan,
            konfirmasi_status,  -- 1 = REQUEST (vendor confirms availability at this price)
            jumlah_tersedia,
            jumlah_inden,
            lama_inden,
            pesan_ulang,
            modified_date,
            modified_by,
            flag_kirim
        )
        VALUES (
            @kode_konfirmasi,
            @tanggal_kirim,
            @kode_vendor,
            @nama_vendor,
            @harga_po_terakhir,
            @mata_uang_po_terakhir,
            @nomor_pr,
            @item_pr,
            @kode_material,
            @deskripsi,
            @deskripsi_material,
            @jumlah,
            @harga_po_terakhir,  -- Initial price same as last PO
            @mata_uang_po_terakhir,
            @satuan,
            1,  -- Status: REQUEST
            0,  -- To be filled by vendor
            0,  -- To be filled by vendor
            0,  -- To be filled by vendor
            NULL,  -- To be filled by vendor (1=yes, 0=no)
            NULL,  -- Will be filled when vendor responds
            NULL,  -- Will be filled when vendor responds
            NULL  -- Flag kirim
        );

        COMMIT TRANSACTION;
        PRINT 'Confirmation REQUEST created: ' + @kode_konfirmasi + ' for vendor ' + @kode_vendor;

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

-- ============================================
-- SP 2: Vendor Respond to Confirmation Request (Status 1)
-- ============================================
IF OBJECT_ID('SP_Respond_Confirmation_Request', 'P') IS NOT NULL
    DROP PROCEDURE SP_Respond_Confirmation_Request;
GO

CREATE PROCEDURE SP_Respond_Confirmation_Request
    @kode_konfirmasi NVARCHAR(50),
    @kode_vendor NVARCHAR(50),
    @pesan_ulang BIT,  -- 1 = Can supply at this price, 0 = Cannot
    @jumlah_tersedia DECIMAL(18,2) = 0,
    @jumlah_inden DECIMAL(18,2) = 0,
    @lama_inden INT = 0,
    @keterangan NVARCHAR(500) = NULL
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        -- Update confirmation with vendor response
        UPDATE TB_S_MST_KONFIRMASI
        SET
            pesan_ulang = @pesan_ulang,
            jumlah_tersedia = @jumlah_tersedia,
            jumlah_inden = @jumlah_inden,
            lama_inden = @lama_inden,
            keterangan = @keterangan,
            modified_date = GETDATE(),
            modified_by = 'WEB'
        WHERE
            kode_konfirmasi = @kode_konfirmasi
            AND kode_vendor = @kode_vendor
            AND konfirmasi_status = 1;

        IF @@ROWCOUNT = 0
        BEGIN
            PRINT 'ERROR: Confirmation request not found or already processed';
            ROLLBACK TRANSACTION;
            RETURN;
        END

        COMMIT TRANSACTION;

        IF @pesan_ulang = 1
            PRINT 'Vendor CONFIRMED availability at requested price: ' + @kode_konfirmasi;
        ELSE
            PRINT 'Vendor DECLINED availability at requested price: ' + @kode_konfirmasi;

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

-- ============================================
-- SP 3: Create Price Quote Request (Vendor submits price)
-- ============================================
IF OBJECT_ID('SP_Create_Price_Quote_Request', 'P') IS NOT NULL
    DROP PROCEDURE SP_Create_Price_Quote_Request;
GO

CREATE PROCEDURE SP_Create_Price_Quote_Request
    @kode_konfirmasi NVARCHAR(50),
    @kode_vendor NVARCHAR(50),
    @nama_vendor NVARCHAR(200),
    @nomor_pr NVARCHAR(50),
    @item_pr NVARCHAR(50),
    @kode_material NVARCHAR(50),
    @deskripsi NVARCHAR(500),
    @deskripsi_material NVARCHAR(500) = NULL,
    @jumlah DECIMAL(18,2),
    @satuan NVARCHAR(10),
    @harga_po_terakhir DECIMAL(18,2),
    @mata_uang_po_terakhir NVARCHAR(10) = 'IDR',
    @tanggal_kirim DATE = NULL
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        -- Set default tanggal_kirim to today if not provided
        IF @tanggal_kirim IS NULL
            SET @tanggal_kirim = CAST(GETDATE() AS DATE);

        -- Insert Price Quote Request (Status = 2)
        INSERT INTO TB_S_MST_KONFIRMASI (
            kode_konfirmasi,
            tanggal_kirim,
            kode_vendor,
            nama_vendor,
            harga_po_terakhir,
            mata_uang_po_terakhir,
            nomor_pr,
            item_pr,
            kode_material,
            deskripsi,
            deskripsi_material,
            jumlah,
            harga,  -- Will be filled by vendor
            mata_uang,  -- Will be filled by vendor
            satuan,
            konfirmasi_status,  -- 2 = CONFIRM (vendor provides new quote)
            jumlah_tersedia,
            jumlah_inden,
            lama_inden,
            pesan_ulang,
            modified_date,
            modified_by,
            flag_kirim
        )
        VALUES (
            @kode_konfirmasi,
            @tanggal_kirim,
            @kode_vendor,
            @nama_vendor,
            @harga_po_terakhir,
            @mata_uang_po_terakhir,
            @nomor_pr,
            @item_pr,
            @kode_material,
            @deskripsi,
            @deskripsi_material,
            @jumlah,
            0,  -- To be filled by vendor
            NULL,  -- To be filled by vendor
            @satuan,
            2,  -- Status: CONFIRM (Request Price Quote)
            0,
            0,
            0,
            NULL,
            NULL,
            NULL,
            NULL
        );

        COMMIT TRANSACTION;
        PRINT 'Price Quote REQUEST created: ' + @kode_konfirmasi + ' for vendor ' + @kode_vendor;

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

-- ============================================
-- SP 4: Vendor Submit Price Quote (Status 2)
-- ============================================
IF OBJECT_ID('SP_Submit_Price_Quote', 'P') IS NOT NULL
    DROP PROCEDURE SP_Submit_Price_Quote;
GO

CREATE PROCEDURE SP_Submit_Price_Quote
    @kode_konfirmasi NVARCHAR(50),
    @kode_vendor NVARCHAR(50),
    @harga DECIMAL(18,2),
    @mata_uang NVARCHAR(10) = 'IDR',
    @jumlah_tersedia DECIMAL(18,2) = 0,
    @jumlah_inden DECIMAL(18,2) = 0,
    @lama_inden INT = 0,
    @keterangan NVARCHAR(500) = NULL
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        -- Update with vendor's price quote
        UPDATE TB_S_MST_KONFIRMASI
        SET
            harga = @harga,
            mata_uang = @mata_uang,
            jumlah_tersedia = @jumlah_tersedia,
            jumlah_inden = @jumlah_inden,
            lama_inden = @lama_inden,
            keterangan = @keterangan,
            modified_date = GETDATE(),
            modified_by = 'WEB'
        WHERE
            kode_konfirmasi = @kode_konfirmasi
            AND kode_vendor = @kode_vendor
            AND konfirmasi_status = 2;

        IF @@ROWCOUNT = 0
        BEGIN
            PRINT 'ERROR: Price quote request not found or already processed';
            ROLLBACK TRANSACTION;
            RETURN;
        END

        COMMIT TRANSACTION;
        PRINT 'Price quote submitted: ' + @kode_konfirmasi + ' = ' + CAST(@harga AS NVARCHAR);

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

-- ============================================
-- SP 5: Send Confirmation to SAP (Flag as sent)
-- ============================================
IF OBJECT_ID('SP_Send_Confirmation_To_SAP', 'P') IS NOT NULL
    DROP PROCEDURE SP_Send_Confirmation_To_SAP;
GO

CREATE PROCEDURE SP_Send_Confirmation_To_SAP
    @kode_vendor NVARCHAR(50),
    @konfirmasi_status INT  -- 1 or 2
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        DECLARE @affected_rows INT;

        -- Update flag_kirim = 1 for all confirmations that have been filled
        UPDATE TB_S_MST_KONFIRMASI
        SET flag_kirim = 1
        WHERE
            kode_vendor = @kode_vendor
            AND konfirmasi_status = @konfirmasi_status
            AND tanggal_kirim = CAST(GETDATE() AS DATE)
            AND (flag_kirim IS NULL OR flag_kirim = 0);

        SET @affected_rows = @@ROWCOUNT;

        COMMIT TRANSACTION;
        PRINT CAST(@affected_rows AS NVARCHAR) + ' confirmation(s) sent to SAP for vendor ' + @kode_vendor;
        RETURN @affected_rows;

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

PRINT '=========================================';
PRINT 'Confirmation Workflow Stored Procedures Created!';
PRINT '=========================================';
