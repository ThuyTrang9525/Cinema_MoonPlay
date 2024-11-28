-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 05:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moonplaycinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `commented_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `moviecategories`
--

CREATE TABLE `moviecategories` (
  `movie_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `release_year` year(4) DEFAULT NULL,
  `poster_url` varchar(255) DEFAULT NULL,
  `thumb_url` varchar(255) DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `actor` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `description`, `release_year`, `poster_url`, `thumb_url`, `duration`, `type`, `actor`) VALUES
(1, 'Vẫn Mãi Là Em', 'Bản remake từ She Was Pretty - bộ phim Hàn Quốc đình đám, dựa trên một câu chuyện có thật về mối quan hệ của một cặp đôi từ bạn thành yêu. Ploypailin là một cô gái xinh đẹp xuất thân từ một gia đình giàu có. Sau khi công ty xuất bản của gia đình cô bị phá sản, cô đã trải qua những khó khăn và mất đi vẻ đẹp của mình. Kawin là một cậu bé xấu xí lại tự ti, nhưng lớn lên trở thành một biên tập viên đẹp trai và thành đạt. Hai người bạn thưở nhỏ quyết định gặp lại nhau khi trưởng thành. Vì xấu hổ về vẻ ngoài và sợ làm hỏng ký ức tốt đẹp của Kawin về mình, Ploypailin đã yêu cầu người bạn thân xinh đẹp giả làm cô để gặp Kawin. Tuy nhiên, mọi thứ nhanh chóng trở nên phức tạp khi Ploypailin được chỉ định làm việc tại tạp chí nơi Kawin là phó tổng biên tập. Anh công khai ngược đãi và coi thường cô vì bản tính vụng về của cô, mà không biết rằng cô chính là người bạn thời thơ ấu của anh.', '2021', 'https://phimimg.com/upload/vod/20241105-1/ff9b778b3f26b2b82af290a6b306c40f.jpg', 'https://player.phimapi.com/player/?url=https://s5.phim1280.tv/20241105/a3Y1CogJ/index.m3u8', 86, 'Phim tình cảm', 'Pae Arak,Fang Dhanundhorn,Malinee Adelaide,Nat Kitcharit,Up Poompat'),
(2, 'Truyền Thuyết Nàng Nak', 'Số phận thử thách tình yêu của một cặp đôi khi chiến tranh chia cắt họ. Nhưng nỗ lực của họ để được ở bên nhau một lần nữa giúp xóa nhòa ranh giới giữa người sống và người chết.', '2024', 'https://phimimg.com/upload/vod/20241101-1/1136354cdbbf84932f05dfe657897781.jpg', 'https://player.phimapi.com/player/?url=https://s5.phim1280.tv/20241101/Yvqq80gv/index.m3u8', 46, 'Phim tình cảm', 'Thuchapon Koowongbundit, Preeyakarn Jaikanta, Chanatip Phothongka, Gap Chanoksuda Raksanaves, Mil Sarut, Nawapraditkul, Namnung Suttidachanai, Care Wongwachira Petchkeaw, Gap Jakkarin Phooriphad, Jack Chakapan Chan-O, อริศรา วงษ์ชาลี'),
(3, 'Nhìn Thấy Tình Yêu', 'Bộ phim kể về câu chuyện về đời thứ ba của gia đình giàu có, trốn tránh thừa kế công việc kinh doanh của gia đình, vô tình phải lòng một người chăm sóc người khiếm thính.', '2024', 'https://phimimg.com/upload/vod/20241031-1/17d28211ff9cfb483570b17a7ab00570.jpg', 'https://player.phimapi.com/player/?url=https://s5.phim1280.tv/20241031/8tP5zkVn/index.m3u8', 25, 'Phim tình cảm', '金雲, Lin Yu, 林家佑, 林詠傑, 艾雨帆, 李悠, 陳柏文'),
(4, 'Quý Cô Seon Ju Phục Thù', 'Một người phụ nữ mạnh mẽ phá bỏ cuộc hôn nhân đầy bất hạnh của mình và xây dựng một \"ngôi nhà mới\" để bắt đầu lại từ đầu.', '2024', 'https://phimimg.com/upload/vod/20241120-1/05e935ee1659e79b7c50e9c8346aa2b1.jpg', 'https://player.phimapi.com/player/?url=https://s4.phim1280.tv/20241120/gvhB7Dcq/index.m3u8', 29, 'Phim tình cảm', 'Sim Yi Young, Song Chang Eui, Choi Jung Yoon, Joung Young Sub'),
(5, 'Men Say Tình Yêu', 'Chae Yong Joo, một cựu đặc nhiệm đầy nhiệt huyết, hiện là \"vua bán hàng\" của một công ty rượu. Cuộc sống của cô đảo lộn khi chi nhánh đứng trước nguy cơ đóng cửa. Nhiệm vụ của cô là bán loại bia đặc biệt của bậc thầy Yoon Min Joo, một người đàn ông sống ẩn dật. Sự xuất hiện của Yong Joo đã làm xáo trộn cuộc sống yên bình của anh.', '2024', 'https://phimimg.com/upload/vod/20241104-1/26e9a849cc1c17ead82dadbbca3d62a5.jpg', 'https://player.phimapi.com/player/?url=https://s4.phim1280.tv/20241104/vxFw722R/index.m3u8', 62, 'Phim tình cảm', 'Kim Se Jeong, Lee Jong Won, Shin Do Hyun, Baek Sung Chul, Baek Hyun Joo, Park Jee A.'),
(6, 'Tom Và Jerry Bay Đến Sao Hỏa', 'Tom và Jerry: Bay Đến Sao Hỏa là một trong loạt phim hoạt hình hài hước dành cho thiếu nhi. Phim xoay quanh hai nhân vật chính Tom (mèo) và Jerry (chuột). Vẫn là màn đuổi bắt quen thuộc giữa Tom và Jerry.', '2011', 'https://phimimg.com/upload/vod/20240228-1/462ceddf21438ee86d86f096eed0bd25.jpg', 'https://player.phimapi.com/player/?url=https://s2.phim1280.tv/20240310/LMsXdt75/index.m3u8', 75, 'Phim hoạt hình', 'Jeff Bennett, Corey Burton, Kathryn Fiore.'),
(7, 'Thám Tử Lừng Danh Conan', 'Phim hoạt hình Conan bắt đầu sau vụ việc xảy ra tại công viên giải trí nổi tiếng Tropical Land tại khu tàu lượn siêu tốc. Kudo đang điều tra một trong hai người đàn ông có vẻ ngoài khả nghi được cho là nghi phạm trong vụ việc. Anh ta bị tấn công bởi một trong số họ có mật danh là Gin và đồng đội của anh ta tên là Vodka. Sau khi đánh Shinichi, Gin đã đưa cho anh ta một loại thuốc mà sau này được gọi là APTX 4869 để giết anh ta. Trên thực tế, chất độc có một tác dụng phụ hiếm gặp, biến Shinichi từ một cơ thể trưởng thành thành một đứa trẻ thay vì giết chết. Sau sự cố quan trọng, Shinichi về nhà và lấy tên là Conan Edogawa sau khi bị người bạn thời thơ ấu Ran gây áp lực. Shinichi đã cố gắng che giấu danh tính bí mật của mình với những người anh quan tâm để điều tra về tổ chức Áo Đen.', '1996', 'https://phimimg.com/upload/vod/20240310-1/025424cf62248b9a7b54279ef5416e26.jpg', 'https://player.phimapi.com/player/?url=https://s3.phim1280.tv/20240318/p2oB0Tj7/index.m3u8', 25, 'Phim hoạt hình', 'Minami Takayama, Kappei Yamaguchi, Wakana Yamazaki, Akira Kamiya, Rikiya Koyama, Megumi Hayashibara, Kenichi Ogata, Yukiko Iwai, Wataru Takagi, Ikue Otani, Chafurin.'),
(8, 'Nhật Ký Hải Trình: One Piece Truyền Kỳ Đảo Người Cá', 'Phiên bản đặc biệt đã chỉnh sửa - One Piece: Fish-Man Island Saga là phiên bản chỉnh sửa và cô đọng của bản chuyển thể anime One Piece của Fish-Man Island Saga. Hiện tại, phim đang được phát sóng trong thời gian nghỉ năm tháng của anime gốc từ ngày 3 tháng 11 năm 2024, đến ngày 6 tháng 4 năm 2025, trước khi bộ phim chuyển sang khung giờ mới. Số tập phim sẽ được cô đọng từ 57 xuống còn 21.', '2024', 'https://phimimg.com/upload/vod/20241114-1/b145f04a857ff4f425308b1592da0cf0.jpg', 'https://player.phimapi.com/player/?url=https://s4.phim1280.tv/20241114/7iGKgSsN/index.m3u8', 25, 'Phim hoạt hình', 'Đang cập nhật'),
(9, 'Kiếm Lai', 'Thế giới rộng lớn không thiếu cái lạ. Trần Bình An ta chỉ với một kiếm, có thể dời núi, lấp biển, hàng yêu, trấn ma, phong thần, chém sông, phá thành, mở trời mở đất.', '2024', 'https://phimimg.com/upload/vod/20240822-1/188efb9fc58aca32ef3d96d6209fba6d.jpg', 'https://player.phimapi.com/player/?url=https://s3.phim1280.tv/20240823/Y2uPpyjJ/index.m3u8', 25, 'Phim hoạt hình', 'Zhangtaikang Chen, Hao Chen, Yun Weiyi, 徐宇隆, 賀文瀟, 刘校妤, Zhenhe Ling, 白雪岑'),
(10, 'Một rổ khẩu nghiệp', 'Tay huấn luyện viên bóng rổ thô lỗ ở trường trung học tin chắc gã sẽ vươn đến các giải đấu lớn, miễn là xoay chuyển được đội bóng dở tệ của mình. Chúc gã may mắn!', '2020', 'https://phimimg.com/upload/vod/20241113-1/8aea15a945bd6c5018ac2a42c6be0a6c.jpg', 'https://player.phimapi.com/player/?url=https://s5.phim1280.tv/20241113/aSXVLQ3d/index.m3u8', 30, 'Phim hoạt hình', 'Jake Johnson, Rob Riggle, Natasha Leggero, Cleo King, Ron Funches, A.D. Miles, Gil Ozeri, Sam Richardson, Steve Berg, Ben Hoffman, Mary Holland'),
(11, 'Hank Và Bạn Xe Tải Chở Rác (Phần 2)', 'Trí tưởng tượng đưa Hank, Xe Rác, hội bạn động vật Walter, Donny và cô Mona vào những cuộc phiêu lưu ấm lòng ở sân sau và xa hơn nữa!', '2021', 'https://phimimg.com/upload/vod/20241114-1/3276f2ac9235cd82b50ccee2e44354c3.jpg', 'https://player.phimapi.com/player/?url=https://s4.phim1280.tv/20241114/uVj8b70S/index.m3u8', 17, 'Phim kinh dị', 'Henry Keane, Glen Keane, Lucas Neff, Brian Baumgartner, Jackie Loeb, Olive Keane'),
(12, 'Mắt Của Quỷ', 'Đau đớn khi đứa con gái duy nhất mà Ngọc hết mực yêu thương mất do một tai nạn bất thường khi mới 10 tuổi. Ngọc cầu cứu pháp sư để được gặp đứa con gái vừa chết của mình. Cô chấp nhận trả bằng mọi giá, kể cả bằng máu và một phần cơ thể của mình cho đến khi cô phát hiện ra một sự thật kinh hoàng.', '2020', 'https://phimimg.com/upload/vod/20241104-1/70aaee9be46d786a01300e9aef693fd1.jpg', 'https://player.phimapi.com/player/?url=https://s5.phim1280.tv/20241103/v8hfe9bU/index.m3u8', 32, 'Phim kinh dị', 'Diệp Bảo Ngọc, La Thành, Hữu Vi'),
(13, 'Linh Hồn Đổi Xác (Phần 1)', 'Sau 250 năm bị đóng băng, một tù nhân trở lại cuộc sống trong cơ thể mới với một cơ hội để giành lấy tự do của mình, đó là giải quyết một vụ giết người phức tạp.', '2018', 'https://phimimg.com/upload/vod/20241120-1/2d8b5c4c6ce7509ac3fe7b51450505a2.jpg', 'https://player.phimapi.com/player/?url=https://s4.phim1280.tv/20241120/TVGv8cK9/index.m3u8', 59, 'Phim kinh dị', 'Anthony Mackie, Lela Loren, Simone Missick, Chris Conner, Dina Shihabi, Torben Liebrecht, Renée Elise Goldsberry, Joel Kinnaman, James Purefoy, Martha Higareda, Dichen Lachman, Will Yun Lee, Kristin Lehman, Ato Essandoh, Tamara Taylor, Byron Mann'),
(14, 'Ngôi Đền Kỳ Quái 3', 'Peace Aod, một người thợ bốc mộ trẻ tuổi ở Đền Thamma Nakanimitr, đã khai quật được một chiếc vòng chân cổ bằng vàng từ một ngôi mộ từ thời Thế chiến thứ hai. Anh ta quyết định bỏ túi chiếc vòng chân và rơi vào con mồi của một lời nguyền biến da của anh ta thành vảy rắn.', '2022', 'https://phimimg.com/upload/vod/20240828-1/032a3d66dc62c1353f1c69c35d2da546.jpg', 'https://player.phimapi.com/player/?url=https://s3.phim1280.tv/20240828/oBILb0TC/index.m3u8', 114, 'Phim kinh dị', 'Witthawat Rattanaboonbaramee, Phiravich Attachitsataporn, Bhuripat Vejvongsatechavat, Khunnapat Pichetworawut, Chanagtien Potongkam, Atirootj Saengtien, Kyutae Sim, Atiwat Saengtien, Thitipan Raksasat, Kanthapat Kitichaivaranggoon'),
(15, 'Tà Chú Cấm', 'Kể về cặp vợ chồng Ning, Kwin và cô con gái 7 tuổi với tên gọi Ing. Vì khó khăn về tài chính, hai vợ chồng quyết định cho thuê ngôi nhà đang ở và chuyển đến một căn hộ chung cư giá rẻ để sinh sống. Sau khi những người thuê nhà chuyển đến, Ning nhận thấy chồng bắt đầu có những hành vi bất thường. Anh ta trở nên bí mật và thường biến mất khỏi căn hộ và lúc 4 giờ sáng. Kwin thậm chí còn có một hình xăm kỳ lạ ở ngực tựa như ký hiệu đặc biệt của một hội tà giáo bí ẩn. Khi hành vi của chồng ngày càng trở nên đáng lo ngại, cũng là lúc Ning nhận ra cô con gái của mình đang gặp hiểm nguy. Bí mật nào đang được che giấu trong ngôi nhà cho thuê của họ?', '2023', 'https://phimimg.com/upload/vod/20230920-1/7af5eee1d213d731ac8e01dacad7ac05.jpg', 'https://player.phimapi.com/player/?url=https://s3.phim1280.tv/20240730/dgoOKgFj/index.m3u8', 124, 'Phim kinh dị', 'Nittha Jirayungyurn, Sukollawat Kanarot, Penpak Sirikul, Thanyaphat Mayuraleela, Namfon Pakdee, Suphithak Chatsuriyawong, Natniphaporm Ingamornrat, Pawarisa Surathin, Narupornkamol Chaisang, Piranpatch Teawsakul'),
(16, 'Ma Vui Vẻ 3', 'Nội dung của phim Ma Vui Vẻ 3 xoay quanh một ca sĩ trẻ, người không thành công trong sự nghiệp và cuộc sống, sự bế tắc đã đưa cô ấy tới quyết định tự tử và sau khi chết đó, cô sẽ được đầu thai, lần này là vào một gia đình chuyên về âm nhạc. Linh hồn của cô ấy phải đến bệnh viện, nơi người mẹ tương lai của cô ấy hiện đã sẵn sàng để sinh ra cô ấy, để cô ấy có thể bước vào bụng mẹ và được sinh ra. Thật không may, cô bỏ lỡ thời gian sinh của cô vốn đã được chỉ định, lý do là sự can thiệp vô tình của một thanh niên tên là Hong. Lúc đầu, cô tức giận và làm cho cuộc sống của anh ta trở nên khó khăn, nhưng cuối cùng thì họ lại phải lòng nhau, mặc dù cô không thể ở lại lâu nhưng cô lại có một cơ hội cuối cùng để được tái sinh một lần nữa.', '1986', 'https://phimimg.com/upload/vod/20231008-1/6de5b90a1de8f3297bb9a04b43ca402b.jpg', 'https://player.phimapi.com/player/?url=https://s1.phim1280.tv/20231001/BgB8l8Rx/index.m3u8', 89, 'Phim hài', 'Raymond Wong, Maggie Cheung, Charine Chan, Danny Poon, Ho Pak-Kwong, Walter Tso Tat-Wah, Wong Siu-Ming, Ngai Tim-Choi, Kobe Wong Kam-Bo, Aai Dung-Gwa'),
(17, 'Cô Bạn Gia Sư', 'Trong phim Cô Bạn Gia Sư, Choi Soo-wan và Kim Ji-hoon tuy cùng tuổi nhưng học lực lại có cách biệt lớn. Trong phim online này, Soo-wan đã là sinh viên đại học năm thứ hai, nhưng Ji-hoon vẫn còn đang là học sinh cấp ba vì bị lưu ban tới hai lần. Hoàn cảnh gia đình của cả hai cũng khác nhau một trời một vực. Soo-wan thì bị gán cho biệt danh gà quê. Trong khi đó, Ji-hoon là một công tử nhà giàu đẹp trai. Soo-wan vì phải kiếm thêm tiền đóng học phí mà phải đi làm gia sư dạy thêm cho Ji-hoon, và những rắc rối nảy sinh từ đây. Xem phim Cô Bạn Gia Sư bạn sẽ rất hài lòng với chất lượng dịch vụ xem phim online.', '2003', 'https://phimimg.com/upload/vod/20231208-1/e5017637dca84a96e601cee20a325412.jpg', 'https://player.phimapi.com/player/?url=https://s4.phim1280.tv/20240921/uqxnCstn/index.m3u8', 113, 'Phim hài', 'HaNeul Kim, Sang-Woo Kwon, Il-seob Baek'),
(18, 'Em Chưa 18', 'Câu chuyện bắt đầu với Hoàng, một Tay chơi “chất lầy” bảnh tỏn, thu nhập ngất ngưởng, sống cùng quy luật \"không có đêm thứ 2\" với bất kỳ cô nàng nào. Định mệnh ập đến khi chàng trai trong mơ của bao người đàn ông gặp gỡ Linh Đan. Dĩ nhiên, cả hai đã có mối tình chớp nhoáng và không hề có gì khác biệt với những cô gái trước đây, cho đến khi Hoàng phát hiện ra bạn gái mới của mình chưa đủ 18 tuổi. Từ đây, cả thế giới đào hoa của chàng \"lầy gái\" số một bất ngờ thu nhỏ lại trong lưới tình của cô học trò xinh đẹp tinh quái.', '2017', 'https://phimimg.com/upload/vod/20231011-1/03464a38b2865d866cfef15d1b617e3d.jpg', 'https://player.phimapi.com/player/?url=https://s4.phim1280.tv/20240917/5ShlIBXa/index.m3u8', 58, 'Phim hài', 'Kaity Nguyễn, Kiều Minh Tuấn, Will, Nguyễn Tiến Dũng, Châu Bùi, Kiều Trinh, Alexandra Nguyễn, Võ Ngọc Trai, Don Nguyễn, Chí Tâm'),
(19, '4 Sát Thủ', 'Bốn sát thủ về hưu bắt đầu hành động trở lại khi họ tình cờ gặp một cảnh sát ngay thẳng quyết tìm ra một tên sát nhân khó bắt.', '2022', 'https://phimimg.com/upload/vod/20230923-1/203a17dd2fd2bcada93c9929d659fa68.jpg', 'https://player.phimapi.com/player/?url=https://s3.phim1280.tv/20240730/nX50ivB5/index.m3u8', 141, 'Phim hài', 'Abimana Aryasatya, Putri Marino, Lutesha, Arie Kriting, Kristo Immanuel, Marthino Lio, Michelle Tahalea, Michael Kho, Donny Damara, Budi Ros'),
(20, 'Chàng Vợ Của Em', 'Từ trước tới nay, người Việt vốn quen với hình ảnh người phụ nữ lúi húi trong bếp, phục vụ cơm nước cho chồng con, còn người đàn ông thì ra ngoài xã hội làm việc, kiếm tiền. Song, mọi chuyện hoàn toàn khác đối với Mai (Phương Anh Đào). Xinh đẹp, mạnh mẽ, giàu có, nhưng đổi lại, cô gái luôn bận rộn trăm công nghìn việc tại công ty, hàng ngày phải đối đầu với “đám đàn ông ở công ty”. Mai bận đến nỗi không có thời gian chăm sóc chó cưng, nhà cửa thì bừa bộn, và bản thân không còn khái niệm “bữa cơm gia đình”. Người phụ nữ hiện đại, sành điệu ấy chẳng cần bất cứ đấng mày râu nào chu cấp kinh tế, nhưng lại khao khát một “chàng vợ” có thể thay mình tề gia nội trợ, làm hậu phương vững chắc cho cô thỏa chí tung hoành.', '2018', 'https://phimimg.com/upload/vod/20231011-1/792324a2f1cd6cd5b246e0db7cbb9add.jpg', 'https://player.phimapi.com/player/?url=https://s3.phim1280.tv/20240412/eVt0YLbr/index.m3u8', 90, 'Phim hài', 'Phương Anh Đào, Thái Hòa, Thanh Trúc, Hứa Vĩ Văn, Trung Dũng, Vân Trang'),
(21, 'Họ Nhân Bản Tyrone', 'Một chuỗi sự kiện kỳ lạ khiến bộ ba bất đắc dĩ (John Boyega, Teyonah Parris và Jamie Foxx) vướng vào một âm mưu nham hiểm ở khu phố.', '2023', 'https://phimimg.com/upload/vod/20230921-1/7cda667f17e361a917b8c3d80703cf8a.jpg', 'https://player.phimapi.com/player/?url=https://s4.phim1280.tv/20240918/LEMq9Hfy/index.m3u8', 0, 'Khoa học viễn tưởng', 'John Boyega, Teyonah Parris, Jamie Foxx, Kiefer Sutherland, David Alan Grier, J. Alphonse Nicholson, Tamberla Perry, Eric Robinson Jr., Trayce Malachi, Shariff Earp'),
(22, 'Tân Siêu Nhân Điện Quang', 'Chính phủ Nhật Bản thành lập đội đặc nhiệm để chống lại những sinh vật khổng lồ bất ngờ xuất hiện trên khắp đất nước. Chẳng bao lâu, đội bất ngờ gặp một hình người khổng lồ màu bạc bắt đầu xuất hiện mỗi khi bị quái vật không gian tấn công!', '2022', 'https://phimimg.com/upload/vod/20230925-1/4d4128640c06bfb2a05d5104b2b8dbe3.jpg', 'https://player.phimapi.com/player/?url=https://s3.phim1280.tv/20240819/miMeo7Hh/index.m3u8', 0, 'Khoa học viễn tưởng', 'Takumi Saitoh, Masami Nagasawa, Hidetoshi Nishijima, Daiki Arioka, Akari Hayami, Tetsushi Tanaka, Kōji Yamamoto, Ryo Iwamatsu, Kyūsaku Shimada, Toru Masuoka'),
(23, 'Hồ Bơi Vô Cực', 'James và Em Foster đang tận hưởng kỳ nghỉ trọn gói trên bãi biển ở hòn đảo La Tolqa thì một tai nạn chết người khiến James bị rơi vào vòng lao lý. Dẫu vậy, anh ta được trao cơ hội khi có thể sử dụng tiền để tạo ra một bản sao nhằm chịu tội thay cho mình. Và từ đây, những trò chơi quái đản bắt đầu diễn ra một cách không thể kiểm soát.', '2023', 'https://phimimg.com/upload/vod/20230911-1/d209e38463d82320e580e13fe571a2df.jpg', 'https://player.phimapi.com/player/?url=https://s3.phim1280.tv/20240619/agfVfvjJ/index.m3u8', 0, 'Khoa học viễn tưởng', 'Alexander Skarsgård, Mia Goth, Cleopatra Coleman, Jalil Lespert, Amanda Brugel, John Ralston, Jeff Ricketts, Caroline Boulton, Thomas Kretschmann'),
(24, 'Logan: Trận Chiến Cuối Cùng', 'Lấy bối cảnh năm 2029, giống loài dị nhân gần như bị tuyệt diệt. Wolverine lúc này phải đối mặt với sự lão hóa cả về thể chất lẫn khả năng phục hồi. Anh cùng với Giáo sư X, người lúc này đang mắc chứng bệnh Alzheimer, phải hợp sức để bảo vệ cô bé dị nhân Laura Kinney. Đối chọi với một đội quân ác nhân mạnh mẽ do Donald Pierce dẫn đầu và một tổ chức khổng lồ bí ẩn ở phía sau, liệu họ có bảo toàn được tính mạng và viết tiếp câu chuyện của mình.', '2017', 'https://phimimg.com/upload/vod/20230915-1/a8ba6ba4fe347ca3d83e2bdbdee7249b.jpg', 'https://player.phimapi.com/player/?url=https://s3.phim1280.tv/20230914/jbGbnV76/index.m3u8', 0, 'Khoa học viễn tưởng', 'Hugh Jackman, Dafne Keen, Patrick Stewart, Elizabeth Rodriguez, Boyd Holbrook, Stephen Merchant, Richard E. Grant, Stephen Dunlevy, Eriq La Salle, Elise Neal'),
(25, 'Những Kẻ Tham Lam', 'Phim kể về cuộc sống của cư dân một thị trấn đảo nhỏ vốn rất bình yên tuy nhiên bất ngờ bị đảo lộn khi một vụ giết người chấn động và một triệu đô la bí ẩn xuất hiện.', '2024', 'https://phimimg.com/upload/vod/20241106-1/ad6dc172cdcba45c4f60a852e5818b0b.jpg', 'https://player.phimapi.com/player/?url=https://s5.phim1280.tv/20241106/xxLGj3pS/index.m3u8', 0, 'Khoa học viễn tưởng', 'Himesh Patel, Joseph Gordon-Levitt, Lily James, Uzo Aduba, Tim Blake Nelson, Simon Rex, Nina Arianda, Jim Gaffigan, José María Yázpik, Joey Lauren Adams, Neva Howell, Thunderbird Dinwiddie, Yingling Zhu, Traci Lords, Michael Harding, Khetphet Phagnasay');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `watchhistory`
--

CREATE TABLE `watchhistory` (
  `history_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `last_position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`user_id`,`movie_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `moviecategories`
--
ALTER TABLE `moviecategories`
  ADD PRIMARY KEY (`movie_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `watchhistory`
--
ALTER TABLE `watchhistory`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `watchhistory`
--
ALTER TABLE `watchhistory`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE;

--
-- Constraints for table `moviecategories`
--
ALTER TABLE `moviecategories`
  ADD CONSTRAINT `moviecategories_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `moviecategories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE;

--
-- Constraints for table `watchhistory`
--
ALTER TABLE `watchhistory`
  ADD CONSTRAINT `watchhistory_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `watchhistory_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
CREATE TABLE goidangky (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Mã voucher, tự động tăng
    ten_goi VARCHAR(255) NOT NULL,    -- Tên gói voucher phim
    gia DECIMAL(10, 2) NOT NULL       -- Giá của voucher, có thể là số tiền thập phân
);

INSERT INTO goidangky (ten_goi, gia)
VALUES 
('Gói xem phim 1 tháng', 150000),
('Gói xem phim 3 tháng', 400000),
('Gói xem phim 6 tháng', 750000);

ALTER TABLE movies
ADD trailer_url VARCHAR(255) AFTER poster_url;


UPDATE movies
SET trailer_url = CASE 
    WHEN movie_id = 1 THEN 'https://photo2.tinhte.vn/data/attachment-files/2023/02/6316142_ok.jpeg'
    WHEN movie_id = 2 THEN 'https://www.tourthailan.net.vn/images/diadiem/mieu-tho-Mae-Nak-2.jpg'
    WHEN movie_id = 3 THEN 'https://vcover-hz-pic.wetvinfo.com/vcover_hz_pic/0/rigkbvj5a6vdcj11730286437019/0'
    WHEN movie_id = 4 THEN 'https://motchill.se/storage/images/quy-co-seon-ju-phuc-thu/0d48bf417de0adb32b6812145b0ea317.jpg'
    WHEN movie_id = 5 THEN 'https://motchill.zip/storage/images/men-say-tinh-yeu/86e4894002928b08937ddd6fb891140e.jpg'
    WHEN movie_id = 6 THEN 'https://www.justwatch.com/images/backdrop/289372060/s640/tom-and-jerry-blast-off-to-mars.%7Bformat%7D'
    WHEN movie_id = 7 THEN 'https://cdn.tgdd.vn/Files/2023/08/02/1540758/nhung-cau-noi-hay-nhat-trong-phim-tham-tu-lung-danh-conan-202308021125158172.jpg'
    WHEN movie_id = 8 THEN 'https://pic3.iqiyipic.com/image/20241104/56/8f/a_100592985_m_601_en_m10_720_405.jpg'
    WHEN movie_id = 9 THEN 'https://i.ytimg.com/vi/-5Ven8OqJ6Q/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLCLAs6NaDouzLvIEEQBGxOHEmECoQ'
    WHEN movie_id = 10 THEN 'https://occ-0-8407-116.1.nflxso.net/dnm/api/v6/E8vDc_W8CLv7-yMQu8KMEC7Rrr8/AAAABZfZyMjgZB1YTwmyctlpVDZX9oxTXSyN2zVjeWclnhMBFD99c27RBTqjobTYHa3uuPGp_TE_aSRgVtnYuI81-aSYgupU4B1QT9Wn.jpg?r=a8a'
    WHEN movie_id = 11 THEN 'https://occ-0-8407-2219.1.nflxso.net/dnm/api/v6/9pS1daC2n6UGc3dUogvWIPMR_OU/AAAABXEcGY-yXF4s6KeH5moSqUfeVDVgQKtYnFGVyGcAGpQgcsPEGQE7ke9j_UBjI7ptda5rv1RO94DQe9MI13WrqUzGtP8u9BLv6PwiOl24f8uc3XPl579KGb3Q7Q.jpg?r=a74'
    WHEN movie_id = 12 THEN 'https://assets.glxplay.io/images/w700/title/mat-cua-quy_web_backdrop_767e9998ebd7f9b832ef57112760a1a1.jpg'
    WHEN movie_id = 13 THEN 'https://toomva.com/images/videos/2018/05/linh-hon-doi-xac-1---1-1527304815.jpg'
    WHEN movie_id = 14 THEN 'https://assets.glxplay.io/images/w700/title/pee-nak-3_mobile_backdrop_0e811644e58ec3c01603360a3a504a4f.jpg'
    WHEN movie_id = 15 THEN 'https://khenphim.com/wp-content/uploads/2023/06/Home-For-Rent-2-doll_KP.webp'
    WHEN movie_id = 16 THEN 'https://m.media-amazon.com/images/M/MV5BODIyODYwYWItM2VmMi00YmIwLWEyMDktZmNlZGRkNzU0MzE2XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'
    WHEN movie_id = 17 THEN 'https://i-ione.vnecdn.net/2018/06/17/1-8607-1529223663.jpg'
    WHEN movie_id = 18 THEN 'https://thanhnien.mediacdn.vn/uploaded/thienminh/2017_05_30/anh2_AEKR.jpg?width=500'
    WHEN movie_id = 19 THEN 'https://occ-0-8407-114.1.nflxso.net/dnm/api/v6/6AYY37jfdO6hpXcMjf9Yu5cnmO0/AAAABX-6KImVlsu5jf7gOEDcJQK5u7cDw8EJwLqRWA0B6nK57QpKnvc61wH-4XY3BT0HUS9zJ56QEMdV5ZVNYQ1TowkZfb2K723NinI_.jpg?r=249'
    WHEN movie_id = 20 THEN 'https://static2.vieon.vn/vieplay-image/thumbnail_v4_ntc/2024/02/19/jw7rjasm_1920x1080-changvocuaem-notitle_296_168.jpeg'
    WHEN movie_id = 21 THEN 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6etonLc8N4XUXwbwhY4BqNxDgLf8dFmpdoQ&s'
    WHEN movie_id = 22 THEN 'https://tintuc-divineshop.cdn.vccloud.vn/wp-content/uploads/2022/09/trailer-tan-sieu-nhan-dien-quang-tai-hien-tuoi-tho-voi-ky-xao-tien-bo_6336db8b704c2.jpeg'
    WHEN movie_id = 23 THEN 'https://www.digitaltrends.com/wp-content/uploads/2023/01/Infinity-Pool_Beach_MiaAlexander_courtesyofNEONTopic1.jpg?p=1'
    WHEN movie_id = 24 THEN 'https://genk.mediacdn.vn/139269124445442048/2022/12/31/1-16724614880141836897514-1672487526175-1672487526356174471554.jpg'
    WHEN movie_id = 25 THEN 'https://motchill.zip/storage/images/nhung-ke-tham-lam/9a95d55bccbd218a360cc99aff363fa8.jpg'
    ELSE trailer_url
END;
