-- ============================================
-- STORED PROCEDURES: NEGOTIATION WORKFLOW
-- Baragud Vendor Management System
-- ============================================
-- File: 03_SP_Negotiation_Workflow.sql
-- Purpose: Stored procedures untuk workflow Negosiasi Harga
-- ============================================

USE baragud;
GO

-- ============================================
-- SP 1: Copy RFQ to Negotiation
-- ============================================
IF OBJECT_ID('SP_Create_Negotiation_From_RFQ', 'P') IS NOT NULL
    DROP PROCEDURE SP_Create_Negotiation_From_RFQ;
GO

CREATE PROCEDURE SP_Create_Negotiation_From_RFQ
    @nomor_rfq NVARCHAR(50),
    @kode_vendor NVARCHAR(50)
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        -- Validate RFQ exists
        IF NOT EXISTS (
            SELECT 1 FROM TB_S_MST_RFQ_BARANG_HEAD
            WHERE nomor_rfq = @nomor_rfq AND kode_vendor = @kode_vendor
        )
        BEGIN
            PRINT 'ERROR: RFQ ' + @nomor_rfq + ' not found for vendor ' + @kode_vendor;
            ROLLBACK TRANSACTION;
            RETURN;
        END

        -- Check if negotiation already exists
        IF EXISTS (
            SELECT 1 FROM TB_S_MST_NEGO_BARANG_HEAD
            WHERE nomor_rfq = @nomor_rfq AND kode_vendor = @kode_vendor
        )
        BEGIN
            PRINT 'Negotiation for RFQ ' + @nomor_rfq + ' already exists';
            ROLLBACK TRANSACTION;
            RETURN;
        END

        -- Copy RFQ Header to Negotiation Header
        INSERT INTO TB_S_MST_NEGO_BARANG_HEAD (
            nomor_rfq,
            kode_vendor,
            tanggal_rfq,
            tanggal_jatuh_tempo,
            keterangan,
            modified_date,
            modified_by
        )
        SELECT
            nomor_rfq,
            kode_vendor,
            tanggal_rfq,
            tanggal_jatuh_tempo,
            keterangan,
            NULL,  -- Will be updated when vendor submits negotiation
            NULL
        FROM TB_S_MST_RFQ_BARANG_HEAD
        WHERE nomor_rfq = @nomor_rfq AND kode_vendor = @kode_vendor;

        -- Copy RFQ Detail to Negotiation Detail
        INSERT INTO TB_S_MST_NEGO_BARANG_DTL (
            nomor_rfq,
            kode_barang,
            deskripsi_barang,
            deskripsi_material,
            jumlah_permintaan,
            satuan,
            deskripsi_satuan,
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
            harga_satuan_nego,
            keterangan_nego
        )
        SELECT
            rfq.nomor_rfq,
            rfq.kode_barang,
            rfq.deskripsi_barang,
            rfq.deskripsi_material,
            rfq.jumlah_permintaan,
            rfq.satuan,
            uom.deskripsi_satuan,
            rfq.mata_uang,
            rfq.harga_satuan,  -- Original RFQ price
            rfq.per_harga_satuan,
            rfq.konversi,
            rfq.jumlah_konversi,
            rfq.satuan_konversi,
            rfq.ketersediaan_barang,
            rfq.masa_berlaku_harga,
            rfq.keterangan,
            'SAP',
            NULL,  -- Will be filled when vendor submits negotiation
            NULL,
            rfq.jumlah_tersedia,
            rfq.jumlah_inden,
            rfq.lama_inden,
            rfq.dipakai_untuk,
            NULL,  -- Negotiated price to be filled by vendor
            NULL   -- Negotiation remarks
        FROM TB_S_MST_RFQ_BARANG_DTL rfq
        LEFT JOIN TB_S_MST_SATUAN uom ON uom.satuan = rfq.satuan
        WHERE rfq.nomor_rfq = @nomor_rfq;

        -- Copy RFQ Equivalents to Negotiation Equivalents
        INSERT INTO TB_S_MST_NEGO_BARANG_EQIV (
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
            modified_date,
            modified_by
        )
        SELECT
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
            NULL,
            NULL
        FROM TB_S_MST_RFQ_BARANG_EQIV
        WHERE nomor_rfq = @nomor_rfq;

        -- Copy RFQ Additional Charges to Negotiation
        INSERT INTO TB_S_MST_NEGO_BIAYA_TAMBAHAN (
            nomor_rfq,
            jenis_biaya,
            nilai_biaya,
            mata_uang,
            keterangan,
            modified_date,
            modified_by
        )
        SELECT
            nomor_rfq,
            jenis_biaya,
            nilai_biaya,
            mata_uang,
            keterangan,
            NULL,
            NULL
        FROM TB_S_MST_RFQ_BIAYA_TAMBAHAN
        WHERE nomor_rfq = @nomor_rfq;

        COMMIT TRANSACTION;
        PRINT 'Negotiation created from RFQ: ' + @nomor_rfq;

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

-- ============================================
-- SP 2: Vendor Submit Negotiation Price
-- ============================================
IF OBJECT_ID('SP_Submit_Negotiation_Price', 'P') IS NOT NULL
    DROP PROCEDURE SP_Submit_Negotiation_Price;
GO

CREATE PROCEDURE SP_Submit_Negotiation_Price
    @nomor_rfq NVARCHAR(50),
    @kode_barang NVARCHAR(50),
    @harga_satuan_nego DECIMAL(18,2),
    @keterangan_nego NVARCHAR(MAX) = NULL,
    @ketersediaan_barang INT = NULL,
    @masa_berlaku_harga DATE = NULL
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        -- Update negotiation detail with new price
        UPDATE TB_S_MST_NEGO_BARANG_DTL
        SET
            harga_satuan_nego = @harga_satuan_nego,
            keterangan_nego = @keterangan_nego,
            ketersediaan_barang = ISNULL(@ketersediaan_barang, ketersediaan_barang),
            masa_berlaku_harga = ISNULL(@masa_berlaku_harga, masa_berlaku_harga),
            modified_date = GETDATE(),
            modified_by = 'WEB'
        WHERE
            nomor_rfq = @nomor_rfq
            AND kode_barang = @kode_barang;

        IF @@ROWCOUNT = 0
        BEGIN
            PRINT 'ERROR: Negotiation item not found: ' + @nomor_rfq + ' - ' + @kode_barang;
            ROLLBACK TRANSACTION;
            RETURN;
        END

        -- Update header modified date
        UPDATE TB_S_MST_NEGO_BARANG_HEAD
        SET
            modified_date = GETDATE(),
            modified_by = 'WEB'
        WHERE nomor_rfq = @nomor_rfq;

        COMMIT TRANSACTION;
        PRINT 'Negotiation price submitted: ' + @nomor_rfq + ' - ' + @kode_barang + ' = ' + CAST(@harga_satuan_nego AS NVARCHAR);

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

-- ============================================
-- SP 3: Update Negotiation Equivalent Price
-- ============================================
IF OBJECT_ID('SP_Update_Negotiation_Equivalent', 'P') IS NOT NULL
    DROP PROCEDURE SP_Update_Negotiation_Equivalent;
GO

CREATE PROCEDURE SP_Update_Negotiation_Equivalent
    @nomor_rfq NVARCHAR(50),
    @kode_barang NVARCHAR(50),
    @ekuivalen INT,
    @harga_satuan DECIMAL(18,2),
    @ketersediaan_barang INT = NULL,
    @masa_berlaku_harga DATE = NULL
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        UPDATE TB_S_MST_NEGO_BARANG_EQIV
        SET
            harga_satuan = @harga_satuan,
            ketersediaan_barang = ISNULL(@ketersediaan_barang, ketersediaan_barang),
            masa_berlaku_harga = ISNULL(@masa_berlaku_harga, masa_berlaku_harga),
            modified_date = GETDATE(),
            modified_by = 'WEB'
        WHERE
            nomor_rfq = @nomor_rfq
            AND kode_barang = @kode_barang
            AND ekuivalen = @ekuivalen;

        IF @@ROWCOUNT = 0
        BEGIN
            PRINT 'ERROR: Negotiation equivalent not found';
            ROLLBACK TRANSACTION;
            RETURN;
        END

        COMMIT TRANSACTION;
        PRINT 'Negotiation equivalent updated: Equiv ' + CAST(@ekuivalen AS NVARCHAR);

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

-- ============================================
-- SP 4: Update Negotiation Additional Charges
-- ============================================
IF OBJECT_ID('SP_Update_Negotiation_Charges', 'P') IS NOT NULL
    DROP PROCEDURE SP_Update_Negotiation_Charges;
GO

CREATE PROCEDURE SP_Update_Negotiation_Charges
    @nomor_rfq NVARCHAR(50),
    @jenis_biaya NVARCHAR(200),
    @nilai_biaya DECIMAL(18,2),
    @keterangan NVARCHAR(500) = NULL
AS
BEGIN
    SET NOCOUNT ON;

    BEGIN TRY
        BEGIN TRANSACTION;

        UPDATE TB_S_MST_NEGO_BIAYA_TAMBAHAN
        SET
            nilai_biaya = @nilai_biaya,
            keterangan = @keterangan,
            modified_date = GETDATE(),
            modified_by = 'WEB'
        WHERE
            nomor_rfq = @nomor_rfq
            AND jenis_biaya = @jenis_biaya;

        IF @@ROWCOUNT = 0
        BEGIN
            PRINT 'Charge type not found, inserting new...';
            INSERT INTO TB_S_MST_NEGO_BIAYA_TAMBAHAN (
                nomor_rfq, jenis_biaya, nilai_biaya, mata_uang, keterangan, modified_date, modified_by
            )
            VALUES (
                @nomor_rfq, @jenis_biaya, @nilai_biaya, 'IDR', @keterangan, GETDATE(), 'WEB'
            );
        END

        COMMIT TRANSACTION;
        PRINT 'Negotiation charges updated: ' + @jenis_biaya;

    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;
        PRINT 'ERROR: ' + ERROR_MESSAGE();
        THROW;
    END CATCH
END
GO

PRINT '=========================================';
PRINT 'Negotiation Workflow Stored Procedures Created!';
PRINT '=========================================';
