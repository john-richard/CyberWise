--
-- PostgreSQL database dump
--

-- Dumped from database version 17.2
-- Dumped by pg_dump version 17.2

-- Started on 2025-07-12 13:01:10

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

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 217 (class 1259 OID 16389)
-- Name: categories; Type: TABLE; Schema: forum; Owner: -
--

CREATE TABLE forum.categories (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    description text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    status boolean DEFAULT true NOT NULL,
    community_display boolean DEFAULT true NOT NULL
);


--
-- TOC entry 218 (class 1259 OID 16398)
-- Name: categories_id_seq; Type: SEQUENCE; Schema: forum; Owner: -
--

CREATE SEQUENCE forum.categories_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4931 (class 0 OID 0)
-- Dependencies: 218
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: forum; Owner: -
--

ALTER SEQUENCE forum.categories_id_seq OWNED BY forum.categories.id;


--
-- TOC entry 219 (class 1259 OID 16399)
-- Name: featured_threads; Type: TABLE; Schema: forum; Owner: -
--

CREATE TABLE forum.featured_threads (
    id integer NOT NULL,
    thread_id integer,
    title character varying(255) NOT NULL,
    content text,
    status boolean DEFAULT true,
    link character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    "order" integer DEFAULT 1 NOT NULL,
    metadata jsonb,
    search_vector tsvector GENERATED ALWAYS AS (to_tsvector('english'::regconfig, (((COALESCE(title, ''::character varying))::text || ' '::text) || COALESCE(content, ''::text)))) STORED
);


--
-- TOC entry 220 (class 1259 OID 16408)
-- Name: featured_posts_id_seq1; Type: SEQUENCE; Schema: forum; Owner: -
--

CREATE SEQUENCE forum.featured_posts_id_seq1
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4932 (class 0 OID 0)
-- Dependencies: 220
-- Name: featured_posts_id_seq1; Type: SEQUENCE OWNED BY; Schema: forum; Owner: -
--

ALTER SEQUENCE forum.featured_posts_id_seq1 OWNED BY forum.featured_threads.id;


--
-- TOC entry 221 (class 1259 OID 16409)
-- Name: migrations; Type: TABLE; Schema: forum; Owner: -
--

CREATE TABLE forum.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


--
-- TOC entry 222 (class 1259 OID 16412)
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: forum; Owner: -
--

CREATE SEQUENCE forum.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4933 (class 0 OID 0)
-- Dependencies: 222
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: forum; Owner: -
--

ALTER SEQUENCE forum.migrations_id_seq OWNED BY forum.migrations.id;


--
-- TOC entry 223 (class 1259 OID 16413)
-- Name: password_resets; Type: TABLE; Schema: forum; Owner: -
--

CREATE TABLE forum.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


--
-- TOC entry 224 (class 1259 OID 16418)
-- Name: personal_access_tokens; Type: TABLE; Schema: forum; Owner: -
--

CREATE TABLE forum.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- TOC entry 225 (class 1259 OID 16423)
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: forum; Owner: -
--

CREATE SEQUENCE forum.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4934 (class 0 OID 0)
-- Dependencies: 225
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: forum; Owner: -
--

ALTER SEQUENCE forum.personal_access_tokens_id_seq OWNED BY forum.personal_access_tokens.id;


--
-- TOC entry 226 (class 1259 OID 16424)
-- Name: posts; Type: TABLE; Schema: forum; Owner: -
--

CREATE TABLE forum.posts (
    id integer NOT NULL,
    thread_id integer,
    user_id integer,
    content text NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    deleted_at timestamp without time zone
);


--
-- TOC entry 227 (class 1259 OID 16431)
-- Name: posts_id_seq; Type: SEQUENCE; Schema: forum; Owner: -
--

CREATE SEQUENCE forum.posts_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4935 (class 0 OID 0)
-- Dependencies: 227
-- Name: posts_id_seq; Type: SEQUENCE OWNED BY; Schema: forum; Owner: -
--

ALTER SEQUENCE forum.posts_id_seq OWNED BY forum.posts.id;


--
-- TOC entry 228 (class 1259 OID 16432)
-- Name: thread_categories; Type: TABLE; Schema: forum; Owner: -
--

CREATE TABLE forum.thread_categories (
    thread_id integer NOT NULL,
    category_id integer NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- TOC entry 229 (class 1259 OID 16437)
-- Name: threads; Type: TABLE; Schema: forum; Owner: -
--

CREATE TABLE forum.threads (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    user_id integer,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    status boolean DEFAULT true NOT NULL,
    content text,
    closed boolean DEFAULT false NOT NULL,
    views jsonb,
    search_vector tsvector GENERATED ALWAYS AS (to_tsvector('english'::regconfig, (((COALESCE(title, ''::character varying))::text || ' '::text) || COALESCE(content, ''::text)))) STORED
);


--
-- TOC entry 230 (class 1259 OID 16446)
-- Name: threads_id_seq; Type: SEQUENCE; Schema: forum; Owner: -
--

CREATE SEQUENCE forum.threads_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4936 (class 0 OID 0)
-- Dependencies: 230
-- Name: threads_id_seq; Type: SEQUENCE OWNED BY; Schema: forum; Owner: -
--

ALTER SEQUENCE forum.threads_id_seq OWNED BY forum.threads.id;


--
-- TOC entry 231 (class 1259 OID 16447)
-- Name: top_posts; Type: TABLE; Schema: forum; Owner: -
--

CREATE TABLE forum.top_posts (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    link character varying(255) NOT NULL,
    description text,
    status boolean DEFAULT true,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    deleted_at timestamp without time zone
);


--
-- TOC entry 232 (class 1259 OID 16455)
-- Name: top_posts_id_seq; Type: SEQUENCE; Schema: forum; Owner: -
--

CREATE SEQUENCE forum.top_posts_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4937 (class 0 OID 0)
-- Dependencies: 232
-- Name: top_posts_id_seq; Type: SEQUENCE OWNED BY; Schema: forum; Owner: -
--

ALTER SEQUENCE forum.top_posts_id_seq OWNED BY forum.top_posts.id;


--
-- TOC entry 233 (class 1259 OID 16456)
-- Name: users; Type: TABLE; Schema: forum; Owner: -
--

CREATE TABLE forum.users (
    id integer NOT NULL,
    username character varying(100) NOT NULL,
    email character varying(150) NOT NULL,
    password character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    role smallint DEFAULT 2 NOT NULL,
    first_name character varying(100),
    last_name character varying(100),
    status smallint DEFAULT 1 NOT NULL,
    deleted_at timestamp with time zone,
    avatar character varying(255),
    metadata jsonb
);


--
-- TOC entry 234 (class 1259 OID 16465)
-- Name: users_id_seq; Type: SEQUENCE; Schema: forum; Owner: -
--

CREATE SEQUENCE forum.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4938 (class 0 OID 0)
-- Dependencies: 234
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: forum; Owner: -
--

ALTER SEQUENCE forum.users_id_seq OWNED BY forum.users.id;


--
-- TOC entry 4728 (class 2604 OID 16466)
-- Name: categories id; Type: DEFAULT; Schema: forum; Owner: -
--

ALTER TABLE ONLY forum.categories ALTER COLUMN id SET DEFAULT nextval('forum.categories_id_seq'::regclass);


--
-- TOC entry 4733 (class 2604 OID 16467)
-- Name: featured_threads id; Type: DEFAULT; Schema: forum; Owner: -
--

ALTER TABLE ONLY forum.featured_threads ALTER COLUMN id SET DEFAULT nextval('forum.featured_posts_id_seq1'::regclass);


--
-- TOC entry 4739 (class 2604 OID 16468)
-- Name: migrations id; Type: DEFAULT; Schema: forum; Owner: -
--

ALTER TABLE ONLY forum.migrations ALTER COLUMN id SET DEFAULT nextval('forum.migrations_id_seq'::regclass);


--
-- TOC entry 4740 (class 2604 OID 16469)
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: forum; Owner: -
--

ALTER TABLE ONLY forum.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('forum.personal_access_tokens_id_seq'::regclass);


--
-- TOC entry 4741 (class 2604 OID 16470)
-- Name: posts id; Type: DEFAULT; Schema: forum; Owner: -
--

ALTER TABLE ONLY forum.posts ALTER COLUMN id SET DEFAULT nextval('forum.posts_id_seq'::regclass);


--
-- TOC entry 4746 (class 2604 OID 16471)
-- Name: threads id; Type: DEFAULT; Schema: forum; Owner: -
--

ALTER TABLE ONLY forum.threads ALTER COLUMN id SET DEFAULT nextval('forum.threads_id_seq'::regclass);


--
-- TOC entry 4752 (class 2604 OID 16472)
-- Name: top_posts id; Type: DEFAULT; Schema: forum; Owner: -
--

ALTER TABLE ONLY forum.top_posts ALTER COLUMN id SET DEFAULT nextval('forum.top_posts_id_seq'::regclass);


--
-- TOC entry 4756 (class 2604 OID 16473)
-- Name: users id; Type: DEFAULT; Schema: forum; Owner: -
--

ALTER TABLE ONLY forum.users ALTER COLUMN id SET DEFAULT nextval('forum.users_id_seq'::regclass);


--
-- TOC entry 4908 (class 0 OID 16389)
-- Dependencies: 217
-- Data for Name: categories; Type: TABLE DATA; Schema: forum; Owner: -
--

INSERT INTO forum.categories VALUES (1, 'General Discussion', 'General topics for conversation', '2024-11-26 21:27:17.695779', '2024-11-26 21:27:17.695779', true, true) ON CONFLICT DO NOTHING;
INSERT INTO forum.categories VALUES (3, 'Support', 'Discussion about forum help and technical support', '2024-11-26 21:27:17.695779', '2024-11-26 21:27:17.695779', true, true) ON CONFLICT DO NOTHING;
INSERT INTO forum.categories VALUES (4, 'Off-Topic', 'Casual discussions about anything not related to the forum topics', '2024-11-26 21:27:17.695779', '2024-11-26 21:27:17.695779', true, true) ON CONFLICT DO NOTHING;
INSERT INTO forum.categories VALUES (5, 'Suggestions', 'Ideas and suggestions for the forum', '2024-11-26 21:27:17.695779', '2024-11-26 21:27:17.695779', true, true) ON CONFLICT DO NOTHING;
INSERT INTO forum.categories VALUES (6, 'Featured Thread', 'Featured threads from other sources.', '2024-12-05 23:45:52.566997', '2024-12-05 23:45:52.566997', true, false) ON CONFLICT DO NOTHING;
INSERT INTO forum.categories VALUES (2, 'Announcements', 'Important updates and forum news', '2024-11-26 21:27:17.695779', '2024-11-26 21:27:17.695779', true, true) ON CONFLICT DO NOTHING;
INSERT INTO forum.categories VALUES (7, 'Learning Hub', 'Learning Hub offers concise topics on cybersecurity with links to trusted resources for in-depth learning.', '2025-01-19 10:52:08.95325', '2025-01-19 10:52:08.95325', true, false) ON CONFLICT DO NOTHING;
INSERT INTO forum.categories VALUES (8, 'Test Your Knowledge', 'Test your knowledge questionaires.', '2025-02-03 20:28:29.215963', '2025-02-03 20:28:29.215963', true, false) ON CONFLICT DO NOTHING;
INSERT INTO forum.categories VALUES (9, 'Self Assessment', 'Self assessment questionaires.', '2025-06-29 20:58:14.166116', '2025-06-29 20:58:14.166116', true, false) ON CONFLICT DO NOTHING;


--
-- TOC entry 4910 (class 0 OID 16399)
-- Dependencies: 219
-- Data for Name: featured_threads; Type: TABLE DATA; Schema: forum; Owner: -
--

INSERT INTO forum.featured_threads VALUES (21, 57, 'What does a firewall do?', 'NULL', true, 'NULL', '2025-02-04 00:49:27', '2025-02-04 00:49:27', 1, '{"answer": "a", "choices": {"a": "Blocks unauthorized access to a network", "b": "Sets hackers` keyboards on fire when they try to break in", "c": "Stops viruses by spraying them with digital water", "d": "Allows only really good hackers to get through"}}', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (2, 20, 'How to Protect Your Business from Ransomware Attacks', 'Ransomware attacks are on the rise, targeting businesses of all sizes. Effective strategies, including regular backups and employee training, are essential for mitigating these threats.', false, 'https://www.cisa.gov/stopransomware/how-can-i-protect-against-ransomware', '2024-12-05 16:32:01', '2025-03-30 12:31:17', 1, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (12, 20, 'ABS-CBN: Spot the Scam to Stop the Scam | Safety Tips', 'A public service video by ABS-CBN featuring BINI, educating viewers on spotting and avoiding social media scams through practical advice.', false, 'https://www.youtube.com/watch?v=wxXukOJ0tOs', '2025-01-24 23:06:00', '2025-04-01 10:28:57', 5, '{"icon": "bi-cash-coin"}', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (3, 20, 'The Importance of Multi-Factor Authentication (MFA)', 'Multi-factor authentication adds an extra layer of security to your accounts by requiring multiple forms of verification. This simple step can significantly reduce the risk of unauthorized access.', false, 'https://www.okta.com/identity-101/why-mfa-is-everywhere/', '2024-12-05 16:32:46', '2025-03-30 12:32:15', 1, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (18, 57, 'Which of these is a strong password?', 'NULL', true, 'NULL', '2025-02-03 23:26:08', '2025-02-03 23:26:08', 1, '{"answer": "c", "choices": {"a": "123456789 (No one would ever guess something so obvious, right?)", "b": "Password123 (It has numbers, so it must be good!)", "c": "Xy9!$mQb72* (Your keyboard just had a workout.)", "d": "Your pet’s name + birth year (Fluffy2015—unstoppable!)"}}', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (6, 20, 'ABS-CBN: Spot the Scam to Stop the Scam | Deepfake Scam', 'Is a public service announcement by ABS-CBN featuring Robi Domingo and Maymay Entrata. Part of ABS-CBN''s "Spot the Scam" campaign launched in September 2024, the video educates viewers on identifying and avoiding deepfake scams—manipulated digital content designed to deceive. Robi and Maymay provide practical tips, such as verifying the legitimacy of sources and observing inconsistencies in digital content, to help the public protect themselves from online fraud.', false, 'https://www.youtube.com/watch?v=6uD1Kl50wLE&t=27s', '2025-01-24 19:20:28.528844', '2025-04-01 10:28:02', 1, '{"icon": "bi-shield-lock"}', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (13, 56, 'Unveiling the Vulnerabilities in Wireless Mobile Data Exchange', 'In today’s fast-paced digital era, the convenience of wireless mobile data exchange has revolutionized the way we communicate and access information.', true, 'https://cybersuraksa.medium.com/unveiling-the-vulnerabilities-in-wireless-mobile-data-exchange-41daf7e1ee7d', '2025-01-25 12:05:51', '2025-01-25 12:05:51', 1, '{"icon": "bi-cloud-upload"}', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (14, 56, 'Importance of cybersecurity around mobile', 'We are invaded by cyberattacks, digital hijackings and ransonware, terms that a few years ago still sounded like action, fiction or spy movies to us. Did you know that many of these vulnerabilities and risks travel with us in the palm of our hand?', true, 'https://a3sec.com/en/blog/importance-of-cybersecurity-around-mobile?utm_source=chatgpt.com', '2025-01-25 12:12:58', '2025-01-25 12:12:58', 1, '{"icon": "bi-file-lock"}', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (19, 57, 'What does a VPN do?', 'NULL', true, 'NULL', '2025-02-03 23:27:38', '2025-02-03 23:27:38', 1, '{"answer": "a", "choices": {"a": "Hides your IP address and encrypts your internet traffic", "b": "Makes your Wi-Fi signal stronger", "c": "Lets you see into the \"dark web\" like a hacker spy", "d": "Automatically generates cat memes while you browse"}}', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (20, 57, 'What is two-factor authentication (2FA)?', 'NULL', true, 'NULL', '2025-02-03 23:30:41', '2025-02-04 00:42:53', 1, '{"answer": "a", "choices": {"a": "Logging in twice just to be extra sure", "b": "A way to verify your identity using two different methods", "c": "When your computer asks if you`re really sure you want to continue", "d": "A sequel to One-Factor Authentication that nobody asked for"}}', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (17, 57, 'What does phishing refer to?', 'NULL', true, 'NULL', '2025-02-03 14:12:15', '2025-02-04 00:48:14', 1, '{"answer": "a", "choices": {"a": "A sport where hackers try to catch passwords instead of fish", "b": "A virus that makes your computer smell like tuna", "c": "A type of firewall that only works underwater", "d": "A security software designed by a band from the `90s"}}', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (22, 57, 'What is ransomware?', 'NULL', true, 'NULL', '2025-02-04 00:56:23', '2025-02-04 00:56:23', 1, '{"answer": "a", "choices": {"a": "A type of malware that locks your files until you pay a ransom", "b": "A computer program that helps locate kidnapped data", "c": "A game where hackers role-play as pirates", "d": "A new form of online shopping that requires a treasure hunt"}}', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (23, 57, 'What is social engineering in cybersecurity?', 'NULL', true, 'NULL', '2025-02-05 01:20:20', '2025-02-05 01:20:20', 1, '{"answer": "b", "choices": {"a": "A way to build a friendly internet community", "b": "Hacking people instead of computers by tricking them into giving information", "c": "Using AI to design cybersecurity software", "d": "Making sure all engineers have social skills"}}', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (4, 20, 'Securing the Internet of Things (IoT) in the Age of Connectivity', 'As IoT devices become more widespread, they create new vulnerabilities for cybercriminals to exploit. Securing these devices will require new strategies and technologies.', false, 'https://www.pewresearch.org/internet/2017/06/06/the-internet-of-things-connectivity-binge-what-are-the-implications/', '2024-12-05 16:33:20', '2025-03-30 12:32:19', 1, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (5, 20, 'Cloud Security: The Next Frontier', 'As organizations increasingly move to the cloud, securing sensitive data becomes critical. Future cloud security will focus on automation, encryption, and advanced identity management to safeguard against evolving threats.', false, 'https://valoremreply.com/resources/insights/blog/2024/august/the-next-frontier-of-cloud-computing-industry-cloud-platforms/', '2024-12-05 16:33:55', '2025-03-30 12:32:23', 1, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (1, 20, 'AI And Machine Learning in Cybersecurity', 'AI and machine learning are revolutionizing cybersecurity by enabling faster detection and response to threats. These technologies will be critical in protecting against increasingly sophisticated cyberattacks.', false, 'https://kpmg.com/ch/en/insights/cybersecurity-risk/artificial-intelligence-influences.html', '2024-12-05 16:18:15', '2025-03-30 12:32:33', 1, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (24, 57, 'What is a brute force attack?', 'NULL', true, 'NULL', '2025-02-05 01:21:38', '2025-02-23 12:38:33', 1, '{"answer": "d", "choices": {"a": "The reason why IT people cry at night", "b": "A cyber ninja move only the best hackers can perform", "c": "A feature that lets you bypass CAPTCHA", "d": "A hacker using trial and error to guess passwords"}}', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (13, 20, 'How to Spot a Scam', 'With the three golden rules: Slow it Down, Spot Check and Stop! Don’t Send, ScamsSpotter.org offers easy-to-follow help to prevent cybercrime.', true, 'https://www.youtube.com/watch?v=iRLYKjHmSyY', '2025-03-30 12:35:19', '2025-03-30 12:35:19', 1, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (12, 20, 'ABS-CBN: Spot the Scam to Stop the Scam | Safety Tips', 'A public service video by ABS-CBN featuring BINI, educating viewers on spotting and avoiding social media scams through practical advice.', false, 'https://www.youtube.com/watch?v=wxXukOJ0tOs', '2025-03-30 12:34:38', '2025-04-01 10:28:57', 1, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (14, 20, 'How to spot Deepfake Scam', 'ABS-CBN video educates viewers on spotting and avoiding deepfake scams.', true, 'https://www.youtube.com/watch?v=6uD1Kl50wLE&t=27s', '2025-04-01 10:30:33', '2025-04-01 10:30:33', 1, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (6, 20, 'ABS-CBN: Spot the Scam to Stop the Scam | Deepfake Scam', 'Is a public service announcement by ABS-CBN featuring Robi Domingo and Maymay Entrata. Part of ABS-CBN''s "Spot the Scam" campaign launched in September 2024, the video educates viewers on identifying and avoiding deepfake scams—manipulated digital content designed to deceive. Robi and Maymay provide practical tips, such as verifying the legitimacy of sources and observing inconsistencies in digital content, to help the public protect themselves from online fraud.', false, 'https://www.youtube.com/watch?v=6uD1Kl50wLE&t=27s', '2025-03-30 11:28:13', '2025-04-01 10:28:02', 1, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (7, 20, 'Ways to Identify an Impersonation Scam', 'ABS-CBN video with Andrea Brillantes educates viewers on identifying impersonation scams.', false, 'https://www.youtube.com/watch?v=b-SAD7v0ATE', '2025-01-24 21:13:29', '2025-04-01 10:31:18', 2, '{"icon": "bi-list-check"}', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (7, 20, 'Ways to Identify an Impersonation Scam', 'ABS-CBN video with Andrea Brillantes educates viewers on identifying impersonation scams.', true, 'https://www.youtube.com/watch?v=b-SAD7v0ATE', '2025-03-30 11:36:44', '2025-04-01 10:31:18', 1, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (11, 20, 'How to Recognize and Avoid Piracy Scams', 'ABS-CBN video with Kyle Echarri warns about risks of pirated content.', true, 'https://www.youtube.com/watch?v=qP8ZO81ihvU', '2025-03-30 12:34:03', '2025-04-01 10:32:35', 1, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (15, 20, 'Safety Tips: Spot and Stop Online Scams', 'ABS-CBN''s "Spot the Scam to Stop the Scam" video series features Kapamilya stars providing safety tips to help viewers recognize and avoid online scams, promoting vigilance and data security.', true, 'https://www.youtube.com/watch?v=wxXukOJ0tOs', '2025-04-01 10:34:13', '2025-04-01 10:34:13', 1, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.featured_threads VALUES (16, 56, 'Stay Protected With the Windows Security App', 'The Windows Security app is a comprehensive security solution integrated into Windows, designed to protect your device and data from various threats. It includes features such as Microsoft Defender Antivirus, Windows Firewall, and Smart App Control, which work together to provide real-time protection against viruses, malware, and other security threats. The app is built into Windows, ensuring that your device is protected from the moment you start it up.', true, 'https://support.microsoft.com/en-us/windows/stay-protected-with-the-windows-security-app-2ae0363d-0ada-c064-8b56-6a39afb6a963', '2025-06-29 12:29:22', '2025-06-29 12:29:22', 1, NULL, DEFAULT) ON CONFLICT DO NOTHING;


--
-- TOC entry 4912 (class 0 OID 16409)
-- Dependencies: 221
-- Data for Name: migrations; Type: TABLE DATA; Schema: forum; Owner: -
--

INSERT INTO forum.migrations VALUES (1, '2024_12_02_022300_create_comments_table', 1) ON CONFLICT DO NOTHING;
INSERT INTO forum.migrations VALUES (2, '2019_12_14_000001_create_personal_access_tokens_table', 2) ON CONFLICT DO NOTHING;
INSERT INTO forum.migrations VALUES (3, '2024_12_03_122905_create_password_resets_table', 3) ON CONFLICT DO NOTHING;
INSERT INTO forum.migrations VALUES (4, '2024_12_13_232148_add_avatar_to_users_table', 4) ON CONFLICT DO NOTHING;
INSERT INTO forum.migrations VALUES (5, '2024_12_21_020023_add_views_column_to_threads_table', 5) ON CONFLICT DO NOTHING;


--
-- TOC entry 4914 (class 0 OID 16413)
-- Dependencies: 223
-- Data for Name: password_resets; Type: TABLE DATA; Schema: forum; Owner: -
--

INSERT INTO forum.password_resets VALUES ('janemango@mailinator.com', '$2y$12$GwDnWEMaW.RnxfK89yoyyOyLBmYo7REqGgkOOV875v/4b0HOSn6lC', '2025-02-23 14:08:32') ON CONFLICT DO NOTHING;


--
-- TOC entry 4915 (class 0 OID 16418)
-- Dependencies: 224
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: forum; Owner: -
--

INSERT INTO forum.personal_access_tokens VALUES (1, 'App\Models\User', 8, 'API Token', '5b30bb5129b3b7c1964071d091f9b1959b2646ed3f8ecd20896219d68092846b', '["*"]', NULL, NULL, '2024-12-03 21:41:02', '2024-12-03 21:41:02') ON CONFLICT DO NOTHING;
INSERT INTO forum.personal_access_tokens VALUES (2, 'App\Models\User', 8, 'API Token', '414b3ea1393f793a02025c57870b18b00aa31684f25ff5e6a1b63ae38da21e55', '["*"]', NULL, NULL, '2024-12-03 22:00:40', '2024-12-03 22:00:40') ON CONFLICT DO NOTHING;
INSERT INTO forum.personal_access_tokens VALUES (15, 'App\Models\User', 9, 'API Token', 'b892924c96d330e07775eff39cd9aa53b69de6403674e7f69f35c7ba0ddada13', '["*"]', NULL, NULL, '2024-12-04 15:39:36', '2024-12-04 15:39:36') ON CONFLICT DO NOTHING;
INSERT INTO forum.personal_access_tokens VALUES (16, 'App\Models\User', 10, 'API Token', '9974a0bf3b85dba69347db60fdcdd6bd3ced7f84ab8b37868335761213375811', '["*"]', NULL, NULL, '2024-12-04 15:52:30', '2024-12-04 15:52:30') ON CONFLICT DO NOTHING;
INSERT INTO forum.personal_access_tokens VALUES (17, 'App\Models\User', 11, 'API Token', '1c6376b4f4cd43cd36b8a8a9f929c46e9d3bfe9838f8beee782b91700b3e278f', '["*"]', NULL, NULL, '2024-12-04 15:58:00', '2024-12-04 15:58:00') ON CONFLICT DO NOTHING;
INSERT INTO forum.personal_access_tokens VALUES (19, 'App\Models\User', 12, 'API Token', 'a55f9c84cc8e504d47f679eba34346fc5ac77f31ce3c4e5d54000dfd661f4b96', '["*"]', NULL, NULL, '2024-12-04 16:03:08', '2024-12-04 16:03:08') ON CONFLICT DO NOTHING;
INSERT INTO forum.personal_access_tokens VALUES (20, 'App\Models\User', 13, 'API Token', 'c8472043a85d529ee0737350793fca8f29db0ae1e89333e578143c60be676095', '["*"]', NULL, NULL, '2024-12-04 16:04:39', '2024-12-04 16:04:39') ON CONFLICT DO NOTHING;
INSERT INTO forum.personal_access_tokens VALUES (22, 'App\Models\User', 14, 'API Token', 'bfbc37b5f30b8127a5ec6057d93a0dcfb12e7471c7b0ec36eb49580012e5060b', '["*"]', NULL, NULL, '2024-12-04 16:09:50', '2024-12-04 16:09:50') ON CONFLICT DO NOTHING;
INSERT INTO forum.personal_access_tokens VALUES (40, 'App\Models\User', 20, 'API Token', '0d1dc2aec5f5ec0e2367472e76cfce0cdb562409e1acd06262d03b988e8885b9', '["*"]', NULL, NULL, '2024-12-13 23:53:12', '2024-12-13 23:53:12') ON CONFLICT DO NOTHING;
INSERT INTO forum.personal_access_tokens VALUES (41, 'App\Models\User', 22, 'API Token', '6860be77dc0f357952dae0f98977fa5db5db7b3574a6c3b598df814798784759', '["*"]', NULL, NULL, '2024-12-14 16:54:45', '2024-12-14 16:54:45') ON CONFLICT DO NOTHING;
INSERT INTO forum.personal_access_tokens VALUES (53, 'App\Models\User', 23, 'API Token', 'b21f3eb4a2a05e1c904003ec81367320881714c6c5444786758dd1e5fca68e3d', '["*"]', NULL, NULL, '2024-12-23 11:22:42', '2024-12-23 11:22:42') ON CONFLICT DO NOTHING;
INSERT INTO forum.personal_access_tokens VALUES (54, 'App\Models\User', 24, 'API Token', '370c4ec59434842b183b2312b2b190c9f10f9b2cc06396b8abdd3a02cd0bc808', '["*"]', NULL, NULL, '2024-12-23 11:23:27', '2024-12-23 11:23:27') ON CONFLICT DO NOTHING;
INSERT INTO forum.personal_access_tokens VALUES (111, 'App\Models\User', 15, 'API Token', '9260c860a1817e11f026d5e325baefab6054fa6ee263e0d59e4a821ef863f189', '["*"]', NULL, NULL, '2025-06-29 14:20:51', '2025-06-29 14:20:51') ON CONFLICT DO NOTHING;
INSERT INTO forum.personal_access_tokens VALUES (115, 'App\Models\User', 15, 'API Token', '1c09baf09d23c3e326c5a8446bcf03cb255098242234e5dfcf1aac178e15d9a0', '["*"]', NULL, NULL, '2025-07-12 04:34:55', '2025-07-12 04:34:55') ON CONFLICT DO NOTHING;


--
-- TOC entry 4917 (class 0 OID 16424)
-- Dependencies: 226
-- Data for Name: posts; Type: TABLE DATA; Schema: forum; Owner: -
--

INSERT INTO forum.posts VALUES (2, 5, 5, 'Let''s discuss some cool topics.', '2024-12-30 18:32:36', '2024-12-30 18:32:36', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.posts VALUES (19, 55, 15, 'Protecting personal data on social media starts with using strong, unique passwords and enabling two-factor authentication for added security. Be mindful of what you share publicly, and regularly review your privacy settings to control who can see your information.', '2024-12-31 16:36:57', '2024-12-31 16:36:57', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.posts VALUES (20, 55, 5, 'Be cautious about accepting friend requests or messages from unknown users, as they may be phishing attempts. Regularly review and update your security settings to protect your account.', '2025-01-01 04:07:55', '2025-01-01 04:07:55', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.posts VALUES (21, 55, 21, 'Regularly audit your connected apps and revoke access for those you no longer use. Ensure your social media activity doesn’t reveal information that could be used for identity theft.', '2025-01-01 05:51:03', '2025-01-01 05:51:03', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.posts VALUES (1, 5, 7, 'Thank you for starting this forum!', '2024-12-30 16:36:57', '2024-12-30 16:36:57', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.posts VALUES (22, 45, 15, 'Yes, this is a common issue after system updates, especially if they affect network drivers, firewall settings, or VPN client compatibility. Here are some troubleshooting steps you can try:

1. Restart Your Device
A simple reboot can sometimes resolve post-update glitches.

2. Reinstall or Update Your VPN Client
Uninstall and then reinstall your VPN software.

Check the vendor’s website for a newer version compatible with your updated OS.

3. Check Windows or macOS Firewall Settings
Updates can reset firewall settings.

Make sure your VPN app is allowed through the firewall.

4. Re-enable Network Adapter or TAP Adapter
Go to Device Manager (Windows) or Network Preferences (Mac).

Disable and re-enable your VPN adapter or TAP adapter.

Update its driver if available.

5. Flush DNS and Reset Network Settings (Windows)
Open Command Prompt as Administrator and run:

perl
Copy
Edit
ipconfig /flushdns
netsh winsock reset
netsh int ip reset
Then restart your computer.

6. Check for Conflicts with Antivirus or Third-Party Firewalls
Temporarily disable them to test VPN connectivity.

Some antivirus software blocks VPN tunnels after updates.

7. Use Mobile Hotspot as a Test
Try connecting through a mobile hotspot to rule out router or ISP blocking.

8. Contact Your IT Department
They may need to reset your VPN credentials or provide updated configuration files.

Some companies enforce new security settings after OS updates.

If you share your OS and VPN client (e.g., Cisco AnyConnect, FortiClient, OpenVPN), I can give more specific advice.', '2025-06-22 04:58:52', '2025-06-22 04:58:52', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.posts VALUES (23, 23, 15, 'Public Wi-Fi, like the kind found in cafes or airports, can be unsafe because hackers may intercept your data, trick you with fake networks, or install malware on your device. To stay safe, use a VPN to encrypt your connection, avoid logging into sensitive accounts (like banking or email), turn off file sharing and auto-connect features, and make sure websites you visit use “https.” Always keep your device and antivirus software updated, use two-factor authentication for important accounts, and forget the network after use. For sensitive tasks, using your mobile data or hotspot is often a safer choice.', '2025-06-22 05:00:09', '2025-06-22 05:00:09', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.posts VALUES (24, 22, 15, 'If you think your email has been hacked, act quickly to regain control and protect your personal information. First, try to log in and change your password immediately—use a strong, unique one. If you’re locked out, use the email provider’s account recovery process to reset your password. Once back in, check for suspicious activity, like unknown logins, forwarded emails, or changed recovery info. Remove any unfamiliar devices and update your recovery options (phone number, backup email). Next, enable two-factor authentication (2FA) for extra security. Let your contacts know you were hacked so they don’t fall for any phishing messages. Finally, scan your device for malware and consider changing passwords for other accounts linked to that email. To prevent future hacks, always use strong passwords, avoid reusing them, enable 2FA, and be cautious of phishing emails.', '2025-06-22 05:00:40', '2025-06-22 05:00:40', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.posts VALUES (25, 21, 15, 'To tell if a website is safe to use, start by **checking for “https\://”** at the beginning of the web address—this means the site uses encryption to protect your data. A padlock icon next to the URL also signals it''s secure. Be cautious if the site has **spelling errors in the URL**, looks poorly designed, or asks for personal info too soon—these could be **phishing sites**. Avoid clicking on suspicious pop-ups or links from unknown emails or messages. You can also check the site’s reputation using tools like **Google Safe Browsing**, **Norton Safe Web**, or **VirusTotal**. If in doubt, **don’t enter any sensitive information**, especially on sites that don’t look trustworthy or professional.', '2025-06-22 05:01:19', '2025-06-22 05:01:19', NULL) ON CONFLICT DO NOTHING;


--
-- TOC entry 4919 (class 0 OID 16432)
-- Dependencies: 228
-- Data for Name: thread_categories; Type: TABLE DATA; Schema: forum; Owner: -
--

INSERT INTO forum.thread_categories VALUES (20, 6, '2024-12-05 23:49:07.962703', '2024-12-05 23:49:07.962703') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (1, 2, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (2, 2, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (3, 3, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (4, 1, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (5, 5, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (6, 1, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (7, 1, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (8, 1, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (9, 1, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (10, 1, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (12, 4, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (13, 4, '2024-12-20 11:01:36.382465', '2024-12-20 11:01:36.382465') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (23, 3, '2024-12-28 09:36:27.559955', '2024-12-28 09:36:27.559955') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (22, 1, '2024-12-28 09:36:27.559955', '2024-12-28 09:36:27.559955') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (21, 1, '2024-12-28 09:36:27.559955', '2024-12-28 09:36:27.559955') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (45, 3, '2024-12-28 14:23:32.577288', '2024-12-28 14:23:32.577288') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (55, 1, '2024-12-28 14:36:57.736001', '2024-12-28 14:36:57.736001') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (56, 7, '2025-01-24 19:13:17.549965', '2025-01-24 19:13:17.549965') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (57, 8, '2025-02-03 20:35:26.915957', '2025-02-03 20:35:26.915957') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (58, 2, '2025-06-22 13:04:03.629002', '2025-06-22 13:04:03.629002') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (59, 9, '2025-06-29 21:08:29.202151', '2025-06-29 21:08:29.202151') ON CONFLICT DO NOTHING;
INSERT INTO forum.thread_categories VALUES (60, 1, '2025-07-12 10:10:25.886951', '2025-07-12 10:10:25.886951') ON CONFLICT DO NOTHING;


--
-- TOC entry 4920 (class 0 OID 16437)
-- Dependencies: 229
-- Data for Name: threads; Type: TABLE DATA; Schema: forum; Owner: -
--

INSERT INTO forum.threads VALUES (13, 'One of the Best Post I Have Seen!', 7, '2024-11-29 21:59:08', '2024-11-29 21:59:08', false, NULL, false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (14, 'AI and Machine Learning in Cybersecurity', 7, '2024-12-05 09:29:34', '2024-12-05 09:29:34', false, NULL, false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (15, 'How to Protect Your Business from Ransomware Attacks', 7, '2024-12-05 09:37:26', '2024-12-05 09:37:26', false, NULL, false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (16, 'The Importance of Multi-Factor Authentication (MFA)', 7, '2024-12-05 09:45:14', '2024-12-05 09:45:14', false, NULL, false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (17, 'Securing the Internet of Things (IoT) in the Age of Connectivity', 7, '2024-12-05 09:48:24', '2024-12-05 09:48:24', false, NULL, false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (18, 'Cloud Security: The Next Frontier', 7, '2024-12-05 09:50:58', '2024-12-05 09:50:58', false, NULL, false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (19, 'This is now my sample thread!', 15, '2024-12-05 13:42:00', '2024-12-05 13:42:00', false, NULL, false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (12, 'One of the Best Post I Have Seen!', 7, '2024-11-26 14:30:09', '2024-11-26 14:30:09', false, NULL, true, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (1, 'Welcome to the Forum!', 5, '2024-11-26 19:00:13.256222', '2024-11-26 19:00:13.256222', false, 'Discover a space to connect, share ideas, and grow with like-minded individuals. Dive into topics you love and start engaging today!', false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (2, 'Forum Updates', 6, '2024-11-26 19:00:13.256222', '2024-11-26 19:00:13.256222', false, 'Stay in the loop with the latest improvements and exciting changes happening in our forum.', false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (3, 'How to Get Help with Issues', 5, '2024-11-26 19:00:13.256222', '2024-11-26 19:00:13.256222', false, 'Stuck on a problem? Share your questions here, and let the community guide you to the solution!', false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (5, 'Forum Feature Requests', 5, '2024-11-26 21:34:56.277262', '2024-11-26 21:34:56.277262', false, 'Got ideas to improve our forum? Share your thoughts and help shape the future of this community!', false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (7, 'Getting Started with Featured Tools', 7, '2024-11-26 21:47:48.124454', '2024-11-26 21:47:48.124454', false, 'Maximize productivity by exploring our handpicked tools designed to simplify your workflow.', false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (8, 'Testing and Debugging you Start-App', 7, '2024-11-26 21:47:48.124454', '2024-11-26 21:47:48.124454', false, 'Learn essential tips and tricks to efficiently test and debug your application before launch.', false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (9, 'Mastering Skills with Featured Tools', 7, '2024-11-26 21:47:48.124454', '2024-11-26 21:47:48.124454', false, 'Elevate your expertise by leveraging tools that enhance learning and development.', false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (10, 'Getting Started with RESTful APIs', 7, '2024-11-26 21:47:48.124454', '2024-11-26 21:47:48.124454', false, 'Dive into the world of APIs with this beginner-friendly guide to building and consuming RESTful services.', false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (22, 'What should I do if I think my email has been hacked?', 24, '2024-12-28 09:27:19.769806', '2024-12-28 09:27:19.769806', true, 'Help for recovering a hacked email account, securing it, and preventing future incidents.', false, '[9, 15, 16, 17, 5, 21]', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (6, 'Kickstart Your Web App Development!', 7, '2024-11-26 21:47:48.124454', '2024-11-26 21:47:48.124454', false, 'Start building amazing web apps today with essential tips, tools, and guidance from the pros.', false, '[9, 15, 16, 17, 5, 21]', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (4, 'Why Cats are Better than Dogs', 5, '2024-12-21 03:34:56.277262', '2024-12-21 03:34:56.277262', false, 'Cats are independent yet affectionate companions with a knack for entertainment. Let’s dive into why they might just edge out dogs!', false, '[9, 15, 16, 17]', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (20, 'The Future of Cybersecurity: Trends You Need to Know', 15, '2024-12-05 15:47:35', '2024-12-05 15:47:35', true, NULL, false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (23, 'Is it safe to use public Wi-fi, and how can I protect myself while using it?', 15, '2024-12-28 09:30:12.498008', '2025-01-02 01:48:09', true, 'What are the potential risks of connecting to unsecured networks in cafes or public spaces? Share tips on how to stay protected while browsing on public Wi-Fi.', false, '[9, 15, 16, 17, 21]', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (56, 'Learning Hub', 15, '2025-02-23 20:37:42.911496', '2025-02-23 20:37:42.911496', true, NULL, false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (57, 'TestYour Knowledge', 15, '2025-02-23 20:37:42.911496', '2025-02-23 20:37:42.911496', true, NULL, false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (55, 'Best Practices for Protecting Personal Data on Social Media', 17, '2024-12-28 16:36:57', '2025-02-26 01:21:18', true, 'With more personal information being shared on social media, it''s important to safeguard privacy. What steps can individuals take to protect their data from cyber threats while still using social platforms? Share your top recommendations!', false, '[22, 23, 21, 15]', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (21, 'How can I tell if a website is safe to use?', 5, '2024-12-28 09:24:14.822206', '2025-04-01 11:01:31', true, 'Questions about identifying secure websites, recognizing HTTPS, and avoiding phishing sites.', false, '[15]', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (45, 'Unable to Access Corporate VPN After System Update', 17, '2024-12-28 16:23:32', '2025-06-22 04:57:13', true, 'After a recent system update, I can no longer access my company''s VPN. Has anyone faced similar issues, and what troubleshooting steps can I take to resolve this? Any help is appreciated!', false, '[21, 15]', DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (58, 'Have You Ever Been Targeted by an Online Scam? How Did You Handle It?', 15, '2025-06-22 05:04:03', '2025-06-22 05:04:03', true, 'Online scams and phishing attacks are becoming more common in the Philippines, from fake delivery messages to suspicious job offers. Have you or someone you know ever experienced one? What warning signs did you notice, and what steps did you take afterward? Let’s share our experiences and tips to help others stay safe online!', false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (59, 'Self Assessment', 15, '2025-06-29 21:05:56.026148', '2025-06-29 21:05:56.026148', true, NULL, false, NULL, DEFAULT) ON CONFLICT DO NOTHING;
INSERT INTO forum.threads VALUES (60, 'I think I was scammed. How to get my money back in Gcash?', 29, '2025-07-12 02:10:25', '2025-07-12 02:10:25', true, 'This is for testing purposes only', false, NULL, DEFAULT) ON CONFLICT DO NOTHING;


--
-- TOC entry 4922 (class 0 OID 16447)
-- Dependencies: 231
-- Data for Name: top_posts; Type: TABLE DATA; Schema: forum; Owner: -
--

INSERT INTO forum.top_posts VALUES (9, 'One of the Best Post I Have Seen!', 'https://oneofthebestpost.com', 'This is a sample description for the featured post - one of the best.', false, '2024-11-29 21:59:09', '2024-11-29 21:59:09', '2024-11-29 21:59:29') ON CONFLICT DO NOTHING;
INSERT INTO forum.top_posts VALUES (8, 'One of the Best Post I Have Seen!', 'https://oneofthebestpost.com', 'This is a sample description for the featured post - one of the best.', false, '2024-11-26 14:30:09', '2024-11-26 14:30:09', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.top_posts VALUES (2, 'How to Build a Simple Web App', 'https://example.com/web-app-guide', 'A detailed tutorial on building a Laravel web app.', false, '2024-11-26 21:54:51.641315', '2024-11-26 21:54:51.641315', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.top_posts VALUES (3, 'Introduction to Laravel Eloquent ORM', 'https://example.com/eloquent-orm', 'Learn how to use Laravel Eloquent ORM effectively.', false, '2024-11-26 21:54:51.641315', '2024-11-26 21:54:51.641315', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.top_posts VALUES (4, 'Tips for Debugging in PHP', 'https://example.com/debugging-php', 'Practical tips for debugging your PHP applications.', false, '2024-11-26 21:54:51.641315', '2024-11-26 21:54:51.641315', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.top_posts VALUES (5, 'Advanced Laravel Features', 'https://example.com/advanced-laravel', 'In-depth exploration of advanced Laravel features.', false, '2024-11-26 21:54:51.641315', '2024-11-26 21:54:51.641315', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.top_posts VALUES (6, 'Building RESTful APIs with Laravel', 'https://example.com/building-apis', 'A guide to creating RESTful APIs with Laravel.', false, '2024-11-26 21:54:51.641315', '2024-11-26 21:54:51.641315', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.top_posts VALUES (10, 'AI and Machine Learning in Cybersecurity', 'https://kpmg.com/ch/en/insights/cybersecurity-risk/artificial-intelligence-influences.html', 'AI and machine learning are revolutionizing cybersecurity by enabling faster detection and response to threats. These technologies will be critical in protecting against increasingly sophisticated cyberattacks.', true, '2024-12-05 09:29:34', '2024-12-05 09:29:34', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.top_posts VALUES (11, 'How to Protect Your Business from Ransomware Attacks', 'https://www.cisa.gov/stopransomware/how-can-i-protect-against-ransomware', 'Ransomware attacks are on the rise, targeting businesses of all sizes. Effective strategies, including regular backups and employee training, are essential for mitigating these threats.', true, '2024-12-05 09:37:26', '2024-12-05 09:37:26', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.top_posts VALUES (12, 'The Importance of Multi-Factor Authentication (MFA)', 'https://www.okta.com/identity-101/why-mfa-is-everywhere/', 'Multi-factor authentication adds an extra layer of security to your accounts by requiring multiple forms of verification. This simple step can significantly reduce the risk of unauthorized access.', true, '2024-12-05 09:45:14', '2024-12-05 09:45:14', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.top_posts VALUES (13, 'Securing the Internet of Things (IoT) in the Age of Connectivity', 'https://www.pewresearch.org/internet/2017/06/06/the-internet-of-things-connectivity-binge-what-are-the-implications/', 'As IoT devices become more widespread, they create new vulnerabilities for cybercriminals to exploit. Securing these devices will require new strategies and technologies.', true, '2024-12-05 09:48:24', '2024-12-05 09:48:24', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.top_posts VALUES (14, 'Cloud Security: The Next Frontier', 'https://valoremreply.com/resources/insights/blog/2024/august/the-next-frontier-of-cloud-computing-industry-cloud-platforms/', 'As organizations increasingly move to the cloud, securing sensitive data becomes critical. Future cloud security will focus on automation, encryption, and advanced identity management to safeguard against evolving threats.', true, '2024-12-05 09:50:58', '2024-12-05 09:50:58', NULL) ON CONFLICT DO NOTHING;


--
-- TOC entry 4924 (class 0 OID 16456)
-- Dependencies: 233
-- Data for Name: users; Type: TABLE DATA; Schema: forum; Owner: -
--

INSERT INTO forum.users VALUES (7, 'pedropascal', 'pedropascal@mailinator.com', '$2y$12$xnqlIOkAtg9C2QP5qxddd..8cuHBsdgeGpoqHAjIAGcIFXmd6chCm', '2024-11-26 12:37:46', '2024-11-26 12:38:42', 1, 'Pedro', 'Pascal', 1, NULL, 'assets/img/avatar/em.jpg', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.users VALUES (23, 'pyuser0003', 'pyuser0003@mailinator.com', '$2y$12$xnqlIOkAtg9C2QP5qxddd..8cuHBsdgeGpoqHAjIAGcIFXmd6chCm', '2024-12-23 11:22:42', '2024-12-23 11:22:42', 2, NULL, NULL, 1, NULL, 'assets/img/avatar/8HTWND6aMl4dnLbnbMVKBG65b9p3x8ySGe8rA08p.jpg', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.users VALUES (24, 'pyuser0004', 'pyuser0004@mailinator.com', '$2y$12$xnqlIOkAtg9C2QP5qxddd..8cuHBsdgeGpoqHAjIAGcIFXmd6chCm', '2024-12-23 11:23:27', '2024-12-23 11:23:27', 2, NULL, NULL, 1, NULL, 'assets/img/avatar/ssMNHQKOXtONexUNhXbqnKAu0Q4JX9e5ieu5f24K.png', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.users VALUES (17, 'laraveluser001', 'laraveluser001@mailinator.com', '$2y$12$xnqlIOkAtg9C2QP5qxddd..8cuHBsdgeGpoqHAjIAGcIFXmd6chCm', '2024-12-12 16:28:55', '2024-12-12 16:28:55', 2, NULL, NULL, 1, NULL, 'assets/img/avatar/IM.jpg', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.users VALUES (21, 'pyuser0001', 'pyuser0001@mailinator.com', '$2y$12$xnqlIOkAtg9C2QP5qxddd..8cuHBsdgeGpoqHAjIAGcIFXmd6chCm', '2024-12-12 16:28:55', '2024-12-12 16:28:55', 2, NULL, NULL, 1, NULL, 'assets/img/avatar/av.jpg', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.users VALUES (22, 'tes123', 'tes123@mailinator.com', '$2y$12$xnqlIOkAtg9C2QP5qxddd..8cuHBsdgeGpoqHAjIAGcIFXmd6chCm', '2024-12-14 16:54:45', '2024-12-14 16:54:45', 2, NULL, NULL, 1, NULL, 'assets/img/avatar/I0lSD6dUVaH7xe69v88cVc7coNs9jjmZU4a9LJDf.jpg', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.users VALUES (6, 'JaneDoo', 'janedoo@mailinator.com', '$2y$12$xnqlIOkAtg9C2QP5qxddd..8cuHBsdgeGpoqHAjIAGcIFXmd6chCm', '2024-11-26 10:18:57', '2024-11-26 10:32:37', 2, 'Jane', 'Doo', 0, '2024-11-26 10:35:37+08', 'assets/img/avatar/I0lSD6dUVaH7xe69v88cVc7coNs9jjmZU4a9LJDf.jpg', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.users VALUES (8, 'janjeiar', 'janjeiar@mailinator.com', '$2y$12$xnqlIOkAtg9C2QP5qxddd..8cuHBsdgeGpoqHAjIAGcIFXmd6chCm', '2024-12-03 21:14:25', '2024-12-03 21:14:25', 1, NULL, NULL, 1, NULL, 'assets/img/avatar/I0lSD6dUVaH7xe69v88cVc7coNs9jjmZU4a9LJDf.jpg', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.users VALUES (9, 'johnmango', 'johnmango@mailinator.com', '$2y$12$xnqlIOkAtg9C2QP5qxddd..8cuHBsdgeGpoqHAjIAGcIFXmd6chCm', '2024-12-04 15:39:35', '2024-12-04 15:39:35', 1, NULL, NULL, 1, NULL, 'assets/img/avatar/I0lSD6dUVaH7xe69v88cVc7coNs9jjmZU4a9LJDf.jpg', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.users VALUES (16, 'qwerty123', 'qwerty123@mailinator.com', '$2y$12$xnqlIOkAtg9C2QP5qxddd..8cuHBsdgeGpoqHAjIAGcIFXmd6chCm', '2024-12-09 14:14:47', '2024-12-09 14:14:47', 2, NULL, NULL, 1, NULL, 'assets/img/avatar/I0lSD6dUVaH7xe69v88cVc7coNs9jjmZU4a9LJDf.jpg', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.users VALUES (15, 'romeo.fajilanjr', 'janemango@mailinator.com', '$2y$12$xnqlIOkAtg9C2QP5qxddd..8cuHBsdgeGpoqHAjIAGcIFXmd6chCm', '2024-12-04 16:12:17', '2025-07-12 04:38:13', 1, NULL, NULL, 1, NULL, 'assets/img/avatar/I0lSD6dUVaH7xe69v88cVc7coNs9jjmZU4a9LJDf.jpg', '{"card": "cyberdefender", "items": 8, "score": 7, "title": "Cyber Defender", "updated_at": "2025-07-12 04:38:13", "description": "You''re on the right track!"}') ON CONFLICT DO NOTHING;
INSERT INTO forum.users VALUES (5, 'johndee', 'johndee@mailinator.com', '$2y$12$xnqlIOkAtg9C2QP5qxddd..8cuHBsdgeGpoqHAjIAGcIFXmd6chCm', '2024-11-26 09:49:59', '2024-11-26 10:08:20', 2, 'Jan', 'Dee', 1, NULL, 'assets/img/avatar/qwerty1234.jpg', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.users VALUES (25, 'juanmiguel0823', 'juanmiguel0823@mailinator.com', '$2y$12$xnqlIOkAtg9C2QP5qxddd..8cuHBsdgeGpoqHAjIAGcIFXmd6chCm', '2025-01-19 12:51:22', '2025-01-19 12:51:22', 2, NULL, NULL, 1, NULL, 'assets/img/avatar/WtCclRhQQ9UnOBAIMW7TkBGoFxHI7QUNKjiTHs2a.jpg', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.users VALUES (26, 'testadmin', 'testadmin@mailinator.com', '$2y$12$Zqchzs3ejNLKQL5f8BaIQ.LLBeXufzBQ8hUBuYNIuqSoPl0fQC8vG', '2025-02-18 08:55:52', '2025-02-18 08:55:52', 2, NULL, NULL, 1, NULL, 'assets/img/avatar/vjCdYWr7RJdAFuDo1mviywhYAFSKRYlguRaHk8Or.png', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.users VALUES (27, 'juanmiguel99', 'juanmiguel99@mailinator.com', '$2y$12$oZk7E.mdQQ2ors.bTkJ2VuJMGsATaLQL2FmKUT1MHNnbD7msu.EKq', '2025-04-25 12:42:43', '2025-04-25 12:42:43', 2, NULL, NULL, 1, NULL, 'assets/img/avatar/4Dd0ePrhZPUhaypkmbhrTzzhJegZKaSPRG7bjsRu.jpg', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.users VALUES (28, 'username100', 'username100@mailinator.com', '$2y$12$UjLVbp/bKaa1LIrI6hD/B.Nk/.CSYRmxKu32tdtNw2hh0.vA.rtSW', '2025-04-25 12:43:54', '2025-04-25 12:43:54', 2, NULL, NULL, 1, NULL, 'assets/img/avatar/ldSjlhWMEstNyKhigfIxp2hhKyVsDXS81Oqty3yv.jpg', NULL) ON CONFLICT DO NOTHING;
INSERT INTO forum.users VALUES (29, 'moris', 'moris.laine@gmail.com', '$2y$12$mbBxKQ3ikEIgrc/SAeAIOev4Irw8VNYCtKIHBZhZj9xqVMYYc8dl.', '2025-07-12 02:05:17', '2025-07-12 02:21:31', 2, NULL, NULL, 1, NULL, NULL, '{"card": "hackerbf", "items": 8, "score": 0, "title": "Hacker''s Best Friend", "updated_at": "2025-07-12 02:21:31", "description": "Your info is already on the dark web."}') ON CONFLICT DO NOTHING;


--
-- TOC entry 4939 (class 0 OID 0)
-- Dependencies: 218
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: forum; Owner: -
--

SELECT pg_catalog.setval('forum.categories_id_seq', 3, true);


--
-- TOC entry 4940 (class 0 OID 0)
-- Dependencies: 220
-- Name: featured_posts_id_seq1; Type: SEQUENCE SET; Schema: forum; Owner: -
--

SELECT pg_catalog.setval('forum.featured_posts_id_seq1', 18, true);


--
-- TOC entry 4941 (class 0 OID 0)
-- Dependencies: 222
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: forum; Owner: -
--

SELECT pg_catalog.setval('forum.migrations_id_seq', 5, true);


--
-- TOC entry 4942 (class 0 OID 0)
-- Dependencies: 225
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: forum; Owner: -
--

SELECT pg_catalog.setval('forum.personal_access_tokens_id_seq', 115, true);


--
-- TOC entry 4943 (class 0 OID 0)
-- Dependencies: 227
-- Name: posts_id_seq; Type: SEQUENCE SET; Schema: forum; Owner: -
--

SELECT pg_catalog.setval('forum.posts_id_seq', 25, true);


--
-- TOC entry 4944 (class 0 OID 0)
-- Dependencies: 230
-- Name: threads_id_seq; Type: SEQUENCE SET; Schema: forum; Owner: -
--

SELECT pg_catalog.setval('forum.threads_id_seq', 60, true);


--
-- TOC entry 4945 (class 0 OID 0)
-- Dependencies: 232
-- Name: top_posts_id_seq; Type: SEQUENCE SET; Schema: forum; Owner: -
--

SELECT pg_catalog.setval('forum.top_posts_id_seq', 14, true);


--
-- TOC entry 4946 (class 0 OID 0)
-- Dependencies: 234
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: forum; Owner: -
--

SELECT pg_catalog.setval('forum.users_id_seq', 29, true);


--
-- TOC entry 4761 (class 1259 OID 24679)
-- Name: featured_threads_search_vector_idx; Type: INDEX; Schema: forum; Owner: -
--

CREATE INDEX featured_threads_search_vector_idx ON forum.featured_threads USING gin (search_vector);


--
-- TOC entry 4762 (class 1259 OID 24672)
-- Name: threads_search_vector_idx; Type: INDEX; Schema: forum; Owner: -
--

CREATE INDEX threads_search_vector_idx ON forum.threads USING gin (search_vector);


-- Completed on 2025-07-12 13:01:11

--
-- PostgreSQL database dump complete
--

