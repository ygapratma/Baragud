-- ============================================
-- EXECUTE ALL: CREATE STORED PROCEDURES
-- Baragud Vendor Management System
-- ============================================
-- File: 00_Execute_All_Create_SPs.sql
-- Purpose: Execute semua script untuk membuat stored procedures
-- ============================================

USE baragud;
GO

PRINT '=========================================';
PRINT 'CREATING ALL STORED PROCEDURES';
PRINT 'Baragud Vendor Management System';
PRINT 'Started at: ' + CONVERT(NVARCHAR, GETDATE(), 120);
PRINT '=========================================';
PRINT '';

-- Execute each script in order
PRINT 'Step 1/5: Creating Master Data Stored Procedures...';
:r 01_SP_Master_Data.sql
GO

PRINT '';
PRINT 'Step 2/5: Creating RFQ Workflow Stored Procedures...';
:r 02_SP_RFQ_Workflow.sql
GO

PRINT '';
PRINT 'Step 3/5: Creating Negotiation Workflow Stored Procedures...';
:r 03_SP_Negotiation_Workflow.sql
GO

PRINT '';
PRINT 'Step 4/5: Creating Confirmation Workflow Stored Procedures...';
:r 04_SP_Confirmation_Workflow.sql
GO

PRINT '';
PRINT 'Step 5/5: Creating PO Workflow Stored Procedures...';
:r 05_SP_PO_Workflow.sql
GO

PRINT '';
PRINT '=========================================';
PRINT 'ALL STORED PROCEDURES CREATED SUCCESSFULLY!';
PRINT 'Completed at: ' + CONVERT(NVARCHAR, GETDATE(), 120);
PRINT '=========================================';
PRINT '';
PRINT 'Next step: Run 06_Data_Injection_Example.sql to inject sample data';
PRINT '';
