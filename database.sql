create
or replace table bimbingan
(
    id_bimbingan                int auto_increment primary key,
    tanggal_bimbingan           date                               null,
    catatan_dosen_bimbingan     text                                  null,
    catatan_mahasiswa_bimbingan text                                  null,
    id_dosen                    int                                   null,
    id_tugas_akhir              int                                   null,
    create_at                   timestamp default current_timestamp() not null
)
    charset = latin1;

create
or replace table dosen
(
    id         int auto_increment
        primary key,
    no_dosen   char(4)                                 null,
    nidn       varchar(10) default ''                  null,
    gelar1     char(20)                                null,
    nama_dosen char(50)                                null,
    gelar2     char(20)                                null,
    rektor     char                                    null,
    id_user    int                                     not null,
    is_active  int(1)      default 1                   not null,
    waktu      timestamp   default current_timestamp() not null on update current_timestamp(),
    constraint no_dosen
        unique (no_dosen)
)
    charset = latin1;


create
or replace table login_dosen
(
    id        int auto_increment
        primary key,
    password  char(42)                              null,
    id_dosen  int                                   not null,
    id_user   int                                   not null,
    token     varchar(200)                          null,
    web_token varchar(100)                          null,
    waktu     timestamp default current_timestamp() not null on update current_timestamp(),
    constraint id_dosen
        unique (id_dosen),
    constraint login_dosen_ibfk_1
        foreign key (id_dosen) references dosen (id)
)
    charset = latin1;


create
or replace index token
    on login_dosen (token);

create
or replace table mhs
(
    id                int auto_increment
        primary key,
    no_mhs            char(10)                                 not null,
    nama              char(50)                                 null,
    almt              char(50)                                 null,
    tmp_lahir         char(30)                                 null,
    tgl_lahir         date                                     null,
    j_kelamin         char                                     null,
    id_user           int                                      not null,
    waktu             timestamp    default current_timestamp() not null on update current_timestamp(),
    id_dosen_wali     int          default 1                   not null,
    no_cama           char(10)     default ''                  null,
    lulus             int          default 0                   null,
    is_do             int          default 0                   not null,
    is_transfered     int          default 0                   not null,
    email_utama       varchar(200) default ''                  null,
    email_universitas varchar(200) default ''                  null,
    nomer_whatsapp    varchar(20)  default ''                  null,
    constraint no_mhs
        unique (no_mhs),
    constraint mhs_ibfk_2
        foreign key (id_dosen_wali) references dosen (id)
)
    charset = latin1;

create
or replace table login_mhs
(
    id        int auto_increment
        primary key,
    password  char(42)                                 null,
    id_mhs    int                                      not null,
    id_user   int                                      not null,
    token     varchar(200) default ''                  not null,
    waktu     timestamp    default current_timestamp() not null on update current_timestamp(),
    web_token varchar(200) default ''                  null,
    constraint id_mhs
        unique (id_mhs),
    constraint login_mhs_ibfk_1
        foreign key (id_mhs) references mhs (id)
)
    charset = latin1;

create
or replace index id_user
    on login_mhs (id_user);

create
or replace index token
    on login_mhs (token);

create
or replace index id_dosen_wali
    on mhs (id_dosen_wali);

create
or replace index id_user
    on mhs (id_user);

create
or replace table pendadaran
(
    id_pendadaran               int auto_increment
        primary key,
    tanggal_pendadaran          date          null,
    jam_pendadaran              varchar(20)   null,
    akdsem                      varchar(5)    null,
    id_mhs                      int           null,
    id_tugas_akhir              int           null,
    id_dosen_pembimbing_1       int           null,
    id_dosen_pembimbing_2       int           null,
    id_dosen_penguji            int           null,
    approve_doping_1_pendadaran int default 0 null,
    approve_doping_2_pendadaran int default 0 null,
    approve_penguji_pendadaran  int default 0 null,
    nilai_doping_1_pendadaran   int default 0 null,
    nilai_doping_2_pendadaran   int default 0 null,
    nilai_penguji_pendadaran    int default 0 null
)
    charset = latin1;

create
or replace table tugas_akhir
(
    id_tugas_akhir               int auto_increment
        primary key,
    link_dokumen                 varchar(255) default ''                  null,
    judul_tugas_akhir            varchar(230)                             null,
    id_mhs                       int                                      null,
    akdsem                       varchar(5)                               null,
    id_dosen_pembimbing_1        int                                      null,
    id_dosen_pembimbing_2        int                                      null,
    approve_doping_1_tugas_akhir int(1)       default 0                   not null,
    approve_doping_2_tugas_akhir int(1)       default 0                   not null,
    create_at                    timestamp    default current_timestamp() not null
)
    charset = latin1;

create
or replace table user_sita
(
    id_user       int(10) auto_increment
        primary key,
    username_user varchar(191) collate utf8mb4_unicode_ci not null,
    password_user varchar(191) collate utf8mb4_unicode_ci not null,
    nama_user     varchar(191) collate utf8mb4_unicode_ci not null,
    email_user    varchar(191) collate utf8mb4_unicode_ci not null,
    created_at    timestamp  default current_timestamp()  not null,
    enabled       tinyint(1) default 1                    not null,
    no_prodi      int        default 0                    null
)
    charset = latin1;

CREATE TABLE `sessions_sita`
(
	`id`         varchar(128) NOT NULL,
	`ip_address` varchar(45)  NOT NULL,
	`timestamp`  int(10) unsigned NOT NULL DEFAULT 0,
	`data`       blob         NOT NULL,
	KEY          `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO dosen (no_dosen, nidn, gelar1, nama_dosen, gelar2, rektor, id_user, is_active)
VALUES ('D001', '1234567890', 'Dr.', 'Ahmad Fauzi', 'M.Sc.', 'Y', 1, 1),
	   ('D002', '1234567891', 'Prof.', 'Budi Santoso', 'Ph.D.', 'N', 2, 1),
	   ('D003', '1234567892', 'Ir.', 'Citra Lestari', 'M.T.', 'N', 3, 1),
	   ('D004', '1234567893', 'Drs.', 'Dedi Kusuma', 'M.Hum.', 'N', 4, 1),
	   ('D005', '1234567894', 'Dr.', 'Eka Wibowo', 'M.Kom.', 'N', 5, 1),
	   ('D006', '1234567895', 'Dr.', 'Farah Nabila', 'M.Si.', 'N', 6, 1),
	   ('D007', '1234567896', 'Prof.', 'Gunawan Prasetyo', 'Ph.D.', 'N', 7, 1),
	   ('D008', '1234567897', 'Ir.', 'Hanafi Setiawan', 'M.T.', 'N', 8, 1),
	   ('D009', '1234567898', 'Drs.', 'Indra Saputra', 'M.Pd.', 'N', 9, 1),
	   ('D010', '1234567899', 'Dr.', 'Joko Riyadi', 'M.M.', 'N', 10, 1);



-- insert into login_dosen(password, id_dosen, id_user, token, web_token)
-- values (password('asdasd'), 1, 1, null, null),
-- 	   (password('asdasd'), 2, 1, null, null),
-- 	   (password('asdasd'), 3, 1, null, null),
-- 	   (password('asdasd'), 4, 1, null, null),
-- 	   (password('asdasd'), 5, 1, null, null),
-- 	   (password('asdasd'), 6, 1, null, null),
-- 	   (password('asdasd'), 7, 1, null, null),
-- 	   (password('asdasd'), 9, 1, null, null),
-- 	   (password('asdasd'), 8, 1, null, null),
-- 	   (password('asdasd'), 10, 1, null, null);

insert into user_sita(username_user, password_user, nama_user, email_user)
values ("inf", '$2a$12$ThWaHWcB463DkW8VVmdN/OHjOQ5NfwCxL4qH/WN1OojmX.Tv7bqhu', 'User IT', 'it@ukrim.ac.id');

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

INSERT INTO mhs (no_mhs, nama, almt, tmp_lahir, tgl_lahir, j_kelamin, id_user, id_dosen_wali, no_cama, lulus, is_do, is_transfered, email_utama, email_universitas, nomer_whatsapp)
VALUES
	('2342100001', 'Andi Pratama', 'Jl. Merpati No. 10, Jakarta', 'Jakarta', '2002-01-10', 'L', 1, 1, '', 0, 0, 0, 'andi.pratama@gmail.com', 'andi.pratama@univ.ac.id', '0812100001'),
	('2342100002', 'Siti Nurhaliza', 'Jl. Kenanga No. 12, Bandung', 'Bandung', '2002-02-12', 'P', 2, 1, '', 0, 0, 0, 'siti.nurhaliza@gmail.com', 'siti.nurhaliza@univ.ac.id', '0812100002'),
	('2342100003', 'Budi Santoso', 'Jl. Melati No. 5, Surabaya', 'Surabaya', '2002-03-15', 'L', 3, 1, '', 0, 0, 0, 'budi.santoso@gmail.com', 'budi.santoso@univ.ac.id', '0812100003'),
	('2342100004', 'Dewi Anggraini', 'Jl. Mawar No. 8, Medan', 'Medan', '2002-04-20', 'P', 4, 1, '', 0, 0, 0, 'dewi.anggraini@gmail.com', 'dewi.anggraini@univ.ac.id', '0812100004'),
	('2342100005', 'Agus Setiawan', 'Jl. Cempaka No. 3, Yogyakarta', 'Yogyakarta', '2002-05-25', 'L', 5, 1, '', 0, 0, 0, 'agus.setiawan@gmail.com', 'agus.setiawan@univ.ac.id', '0812100005'),
	('2342100006', 'Rina Marlina', 'Jl. Dahlia No. 15, Semarang', 'Semarang', '2002-06-18', 'P', 6, 1, '', 0, 0, 0, 'rina.marlina@gmail.com', 'rina.marlina@univ.ac.id', '0812100006'),
	('2342100007', 'Hendra Wijaya', 'Jl. Teratai No. 21, Palembang', 'Palembang', '2002-07-11', 'L', 7, 1, '', 0, 0, 0, 'hendra.wijaya@gmail.com', 'hendra.wijaya@univ.ac.id', '0812100007'),
	('2342100008', 'Fitri Handayani', 'Jl. Flamboyan No. 30, Makassar', 'Makassar', '2002-08-14', 'P', 8, 1, '', 0, 0, 0, 'fitri.handayani@gmail.com', 'fitri.handayani@univ.ac.id', '0812100008'),
	('2342100009', 'Rizky Ramadhan', 'Jl. Anggrek No. 9, Malang', 'Malang', '2002-09-09', 'L', 9, 1, '', 0, 0, 0, 'rizky.ramadhan@gmail.com', 'rizky.ramadhan@univ.ac.id', '0812100009'),
	('2342100010', 'Putri Ayu Lestari', 'Jl. Kemuning No. 2, Denpasar', 'Denpasar', '2002-10-05', 'P', 10, 1, '', 0, 0, 0, 'putri.ayu@gmail.com', 'putri.ayu@univ.ac.id', '0812100010'),
	('2342100011', 'Fajar Nugroho', 'Jl. Merak No. 11, Bogor', 'Bogor', '2002-11-21', 'L', 11, 1, '', 0, 0, 0, 'fajar.nugroho@gmail.com', 'fajar.nugroho@univ.ac.id', '0812100011'),
	('2342100012', 'Lina Kartika', 'Jl. Cemara No. 17, Solo', 'Solo', '2002-12-12', 'P', 12, 1, '', 0, 0, 0, 'lina.kartika@gmail.com', 'lina.kartika@univ.ac.id', '0812100012'),
	('2342100013', 'Yudi Saputra', 'Jl. Mangga No. 22, Balikpapan', 'Balikpapan', '2003-01-13', 'L', 13, 1, '', 0, 0, 0, 'yudi.saputra@gmail.com', 'yudi.saputra@univ.ac.id', '0812100013'),
	('2342100014', 'Mega Wulandari', 'Jl. Durian No. 6, Pontianak', 'Pontianak', '2003-02-14', 'P', 14, 1, '', 0, 0, 0, 'mega.wulandari@gmail.com', 'mega.wulandari@univ.ac.id', '0812100014'),
	('2342100015', 'Doni Kurniawan', 'Jl. Jati No. 7, Pekanbaru', 'Pekanbaru', '2003-03-15', 'L', 15, 1, '', 0, 0, 0, 'doni.kurniawan@gmail.com', 'doni.kurniawan@univ.ac.id', '0812100015'),
	('2342100016', 'Rosa Amelia', 'Jl. Pinus No. 14, Manado', 'Manado', '2003-04-16', 'P', 16, 1, '', 0, 0, 0, 'rosa.amelia@gmail.com', 'rosa.amelia@univ.ac.id', '0812100016'),
	('2342100017', 'Imam Syafii', 'Jl. Kamboja No. 18, Banjarmasin', 'Banjarmasin', '2003-05-17', 'L', 17, 1, '', 0, 0, 0, 'imam.syafii@gmail.com', 'imam.syafii@univ.ac.id', '0812100017'),
	('2342100018', 'Nurul Hidayah', 'Jl. Kenari No. 20, Padang', 'Padang', '2003-06-18', 'P', 18, 1, '', 0, 0, 0, 'nurul.hidayah@gmail.com', 'nurul.hidayah@univ.ac.id', '0812100018'),
	('2342100019', 'Arief Budiman', 'Jl. Sawo No. 25, Maluku', 'Ambon', '2003-07-19', 'L', 19, 1, '', 0, 0, 0, 'arief.budiman@gmail.com', 'arief.budiman@univ.ac.id', '0812100019'),
	('2342100020', 'Clara Anindya', 'Jl. Nangka No. 4, Jayapura', 'Jayapura', '2003-08-20', 'P', 20, 1, '', 0, 0, 0, 'clara.anindya@gmail.com', 'clara.anindya@univ.ac.id', '0812100020');

