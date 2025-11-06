-- ============================================
-- STORED PROCEDURES: MASTER DATA
-- Baragud Vendor Management System
-- ============================================
-- File: 01_SP_Master_Data.sql
-- Purpose: Stored procedures untuk inject master data (Vendor, User, Currency, UOM)
-- ============================================

USE baragud;
GO

-- ============================================
-- SP 1: Insert Vendor Master Data
-- ============================================
IF OBJECT_ID('SP_Insert_Vendor', 'P') IS NOT NULL
    DROP PROCEDURE SP_Insert_Vendor;
GO

CREATE PROCEDURE SP_Insert_Vendor
    @kode_vendor NVARCHAR(50),
    @nama_perusahaan NVARCHAR(200),
    @alamat_perusahaan NVARCHAR(500),
    @kode_negara NVARCHAR(10) = 'ID',
    @kode_provinsi NVARCHAR(10) = NULL,
    @email_perusahaan NVARCHAR(100),
    @telepon_perusahaan NVARCHAR(50) = NULL,
    @fax_perusahaan NVARCHAR(50) = NULL,
    @npwp NVARCHAR(50) = NULL,
    @deletion BIT = 0
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        -- Check if vendor already exists
        IF EXISTS (SELECT 1 FROM TB_S_MST_VENDOR WHERE kode_vendor = @kode_vendor)
        BEGIN
            PRINT 'Vendor ' + @kode_vendor + ' already exists. Skipping...';
            ROLLBACK TRANSACTION;
            RETURN;
        END

        -- Insert Vendor
        INSERT INTO TB_S_MST_VENDOR (
            kode_vendor,
            nama_perusahaan,
            alamat_perusahaan,
            kode_negara,
            kode_provinsi,
            email_perusahaan,
            telepon_perusahaan,
            fax_perusahaan,
            npwp,
            deletion,
            modified_date,
            modified_by
        )
        VALUES (
            @kode_vendor,
            @nama_perusahaan,
            @alamat_perusahaan,
            @kode_negara,
            @kode_provinsi,
            @email_perusahaan,
            @telepon_perusahaan,
            @fax_perusahaan,
            @npwp,
            @deletion,
            GETDATE(),
            'SYSTEM'
        );

        COMMIT TRANSACTION;
        PRINT 'Vendor ' + @kode_vendor + ' inserted successfully';

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

-- ============================================
-- SP 2: Insert User/Pengguna
-- ============================================
IF OBJECT_ID('SP_Insert_User', 'P') IS NOT NULL
    DROP PROCEDURE SP_Insert_User;
GO

CREATE PROCEDURE SP_Insert_User
    @kode_vendor NVARCHAR(50),
    @nama NVARCHAR(200),
    @sandi NVARCHAR(200) = '123456',  -- Default password
    @first_login BIT = 1,
    @deletion BIT = 0
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        -- Check if vendor exists
        IF NOT EXISTS (SELECT 1 FROM TB_S_MST_VENDOR WHERE kode_vendor = @kode_vendor)
        BEGIN
            PRINT 'ERROR: Vendor ' + @kode_vendor + ' does not exist. Please create vendor first.';
            ROLLBACK TRANSACTION;
            RETURN;
        END

        -- Check if user already exists
        IF EXISTS (SELECT 1 FROM TB_S_MST_PENGGUNA WHERE kode_vendor = @kode_vendor)
        BEGIN
            PRINT 'User for vendor ' + @kode_vendor + ' already exists. Skipping...';
            ROLLBACK TRANSACTION;
            RETURN;
        END

        -- Insert User (password will be MD5 hashed on first login)
        INSERT INTO TB_S_MST_PENGGUNA (
            kode_vendor,
            nama,
            sandi,
            first_login,
            deletion,
            modified_date,
            modified_by
        )
        VALUES (
            @kode_vendor,
            @nama,
            @sandi,  -- Raw password for first login
            @first_login,
            @deletion,
            GETDATE(),
            'SYSTEM'
        );

        COMMIT TRANSACTION;
        PRINT 'User for vendor ' + @kode_vendor + ' created with password: ' + @sandi;

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

-- ============================================
-- SP 3: Insert Currency Master
-- ============================================
IF OBJECT_ID('SP_Insert_Currency', 'P') IS NOT NULL
    DROP PROCEDURE SP_Insert_Currency;
GO

CREATE PROCEDURE SP_Insert_Currency
    @kode_uang NVARCHAR(10),
    @deskripsi NVARCHAR(100)
AS
BEGIN
    SET NOCOUNT ON;

    IF NOT EXISTS (SELECT 1 FROM TB_S_MST_MATA_UANG WHERE kode_uang = @kode_uang)
    BEGIN
        INSERT INTO TB_S_MST_MATA_UANG (kode_uang, deskripsi)
        VALUES (@kode_uang, @deskripsi);
        PRINT 'Currency ' + @kode_uang + ' inserted';
    END
    ELSE
        PRINT 'Currency ' + @kode_uang + ' already exists';
END
GO

-- ============================================
-- SP 4: Insert Unit of Measure (Satuan)
-- ============================================
IF OBJECT_ID('SP_Insert_UOM', 'P') IS NOT NULL
    DROP PROCEDURE SP_Insert_UOM;
GO

CREATE PROCEDURE SP_Insert_UOM
    @satuan NVARCHAR(10),
    @deskripsi_satuan NVARCHAR(100)
AS
BEGIN
    SET NOCOUNT ON;

    IF NOT EXISTS (SELECT 1 FROM TB_S_MST_SATUAN WHERE satuan = @satuan)
    BEGIN
        INSERT INTO TB_S_MST_SATUAN (satuan, deskripsi_satuan)
        VALUES (@satuan, @deskripsi_satuan);
        PRINT 'UOM ' + @satuan + ' inserted';
    END
    ELSE
        PRINT 'UOM ' + @satuan + ' already exists';
END
GO

PRINT '=========================================';
PRINT 'Master Data Stored Procedures Created!';
PRINT '=========================================';
