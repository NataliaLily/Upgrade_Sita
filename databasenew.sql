-- ==========================
-- TABEL DOSEN
-- ==========================
DROP TABLE IF EXISTS dosen;

CREATE TABLE dosen (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    no_dosen   CHAR(4) NULL UNIQUE,
    nidn       VARCHAR(10) DEFAULT '' NULL,
    gelar1     CHAR(20) NULL,
    nama_dosen CHAR(50) NULL,
    gelar2     CHAR(20) NULL,
    rektor     CHAR NULL,
    id_user    INT NOT NULL,
    is_active  TINYINT(1) DEFAULT 1 NOT NULL,
    waktu      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ==========================
-- TABEL LOGIN_DOSEN
-- ==========================
DROP TABLE IF EXISTS login_dosen;

CREATE TABLE login_dosen (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    password  CHAR(42) NULL,
    id_dosen  INT NOT NULL UNIQUE,
    id_user   INT NOT NULL,
    token     VARCHAR(200) NULL,
    web_token VARCHAR(100) NULL,
    waktu     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT login_dosen_ibfk_1 FOREIGN KEY (id_dosen) REFERENCES dosen (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX idx_login_dosen_token ON login_dosen (token);

-- ==========================
-- TABEL MHS
-- ==========================
DROP TABLE IF EXISTS mhs;

CREATE TABLE mhs (
    id                INT AUTO_INCREMENT PRIMARY KEY,
    no_mhs            CHAR(10) NOT NULL UNIQUE,
    nama              CHAR(50) NULL,
    almt              CHAR(50) NULL,
    tmp_lahir         CHAR(30) NULL,
    tgl_lahir         DATE NULL,
    j_kelamin         CHAR NULL,
    id_user           INT NOT NULL,
    waktu             TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
    id_dosen_wali     INT DEFAULT 1 NOT NULL,
    no_cama           CHAR(10) DEFAULT '' NULL,
    lulus             INT DEFAULT 0 NULL,
    is_do             INT DEFAULT 0 NOT NULL,
    is_transfered     INT DEFAULT 0 NOT NULL,
    email_utama       VARCHAR(200) DEFAULT '' NULL,
    email_universitas VARCHAR(200) DEFAULT '' NULL,
    nomer_whatsapp    VARCHAR(20) DEFAULT '' NULL,
    CONSTRAINT mhs_ibfk_2 FOREIGN KEY (id_dosen_wali) REFERENCES dosen (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX idx_mhs_id_dosen_wali ON mhs (id_dosen_wali);
CREATE INDEX idx_mhs_id_user ON mhs (id_user);

-- ==========================
-- TABEL LOGIN_MHS
-- ==========================
DROP TABLE IF EXISTS login_mhs;

CREATE TABLE login_mhs (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    password  CHAR(42) NULL,
    id_mhs    INT NOT NULL UNIQUE,
    id_user   INT NOT NULL,
    token     VARCHAR(200) DEFAULT '' NOT NULL,
    waktu     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
    web_token VARCHAR(200) DEFAULT '' NULL,
    CONSTRAINT login_mhs_ibfk_1 FOREIGN KEY (id_mhs) REFERENCES mhs (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX idx_login_mhs_id_user ON login_mhs (id_user);
CREATE INDEX idx_login_mhs_token ON login_mhs (token);

-- ==========================
-- TABEL PENADARAN
-- ==========================
DROP TABLE IF EXISTS pendadaran;

CREATE TABLE pendadaran (
    id_pendadaran               INT AUTO_INCREMENT PRIMARY KEY,
    tanggal_pendadaran          DATE NULL,
    jam_pendadaran              VARCHAR(20) NULL,
    akdsem                      VARCHAR(5) NULL,
    id_mhs                      INT NULL,
    id_tugas_akhir              INT NULL,
    id_dosen_pembimbing_1       INT NULL,
    id_dosen_pembimbing_2       INT NULL,
    id_dosen_penguji            INT NULL,
    approve_doping_1_pendadaran INT DEFAULT 0 NULL,
    approve_doping_2_pendadaran INT DEFAULT 0 NULL,
    approve_penguji_pendadaran  INT DEFAULT 0 NULL,
    nilai_doping_1_pendadaran   INT DEFAULT 0 NULL,
    nilai_doping_2_pendadaran   INT DEFAULT 0 NULL,
    nilai_penguji_pendadaran    INT DEFAULT 0 NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ==========================
-- TABEL TUGAS_AKHIR
-- ==========================
DROP TABLE IF EXISTS tugas_akhir;

CREATE TABLE tugas_akhir (
    id_tugas_akhir               INT AUTO_INCREMENT PRIMARY KEY,
    link_dokumen                 VARCHAR(255) DEFAULT '' NULL,
    judul_tugas_akhir            VARCHAR(230) NULL,
    id_mhs                       INT NULL,
    akdsem                       VARCHAR(5) NULL,
    id_dosen_pembimbing_1        INT NULL,
    id_dosen_pembimbing_2        INT NULL,
    approve_doping_1_tugas_akhir TINYINT(1) DEFAULT 0 NOT NULL,
    approve_doping_2_tugas_akhir TINYINT(1) DEFAULT 0 NOT NULL,
    created_at                   TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ==========================
-- TABEL USER_SITA
-- ==========================
DROP TABLE IF EXISTS user_sita;

CREATE TABLE user_sita (
    id_user       INT(10) AUTO_INCREMENT PRIMARY KEY,
    username_user VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    password_user VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    nama_user     VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    email_user    VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    enabled       TINYINT(1) DEFAULT 1 NOT NULL,
    no_prodi      INT DEFAULT 0 NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ==========================
-- TABEL SESSIONS_SITA
-- ==========================
DROP TABLE IF EXISTS sessions_sita;

CREATE TABLE `sessions_sita`
(
	`id`         varchar(128) NOT NULL,
	`ip_address` varchar(45)  NOT NULL,
	`timestamp`  int(10) unsigned NOT NULL DEFAULT 0,
	`data`       blob         NOT NULL,
	KEY          `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- CREATE TABLE `sessions_sita` (
--   `id` varchar(255) NOT NULL,
--   `user_id` bigint(20) unsigned DEFAULT NULL,
--   `ip_address` varchar(45) DEFAULT NULL,
--   `user_agent` text DEFAULT NULL,
--   `payload` longtext NOT NULL,
--   `last_activity` int(11) NOT NULL,
--   PRIMARY KEY (`id`),
--   KEY `sessions_user_id_index` (`user_id`),
--   KEY `sessions_last_activity_index` (`last_activity`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



INSERT INTO login_dosen (password, id_dosen, id_user, token, web_token)
VALUES ('asdasd', 1, 1, NULL, NULL),
       ('asdasd', 2, 1, NULL, NULL),
       ('asdasd', 3, 1, NULL, NULL),
       ('asdasd', 4, 1, NULL, NULL),
       ('asdasd', 5, 1, NULL, NULL),
       ('asdasd', 6, 1, NULL, NULL),
       ('asdasd', 7, 1, NULL, NULL),
       ('asdasd', 9, 1, NULL, NULL),
       ('asdasd', 8, 1, NULL, NULL),
       ('asdasd', 10, 1, NULL, NULL);



