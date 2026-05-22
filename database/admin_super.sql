-- =====================================================
-- HAPUS DATABASE LAMA TOTAL
-- =====================================================
DROP DATABASE IF EXISTS admin_super;

-- =====================================================
-- BUAT DATABASE BARU
-- =====================================================
CREATE DATABASE admin_super;
USE admin_super;S

-- =====================================================
-- USERS (FINAL FIX - SESUAI WEB.PHP KAMU)
-- =====================================================
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NULL,
    role VARCHAR(100) DEFAULT 'user',
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- =====================================================
-- PEGAWAI DINAS KESEHATAN
-- =====================================================
CREATE TABLE pegawai_dinkes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nip VARCHAR(100) NULL,
    nama_pegawai VARCHAR(255) NULL,
    jenis_kelamin VARCHAR(50) NULL,
    pendidikan VARCHAR(255) NULL,
    jabatan VARCHAR(255) NULL,
    status_pegawai VARCHAR(100) NULL,
    tmt_pensiun DATE NULL,
    batas_usia_pensiun VARCHAR(50) NULL,
    prediksi_naik_gaji VARCHAR(50) NULL,
    prediksi_naik_pangkat VARCHAR(50) NULL,
    email VARCHAR(255) NULL,
    role VARCHAR(50) DEFAULT 'Pegawai',
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- =====================================================
-- PEGAWAI UPT
-- =====================================================
CREATE TABLE pegawai_upt (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nip VARCHAR(100) NULL,
    nama_pegawai VARCHAR(255) NULL,
    jenis_kelamin VARCHAR(50) NULL,
    pendidikan VARCHAR(255) NULL,
    jabatan VARCHAR(255) NULL,
    status_pegawai VARCHAR(100) NULL,
    tmt_pensiun DATE NULL,
    batas_usia_pensiun VARCHAR(50) NULL,
    upt_unit VARCHAR(255) NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- =====================================================
-- KALENDER DINAS LUAR
-- =====================================================
CREATE TABLE kalender_dinas_luar (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_pegawai VARCHAR(255) NULL,
    tanggal_dinas DATE NULL,
    lokasi VARCHAR(255) NULL,
    keterangan TEXT NULL,
    tag_user VARCHAR(255) NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- =====================================================
-- PENGAJUAN CUTI
-- =====================================================
CREATE TABLE pengajuan_cuti (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NULL,
    nip VARCHAR(100) NULL,
    jenis_cuti VARCHAR(255) NULL,
    tanggal_mulai DATE NULL,
    tanggal_selesai DATE NULL,
    status_pengajuan VARCHAR(100) NULL,
    alasan TEXT NULL,
    bidang VARCHAR(255) NULL,
    unit_kerja VARCHAR(255) NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- =====================================================
-- EXPORT DATA
-- =====================================================
CREATE TABLE export_data (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    jenis_export VARCHAR(255) NULL,
    format_export VARCHAR(100) NULL,
    tanggal_export DATE NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);