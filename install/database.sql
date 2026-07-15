--
-- Table structure for table `tbl_active_log`
--

CREATE TABLE `tbl_active_log` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `date_time` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`, `image`) VALUES
(1, 'admin', 'admin', 'viaviwebtech@gmail.com', 'profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cid` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cid`, `category_name`, `category_image`, `status`) VALUES
(1, 'Sports Channles', '99278_18595_4665.jpg', 1),
(2, 'Fashion Channels', '10103_94282_fashionchannels.png', 1),
(3, 'Entertainment', '44775_shutterstock_624398861.jpg', 1),
(4, 'News Channels', '66925_PJ_2016.07.07_Modern-News-Consumer_0-01.png', 1),
(5, 'Kids Channels', '69244_88870_children-happy.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_channels`
--

CREATE TABLE `tbl_channels` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `channel_type` varchar(255) NOT NULL,
  `channel_title` varchar(100) NOT NULL,
  `channel_url` text NOT NULL,
  `channel_type_ios` varchar(255) NOT NULL,
  `channel_url_ios` text NOT NULL,
  `channel_poster` text NOT NULL,
  `channel_thumbnail` varchar(255) NOT NULL,
  `channel_desc` text NOT NULL,
  `featured_channel` int(1) NOT NULL DEFAULT 0,
  `slider_channel` int(1) NOT NULL DEFAULT 0,
  `total_views` int(11) NOT NULL DEFAULT 0,
  `total_rate` int(11) NOT NULL DEFAULT 0,
  `rate_avg` decimal(11,2) NOT NULL DEFAULT 0.00,
  `status` int(1) NOT NULL DEFAULT 1,
  `user_agent` varchar(30) NOT NULL DEFAULT 'false',
  `user_agent_type` varchar(30) DEFAULT NULL,
  `user_agent_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_channels`
--

INSERT INTO `tbl_channels` (`id`, `cat_id`, `channel_type`, `channel_title`, `channel_url`, `channel_type_ios`, `channel_url_ios`, `channel_poster`, `channel_thumbnail`, `channel_desc`, `featured_channel`, `slider_channel`, `total_views`, `total_rate`, `rate_avg`, `status`, `user_agent`, `user_agent_type`, `user_agent_name`) VALUES
(8, 3, 'youtube', 'MTV', 'https://www.youtube.com/watch?v=rYHlKvQHdc4', 'youtube', 'https://www.youtube.com/watch?v=rYHlKvQHdc4', '55016_p-mtv.jpg', '88773_mtv.png', '<p>MTV gives you the hottest buzz from the entertainment world that will keep you hooked! Be the first to catch the latest MTV shows, music, artists and more!</p>\r\n', 1, 0, 0, 0, 0.00, 1, 'false', NULL, NULL),
(12, 3, 'live_url', '9XM', 'http://qthttp.apple.com.edgesuite.net/1010qwoeiuryfg/sl.m3u8', 'live_url', 'http://qthttp.apple.com.edgesuite.net/1010qwoeiuryfg/sl.m3u8', '60790_p-9xm.jpg', '51046_9xM.jpg', '<p>Bollywood Music at its best, thats what 9XM is all about.</p>\r\n', 1, 0, 0, 0, 0.00, 1, 'false', NULL, NULL),
(14, 1, 'live_url', 'Star Sports', 'http://qthttp.apple.com.edgesuite.net/1010qwoeiuryfg/sl.m3u8', 'live_url', 'http://qthttp.apple.com.edgesuite.net/1010qwoeiuryfg/sl.m3u8', '70579_p-star.jpg', '17953_star-sports-1.jpg', '<p>Watch Star Sports Live Streaming.</p>\r\n', 1, 0, 0, 0, 0.00, 1, 'false', 'custom', ''),
(16, 4, 'youtube', 'NDTV India', 'https://www.youtube.com/watch?v=c1SlL9FMaS0&t=2s', 'youtube', 'https://www.youtube.com/watch?v=c1SlL9FMaS0&t=2s', '68844_246x0w.png', '72882_6478_NDTV.png', '<p>NDTV Live TV, Hindi News Channel, Watch Live TV Online - NDTV India</p>\r\n', 0, 0, 0, 0, 0.00, 1, 'false', NULL, NULL),
(18, 5, 'youtube', 'WB Kids', 'https://www.youtube.com/watch?v=woH6iObv8Gk&t=4s', 'youtube', 'https://www.youtube.com/watch?v=woH6iObv8Gk&t=4s', '31205_p-wb.jpg', '63074_WB_Kids.jpg', '<p>WBKids is the home of all of your favorite clips featuring characters from the Looney Tunes, Scooby-Doo, Tom and Jerry and More!</p>\r\n', 0, 0, 0, 0, 0.00, 1, 'false', 'setting', ''),
(20, 5, 'youtube', 'Booba Cartoon for Kids', 'https://www.youtube.com/watch?v=FTy5YxDPwEs', 'youtube', 'https://www.youtube.com/watch?v=FTy5YxDPwEs', '16299_CiHL6deeJ.jpg', '68281_booba_cartoon.jpg', '<p>Booba animated cartoon series compilation. Watch all episodes in a row. Booba is a funny creature who likes to discover a modern world. Subscribe and never miss the new episodes.</p>\r\n', 0, 0, 4, 0, 0.00, 1, 'false', 'setting', ''),
(21, 5, 'youtube', 'ChuChu TV', 'https://www.youtube.com/watch?v=c1SlL9FMaS0', 'youtube', 'https://www.youtube.com/watch?v=c1SlL9FMaS0', '81293_WBHCBauZi_.jpg', '54473_chuchu_tv.jpg', '<p>ChuChu TV Funzone 3D Nursery Rhymes &amp; Baby Songs - LIVE<br />\r\n<br />\r\n&nbsp;</p>\r\n', 0, 0, 1, 0, 0.00, 1, 'false', 'setting', ''),
(22, 4, 'embedded_url', 'Doordarshan', 'https://www.dailymotion.com/embed/video/x5hnv7h', 'youtube', 'https://www.youtube.com/watch?v=FTy5YxDPwEs', '46453_unnamed.jpg', '4573_mygov_15008929499017401.png', '<p>Doordarshan 24x7<br />\r\n<br />\r\nThis is National Channel of INDIA. Doordarshan.</p>\r\n', 0, 1, 0, 0, 0.00, 1, 'false', 'custom', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE `tbl_comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `type` varchar(60) NOT NULL,
  `comment_on` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_episode`
--

CREATE TABLE `tbl_episode` (
  `id` int(10) NOT NULL,
  `series_id` int(5) NOT NULL,
  `season_id` int(11) NOT NULL,
  `episode_title` varchar(150) NOT NULL,
  `episode_type` varchar(60) NOT NULL,
  `episode_url` text NOT NULL,
  `video_id` varchar(150) NOT NULL,
  `episode_poster` text NOT NULL,
  `total_views` int(10) NOT NULL DEFAULT 0,
  `subtitle` varchar(20) NOT NULL DEFAULT 'false',
  `is_quality` varchar(20) NOT NULL DEFAULT 'false',
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_episode`
--

INSERT INTO `tbl_episode` (`id`, `series_id`, `season_id`, `episode_title`, `episode_type`, `episode_url`, `video_id`, `episode_poster`, `total_views`, `subtitle`, `is_quality`, `status`) VALUES
(1, 1, 1, 'S01E01 - Winter is coming', 'server_url', 'http://www.storiesinflight.com/js_videosub/jellies.mp4', '', '20190_13931_got1.jpg', 0, 'false', 'false', 1),
(2, 1, 1, 'S01E02 - The Kingsroad', 'youtube_url', 'https://www.youtube.com/watch?v=mFdu_lvCTJA', 'mFdu_lvCTJA', '01072019125313_18522.jpg', 0, 'false', 'false', 1),
(3, 1, 1, 'S01E03 - Lord Snow', 'server_url', 'http://www.viaviweb.in/envato/cc/live_tv_demo/uploads/19072019100057_98335.mp4', '', '01072019125504_24026.jpg', 0, 'false', 'false', 1),
(4, 1, 1, 'S01E04 - Cripples, Bastards, and Broken Things', 'server_url', 'http://www.viaviweb.in/envato/cc/demo_video/S_landscape1.mp4', '', '01072019125511_44315.jpg', 0, 'false', 'false', 1),
(5, 1, 1, 'S01E05 - The Wolf and the Lion', 'youtube_url', 'https://youtu.be/FTy5YxDPwEs', '', '01072019125041_53517.jpg', 0, 'false', 'false', 1),
(6, 1, 2, 'S02E01 - The North Remembers', 'youtube_url', 'https://www.youtube.com/watch?v=xmpdHrVfaTk', 'xmpdHrVfaTk', '12072019071340_75185.jpg', 0, 'false', 'false', 1),
(7, 1, 2, 'S02E02 - The Night Lands', 'youtube_url', 'https://www.youtube.com/watch?v=_KdSHWETfGM', '_KdSHWETfGM', '12072019071518_29315.jpg', 0, 'false', 'false', 1),
(9, 1, 2, 'S02E03 - What Is Dead May Never Die', 'youtube_url', 'https://www.youtube.com/watch?v=c1SlL9FMaS0', 'c1SlL9FMaS0', '03062020121246_58306.jpg', 0, 'false', 'false', 1),
(10, 1, 3, 'S03E01 - Valar Dohaeris', 'youtube_url', 'https://www.youtube.com/watch?v=woH6iObv8Gk', 'woH6iObv8Gk', '03062020121208_68222.jpg', 0, 'false', 'false', 1),
(11, 1, 3, 'S03E02 - Dark Wings, Dark Words', 'server_url', 'http://www.viaviweb.in/envato/cc/demo_video/S_landscape2.mp4', '', '03062020121016_2381.jpeg', 0, 'false', 'false', 1),
(19, 3, 7, 'S01E02 - Ghoda', 'youtube_url', 'https://www.youtube.com/watch?v=te-DHSdluJs', 'te-DHSdluJs', '02062020115422_2186.jpg', 0, 'false', 'false', 1),
(21, 3, 7, 'S01E03 - Wafadar', 'youtube_url', 'https://www.youtube.com/watch?v=ofC_1lijofU', 'ofC_1lijofU', '02062020114637_20953.jpg', 0, 'false', 'false', 1),
(22, 3, 7, 'S01E04 - Virginity', 'youtube_url', 'https://www.youtube.com/watch?v=rYHlKvQHdc4', 'rYHlKvQHdc4', '02062020114555_1271.jpg', 0, 'false', 'false', 1),
(23, 4, 9, 'S01E01 - Descenso', 'youtube_url', 'https://www.youtube.com/watch?v=rYHlKvQHdc4', 'rYHlKvQHdc4', '02062020114428_13501.jpg', 0, 'false', 'false', 1),
(24, 4, 9, 'S01E02 - The Sword of Simón Bolivar', 'youtube_url', 'https://www.youtube.com/watch?v=FTy5YxDPwEs', 'FTy5YxDPwEs', '02062020114354_54125.jpg', 0, 'false', 'false', 1),
(25, 4, 9, 'S01E03 - The Men of Always', 'youtube_url', 'https://www.youtube.com/watch?v=woH6iObv8Gk', 'woH6iObv8Gk', '02062020114258_62281.jpg', 0, 'false', 'false', 1),
(26, 4, 10, 'S01E01 - Free at Last', 'youtube_url', 'https://www.youtube.com/watch?v=xqICnqr_a8g', 'xqICnqr_a8g', '02062020114223_61129.jpg', 0, 'false', 'false', 1),
(27, 4, 10, 'S02E02 - Cambalache', 'youtube_url', 'https://www.youtube.com/watch?v=te-DHSdluJs', 'te-DHSdluJs', '02062020114101_10874.jpg', 0, 'false', 'false', 1),
(29, 4, 11, 'S03E01 - The Kingpin Strategy', 'youtube_url', 'https://www.youtube.com/watch?v=ggCvmbjphPE', 'ggCvmbjphPE', '02062020113924_99677.jpg', 0, 'false', 'false', 1),
(30, 4, 11, 'S03E02 - The Cali KGB', 'youtube_url', 'https://www.youtube.com/watch?v=rYHlKvQHdc4', 'rYHlKvQHdc4', '02062020113831_95268.jpg', 0, 'false', 'false', 1),
(41, 1, 1, 'Episode Subtitle', 'server_url', 'http://www.storiesinflight.com/js_videosub/jellies.mp4', '', '13072020112741_11957.png', 0, 'true', 'true', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_genres`
--

CREATE TABLE `tbl_genres` (
  `gid` int(11) NOT NULL,
  `genre_name` varchar(255) NOT NULL,
  `genre_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_genres`
--

INSERT INTO `tbl_genres` (`gid`, `genre_name`, `genre_image`) VALUES
(1, 'Horror', '88406_Horror.jpg'),
(3, 'Action', '33053_Action.jpg'),
(4, 'Thriller', '54577_Thrille.jpg'),
(5, 'Drama', '92886_Drama_2_23.jpg'),
(6, 'Love', '35754_LoveMovie.jpg'),
(7, 'Comedy', '95352_Comedy.jpg'),
(9, 'Test', '35214_Chrysanthemum.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_home`
--

CREATE TABLE `tbl_home` (
  `id` int(11) NOT NULL,
  `home_title` varchar(255) NOT NULL,
  `home_banner` varchar(255) NOT NULL,
  `home_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_home`
--

INSERT INTO `tbl_home` (`id`, `home_title`, `home_banner`, `home_url`) VALUES
(1, 'Star Sports', '27783_Star_Sports.png', 'http://bglive-a.bitgravity.com/ndtv/prolo/live/native'),
(3, 'ABP News', '88806_abp_english.jpg', 'http://bglive-a.bitgravity.com/ndtv/prolo/live/native');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_language`
--

CREATE TABLE `tbl_language` (
  `id` int(11) NOT NULL,
  `language_name` varchar(60) NOT NULL,
  `language_background` varchar(30) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_language`
--

INSERT INTO `tbl_language` (`id`, `language_name`, `language_background`, `status`) VALUES
(1, 'English', '11762E', 1),
(2, 'Hindi', 'E9900B', 1),
(3, 'Gujarati', '0BC1E9', 1),
(4, 'Telugu', 'E91E63', 1),
(5, 'Tamil', '034EE9', 1),
(7, 'عربى', 'E99871', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_movies`
--

CREATE TABLE `tbl_movies` (
  `id` int(11) NOT NULL,
  `language_id` int(5) NOT NULL,
  `genre_id` varchar(50) NOT NULL,
  `movie_type` varchar(60) NOT NULL,
  `movie_title` varchar(255) NOT NULL,
  `movie_cover` text NOT NULL,
  `movie_poster` text NOT NULL,
  `movie_url` text NOT NULL,
  `video_id` varchar(150) NOT NULL,
  `movie_desc` longtext NOT NULL,
  `total_views` int(11) NOT NULL DEFAULT 0,
  `total_rate` varchar(30) NOT NULL DEFAULT '0',
  `rate_avg` varchar(30) NOT NULL DEFAULT '0',
  `is_featured` int(1) NOT NULL DEFAULT 0,
  `is_slider` int(1) NOT NULL DEFAULT 0,
  `subtitle` varchar(20) NOT NULL DEFAULT 'false',
  `is_quality` varchar(20) NOT NULL DEFAULT 'false',
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_movies`
--

INSERT INTO `tbl_movies` (`id`, `language_id`, `genre_id`, `movie_type`, `movie_title`, `movie_cover`, `movie_poster`, `movie_url`, `video_id`, `movie_desc`, `total_views`, `total_rate`, `rate_avg`, `is_featured`, `is_slider`, `subtitle`, `is_quality`, `status`) VALUES
(14, 2, '1', 'embedded_url', 'Bhoot Returns', '51702_c5b60f21775411e6b879b77c8bf4d3fc_1581945832220_l_medium.jpg', '40870_26968.jpg', 'https://player.vimeo.com/video/346746965', '', '<p>This story revolves around a family that moves into a new bungalow. Soon the family members experience weird things happening in the house. The little girl Nimmi claims the presence of an invisible figure named Shabbu thus putting her parents in trouble. Pooja (the sister of Nimmi&#39;s father) surprises the family by a sudden visit, and after analyzing the situation that Nimmi is suffering from, she places wireless cameras all over the house to record the activities of Nimmi. With the passage of time, Laxman (the servant) and Taman (the brother of Nimmi) are brutally murdered. Lastly, the possessed girl Nimmi is burned down and the family flee, bloody and injured.</p>', 0, '0', '0', 0, 0, 'false', 'false', 1),
(15, 4, '3', 'embedded_url', 'Singam 3', '56006_image_710x400xt.jpg', '85307_singam 3.jpg', 'https://www.dailymotion.com/embed/video/x5hnv7h', '', '<p>The film starts with tremble in Andhra Pradesh legislature where long pending murder case of city commissioner Ramakrishna (Jayaprakash) is being discussed where home minister K. Sathyanarayana (Sarath Babu) proposes to bring DCP Durai Singam (Suriya) from Tamil Nadu police to solve the long pending case. Initially being attacked by Madhusudhana Reddy&#39;s (Sharat Saxena) men at the railway station at arrival Durai Singam bashes them out and joins the Visakhapatnam police force under CBI pretending to be casual and not serious about the murder case Durai Singam secretly investigates the case from all aspects. Meanwhile, Durai Singam is being followed by Vidhya (Shruti Haasan) who is a journalist from Andhra Pradesh tracking Durai Singam in disguise as student applied for IPS exams. Durai Singam initially says divorced his wife Kavya (Anushka Shetty), but secretly contacts her later, after suspicion of Subba Rao (Robo Shankar), it is told to play to avoid Kavya from attacks from suspects of the murder case. But, finally finding Reddy is behind the murder in series of investigation decides to wipe out goondas in Vishakhapatnam along with arresting Police officers involved in the murder of commissioner. After, tracking a suspect he come across to know illegal dumping of Bio-waste and E-Waste from Australia by Vittal Prasad (Thakur Anoop Singh) a wealthy businessman from Australia and son of central minister Ram Prasad (Suman) who works as master mind behind dumping of wastes from Australia for his business benefits in Vishakapatnam by help of Reddy and his staff Rajeev Krishna (Kamalesh). When the commissioner tried to expose this to media he was brutally killed by Reddy and his subordinates. This is proved by the witness from assistant commissioner&#39;s driver Malaya (Jeeva Ravi) and school teacher (Joe Malloori) who lost his granddaughter in toxic smoke caused by burning wastes from Australia in nearby dump yard. When Durai Singam attempts to arrest Reddy and Vittal Prasad with help the witness and evidence collected, Reddy&#39;s men kill the school teacher and warn Durai Singam that he will destroy his whole family from Australia if he further investigates the case. Durai Singam travels to Australia like a personal trip with his wife, but he actually goes to get all the shreds of evidence of Vittal&#39;s Business. After returning from Australia he tackles every rowdies and henchman of Reddy and kills him. Angry Vittal arrives Visakhapatnam and warns Durai Singam. As expecting arrival of Vittal to Visakhapatnam, Durai Singam exposes the containers that contained the waste to the press and warns Vittal to surrender. Vittal tries to kill Vidhya who tried to spy on him and Durai Singam by hiring a contract killer from Mumbai by making a bomb blast. Durai Singam manages to save Vidhya as well as himself and exposes Vittal&#39;s real face to the world and provide every evidence he collected from his Australian Head Office and arrest him while he tried to escape from Hyderabad Airport in Telengana State. Vittal tries to escape from Policemen, but Durai Singam stops him and fights with him in Talakona Forest and kills him there. Durai Singam successfully concludes and submits the case file to the home minister and returns to Tamil Nadu. Finally, Vidhya gets engaged with another person happily and Home Minister Ramanathan (Vijayakumar) calls Durai Singam once again as Kavya says &quot;Innoru mission aa?&quot; (Another Mission?). Which suggests that there will be a sequel to this film.</p>', 0, '0', '0', 1, 0, 'false', 'false', 1),
(16, 4, '5', 'embedded_url', 'Baahubali 2: The Conclusion', '83394_baahubali-2-review-rating.jpg', '13060_711eHgGtnFL._SX522_.jpg', 'https://fsiapp.xyz/api/direct.php?ep=199', '', '<p>Yes, the movie cannot be skipped, as the first part and the twist question at the end ensure we all will flock to the theatres. So, I&#39;ll dwelve rather on what one expected from the movie and what one got.<br />\r\n<br />\r\nExp -Magnum opus with brilliant VFX Act - Brilliant VFX indeed with Kingdom, Dream sequences and war scenes portrayed effectively to border disbelief<br />\r\n<br />\r\nExp - Enhancing the character of Bahubali n son, Devsana, Bhallaldev, Sivagami and Kattappa with brilliant one- liners. Act - Characters watered down with very few one-liners to keep the audience hooked. Sivagami&#39;s fierceness gets lost, Kattappa&#39;s loyalty questioned, Bhallaldev&#39;s might becomes more brain than brawn and worst, even Bahubali ends up wasting his arm strength and skills<br />\r\n<br />\r\nExp- A nuanced script where politics and drama get overshadowed by pure heroics and camera following lead character all the time. Act- A muddled script reminiscent of good old Mahabharat serial of schemes and sub- schemes where Bahubali keeps losing without any retribution<br />\r\n<br />\r\nExp - Music which would create awe and timed beautifully to take the movie forward. Act - BGM remains good enough, but the songs didn&#39;t deliver, especially the romantic number between Devsana and Bahubali on which a good share of budget gets wasted<br />\r\n<br />\r\nExp - Last but not the least, an epic climax and final war, which would go on for an hour and where Sivadu finally manages to kill Bhallaldev against all odds Act - Kind of anti climax, which feels edited too much and put together fast enough to ensure reasonable running time and enough shows to hit Rs. 500 Crs collection in a week<br />\r\n<br />\r\nAll in all, somewhere the commercials seem to have overtaken the story, melodrama overshadowing an epic in making and VFX substituting genuine acting.<br />\r\n<br />\r\nIndependently, keeping aside the expectations, the film has been done well, with good BGM, main characters building up muscles, graphics team putting a lot of efforts and the costumes team doing well too. The love story between Bahubali and Devsana develops like a typical Bollywood potboiler with fake acting and a caricature wannabe boyfriend in the middle; finally blooming to a romance with a dream sequence in clouds on a flying ship. Anushka shetty as Devasena, to her credit delivers a wonderful performance as the young devasana with strong dialogues and attitude.<br />\r\n<br />\r\nHowever, as the &#39;Conclusion&#39; ends and a dialogue giving a hint of another sequel pours out, the excitement of crowd is nowhere to be seen. But for those times where you have open mouth stared and cheered for our hero when he nonchalantly massacred people, conquered animals and even challenged nature, &#39;Jai Mahishmati&#39;.</p>', 0, '0', '0', 1, 0, 'false', 'false', 1),
(17, 4, '7', 'embedded_url', 'Duvvada Jagannadham', '41676_59236474.jpg', '19335_rgxpyzifgbgbe.jpg', 'https://verystream.com/e/Z2gJ86endyN/', '', '<p>Duvvada Jagannadham or DJ is an Indian Telugu-language action comedy film written and directed by Harish Shankar and produced by Dil Raju under his banner Sri Venkateswara Creations. The film stars Allu Arjun and Pooja Hegde. Devi Sri Prasad composed the film&#39;s music while Ayananka Bose handled the cinematography. Principal photography commenced in August 2016 in Hyderabad.[1] Abu Dhabi[2] was also a filming location; the production crew chose Abu Dhabi, as they would benefit from the Emirate&#39;s 30% film production rebate.</p>', 0, '0', '0', 1, 0, 'false', 'false', 1),
(18, 4, '4', 'youtube_url', 'Kshanam', '43109_dc-Cover-1critgpgg04atfhu32lg71hhs3-20160229231425.Medi.jpeg', '94115_Kshanam_poster.jpg', 'https://www.youtube.com/watch?v=rYHlKvQHdc4', 'rYHlKvQHdc4', '<p>Rishi, a San Fransisco-based investment banker gets a voice call from Shweta, his ex-lover. They studied medicine in the same college and wanted to marry, but her father arranged an alliance with an entrepreneur named Karthik. Rishi leaves for India with the pretense of attending a marriage in their relatives&#39; household. He takes a car for hire from Babu Khan, a travels agent. Rishi also takes a SIM card on his sister&#39;s address and stays at Hotel Marriott.</p>\r\n\r\n<p>Rishi meets Shweta at a restaurant and learns that her five-year old daughter Ria is missing. Things went worse when none except Shweta, including Karthik, believe that Ria actually exists. He also learns about Karthik&#39;s brother Bobby, a drug addict, who regularly visits her home. Rishi begins an informal investigation which fails many a times, also inviting the ire of two afro-american gangsters in the city. Babu Khan, who helps them in transporting drugs, saves Rishi on humanitarian grounds. Posing as Vasanth Khanna, a police officer, Rishi meets Karthik and learns that the couple was childless. Karthik recalls Shweta being attacked by two masked men before a school to steal her car. He added that Shweta went into coma and post recovery started telling that she had a five-year old daughter named Ria.</p>', 0, '0', '0', 0, 0, 'false', 'false', 1),
(19, 7, '5', 'server_url', 'القادمة الرابعة بعد يوم', '35364_coming-forth-by-day-2012-001-old-vs-new-architecture.jpg', '16704_MV5BMjI5OTY0ODY5Ml5BMl5BanBnXkFtZTcwMjQzMzI2OQ@@._V1_.jpg', 'http://www.viaviweb.in/envato/cc/demo_video/S_landscape2.mp4', '', '<p>أولئك الذين استمتعوا بالكامل بأجسادهم لا يمكن أن يكونوا خاضعين. وأولئك الذين ليس لديهم أبدا؟ هل يمكنهم الصمود في عبودية العزلة والقبول العاجز لما لا يمكنهم تغييره أو احتضانه؟ هذه هي قصة كل يوم لامرأتين تعتنين برجلهم المريض.</p>', 0, '0', '0', 0, 0, 'false', 'false', 1),
(20, 1, '3', 'youtube_url', 'Avengers Endgame', '37351_09B_AEG_DomPayoff_1Sht_REV-7c16828.jpg', '66924_dHjLaIUHXcMBt7YxK1TKWK1end9.jpg', 'https://www.youtube.com/watch?v=TcMBFSGVi1c', 'TcMBFSGVi1c', '<p>Twenty-three days after&nbsp;Thanos&nbsp;used the&nbsp;Infinity Gauntlet&nbsp;to disintegrate half of all life in the universe, Carol Danvers&nbsp;rescues&nbsp;Tony Stark&nbsp;and&nbsp;Nebula&nbsp;from deep space and returns them to Earth. They reunite with the remaining&nbsp;Avengers&mdash;Bruce Banner,&nbsp;Steve Rogers,&nbsp;Rocket,&nbsp;Thor,&nbsp;Natasha Romanoff, and&nbsp;James Rhodes&mdash;and find Thanos on an uninhabited planet. They plan to retake and use the&nbsp;Infinity Stones&nbsp;to reverse the disintegrations, but Thanos reveals he destroyed them to prevent further use. An enraged Thor decapitates Thanos.</p>\r\n\r\n<p>Five years later,&nbsp;Scott Lang&nbsp;escapes from the&nbsp;quantum realm. He travels to the Avengers&#39; compound, where he explains to Romanoff and Rogers that he experienced only five hours while trapped. Theorizing the quantum realm could allow&nbsp;time travel, the three ask Stark to help them retrieve the Stones from the past to reverse Thanos&#39; actions in the present, but Stark refuses to help. After talking with his wife,&nbsp;Pepper Potts, Stark relents and works with Banner, who has since merged his intelligence with the Hulk&#39;s strength and body, and the two successfully build a time machine. Banner warns that changing the past does not affect their present and any changes instead create branched&nbsp;alternate realities. He and Rocket go to the Asgardian refugees&#39; new home in&nbsp;Norway&nbsp;to recruit Thor, now an overweight alcoholic, despondent over his failure in stopping Thanos. In&nbsp;Tokyo, Romanoff recruits&nbsp;Clint Barton, now a ruthless vigilante following the disintegration of his family.</p>', 0, '0', '0', 0, 1, 'false', 'false', 1),
(23, 1, '3,6,4', 'youtube_url', 'Harry Potter and the Philosopher\'s Stone', '50953_maxresdefault.jpg', '25530_815v2OuIHXL._AC_SL1500_.jpg', 'https://www.youtube.com/watch?v=ofC_1lijofU', 'ofC_1lijofU', '<p><strong>Harry Potter and the Philosopher&#39;s Stone</strong> (released in the United States, <strong>India</strong> and Pakistan as Harry Potter and the Sorcerer&#39;s Stone) is a 2001 fantasy film directed by Chris Columbus and distributed by Warner Bros. Pictures. It is based on J. K. Rowling&#39;s 1997 novel of the same name. The film is the first instalment of the Harry Potter film series and was written by Steve Kloves and produced by David Heyman. Its story follows Harry Potter&#39;s first year at Hogwarts School of Witchcraft and Wizardry as he discovers that he is a famous wizard and begins his education. The film stars Daniel Radcliffe as Harry Potter, with Rupert Grint as Ron Weasley, and Emma Watson as Hermione Granger.</p>', 0, '0', '0', 0, 1, 'false', 'false', 0),
(24, 5, '3,4', 'embedded_url', '2.0', '30429_20gjhgj-660_112918050831_120318094858.jpg', '40375_1479701986-300x450.jpg', 'https://www.dailymotion.com/embed/video/x5hnv7h', '', '<p>When mobiles start flying from people&#39;s hands, Dr Vaseegaran and his robot Nila are asked to help. However, due to Pakshi Rajan having a hand in this, the two have to reinstate Chitti to defeat him.</p>', 2, '0', '0', 0, 0, 'false', 'false', 1),
(25, 5, '3,5', 'youtube_url', 'Maari', '25950_Maari 2.jpg', '59091_7e693a86e1456b949c1badf28272c2d2.jpg', 'https://www.youtube.com/watch?v=FTy5YxDPwEs', 'FTy5YxDPwEs', '<p>Maari, a local goon, extorts money from the people in his area and forcibly becomes the business partner of Sridevi. She then pretends to fall in love with him to get his confession for a crime.</p>', 1, '0', '0', 0, 0, 'false', 'false', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quality`
--

CREATE TABLE `tbl_quality` (
  `id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `post_upload_type` varchar(30) NOT NULL,
  `quality_480` text NOT NULL,
  `quality_720` text NOT NULL,
  `quality_1080` text NOT NULL,
  `type` varchar(30) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_quality`
--

INSERT INTO `tbl_quality` (`id`, `post_id`, `post_upload_type`, `quality_480`, `quality_720`, `quality_1080`, `type`, `created_at`, `status`) VALUES
(10, 41, 'server_url', 'http://www.storiesinflight.com/js_videosub/jellies.mp4', '', 'http://www.storiesinflight.com/js_videosub/jellies.mp4', 'episode', '1594632461', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `rate` int(11) NOT NULL,
  `type` varchar(60) NOT NULL,
  `dt_rate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reports`
--

CREATE TABLE `tbl_reports` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `report` text NOT NULL,
  `type` varchar(60) NOT NULL,
  `report_on` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_season`
--

CREATE TABLE `tbl_season` (
  `id` int(10) NOT NULL,
  `series_id` int(10) NOT NULL,
  `season_name` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_season`
--

INSERT INTO `tbl_season` (`id`, `series_id`, `season_name`, `status`) VALUES
(1, 1, 'Season-1', 1),
(2, 1, 'Season-2', 1),
(3, 1, 'Season-3', 1),
(7, 3, 'Season 1', 1),
(9, 4, 'Season 1 (2015)', 1),
(10, 4, 'Season 2 (2016)', 1),
(11, 4, 'Season 3 (2017)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_series`
--

CREATE TABLE `tbl_series` (
  `id` int(10) NOT NULL,
  `series_name` varchar(150) NOT NULL,
  `series_desc` text NOT NULL,
  `series_poster` text NOT NULL,
  `series_cover` text NOT NULL,
  `total_views` int(11) NOT NULL DEFAULT 0,
  `total_rate` varchar(10) NOT NULL DEFAULT '0',
  `rate_avg` varchar(10) NOT NULL DEFAULT '0',
  `is_featured` int(1) NOT NULL DEFAULT 0,
  `is_slider` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_series`
--

INSERT INTO `tbl_series` (`id`, `series_name`, `series_desc`, `series_poster`, `series_cover`, `total_views`, `total_rate`, `rate_avg`, `is_featured`, `is_slider`, `status`) VALUES
(1, 'Game Of Thrones', '<p><em><strong>Game of Thrones</strong></em>&nbsp;is an American&nbsp;fantasy&nbsp;drama&nbsp;television series created by&nbsp;David Benioff&nbsp;and&nbsp;D. B. Weiss&nbsp;for&nbsp;HBO. It is an adaptation of&nbsp;<em>A Song of Ice and Fire</em>,&nbsp;George R. R. Martin&#39;s series of fantasy novels, the first of which is&nbsp;<em>A Game of Thrones</em>. The show was both produced and filmed in&nbsp;Belfast&nbsp;and elsewhere in the&nbsp;United Kingdom. Filming locations also included Canada, Croatia, Iceland, Malta, Morocco, and Spain. The series premiered on&nbsp;HBO&nbsp;in the United States on April 17, 2011, and concluded on May 19, 2019, with 73 episodes broadcast over eight seasons.</p>', '36869_got.jpg', '48629_d0bd7hlw0aagvyc-cropped.jpg', 0, '0', '0', 0, 0, 1),
(3, 'Mirzapur', '<p><strong>Mirzapur </strong>is an Indian crime thriller web television series on Amazon Prime Video produced by Excel Entertainment. The series is primarily shot in Mirzapur, with some shots in Jaunpur, Azamgarh, Ghazipur, Lucknow and Gorakhpur. It revolves around drugs, guns and lawlessness. It depicts the putrescence, governance and rule of mafia dons and the rivalry and crime prevailing in the Purvanchal region of Uttar Pradesh. Its season 1 consists of 9 episodes in total</p>', '4263_mirzapur-poster.jpg', '42989_mirzapur-prime-1200.jpg', 2, '0', '0', 0, 0, 1),
(4, 'Narcos', '<p>Narcos is an American crime drama web television series created and produced by Chris Brancato, Carlo Bernard, and Doug Miro.</p>\r\n\r\n<p>Set and filmed in Colombia, seasons 1 and 2 are based on the story of drug kingpin Pablo Escobar, who became a billionaire through the production and distribution of cocaine. The series also focuses on Escobar&#39;s interactions with drug lords, Drug Enforcement Administration (DEA) agents, and various opposition entities. Season 3 picks up after the fall of Escobar and continues to follow the DEA as they try to shutdown the rise of the infamous Cali Cartel.<br />\r\n&nbsp;</p>', '37970_81rbzNdJUkL._SL1500_.jpg', '91174_mumbai-police-narco-nacco-meme-759.jpg', 0, '0', '0', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `envato_buyer_name` varchar(255) NOT NULL,
  `envato_purchase_code` varchar(255) NOT NULL,
  `envato_buyer_email` varchar(150) NOT NULL,
  `envato_purchased_status` int(1) NOT NULL DEFAULT 0,
  `envato_ios_purchase_code` varchar(255) NOT NULL,
  `envato_ios_purchased_status` int(2) NOT NULL DEFAULT 0,
  `package_name` varchar(255) NOT NULL,
  `ios_bundle_identifier` varchar(255) NOT NULL,
  `email_from` varchar(255) NOT NULL,
  `onesignal_app_id` varchar(500) NOT NULL,
  `onesignal_rest_key` varchar(500) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_logo` varchar(255) NOT NULL,
  `app_email` varchar(255) NOT NULL,
  `app_version` varchar(255) NOT NULL,
  `app_author` varchar(255) NOT NULL,
  `app_contact` varchar(255) NOT NULL,
  `app_website` varchar(255) NOT NULL,
  `app_description` text NOT NULL,
  `app_developed_by` varchar(255) NOT NULL,
  `app_privacy_policy` text NOT NULL,
  `api_latest_limit` int(3) NOT NULL,
  `api_page_limit` int(5) NOT NULL,
  `api_cat_order_by` varchar(255) NOT NULL,
  `api_cat_post_order_by` varchar(255) NOT NULL,
  `api_lan_order_by` varchar(20) NOT NULL,
  `api_gen_order_by` varchar(20) NOT NULL,
  `publisher_id` varchar(500) NOT NULL,
  `interstital_ad` varchar(500) NOT NULL,
  `interstital_ad_id` varchar(500) NOT NULL,
  `interstital_ad_click` varchar(500) NOT NULL,
  `banner_ad` varchar(500) NOT NULL,
  `banner_ad_id` varchar(500) NOT NULL,
  `publisher_id_ios` varchar(500) NOT NULL,
  `app_id_ios` varchar(500) NOT NULL,
  `interstital_ad_ios` varchar(500) NOT NULL,
  `interstital_ad_id_ios` varchar(500) NOT NULL,
  `interstital_ad_click_ios` varchar(500) NOT NULL,
  `banner_ad_ios` varchar(500) NOT NULL,
  `banner_ad_id_ios` varchar(500) NOT NULL,
  `ios_banner_ad_type` varchar(30) NOT NULL DEFAULT 'admob',
  `ios_banner_facebook_id` text NOT NULL,
  `ios_interstital_ad_type` varchar(30) NOT NULL DEFAULT 'admob',
  `ios_interstital_facebook_id` text NOT NULL,
  `banner_ad_type` varchar(30) NOT NULL DEFAULT 'admob',
  `banner_facebook_id` text NOT NULL,
  `interstital_ad_type` varchar(30) NOT NULL DEFAULT 'admob',
  `interstital_facebook_id` text NOT NULL,
  `banner_wortise_id` varchar(255) DEFAULT NULL,
  `interstitial_wortise_id` varchar(255) DEFAULT NULL,
  `native_wortise_id` varchar(255) DEFAULT NULL,
  `wortise_app_id` varchar(255) DEFAULT NULL,
  `user_agent` varchar(150) NOT NULL,
  `omdb_api_key` varchar(150) NOT NULL,
  `netsocks_on_off` varchar(255) NOT NULL DEFAULT 'on',
  `netsocks_publisher_key` varchar(255) DEFAULT '0E2723F4-A102-42DC-9602-AD8F7312767A',
  `netsocks_consent` varchar(255) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `envato_buyer_name`, `envato_purchase_code`, `envato_buyer_email`, `envato_purchased_status`, `envato_ios_purchase_code`, `envato_ios_purchased_status`, `package_name`, `ios_bundle_identifier`, `email_from`, `onesignal_app_id`, `onesignal_rest_key`, `app_name`, `app_logo`, `app_email`, `app_version`, `app_author`, `app_contact`, `app_website`, `app_description`, `app_developed_by`, `app_privacy_policy`, `api_latest_limit`, `api_page_limit`, `api_cat_order_by`, `api_cat_post_order_by`, `api_lan_order_by`, `api_gen_order_by`, `publisher_id`, `interstital_ad`, `interstital_ad_id`, `interstital_ad_click`, `banner_ad`, `banner_ad_id`, `publisher_id_ios`, `app_id_ios`, `interstital_ad_ios`, `interstital_ad_id_ios`, `interstital_ad_click_ios`, `banner_ad_ios`, `banner_ad_id_ios`, `ios_banner_ad_type`, `ios_banner_facebook_id`, `ios_interstital_ad_type`, `ios_interstital_facebook_id`, `banner_ad_type`, `banner_facebook_id`, `interstital_ad_type`, `interstital_facebook_id`, `banner_wortise_id`, `interstitial_wortise_id`, `native_wortise_id`, `wortise_app_id`, `user_agent`, `omdb_api_key`, `netsocks_on_off`, `netsocks_publisher_key`, `netsocks_consent`) VALUES
(1, '', '', '', 0, '', 0, 'com.example.livetvseries', 'com.livetvpro', '-', '', '', 'Live TV', 'ic_launcher_round.png', 'info@viaviweb.com', '2.1.5', 'Viavi Webtech', '+919227777522', 'www.viaviweb.com', '<p>Watch your favorite TV channels Live in your mobile phone with this application on your device. that support almost all format.The application is specially optimized to be extremely easy to configure and detailed documentation is provided.</p>\r\n', 'Viavi Webtech', '<p><strong>We are committed to protecting your privacy</strong></p>\r\n\r\n<p>We collect the minimum amount of information about you that is commensurate with providing you with a satisfactory service. This policy indicates the type of processes that may result in data being collected about you. Your use of this website gives us the right to collect that information.&nbsp;</p>\r\n\r\n<p><strong>Information Collected</strong></p>\r\n\r\n<p>We may collect any or all of the information that you give us depending on the type of transaction you enter into, including your name, address, telephone number, and email address, together with data about your use of the website. Other information that may be needed from time to time to process a request may also be collected as indicated on the website.</p>\r\n\r\n<p><strong>Information Use</strong></p>\r\n\r\n<p>We use the information collected primarily to process the task for which you visited the website. Data collected in the UK is held in accordance with the Data Protection Act. All reasonable precautions are taken to prevent unauthorised access to this information. This safeguard may require you to provide additional forms of identity should you wish to obtain information about your account details.</p>\r\n\r\n<p><strong>Cookies</strong></p>\r\n\r\n<p>Your Internet browser has the in-built facility for storing small files - &quot;cookies&quot; - that hold information which allows a website to recognise your account. Our website takes advantage of this facility to enhance your experience. You have the ability to prevent your computer from accepting cookies but, if you do, certain functionality on the website may be impaired.</p>\r\n\r\n<p><strong>Disclosing Information</strong></p>\r\n\r\n<p>We do not disclose any personal information obtained about you from this website to third parties unless you permit us to do so by ticking the relevant boxes in registration or competition forms. We may also use the information to keep in contact with you and inform you of developments associated with us. You will be given the opportunity to remove yourself from any mailing list or similar device. If at any time in the future we should wish to disclose information collected on this website to any third party, it would only be with your knowledge and consent.&nbsp;</p>\r\n\r\n<p>We may from time to time provide information of a general nature to third parties - for example, the number of individuals visiting our website or completing a registration form, but we will not use any information that could identify those individuals.&nbsp;</p>\r\n\r\n<p>In addition Dummy may work with third parties for the purpose of delivering targeted behavioural advertising to the Dummy website. Through the use of cookies, anonymous information about your use of our websites and other websites will be used to provide more relevant adverts about goods and services of interest to you. For more information on online behavioural advertising and about how to turn this feature off, please visit youronlinechoices.com/opt-out.</p>\r\n\r\n<p><strong>Changes to this Policy</strong></p>\r\n\r\n<p>Any changes to our Privacy Policy will be placed here and will supersede this version of our policy. We will take reasonable steps to draw your attention to any changes in our policy. However, to be on the safe side, we suggest that you read this document each time you use the website to ensure that it still meets with your approval.</p>\r\n\r\n<p><strong>Contacting Us</strong></p>\r\n\r\n<p>If you have any questions about our Privacy Policy, or if you want to know what information we have collected about you, please email us at hd@dummy.com. You can also correct any factual errors in that information or require us to remove your details form any list under our control.</p>\r\n', 15, 10, 'category_name', 'channel_title', 'id', 'genre_name', 'pub-9456493320432553', 'true', 'ca-app-pub-3940256099942544/1033173712', '2', 'true', 'ca-app-pub-3940256099942544/6300978111', 'pub-8356404931736973', '-', 'true', 'ca-app-pub-3940256099942544/4411468910', '5', 'true', 'ca-app-pub-3940256099942544/2934735716', 'admob', '', 'admob', '', 'wortise', 'IMG_16_9_APP_INSTALL#932987606893395_932988046893351', 'wortise', 'IMG_16_9_APP_INSTALL#932987606893395_932990020226487', 'a2562302-14ce-476b-94d4-0c6431f1f927', 'ed6fc25c-9855-485e-9513-fed0d3acc528', '', 'a4e76baa-c4ce-4672-ba85-f2f7190bd19b', 'Live Tv App', '85b39a5b', 'on', '0E2723F4-A102-42DC-9602-AD8F7312767A1', 'off');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_smtp_settings`
--

CREATE TABLE `tbl_smtp_settings` (
  `id` int(5) NOT NULL,
  `smtp_type` varchar(20) NOT NULL,
  `smtp_host` varchar(150) NOT NULL,
  `smtp_email` varchar(150) NOT NULL,
  `smtp_password` text NOT NULL,
  `smtp_secure` varchar(20) NOT NULL,
  `port_no` varchar(10) NOT NULL,
  `smtp_ghost` varchar(150) NOT NULL,
  `smtp_gemail` varchar(150) NOT NULL,
  `smtp_gpassword` text NOT NULL,
  `smtp_gsecure` varchar(20) NOT NULL,
  `gport_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_smtp_settings`
--

INSERT INTO `tbl_smtp_settings` (`id`, `smtp_type`, `smtp_host`, `smtp_email`, `smtp_password`, `smtp_secure`, `port_no`, `smtp_ghost`, `smtp_gemail`, `smtp_gpassword`, `smtp_gsecure`, `gport_no`) VALUES
(1, 'server', '', '', '', 'ssl', '465', 'smtp.gmail.com', '', '', 'ssl', '465');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subtitles`
--

CREATE TABLE `tbl_subtitles` (
  `id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `language` varchar(60) NOT NULL,
  `subtitle_type` varchar(30) NOT NULL,
  `subtitle_url` text NOT NULL,
  `type` varchar(30) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_subtitles`
--

INSERT INTO `tbl_subtitles` (`id`, `post_id`, `language`, `subtitle_type`, `subtitle_url`, `type`, `created_at`) VALUES
(32, 41, 'English', 'local', '13072020112741_25078episode_subtitle.srt', 'episode', '1594632461'),
(33, 41, 'Hindi', 'local', '13072020112741_56570episode_subtitle.srt', 'episode', '1594632461');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `user_type` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `confirm_code` varchar(255) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `register_on` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video`
--

CREATE TABLE `tbl_video` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `video_type` varchar(255) NOT NULL,
  `video_title` varchar(255) NOT NULL,
  `video_url` text NOT NULL,
  `video_id` varchar(255) NOT NULL,
  `video_thumbnail` text NOT NULL,
  `total_views` int(11) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_video`
--

INSERT INTO `tbl_video` (`id`, `cat_id`, `video_type`, `video_title`, `video_url`, `video_id`, `video_thumbnail`, `total_views`, `status`) VALUES
(1, 0, 'youtube', 'Calvin Harris - This Is What You Came For', 'https://www.youtube.com/watch?v=kOkQ4T5WO9E', 'kOkQ4T5WO9E', '75142_forestbridge.jpg', 0, 1),
(4, 0, 'youtube', 'Viavi Webtech - Testimonials', 'https://www.youtube.com/watch?v=JqYsroLntJI', 'JqYsroLntJI', '80681_profile-logo.jpg', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_active_log`
--
ALTER TABLE `tbl_active_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_channels`
--
ALTER TABLE `tbl_channels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_episode`
--
ALTER TABLE `tbl_episode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_genres`
--
ALTER TABLE `tbl_genres`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `tbl_home`
--
ALTER TABLE `tbl_home`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_language`
--
ALTER TABLE `tbl_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_movies`
--
ALTER TABLE `tbl_movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quality`
--
ALTER TABLE `tbl_quality`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_season`
--
ALTER TABLE `tbl_season`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_series`
--
ALTER TABLE `tbl_series`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_smtp_settings`
--
ALTER TABLE `tbl_smtp_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subtitles`
--
ALTER TABLE `tbl_subtitles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_video`
--
ALTER TABLE `tbl_video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_active_log`
--
ALTER TABLE `tbl_active_log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_channels`
--
ALTER TABLE `tbl_channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_episode`
--
ALTER TABLE `tbl_episode`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_genres`
--
ALTER TABLE `tbl_genres`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_home`
--
ALTER TABLE `tbl_home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_language`
--
ALTER TABLE `tbl_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_movies`
--
ALTER TABLE `tbl_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_quality`
--
ALTER TABLE `tbl_quality`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_season`
--
ALTER TABLE `tbl_season`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_series`
--
ALTER TABLE `tbl_series`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_smtp_settings`
--
ALTER TABLE `tbl_smtp_settings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_subtitles`
--
ALTER TABLE `tbl_subtitles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_video`
--
ALTER TABLE `tbl_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;