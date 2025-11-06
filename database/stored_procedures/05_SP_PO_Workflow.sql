-- ============================================
-- STORED PROCEDURES: PO (PURCHASE ORDER) WORKFLOW
-- Baragud Vendor Management System
-- ============================================
-- File: 05_SP_PO_Workflow.sql
-- Purpose: Stored procedures untuk workflow Purchase Order
-- ============================================

USE baragud;
GO

-- ============================================
-- SP 1: Create Purchase Order Header
-- ============================================
IF OBJECT_ID('SP_Create_PO_Header', 'P') IS NOT NULL
    DROP PROCEDURE SP_Create_PO_Header;
GO

CREATE PROCEDURE SP_Create_PO_Header
    @nomor_po NVARCHAR(50),
    @kode_vendor NVARCHAR(50),
    @tanggal_document DATE,
    @tanggal_dibuat DATE = NULL,
    @jatuh_tempo DATE = NULL,
    @status INT = 0,  -- 0 = Active, 1 = Closed
    @keterangan NVARCHAR(500) = NULL
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        -- Set defaults
        IF @tanggal_dibuat IS NULL
            SET @tanggal_dibuat = CAST(GETDATE() AS DATE);

        -- Validate vendor exists
        IF NOT EXISTS (SELECT 1 FROM TB_S_MST_VENDOR WHERE kode_vendor = @kode_vendor)
        BEGIN
            PRINT 'ERROR: Vendor ' + @kode_vendor + ' not found!';
            ROLLBACK TRANSACTION;
            RETURN;
        END

        -- Check if PO already exists
        IF EXISTS (SELECT 1 FROM TB_S_TR_PO_HEAD WHERE nomor_po = @nomor_po)
        BEGIN
            PRINT 'PO ' + @nomor_po + ' already exists';
            ROLLBACK TRANSACTION;
            RETURN;
        END

        -- Insert PO Header
        INSERT INTO TB_S_TR_PO_HEAD (
            nomor_po,
            kode_vendor,
            tanggal_document,
            tanggal_dibuat,
            jatuh_tempo,
            status,
            keterangan,
            modified_date,
            modified_by
        )
        VALUES (
            @nomor_po,
            @kode_vendor,
            @tanggal_document,
            @tanggal_dibuat,
            @jatuh_tempo,
            @status,
            @keterangan,
            GETDATE(),
            'SAP'
        );

        COMMIT TRANSACTION;
        PRINT 'PO Header created: ' + @nomor_po + ' for vendor ' + @kode_vendor;

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

-- ============================================
-- SP 2: Insert PO Detail (Line Items)
-- ============================================
IF OBJECT_ID('SP_Insert_PO_Detail', 'P') IS NOT NULL
    DROP PROCEDURE SP_Insert_PO_Detail;
GO

CREATE PROCEDURE SP_Insert_PO_Detail
    @nomor_po NVARCHAR(50),
    @item_po NVARCHAR(10),
    @kode_material NVARCHAR(50),
    @deskripsi_material NVARCHAR(500),
    @jumlah_po DECIMAL(18,2),
    @satuan NVARCHAR(10),
    @harga_satuan DECIMAL(18,2),
    @mata_uang NVARCHAR(10) = 'IDR',
    @total_harga DECIMAL(18,2) = NULL,
    @tanggal_pengiriman DATE = NULL,
    @keterangan NVARCHAR(500) = NULL
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        -- Validate PO exists
        IF NOT EXISTS (SELECT 1 FROM TB_S_TR_PO_HEAD WHERE nomor_po = @nomor_po)
        BEGIN
            PRINT 'ERROR: PO ' + @nomor_po + ' not found!';
            ROLLBACK TRANSACTION;
            RETURN;
        END

        -- Calculate total if not provided
        IF @total_harga IS NULL
            SET @total_harga = @jumlah_po * @harga_satuan;

        -- Insert PO Detail
        INSERT INTO TB_S_TR_PO_DTL (
            nomor_po,
            item_po,
            kode_material,
            deskripsi_material,
            jumlah_po,
            satuan,
            harga_satuan,
            mata_uang,
            total_harga,
            tanggal_pengiriman,
            keterangan,
            modified_date,
            modified_by
        )
        VALUES (
            @nomor_po,
            @item_po,
            @kode_material,
            @deskripsi_material,
            @jumlah_po,
            @satuan,
            @harga_satuan,
            @mata_uang,
            @total_harga,
            @tanggal_pengiriman,
            @keterangan,
            GETDATE(),
            'SAP'
        );

        COMMIT TRANSACTION;
        PRINT 'PO Detail added: ' + @nomor_po + ' - Item ' + @item_po;

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

-- ============================================
-- SP 3: Create PO Batch Entry (Vendor Upload)
-- ============================================
IF OBJECT_ID('SP_Create_PO_Batch', 'P') IS NOT NULL
    DROP PROCEDURE SP_Create_PO_Batch;
GO

CREATE PROCEDURE SP_Create_PO_Batch
    @nomor_po NVARCHAR(50),
    @item_po NVARCHAR(10),
    @batch_number NVARCHAR(50),
    @quantity DECIMAL(18,2),
    @tanggal_kadaluarsa DATE = NULL,
    @keterangan NVARCHAR(500) = NULL
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        -- Validate PO Detail exists
        IF NOT EXISTS (
            SELECT 1 FROM TB_S_TR_PO_DTL
            WHERE nomor_po = @nomor_po AND item_po = @item_po
        )
        BEGIN
            PRINT 'ERROR: PO Detail not found!';
            ROLLBACK TRANSACTION;
            RETURN;
        END

        -- Insert Batch data
        INSERT INTO TB_S_TR_BATCH (
            nomor_po,
            item_po,
            batch_number,
            quantity,
            tanggal_kadaluarsa,
            keterangan,
            modified_date,
            modified_by
        )
        VALUES (
            @nomor_po,
            @item_po,
            @batch_number,
            @quantity,
            @tanggal_kadaluarsa,
            @keterangan,
            GETDATE(),
            'WEB'  -- Uploaded by vendor via web portal
        );

        COMMIT TRANSACTION;
        PRINT 'Batch data uploaded: ' + @nomor_po + ' - Batch: ' + @batch_number;

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

-- ============================================
-- SP 4: Create PO Outstanding Record
-- ============================================
IF OBJECT_ID('SP_Create_PO_Outstanding', 'P') IS NOT NULL
    DROP PROCEDURE SP_Create_PO_Outstanding;
GO

CREATE PROCEDURE SP_Create_PO_Outstanding
    @purchasing_document NVARCHAR(50),
    @posnr NVARCHAR(10),
    @vendor NVARCHAR(50),
    @vendor_name NVARCHAR(200),
    @estate NVARCHAR(100),
    @item_code NVARCHAR(50),
    @description NVARCHAR(500),
    @order_unit NVARCHAR(10),
    @qty DECIMAL(18,2),
    @outstanding DECIMAL(18,2),
    @unitprice DECIMAL(18,2),
    @total_price DECIMAL(18,2),
    @posting_date DATE,
    @deadline_date DATE,
    @gr_late_in_day INT = 0
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        -- Insert or Update Outstanding record
        IF EXISTS (
            SELECT 1 FROM TB_S_TR_PO_OUTSTANDING
            WHERE purchasing_document = @purchasing_document
            AND posnr = @posnr
        )
        BEGIN
            -- Update existing
            UPDATE TB_S_TR_PO_OUTSTANDING
            SET
                outstanding = @outstanding,
                total_price = @total_price,
                gr_late_in_day = @gr_late_in_day,
                modified_date = GETDATE()
            WHERE
                purchasing_document = @purchasing_document
                AND posnr = @posnr;

            PRINT 'Outstanding updated: ' + @purchasing_document + '-' + @posnr;
        END
        ELSE
        BEGIN
            -- Insert new
            INSERT INTO TB_S_TR_PO_OUTSTANDING (
                purchasing_document,
                posnr,
                vendor,
                vendor_name,
                estate,
                item_code,
                description,
                order_unit,
                qty,
                outstanding,
                unitprice,
                total_price,
                posting_date,
                deadline_date,
                gr_late_in_day,
                modified_date
            )
            VALUES (
                @purchasing_document,
                @posnr,
                @vendor,
                @vendor_name,
                @estate,
                @item_code,
                @description,
                @order_unit,
                @qty,
                @outstanding,
                @unitprice,
                @total_price,
                @posting_date,
                @deadline_date,
                @gr_late_in_day,
                GETDATE()
            );

            PRINT 'Outstanding created: ' + @purchasing_document + '-' + @posnr;
        END

        COMMIT TRANSACTION;

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

-- ============================================
-- SP 5: Close Purchase Order
-- ============================================
IF OBJECT_ID('SP_Close_PO', 'P') IS NOT NULL
    DROP PROCEDURE SP_Close_PO;
GO

CREATE PROCEDURE SP_Close_PO
    @nomor_po NVARCHAR(50)
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        UPDATE TB_S_TR_PO_HEAD
        SET
            status = 1,  -- 1 = Closed
            modified_date = GETDATE(),
            modified_by = 'SAP'
        WHERE nomor_po = @nomor_po;

        IF @@ROWCOUNT = 0
        BEGIN
            PRINT 'ERROR: PO ' + @nomor_po + ' not found!';
            ROLLBACK TRANSACTION;
            RETURN;
        END

        COMMIT TRANSACTION;
        PRINT 'PO Closed: ' + @nomor_po;

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

PRINT '=========================================';
PRINT 'PO Workflow Stored Procedures Created!';
PRINT '=========================================';
