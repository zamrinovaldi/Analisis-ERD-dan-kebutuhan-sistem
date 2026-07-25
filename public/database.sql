SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `kamars`;
CREATE TABLE `kamars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomor_kamar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_kamar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kamars_nomor_kamar_unique` (`nomor_kamar`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `kamars` (`id`, `nomor_kamar`, `tipe_kamar`, `harga`, `status`, `created_at`, `updated_at`) VALUES ('12', '202', 'Deluxe', '800000', 'Tersedia', '2026-07-24 10:56:37', '2026-07-24 10:56:37');
INSERT INTO `kamars` (`id`, `nomor_kamar`, `tipe_kamar`, `harga`, `status`, `created_at`, `updated_at`) VALUES ('15', '205', 'Deluxe', '800000', 'Tersedia', '2026-07-24 10:56:37', '2026-07-24 10:56:37');
INSERT INTO `kamars` (`id`, `nomor_kamar`, `tipe_kamar`, `harga`, `status`, `created_at`, `updated_at`) VALUES ('16', '206', 'Deluxe', '800000', 'Tersedia', '2026-07-24 10:56:37', '2026-07-24 10:56:37');
INSERT INTO `kamars` (`id`, `nomor_kamar`, `tipe_kamar`, `harga`, `status`, `created_at`, `updated_at`) VALUES ('17', '207', 'Deluxe', '800000', 'Tersedia', '2026-07-24 10:56:37', '2026-07-24 10:56:37');
INSERT INTO `kamars` (`id`, `nomor_kamar`, `tipe_kamar`, `harga`, `status`, `created_at`, `updated_at`) VALUES ('18', '208', 'Deluxe', '800000', 'Tersedia', '2026-07-24 10:56:37', '2026-07-24 10:56:37');
INSERT INTO `kamars` (`id`, `nomor_kamar`, `tipe_kamar`, `harga`, `status`, `created_at`, `updated_at`) VALUES ('19', '209', 'Deluxe', '800000', 'Tersedia', '2026-07-24 10:56:37', '2026-07-24 10:56:37');
INSERT INTO `kamars` (`id`, `nomor_kamar`, `tipe_kamar`, `harga`, `status`, `created_at`, `updated_at`) VALUES ('20', '210', 'Deluxe', '800000', 'Tersedia', '2026-07-24 10:56:37', '2026-07-24 10:56:37');
INSERT INTO `kamars` (`id`, `nomor_kamar`, `tipe_kamar`, `harga`, `status`, `created_at`, `updated_at`) VALUES ('21', '301', 'Suite', '1500000', 'Pemeliharaan', '2026-07-24 10:56:37', '2026-07-24 10:56:37');
INSERT INTO `kamars` (`id`, `nomor_kamar`, `tipe_kamar`, `harga`, `status`, `created_at`, `updated_at`) VALUES ('22', '302', 'Suite', '1500000', 'Tersedia', '2026-07-24 10:56:37', '2026-07-24 10:56:37');
INSERT INTO `kamars` (`id`, `nomor_kamar`, `tipe_kamar`, `harga`, `status`, `created_at`, `updated_at`) VALUES ('23', '303', 'Standard', '600000', 'Tersedia', '2026-07-24 10:56:37', '2026-07-25 05:50:22');
INSERT INTO `kamars` (`id`, `nomor_kamar`, `tipe_kamar`, `harga`, `status`, `created_at`, `updated_at`) VALUES ('24', '304', 'Suite', '1500000', 'Tersedia', '2026-07-24 10:56:37', '2026-07-24 10:56:37');
INSERT INTO `kamars` (`id`, `nomor_kamar`, `tipe_kamar`, `harga`, `status`, `created_at`, `updated_at`) VALUES ('25', '305', 'Suite', '1500000', 'Tersedia', '2026-07-24 10:56:37', '2026-07-24 10:56:37');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('1', '0001_01_01_000000_create_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('2', '0001_01_01_000001_create_cache_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('3', '0001_01_01_000002_create_jobs_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('4', '2026_07_23_000001_create_kamars_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('5', '2026_07_23_000002_create_penyewas_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('6', '2026_07_23_000003_create_pembayarans_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('7', '2026_07_23_000004_add_role_to_users_table', '1');

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `pembayarans`;
CREATE TABLE `pembayarans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_bayar` date NOT NULL,
  `jumlah` int NOT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penyewas_id` bigint unsigned NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pembayarans_penyewas_id_foreign` (`penyewas_id`),
  CONSTRAINT `pembayarans_penyewas_id_foreign` FOREIGN KEY (`penyewas_id`) REFERENCES `penyewas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `penyewas`;
CREATE TABLE `penyewas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kamars_id` bigint unsigned NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penyewas_kamars_id_foreign` (`kamars_id`),
  CONSTRAINT `penyewas_kamars_id_foreign` FOREIGN KEY (`kamars_id`) REFERENCES `kamars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('8TJgxoZLVRLjYOZt1KxfNRx5KZrd1YHWRnqxkNvS', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJVQjRZWFpoUjJRY1didGxTQjYyMTQxWnd3bUNFdlAwNFZWUzlGbUVPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2FuYWxpc2lzLWVyZC1kYW4ta2VidXR1aGFuLXNpc3RlbS50ZXN0XC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJ1cmwiOltdLCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=', '1784954458');
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('eyY0hc7xnLuOvKCd9JMdFLpbU3n73SZIAwvtLqn7', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJxUW1STks1WGFoaU1ncWRWN3FCYUxkT2p5UldTTkF2Y2dGakl5TmFnIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvYW5hbGlzaXMtZXJkLWRhbi1rZWJ1dHVoYW4tc2lzdGVtLnRlc3RcL2Rhc2hib2FyZCIsInJvdXRlIjpudWxsfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9', '1784966052');
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('jAUwyJK67y7PDmTeIC6xgfVkdeeU7U9fkwKpVamZ', '1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJxOWFGZ1RrcGpUcGl6TDdQY2FDY0Yxa2RIOXVlT0d6VThUaGVpTWZ5IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvYW5hbGlzaXMtZXJkLWRhbi1rZWJ1dHVoYW4tc2lzdGVtLnRlc3RcL2thbWFyXC9jcmVhdGUiLCJyb3V0ZSI6ImthbWFyLmNyZWF0ZSJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=', '1784958127');
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('YaNgBvEZ3yUpMUnECBYyODuLZ0GtiVNiPSPoyyg4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJObDRSTEZNSkdPNTdTcVpVSVhKeVpzdHJORlV4THRhZTJJd0ZrSVVHIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvYW5hbGlzaXMtZXJkLWRhbi1rZWJ1dHVoYW4tc2lzdGVtLnRlc3RcL2thbWFyXC9jcmVhdGUifSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2FuYWxpc2lzLWVyZC1kYW4ta2VidXR1aGFuLXNpc3RlbS50ZXN0XC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', '1784966452');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES ('1', 'Admin Hotel', 'admin@admin.com', NULL, '$2y$12$kHJuBcvKCbe1XWvR9KxzEuUlz57d7Uk3GQaEgQ88pvHTROHO1jzNy', 'admin', NULL, '2026-07-24 10:56:36', '2026-07-24 10:56:36');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES ('2', 'Owner Hotel', 'owner@admin.com', NULL, '$2y$12$DDJZPMomCJ8TkphcYlLRYupo/Jj3mwvwDsp8GeZ1LEFSYVZW61eKm', 'owner', NULL, '2026-07-24 10:56:37', '2026-07-24 10:56:37');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES ('3', 'Staff Hotel', 'staff@admin.com', NULL, '$2y$12$096KDZ0KNzHw0HiL/tSzpOUyGL5Rzgp4x0r8hrqZrutWkzmz1VuAW', 'staff', NULL, '2026-07-24 10:56:37', '2026-07-24 10:56:37');

SET FOREIGN_KEY_CHECKS=1;
