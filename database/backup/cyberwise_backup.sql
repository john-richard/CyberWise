--
-- PostgreSQL database dump
--

-- Dumped from database version 17.1
-- Dumped by pg_dump version 17.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Data for Name: categories; Type: TABLE DATA; Schema: forum; Owner: postgres
--

INSERT INTO forum.categories VALUES (1, 'General Discussion', 'General topics for conversation', '2024-11-26 21:27:17.695779', '2024-11-26 21:27:17.695779', true, true);
INSERT INTO forum.categories VALUES (3, 'Support', 'Discussion about forum help and technical support', '2024-11-26 21:27:17.695779', '2024-11-26 21:27:17.695779', true, true);
INSERT INTO forum.categories VALUES (4, 'Off-Topic', 'Casual discussions about anything not related to the forum topics', '2024-11-26 21:27:17.695779', '2024-11-26 21:27:17.695779', true, true);
INSERT INTO forum.categories VALUES (5, 'Suggestions', 'Ideas and suggestions for the forum', '2024-11-26 21:27:17.695779', '2024-11-26 21:27:17.695779', true, true);
INSERT INTO forum.categories VALUES (6, 'Featured Thread', 'Featured threads from other sources.', '2024-12-05 23:45:52.566997', '2024-12-05 23:45:52.566997', true, false);
INSERT INTO forum.categories VALUES (2, 'Announcements', 'Important updates and forum news', '2024-11-26 21:27:17.695779', '2024-11-26 21:27:17.695779', true, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: forum; Owner: postgres
--

INSERT INTO forum.users VALUES (7, 'pedropascal', 'pedropascal@mailinator.com', '$2y$12$YDNNyd/KGsu3H6KtfD7XMeQXFWMiXHXY.K.laQiU2tGOpfQWeP8I.', '2024-11-26 12:37:46', '2024-11-26 12:38:42', 1, 'Pedro', 'Pascal', 1, NULL, 'assets/img/avatar/em.jpg');
INSERT INTO forum.users VALUES (23, 'pyuser0003', 'pyuser0003@mailinator.com', '$2y$12$KVpE0r.EeNbRm7o4ZMBvTOpX3UAGnigwCVlnB09MXq2KkTCsopnkW', '2024-12-23 11:22:42', '2024-12-23 11:22:42', 2, NULL, NULL, 1, NULL, 'assets/img/avatar/8HTWND6aMl4dnLbnbMVKBG65b9p3x8ySGe8rA08p.jpg');
INSERT INTO forum.users VALUES (24, 'pyuser0004', 'pyuser0004@mailinator.com', '$2y$12$Xe17BEGpZbdbZX7d6XfXIu0B1li6nlGZfkM/lZ2w4EpvRWaeBM.Yi', '2024-12-23 11:23:27', '2024-12-23 11:23:27', 2, NULL, NULL, 1, NULL, 'assets/img/avatar/ssMNHQKOXtONexUNhXbqnKAu0Q4JX9e5ieu5f24K.png');
INSERT INTO forum.users VALUES (17, 'laraveluser001', 'laraveluser001@mailinator.com', '$2y$12$1VTs11wuEPi/7FRVDeGd6u7OQrvUvKcJDH4iQDMRqtGr4coXhWrsi', '2024-12-12 16:28:55', '2024-12-12 16:28:55', 2, NULL, NULL, 1, NULL, 'assets/img/avatar/IM.jpg');
INSERT INTO forum.users VALUES (21, 'pyuser0001', 'pyuser0001@mailinator.com', '$2y$12$YDNNyd/KGsu3H6KtfD7XMeQXFWMiXHXY.K.laQiU2tGOpfQWeP8I.', '2024-12-12 16:28:55', '2024-12-12 16:28:55', 2, NULL, NULL, 1, NULL, 'assets/img/avatar/av.jpg');
INSERT INTO forum.users VALUES (22, 'tes123', 'tes123@mailinator.com', '$2y$12$CjpUmEjrlcENygOzeqDz8eGISXS71yhpV/.EO8KbDGdGOe08nTL32', '2024-12-14 16:54:45', '2024-12-14 16:54:45', 2, NULL, NULL, 1, NULL, 'assets/img/avatar/I0lSD6dUVaH7xe69v88cVc7coNs9jjmZU4a9LJDf.jpg');
INSERT INTO forum.users VALUES (6, 'JaneDoo', 'janedoo@mailinator.com', '$2y$12$YDNNyd/KGsu3H6KtfD7XMeQXFWMiXHXY.K.laQiU2tGOpfQWeP8I.', '2024-11-26 10:18:57', '2024-11-26 10:32:37', 2, 'Jane', 'Doo', 0, '2024-11-26 10:35:37+08', 'assets/img/avatar/I0lSD6dUVaH7xe69v88cVc7coNs9jjmZU4a9LJDf.jpg');
INSERT INTO forum.users VALUES (8, 'janjeiar', 'janjeiar@mailinator.com', '$2y$12$YDNNyd/KGsu3H6KtfD7XMeQXFWMiXHXY.K.laQiU2tGOpfQWeP8I.', '2024-12-03 21:14:25', '2024-12-03 21:14:25', 1, NULL, NULL, 1, NULL, 'assets/img/avatar/I0lSD6dUVaH7xe69v88cVc7coNs9jjmZU4a9LJDf.jpg');
INSERT INTO forum.users VALUES (9, 'johnmango', 'johnmango@mailinator.com', '$2y$12$YDNNyd/KGsu3H6KtfD7XMeQXFWMiXHXY.K.laQiU2tGOpfQWeP8I.', '2024-12-04 15:39:35', '2024-12-04 15:39:35', 1, NULL, NULL, 1, NULL, 'assets/img/avatar/I0lSD6dUVaH7xe69v88cVc7coNs9jjmZU4a9LJDf.jpg');
INSERT INTO forum.users VALUES (15, 'janemango', 'janemango@mailinator.com', '$2y$12$bkg.WA9emHuM/af/UwLGVenuEeE9I6zKGOs.ebOZn6T5JbuyytAKG', '2024-12-04 16:12:17', '2024-12-04 16:12:17', 1, NULL, NULL, 1, NULL, 'assets/img/avatar/I0lSD6dUVaH7xe69v88cVc7coNs9jjmZU4a9LJDf.jpg');
INSERT INTO forum.users VALUES (16, 'qwerty123', 'qwerty123@mailinator.com', '$2y$12$X.YxyA2/pmDmAhmYfr/9Ku2J9iRLFvTKGWLvrSBxi.wJ/S3wqaAPy', '2024-12-09 14:14:47', '2024-12-09 14:14:47', 2, NULL, NULL, 1, NULL, 'assets/img/avatar/I0lSD6dUVaH7xe69v88cVc7coNs9jjmZU4a9LJDf.jpg');
INSERT INTO forum.users VALUES (5, 'johndee', 'johndee@mailinator.com', '$2y$12$YDNNyd/KGsu3H6KtfD7XMeQXFWMiXHXY.K.laQiU2tGOpfQWeP8I.', '2024-11-26 09:49:59', '2024-11-26 10:08:20', 2, 'Jan', 'Dee', 1, NULL, 'assets/img/avatar/qwerty1234.jpg');


--
-- Data for Name: threads; Type: TABLE DATA; Schema: forum; Owner: postgres
--

INSERT INTO forum.threads VALUES (21, 'How can I tell if a website is safe to use?', 5, '2024-12-28 09:24:14.822206', '2024-12-28 09:24:14.822206', true, 'Questions about identifying secure websites, recognizing HTTPS, and avoiding phishing sites.', false, NULL);
INSERT INTO forum.threads VALUES (13, 'One of the Best Post I Have Seen!', 7, '2024-11-29 21:59:08', '2024-11-29 21:59:08', false, NULL, false, NULL);
INSERT INTO forum.threads VALUES (14, 'AI and Machine Learning in Cybersecurity', 7, '2024-12-05 09:29:34', '2024-12-05 09:29:34', false, NULL, false, NULL);
INSERT INTO forum.threads VALUES (15, 'How to Protect Your Business from Ransomware Attacks', 7, '2024-12-05 09:37:26', '2024-12-05 09:37:26', false, NULL, false, NULL);
INSERT INTO forum.threads VALUES (16, 'The Importance of Multi-Factor Authentication (MFA)', 7, '2024-12-05 09:45:14', '2024-12-05 09:45:14', false, NULL, false, NULL);
INSERT INTO forum.threads VALUES (17, 'Securing the Internet of Things (IoT) in the Age of Connectivity', 7, '2024-12-05 09:48:24', '2024-12-05 09:48:24', false, NULL, false, NULL);
INSERT INTO forum.threads VALUES (18, 'Cloud Security: The Next Frontier', 7, '2024-12-05 09:50:58', '2024-12-05 09:50:58', false, NULL, false, NULL);
INSERT INTO forum.threads VALUES (19, 'This is now my sample thread!', 15, '2024-12-05 13:42:00', '2024-12-05 13:42:00', false, NULL, false, NULL);
INSERT INTO forum.threads VALUES (12, 'One of the Best Post I Have Seen!', 7, '2024-11-26 14:30:09', '2024-11-26 14:30:09', false, NULL, true, NULL);
INSERT INTO forum.threads VALUES (1, 'Welcome to the Forum!', 5, '2024-11-26 19:00:13.256222', '2024-11-26 19:00:13.256222', false, 'Discover a space to connect, share ideas, and grow with like-minded individuals. Dive into topics you love and start engaging today!', false, NULL);
INSERT INTO forum.threads VALUES (2, 'Forum Updates', 6, '2024-11-26 19:00:13.256222', '2024-11-26 19:00:13.256222', false, 'Stay in the loop with the latest improvements and exciting changes happening in our forum.', false, NULL);
INSERT INTO forum.threads VALUES (3, 'How to Get Help with Issues', 5, '2024-11-26 19:00:13.256222', '2024-11-26 19:00:13.256222', false, 'Stuck on a problem? Share your questions here, and let the community guide you to the solution!', false, NULL);
INSERT INTO forum.threads VALUES (5, 'Forum Feature Requests', 5, '2024-11-26 21:34:56.277262', '2024-11-26 21:34:56.277262', false, 'Got ideas to improve our forum? Share your thoughts and help shape the future of this community!', false, NULL);
INSERT INTO forum.threads VALUES (7, 'Getting Started with Featured Tools', 7, '2024-11-26 21:47:48.124454', '2024-11-26 21:47:48.124454', false, 'Maximize productivity by exploring our handpicked tools designed to simplify your workflow.', false, NULL);
INSERT INTO forum.threads VALUES (8, 'Testing and Debugging you Start-App', 7, '2024-11-26 21:47:48.124454', '2024-11-26 21:47:48.124454', false, 'Learn essential tips and tricks to efficiently test and debug your application before launch.', false, NULL);
INSERT INTO forum.threads VALUES (9, 'Mastering Skills with Featured Tools', 7, '2024-11-26 21:47:48.124454', '2024-11-26 21:47:48.124454', false, 'Elevate your expertise by leveraging tools that enhance learning and development.', false, NULL);
INSERT INTO forum.threads VALUES (10, 'Getting Started with RESTful APIs', 7, '2024-11-26 21:47:48.124454', '2024-11-26 21:47:48.124454', false, 'Dive into the world of APIs with this beginner-friendly guide to building and consuming RESTful services.', false, NULL);
INSERT INTO forum.threads VALUES (22, 'What should I do if I think my email has been hacked?', 24, '2024-12-28 09:27:19.769806', '2024-12-28 09:27:19.769806', true, 'Help for recovering a hacked email account, securing it, and preventing future incidents.', false, '[9, 15, 16, 17, 5, 21]');
INSERT INTO forum.threads VALUES (6, 'Kickstart Your Web App Development!', 7, '2024-11-26 21:47:48.124454', '2024-11-26 21:47:48.124454', false, 'Start building amazing web apps today with essential tips, tools, and guidance from the pros.', false, '[9, 15, 16, 17, 5, 21]');
INSERT INTO forum.threads VALUES (4, 'Why Cats are Better than Dogs', 5, '2024-12-21 03:34:56.277262', '2024-12-21 03:34:56.277262', false, 'Cats are independent yet affectionate companions with a knack for entertainment. Let’s dive into why they might just edge out dogs!', false, '[9, 15, 16, 17]');
INSERT INTO forum.threads VALUES (20, 'The Future of Cybersecurity: Trends You Need to Know', 15, '2024-12-05 15:47:35', '2024-12-05 15:47:35', true, NULL, false, NULL);
INSERT INTO forum.threads VALUES (23, 'Is it safe to use public Wi-fi, and how can I protect myself while using it?', 15, '2024-12-28 09:30:12.498008', '2025-01-02 01:48:09', true, 'What are the potential risks of connecting to unsecured networks in cafes or public spaces? Share tips on how to stay protected while browsing on public Wi-Fi.', false, '[9, 15, 16, 17, 21]');
INSERT INTO forum.threads VALUES (45, 'Unable to Access Corporate VPN After System Update', 17, '2024-12-28 16:23:32', '2025-01-01 07:32:28', true, 'After a recent system update, I can no longer access my company''s VPN. Has anyone faced similar issues, and what troubleshooting steps can I take to resolve this? Any help is appreciated!', false, '[21]');
INSERT INTO forum.threads VALUES (55, 'Best Practices for Protecting Personal Data on Social Media', 17, '2024-12-28 16:36:57', '2025-01-01 07:23:52', true, 'With more personal information being shared on social media, it''s important to safeguard privacy. What steps can individuals take to protect their data from cyber threats while still using social platforms? Share your top recommendations!', false, '[22, 23, 21]');


--
-- Data for Name: featured_threads; Type: TABLE DATA; Schema: forum; Owner: postgres
--

INSERT INTO forum.featured_threads VALUES (1, 20, 'AI and Machine Learning in Cybersecurity', 'AI and machine learning are revolutionizing cybersecurity by enabling faster detection and response to threats. These technologies will be critical in protecting against increasingly sophisticated cyberattacks.', true, 'https://kpmg.com/ch/en/insights/cybersecurity-risk/artificial-intelligence-influences.html', '2024-12-05 16:18:15', '2024-12-05 16:18:15', 1);
INSERT INTO forum.featured_threads VALUES (2, 20, 'How to Protect Your Business from Ransomware Attacks', 'Ransomware attacks are on the rise, targeting businesses of all sizes. Effective strategies, including regular backups and employee training, are essential for mitigating these threats.', true, 'https://www.cisa.gov/stopransomware/how-can-i-protect-against-ransomware', '2024-12-05 16:32:01', '2024-12-05 16:32:01', 1);
INSERT INTO forum.featured_threads VALUES (3, 20, 'The Importance of Multi-Factor Authentication (MFA)', 'Multi-factor authentication adds an extra layer of security to your accounts by requiring multiple forms of verification. This simple step can significantly reduce the risk of unauthorized access.', true, 'https://www.okta.com/identity-101/why-mfa-is-everywhere/', '2024-12-05 16:32:46', '2024-12-05 16:32:46', 1);
INSERT INTO forum.featured_threads VALUES (4, 20, 'Securing the Internet of Things (IoT) in the Age of Connectivity', 'As IoT devices become more widespread, they create new vulnerabilities for cybercriminals to exploit. Securing these devices will require new strategies and technologies.', true, 'https://www.pewresearch.org/internet/2017/06/06/the-internet-of-things-connectivity-binge-what-are-the-implications/', '2024-12-05 16:33:20', '2024-12-05 16:33:20', 1);
INSERT INTO forum.featured_threads VALUES (5, 20, 'Cloud Security: The Next Frontier', 'As organizations increasingly move to the cloud, securing sensitive data becomes critical. Future cloud security will focus on automation, encryption, and advanced identity management to safeguard against evolving threats.', true, 'https://valoremreply.com/resources/insights/blog/2024/august/the-next-frontier-of-cloud-computing-industry-cloud-platforms/', '2024-12-05 16:33:55', '2024-12-05 16:33:55', 1);


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: forum; Owner: postgres
--

INSERT INTO forum.migrations VALUES (1, '2024_12_02_022300_create_comments_table', 1);
INSERT INTO forum.migrations VALUES (2, '2019_12_14_000001_create_personal_access_tokens_table', 2);
INSERT INTO forum.migrations VALUES (3, '2024_12_03_122905_create_password_resets_table', 3);
INSERT INTO forum.migrations VALUES (4, '2024_12_13_232148_add_avatar_to_users_table', 4);
INSERT INTO forum.migrations VALUES (5, '2024_12_21_020023_add_views_column_to_threads_table', 5);


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: forum; Owner: postgres
--



--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: forum; Owner: postgres
--

INSERT INTO forum.personal_access_tokens VALUES (1, 'App\Models\User', 8, 'API Token', '5b30bb5129b3b7c1964071d091f9b1959b2646ed3f8ecd20896219d68092846b', '["*"]', NULL, NULL, '2024-12-03 21:41:02', '2024-12-03 21:41:02');
INSERT INTO forum.personal_access_tokens VALUES (2, 'App\Models\User', 8, 'API Token', '414b3ea1393f793a02025c57870b18b00aa31684f25ff5e6a1b63ae38da21e55', '["*"]', NULL, NULL, '2024-12-03 22:00:40', '2024-12-03 22:00:40');
INSERT INTO forum.personal_access_tokens VALUES (72, 'App\Models\User', 15, 'API Token', '5f063a4ca6a66ba2a7e8375c9c0a99f7cc7df29ffea26749c12659f8ffb5edca', '["*"]', NULL, NULL, '2024-12-30 17:31:55', '2024-12-30 17:31:55');
INSERT INTO forum.personal_access_tokens VALUES (73, 'App\Models\User', 15, 'API Token', '7b7aca2343baaacc962d009b4f044e3f84c6a4093f48773e54103d62382843b3', '["*"]', NULL, NULL, '2024-12-30 17:45:39', '2024-12-30 17:45:39');
INSERT INTO forum.personal_access_tokens VALUES (15, 'App\Models\User', 9, 'API Token', 'b892924c96d330e07775eff39cd9aa53b69de6403674e7f69f35c7ba0ddada13', '["*"]', NULL, NULL, '2024-12-04 15:39:36', '2024-12-04 15:39:36');
INSERT INTO forum.personal_access_tokens VALUES (16, 'App\Models\User', 10, 'API Token', '9974a0bf3b85dba69347db60fdcdd6bd3ced7f84ab8b37868335761213375811', '["*"]', NULL, NULL, '2024-12-04 15:52:30', '2024-12-04 15:52:30');
INSERT INTO forum.personal_access_tokens VALUES (17, 'App\Models\User', 11, 'API Token', '1c6376b4f4cd43cd36b8a8a9f929c46e9d3bfe9838f8beee782b91700b3e278f', '["*"]', NULL, NULL, '2024-12-04 15:58:00', '2024-12-04 15:58:00');
INSERT INTO forum.personal_access_tokens VALUES (19, 'App\Models\User', 12, 'API Token', 'a55f9c84cc8e504d47f679eba34346fc5ac77f31ce3c4e5d54000dfd661f4b96', '["*"]', NULL, NULL, '2024-12-04 16:03:08', '2024-12-04 16:03:08');
INSERT INTO forum.personal_access_tokens VALUES (20, 'App\Models\User', 13, 'API Token', 'c8472043a85d529ee0737350793fca8f29db0ae1e89333e578143c60be676095', '["*"]', NULL, NULL, '2024-12-04 16:04:39', '2024-12-04 16:04:39');
INSERT INTO forum.personal_access_tokens VALUES (22, 'App\Models\User', 14, 'API Token', 'bfbc37b5f30b8127a5ec6057d93a0dcfb12e7471c7b0ec36eb49580012e5060b', '["*"]', NULL, NULL, '2024-12-04 16:09:50', '2024-12-04 16:09:50');
INSERT INTO forum.personal_access_tokens VALUES (40, 'App\Models\User', 20, 'API Token', '0d1dc2aec5f5ec0e2367472e76cfce0cdb562409e1acd06262d03b988e8885b9', '["*"]', NULL, NULL, '2024-12-13 23:53:12', '2024-12-13 23:53:12');
INSERT INTO forum.personal_access_tokens VALUES (41, 'App\Models\User', 22, 'API Token', '6860be77dc0f357952dae0f98977fa5db5db7b3574a6c3b598df814798784759', '["*"]', NULL, NULL, '2024-12-14 16:54:45', '2024-12-14 16:54:45');
INSERT INTO forum.personal_access_tokens VALUES (53, 'App\Models\User', 23, 'API Token', 'b21f3eb4a2a05e1c904003ec81367320881714c6c5444786758dd1e5fca68e3d', '["*"]', NULL, NULL, '2024-12-23 11:22:42', '2024-12-23 11:22:42');
INSERT INTO forum.personal_access_tokens VALUES (54, 'App\Models\User', 24, 'API Token', '370c4ec59434842b183b2312b2b190c9f10f9b2cc06396b8abdd3a02cd0bc808', '["*"]', NULL, NULL, '2024-12-23 11:23:27', '2024-12-23 11:23:27');


--
-- Data for Name: posts; Type: TABLE DATA; Schema: forum; Owner: postgres
--

INSERT INTO forum.posts VALUES (2, 5, 5, 'Let''s discuss some cool topics.', '2024-12-30 18:32:36', '2024-12-30 18:32:36', NULL);
INSERT INTO forum.posts VALUES (19, 55, 15, 'Protecting personal data on social media starts with using strong, unique passwords and enabling two-factor authentication for added security. Be mindful of what you share publicly, and regularly review your privacy settings to control who can see your information.', '2024-12-31 16:36:57', '2024-12-31 16:36:57', NULL);
INSERT INTO forum.posts VALUES (20, 55, 5, 'Be cautious about accepting friend requests or messages from unknown users, as they may be phishing attempts. Regularly review and update your security settings to protect your account.', '2025-01-01 04:07:55', '2025-01-01 04:07:55', NULL);
INSERT INTO forum.posts VALUES (21, 55, 21, 'Regularly audit your connected apps and revoke access for those you no longer use. Ensure your social media activity doesn’t reveal information that could be used for identity theft.', '2025-01-01 05:51:03', '2025-01-01 05:51:03', NULL);
INSERT INTO forum.posts VALUES (1, 5, 7, 'Thank you for starting this forum!', '2024-12-30 16:36:57', '2024-12-30 16:36:57', NULL);


--
-- Data for Name: thread_categories; Type: TABLE DATA; Schema: forum; Owner: postgres
--

INSERT INTO forum.thread_categories VALUES (20, 6, '2024-12-05 23:49:07.962703', '2024-12-05 23:49:07.962703');
INSERT INTO forum.thread_categories VALUES (1, 2, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465');
INSERT INTO forum.thread_categories VALUES (2, 2, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465');
INSERT INTO forum.thread_categories VALUES (3, 3, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465');
INSERT INTO forum.thread_categories VALUES (4, 1, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465');
INSERT INTO forum.thread_categories VALUES (5, 5, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465');
INSERT INTO forum.thread_categories VALUES (6, 1, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465');
INSERT INTO forum.thread_categories VALUES (7, 1, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465');
INSERT INTO forum.thread_categories VALUES (8, 1, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465');
INSERT INTO forum.thread_categories VALUES (9, 1, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465');
INSERT INTO forum.thread_categories VALUES (10, 1, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465');
INSERT INTO forum.thread_categories VALUES (12, 4, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465');
INSERT INTO forum.thread_categories VALUES (13, 4, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465');
INSERT INTO forum.thread_categories VALUES (23, 3, '2024-12-28 09:36:27.559955', '2024-12-28 09:36:27.559955');
INSERT INTO forum.thread_categories VALUES (22, 1, '2024-12-28 09:36:27.559955', '2024-12-28 09:36:27.559955');
INSERT INTO forum.thread_categories VALUES (21, 1, '2024-12-28 09:36:27.559955', '2024-12-28 09:36:27.559955');
INSERT INTO forum.thread_categories VALUES (45, 3, '2024-12-28 14:23:32.577288', '2024-12-28 14:23:32.577288');
INSERT INTO forum.thread_categories VALUES (55, 1, '2024-12-28 14:36:57.736001', '2024-12-28 14:36:57.736001');


--
-- Data for Name: top_posts; Type: TABLE DATA; Schema: forum; Owner: postgres
--

INSERT INTO forum.top_posts VALUES (9, 'One of the Best Post I Have Seen!', 'https://oneofthebestpost.com', 'This is a sample description for the featured post - one of the best.', false, '2024-11-29 21:59:09', '2024-11-29 21:59:09', '2024-11-29 21:59:29');
INSERT INTO forum.top_posts VALUES (8, 'One of the Best Post I Have Seen!', 'https://oneofthebestpost.com', 'This is a sample description for the featured post - one of the best.', false, '2024-11-26 14:30:09', '2024-11-26 14:30:09', NULL);
INSERT INTO forum.top_posts VALUES (2, 'How to Build a Simple Web App', 'https://example.com/web-app-guide', 'A detailed tutorial on building a Laravel web app.', false, '2024-11-26 21:54:51.641315', '2024-11-26 21:54:51.641315', NULL);
INSERT INTO forum.top_posts VALUES (3, 'Introduction to Laravel Eloquent ORM', 'https://example.com/eloquent-orm', 'Learn how to use Laravel Eloquent ORM effectively.', false, '2024-11-26 21:54:51.641315', '2024-11-26 21:54:51.641315', NULL);
INSERT INTO forum.top_posts VALUES (4, 'Tips for Debugging in PHP', 'https://example.com/debugging-php', 'Practical tips for debugging your PHP applications.', false, '2024-11-26 21:54:51.641315', '2024-11-26 21:54:51.641315', NULL);
INSERT INTO forum.top_posts VALUES (5, 'Advanced Laravel Features', 'https://example.com/advanced-laravel', 'In-depth exploration of advanced Laravel features.', false, '2024-11-26 21:54:51.641315', '2024-11-26 21:54:51.641315', NULL);
INSERT INTO forum.top_posts VALUES (6, 'Building RESTful APIs with Laravel', 'https://example.com/building-apis', 'A guide to creating RESTful APIs with Laravel.', false, '2024-11-26 21:54:51.641315', '2024-11-26 21:54:51.641315', NULL);
INSERT INTO forum.top_posts VALUES (10, 'AI and Machine Learning in Cybersecurity', 'https://kpmg.com/ch/en/insights/cybersecurity-risk/artificial-intelligence-influences.html', 'AI and machine learning are revolutionizing cybersecurity by enabling faster detection and response to threats. These technologies will be critical in protecting against increasingly sophisticated cyberattacks.', true, '2024-12-05 09:29:34', '2024-12-05 09:29:34', NULL);
INSERT INTO forum.top_posts VALUES (11, 'How to Protect Your Business from Ransomware Attacks', 'https://www.cisa.gov/stopransomware/how-can-i-protect-against-ransomware', 'Ransomware attacks are on the rise, targeting businesses of all sizes. Effective strategies, including regular backups and employee training, are essential for mitigating these threats.', true, '2024-12-05 09:37:26', '2024-12-05 09:37:26', NULL);
INSERT INTO forum.top_posts VALUES (12, 'The Importance of Multi-Factor Authentication (MFA)', 'https://www.okta.com/identity-101/why-mfa-is-everywhere/', 'Multi-factor authentication adds an extra layer of security to your accounts by requiring multiple forms of verification. This simple step can significantly reduce the risk of unauthorized access.', true, '2024-12-05 09:45:14', '2024-12-05 09:45:14', NULL);
INSERT INTO forum.top_posts VALUES (13, 'Securing the Internet of Things (IoT) in the Age of Connectivity', 'https://www.pewresearch.org/internet/2017/06/06/the-internet-of-things-connectivity-binge-what-are-the-implications/', 'As IoT devices become more widespread, they create new vulnerabilities for cybercriminals to exploit. Securing these devices will require new strategies and technologies.', true, '2024-12-05 09:48:24', '2024-12-05 09:48:24', NULL);
INSERT INTO forum.top_posts VALUES (14, 'Cloud Security: The Next Frontier', 'https://valoremreply.com/resources/insights/blog/2024/august/the-next-frontier-of-cloud-computing-industry-cloud-platforms/', 'As organizations increasingly move to the cloud, securing sensitive data becomes critical. Future cloud security will focus on automation, encryption, and advanced identity management to safeguard against evolving threats.', true, '2024-12-05 09:50:58', '2024-12-05 09:50:58', NULL);


--
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: forum; Owner: postgres
--

SELECT pg_catalog.setval('forum.categories_id_seq', 1, true);


--
-- Name: featured_posts_id_seq1; Type: SEQUENCE SET; Schema: forum; Owner: postgres
--

SELECT pg_catalog.setval('forum.featured_posts_id_seq1', 5, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: forum; Owner: postgres
--

SELECT pg_catalog.setval('forum.migrations_id_seq', 5, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: forum; Owner: postgres
--

SELECT pg_catalog.setval('forum.personal_access_tokens_id_seq', 78, true);


--
-- Name: posts_id_seq; Type: SEQUENCE SET; Schema: forum; Owner: postgres
--

SELECT pg_catalog.setval('forum.posts_id_seq', 21, true);


--
-- Name: threads_id_seq; Type: SEQUENCE SET; Schema: forum; Owner: postgres
--

SELECT pg_catalog.setval('forum.threads_id_seq', 57, true);


--
-- Name: top_posts_id_seq; Type: SEQUENCE SET; Schema: forum; Owner: postgres
--

SELECT pg_catalog.setval('forum.top_posts_id_seq', 14, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: forum; Owner: postgres
--

SELECT pg_catalog.setval('forum.users_id_seq', 24, true);


--
-- PostgreSQL database dump complete
--

