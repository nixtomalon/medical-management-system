--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
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
-- Name: diagnose_details; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.diagnose_details (
    diagnose_id integer NOT NULL,
    patient_id integer NOT NULL,
    date character varying(40) NOT NULL,
    diagnose character varying(250) NOT NULL
);


ALTER TABLE public.diagnose_details OWNER TO postgres;

--
-- Name: diagnose_details_diagnose_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.diagnose_details_diagnose_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.diagnose_details_diagnose_id_seq OWNER TO postgres;

--
-- Name: diagnose_details_diagnose_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.diagnose_details_diagnose_id_seq OWNED BY public.diagnose_details.diagnose_id;


--
-- Name: medicines; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.medicines (
    med_id integer NOT NULL,
    med_name character varying(100) NOT NULL,
    med_brand character varying(100) NOT NULL,
    miligram character varying(100) NOT NULL,
    exp_date character varying(100) NOT NULL,
    stock character varying(100) NOT NULL,
    status boolean
);


ALTER TABLE public.medicines OWNER TO postgres;

--
-- Name: medicines_med_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.medicines_med_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.medicines_med_id_seq OWNER TO postgres;

--
-- Name: medicines_med_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.medicines_med_id_seq OWNED BY public.medicines.med_id;


--
-- Name: patients; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.patients (
    patient_id integer NOT NULL,
    fullname character varying(100) NOT NULL,
    address character varying(100) NOT NULL,
    gender character(40) NOT NULL,
    birthdate character varying(255),
    contact_number character varying(25)
);


ALTER TABLE public.patients OWNER TO postgres;

--
-- Name: patients_patient_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.patients_patient_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.patients_patient_id_seq OWNER TO postgres;

--
-- Name: patients_patient_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.patients_patient_id_seq OWNED BY public.patients.patient_id;


--
-- Name: prescriptions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prescriptions (
    pres_id integer NOT NULL,
    diagnose_id integer NOT NULL,
    med_id integer NOT NULL,
    quantity integer NOT NULL
);


ALTER TABLE public.prescriptions OWNER TO postgres;

--
-- Name: prescriptions_pres_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.prescriptions_pres_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.prescriptions_pres_id_seq OWNER TO postgres;

--
-- Name: prescriptions_pres_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.prescriptions_pres_id_seq OWNED BY public.prescriptions.pres_id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    user_id integer NOT NULL,
    username character varying(100) NOT NULL,
    password character varying(100) NOT NULL,
    fullname character varying(100) NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_user_id_seq OWNER TO postgres;

--
-- Name: users_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_user_id_seq OWNED BY public.users.user_id;


--
-- Name: diagnose_details diagnose_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diagnose_details ALTER COLUMN diagnose_id SET DEFAULT nextval('public.diagnose_details_diagnose_id_seq'::regclass);


--
-- Name: medicines med_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.medicines ALTER COLUMN med_id SET DEFAULT nextval('public.medicines_med_id_seq'::regclass);


--
-- Name: patients patient_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.patients ALTER COLUMN patient_id SET DEFAULT nextval('public.patients_patient_id_seq'::regclass);


--
-- Name: prescriptions pres_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prescriptions ALTER COLUMN pres_id SET DEFAULT nextval('public.prescriptions_pres_id_seq'::regclass);


--
-- Name: users user_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN user_id SET DEFAULT nextval('public.users_user_id_seq'::regclass);


--
-- Data for Name: diagnose_details; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.diagnose_details (diagnose_id, patient_id, date, diagnose) FROM stdin;
35	33	2020-10-05	covid
36	31	2020-10-05	toothache
37	34	2020-10-06	Covid
38	33	2020-10-06	covid
39	36	2020-10-07	covid
40	37	2020-10-07	covid
41	31	2020-12-05	covid
42	31	2020-12-08	tooth ache
\.


--
-- Data for Name: medicines; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.medicines (med_id, med_name, med_brand, miligram, exp_date, stock, status) FROM stdin;
4	sample	sample brand	500	03 September 2020	123	f
9	sample name	sample brand	150	23 May 2021	200	f
16	patakahahahah	sample pataka	120	27 December 2020	120	f
2	Ascorbic Acidn	Aschophil	250	30 April 2021	177	t
17	alaxan	brand	200	07 April 2030	200	t
6	neozip	sample brand	250	16 July 2021	24	f
8	Loperamide Diatab	Ritemed	200	17 May 2021	100	t
15	covid vaccine	russia	1000	31 December 2030	9957	f
7	Paracetamol	Ritemed	500	31 August 2021	70	t
1	Amoxicillin	ritemed	250	14 March 2021	76	t
18	covid	russia	1000	01 December 2030	993	t
10	Bioflu	Ritemed	500	31 December 2021	792	t
12	Ibuprofen	Fevral	2000	01 November 2020	145	t
20	sample	sample brand	120	19 July 2030	123	t
19						f
11	Mefinamic Acid	Ritemed	250	30 September 2020	100	t
22						f
5	utross	utro	123	06 September 2020	123	f
21						f
13	Ascorbic Acid	Aschophil	250	31 January 2021	100	t
26						f
25						f
24						f
23						f
3	sample haha	sample	250	22 December 2030	145	f
27						f
28						t
14	sample med	brand	300	31 December 2026	229	f
29						t
30						t
31						t
32						t
\.


--
-- Data for Name: patients; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.patients (patient_id, fullname, address, gender, birthdate, contact_number) FROM stdin;
37	nonoy vasri	cebu city	Male                                    	07 January 1996	09125050123
36	sample name	butuan city	Female                                  	25 December 2020	9088198391
32	kim june menuza	butuan city	Others                                  	24 December 1979	09917562301
33	nonix rivas	marihatag surigao del sur	Others                                  	07 January 2000	09991421457
34	ched doromal	surigao city	Female                                  	31 December 2000	09012233100
35	pj sumalinog	butuan city	Others                                  	09 February 1999	09881461901
31	prandel ranula	bayugan city	Male                                    	25 December 1989	09128812290
\.


--
-- Data for Name: prescriptions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.prescriptions (pres_id, diagnose_id, med_id, quantity) FROM stdin;
49	35	7	5
50	35	6	5
51	36	12	5
52	36	14	4
53	37	15	10
54	38	15	5
55	38	7	6
56	38	10	3
57	39	15	15
58	39	7	5
59	39	1	5
60	40	2	5
61	40	7	5
62	40	15	13
63	41	7	50
64	42	1	9
65	42	18	7
66	42	10	6
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (user_id, username, password, fullname) FROM stdin;
1	norman	gwapo	norman tomalon
2	charmagne	lagat	charmagne arrubio
\.


--
-- Name: diagnose_details_diagnose_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.diagnose_details_diagnose_id_seq', 42, true);


--
-- Name: medicines_med_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.medicines_med_id_seq', 32, true);


--
-- Name: patients_patient_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.patients_patient_id_seq', 37, true);


--
-- Name: prescriptions_pres_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.prescriptions_pres_id_seq', 66, true);


--
-- Name: users_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_user_id_seq', 2, true);


--
-- Name: diagnose_details pk_diagnose_details; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diagnose_details
    ADD CONSTRAINT pk_diagnose_details PRIMARY KEY (diagnose_id);


--
-- Name: medicines pk_medicines; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.medicines
    ADD CONSTRAINT pk_medicines PRIMARY KEY (med_id);


--
-- Name: patients pk_patients; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.patients
    ADD CONSTRAINT pk_patients PRIMARY KEY (patient_id);


--
-- Name: prescriptions pk_prescriptions; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prescriptions
    ADD CONSTRAINT pk_prescriptions PRIMARY KEY (pres_id);


--
-- Name: users pk_users; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT pk_users PRIMARY KEY (user_id);


--
-- Name: prescriptions diagnose_details_prescriptions; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prescriptions
    ADD CONSTRAINT diagnose_details_prescriptions FOREIGN KEY (diagnose_id) REFERENCES public.diagnose_details(diagnose_id);


--
-- Name: prescriptions medicines_prescriptions; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prescriptions
    ADD CONSTRAINT medicines_prescriptions FOREIGN KEY (med_id) REFERENCES public.medicines(med_id);


--
-- Name: diagnose_details patients_diagnose_details; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diagnose_details
    ADD CONSTRAINT patients_diagnose_details FOREIGN KEY (patient_id) REFERENCES public.patients(patient_id);


--
-- PostgreSQL database dump complete
--

