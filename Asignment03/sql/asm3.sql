-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th12 19, 2023 lúc 12:08 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `asm3`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` float NOT NULL,
  `img` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `img`, `productName`, `price`, `category`) VALUES
(10, 'https://lh3.googleusercontent.com/C8UYufgNQnwjx3oakljYh4Cg0K7nye0IuyBUezwchSVSA83nt-hSUHlNoKIyvyfDh6ySOHttvRiNc-sP5-PYRebtFFNXSzssEg=w230-rw', 'Laptop Asus TUF Gaming F15 FX506HF-HN014W', '96.990.000', 'laptop'),
(11, 'https://lh3.googleusercontent.com/NRyX_H1vK9Wfwq9i1oC0-tlMvnLgqQHYM__-6yQfzi3y1qJLKyEFgmw0PpLqTZKSKEhx9DITxEVBWEyyEKknLTlwCg2bFcT_yw=w230-rw', 'Laptop ASUS TUF Gaming A15 FA507NV-LP046W', '27.190.000 ', 'Laptop'),
(12, 'https://lh3.googleusercontent.com/ZwW9mbi4ugbzLW2EGMMl5i4pSbaUsYmSlvChjzW7yeIdZlOB1ZScSIOktUBCgoYPzWUxWM5ijAlomkSyuxHrpWao7H8sk45v=w230-rw', 'Laptop Asus Zenbook 14 Flip OLED UP3404VA-KN038W', '96.690.000', 'laptop'),
(13, 'https://lh3.googleusercontent.com/bg_JNgenuJcSoAu0giW2scnNJtYKq5SD20eZ7_LIiebDzqUJi4sDi_LVWbUdiJVTw9gOh5tyEJ4CylWhvYiBbuc2faQ-af8=w230-rw', 'Laptop ASUS Gaming TUF FX507VV4-LP382W ', '35.790.000', 'Laptop'),
(15, 'https://lh3.googleusercontent.com/SSw3Ad8N232-nANCqPvpG_9EEgkOsdPpFTKeq4NVg2tE4ELRxb5U0Yt7KRmSC8k1HIkQluK3tqBGY5cyvIAkkhRTjQba0F3YrA=w230-rw', 'Laptop Asus ZenBook 14 OLED UX3402VA-KM203W (i5-1340P)', '23.990.000', 'Laptop'),
(16, 'https://lh3.googleusercontent.com/tBWiiGmwXJoDRRy0UPIAExAhm6C7gcmFiJH2nHCTa_xE2dP7kpO7f8WutWDCNdSjNhL_cS6m_DRyYaW6hqJddGspKKGtGpE=w230-rw', 'Laptop ASUS Vivobook Pro', '45.690.000', 'Laptop'),
(17, 'https://lh3.googleusercontent.com/k4t2vTnZyV5QFmUqFANELQdHHoF29ax5RW5hxu6JrMwal5AtA5LFyGp-UQRadNu-Qwl4nXWGqbGcaI8Fkb8h96LUHDtjKiUj=w500-rw', 'Laptop ASUS ROG Strix SCAR 18 G834JY-N6039W', '119.290.000', 'Laptop');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`name`, `phone`, `email`, `password`, `role`) VALUES
('Admin Vuong', '1', 'admin@ut.edu.vn', '1', 'admin'),
('Admin Khang', '12222', 'Khang@ut.edu.vn', '1', 'admin'),
('Vuong', '1', 'user@ut.edu.vn', '1', 'user'),
('Mai V. Xuan Vuong', '0346524965', 'xuannvuongg@gmail.com', '1', 'user');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` float NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
