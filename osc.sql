PGDMP     -    :                u            ajn_osc    9.6.2    9.6.2 b    �           0    0    ENCODING    ENCODING     #   SET client_encoding = 'SQL_ASCII';
                       false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            �           1262    16401    ajn_osc    DATABASE     �   CREATE DATABASE ajn_osc WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252';
    DROP DATABASE ajn_osc;
             postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false            �           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    3                        3079    12387    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false            �           0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    1            �            1255    16485 
   isi_date()    FUNCTION     �   CREATE FUNCTION isi_date() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
    BEGIN
    IF pg_trigger_depth() <> 1 THEN
    RETURN NEW;
    END IF;
        update components set date_modified = 'now()' where id = NEW.id;
        return new;
    END;
$$;
 !   DROP FUNCTION public.isi_date();
       public       postgres    false    3    1            �            1255    24614    isi_date_contract()    FUNCTION       CREATE FUNCTION isi_date_contract() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
    BEGIN
    IF pg_trigger_depth() <> 1 THEN
    RETURN NEW;
    END IF;
        update contract set date_modified = 'now()' where id = NEW.id;
        return new;
    END;
$$;
 *   DROP FUNCTION public.isi_date_contract();
       public       postgres    false    3    1            �            1255    24612    isi_date_customer()    FUNCTION       CREATE FUNCTION isi_date_customer() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
    BEGIN
    IF pg_trigger_depth() <> 1 THEN
    RETURN NEW;
    END IF;
        update customer set date_modified = 'now()' where id = NEW.id;
        return new;
    END;
$$;
 *   DROP FUNCTION public.isi_date_customer();
       public       postgres    false    3    1            �            1255    24616    isi_date_project()    FUNCTION       CREATE FUNCTION isi_date_project() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
    BEGIN
    IF pg_trigger_depth() <> 1 THEN
    RETURN NEW;
    END IF;
        update project set date_modified = 'now()' where id = NEW.id;
        return new;
    END;
$$;
 )   DROP FUNCTION public.isi_date_project();
       public       postgres    false    3    1            �            1259    16458 
   components    TABLE     �  CREATE TABLE components (
    id integer NOT NULL,
    location_id numeric,
    name character varying,
    description character varying,
    nominal numeric,
    nominal_measure character varying,
    type_id integer,
    serial_number character varying,
    status integer,
    confirmation integer,
    date_modified timestamp without time zone DEFAULT '2017-04-19 12:25:28.6136'::timestamp without time zone,
    role integer,
    po_number character varying
);
    DROP TABLE public.components;
       public         postgres    false    3            �            1259    24750    master_comtype_id_seq    SEQUENCE     w   CREATE SEQUENCE master_comtype_id_seq
    START WITH 4
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.master_comtype_id_seq;
       public       postgres    false    3            �            1259    24688    master_comtype    TABLE     �   CREATE TABLE master_comtype (
    id integer DEFAULT nextval('master_comtype_id_seq'::regclass) NOT NULL,
    name character varying
);
 "   DROP TABLE public.master_comtype;
       public         postgres    false    212    3            �            1259    24634    master_confirmation    TABLE     Z   CREATE TABLE master_confirmation (
    id integer NOT NULL,
    name character varying
);
 '   DROP TABLE public.master_confirmation;
       public         postgres    false    3            �            1259    24733    master_role    TABLE     I   CREATE TABLE master_role (
    id integer,
    name character varying
);
    DROP TABLE public.master_role;
       public         postgres    false    3            �            1259    24618    master_status    TABLE     T   CREATE TABLE master_status (
    id integer NOT NULL,
    name character varying
);
 !   DROP TABLE public.master_status;
       public         postgres    false    3            �            1259    16422    project    TABLE       CREATE TABLE project (
    id integer NOT NULL,
    contract_id integer,
    name character varying,
    start timestamp without time zone,
    finish timestamp without time zone,
    status integer,
    note character varying,
    date_modified timestamp without time zone
);
    DROP TABLE public.project;
       public         postgres    false    3            �            1259    24768    available_components    VIEW     �  CREATE VIEW available_components AS
 SELECT com.id,
    com.location_id,
    pr.name AS project_name,
    com.name,
    com.description,
    com.nominal,
    com.nominal_measure,
    mct.name AS type,
    com.po_number,
    com.serial_number,
    mr.name AS role,
    ms.name AS status,
    mc.name AS confirmation,
    com.date_modified
   FROM components com,
    project pr,
    master_status ms,
    master_confirmation mc,
    master_comtype mct,
    master_role mr
  WHERE ((com.location_id = (pr.id)::numeric) AND (ms.id = com.status) AND (mc.id = com.confirmation) AND (com.location_id = (0)::numeric) AND (com.status = 0) AND (com.confirmation = 1) AND (mct.id = com.type_id) AND (mr.id = com.role));
 '   DROP VIEW public.available_components;
       public       postgres    false    211    211    198    207    204    204    203    203    198    198    198    207    190    190    198    198    198    198    198    198    198    198    198    3            �            1259    16431    circuit    TABLE     �   CREATE TABLE circuit (
    no integer NOT NULL,
    id character varying,
    project_id integer,
    name character varying,
    ip character varying
);
    DROP TABLE public.circuit;
       public         postgres    false    3            �            1259    16429    circuit_no_seq    SEQUENCE     p   CREATE SEQUENCE circuit_no_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.circuit_no_seq;
       public       postgres    false    3    192            �           0    0    circuit_no_seq    SEQUENCE OWNED BY     3   ALTER SEQUENCE circuit_no_seq OWNED BY circuit.no;
            public       postgres    false    191            �            1259    16456    components_id_seq    SEQUENCE     s   CREATE SEQUENCE components_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.components_id_seq;
       public       postgres    false    3    198            �           0    0    components_id_seq    SEQUENCE OWNED BY     9   ALTER SEQUENCE components_id_seq OWNED BY components.id;
            public       postgres    false    197            �            1259    16477    components_req    TABLE     �   CREATE TABLE components_req (
    id integer NOT NULL,
    name character varying,
    note character varying,
    nominal numeric,
    project_id numeric
);
 "   DROP TABLE public.components_req;
       public         postgres    false    3            �            1259    16475    components_req_id_seq    SEQUENCE     w   CREATE SEQUENCE components_req_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.components_req_id_seq;
       public       postgres    false    3    202             	           0    0    components_req_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE components_req_id_seq OWNED BY components_req.id;
            public       postgres    false    201            �            1259    16413    contract    TABLE       CREATE TABLE contract (
    id integer NOT NULL,
    customer_id numeric,
    name character varying,
    group_id numeric,
    product_id numeric,
    service_id numeric,
    origin character varying,
    destination character varying,
    tao character varying,
    connection character varying,
    bw_access numeric,
    bw_cir numeric,
    bw_burst numeric,
    remarks character varying,
    rfs timestamp without time zone,
    status character varying,
    date_modified timestamp without time zone,
    period integer
);
    DROP TABLE public.contract;
       public         postgres    false    3            �            1259    16411    contract_id_seq    SEQUENCE     q   CREATE SEQUENCE contract_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.contract_id_seq;
       public       postgres    false    3    188            	           0    0    contract_id_seq    SEQUENCE OWNED BY     5   ALTER SEQUENCE contract_id_seq OWNED BY contract.id;
            public       postgres    false    187            �            1259    16404    customer    TABLE     �  CREATE TABLE customer (
    id integer NOT NULL,
    name character varying,
    address character varying,
    npwp character varying,
    nob character varying,
    phone character varying,
    fax character varying,
    mobile character varying,
    email character varying,
    officer character varying,
    designation character varying,
    date_modified timestamp without time zone
);
    DROP TABLE public.customer;
       public         postgres    false    3            �            1259    16402    customer_id_seq    SEQUENCE     q   CREATE SEQUENCE customer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.customer_id_seq;
       public       postgres    false    186    3            	           0    0    customer_id_seq    SEQUENCE OWNED BY     5   ALTER SEQUENCE customer_id_seq OWNED BY customer.id;
            public       postgres    false    185            �            1259    24763    dismantle_components    VIEW     �  CREATE VIEW dismantle_components AS
 SELECT com.id,
    com.location_id,
    pr.name AS project_name,
    com.name,
    com.description,
    com.nominal,
    com.nominal_measure,
    mct.name AS type,
    com.po_number,
    com.serial_number,
    mr.name AS role,
    ms.name AS status,
    mc.name AS confirmation,
    com.date_modified
   FROM components com,
    project pr,
    master_status ms,
    master_confirmation mc,
    master_comtype mct,
    master_role mr
  WHERE ((com.location_id = (pr.id)::numeric) AND (ms.id = com.status) AND (mc.id = com.confirmation) AND (com.confirmation = 0) AND (com.status = 4) AND (mct.id = com.type_id) AND (mr.id = com.role));
 '   DROP VIEW public.dismantle_components;
       public       postgres    false    203    190    190    198    198    198    198    198    198    198    198    198    198    198    198    198    203    204    204    207    207    211    211    3            �            1259    16467    eventlog    TABLE     �   CREATE TABLE eventlog (
    id_log integer NOT NULL,
    circuit_id character varying,
    status character varying,
    status_int integer,
    datetime timestamp without time zone
);
    DROP TABLE public.eventlog;
       public         postgres    false    3            �            1259    16465    eventlog_id_log_seq    SEQUENCE     u   CREATE SEQUENCE eventlog_id_log_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.eventlog_id_log_seq;
       public       postgres    false    200    3            	           0    0    eventlog_id_log_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE eventlog_id_log_seq OWNED BY eventlog.id_log;
            public       postgres    false    199            �            1259    16449    master_doctype    TABLE     U   CREATE TABLE master_doctype (
    id integer NOT NULL,
    name character varying
);
 "   DROP TABLE public.master_doctype;
       public         postgres    false    3            �            1259    16447    master_doctype_id_seq    SEQUENCE     w   CREATE SEQUENCE master_doctype_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.master_doctype_id_seq;
       public       postgres    false    196    3            	           0    0    master_doctype_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE master_doctype_id_seq OWNED BY master_doctype.id;
            public       postgres    false    195            �            1259    24670    master_project_status    TABLE     \   CREATE TABLE master_project_status (
    id integer NOT NULL,
    name character varying
);
 )   DROP TABLE public.master_project_status;
       public         postgres    false    3            �            1259    16440    project_documents    TABLE     �   CREATE TABLE project_documents (
    id integer NOT NULL,
    project_id numeric,
    description character varying,
    link character varying,
    doctype numeric
);
 %   DROP TABLE public.project_documents;
       public         postgres    false    3            �            1259    16438    project_documents_id_seq    SEQUENCE     z   CREATE SEQUENCE project_documents_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.project_documents_id_seq;
       public       postgres    false    3    194            	           0    0    project_documents_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE project_documents_id_seq OWNED BY project_documents.id;
            public       postgres    false    193            �            1259    16420    project_id_seq    SEQUENCE     p   CREATE SEQUENCE project_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.project_id_seq;
       public       postgres    false    190    3            	           0    0    project_id_seq    SEQUENCE OWNED BY     3   ALTER SEQUENCE project_id_seq OWNED BY project.id;
            public       postgres    false    189            �            1259    24758    requested_components    VIEW     �  CREATE VIEW requested_components AS
 SELECT com.id,
    com.location_id,
    pr.name AS project_name,
    com.name,
    com.description,
    com.nominal,
    com.nominal_measure,
    mct.name AS type,
    com.po_number,
    com.serial_number,
    mr.name AS role,
    ms.name AS status,
    mc.name AS confirmation,
    com.date_modified
   FROM components com,
    project pr,
    master_status ms,
    master_confirmation mc,
    master_comtype mct,
    master_role mr
  WHERE ((com.location_id = (pr.id)::numeric) AND (ms.id = com.status) AND (mc.id = com.confirmation) AND (com.confirmation = 0) AND ((com.status = 0) OR (com.status = 2)) AND (mct.id = com.type_id) AND (mr.id = com.role));
 '   DROP VIEW public.requested_components;
       public       postgres    false    198    190    190    207    211    211    198    198    198    198    198    198    198    198    198    198    203    203    204    204    207    198    198    3            �            1259    24724    users    TABLE     ~   CREATE TABLE users (
    id integer NOT NULL,
    name character varying,
    password character varying,
    auth integer
);
    DROP TABLE public.users;
       public         postgres    false    3            �            1259    24722    users_id_seq    SEQUENCE     n   CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public       postgres    false    3    210            	           0    0    users_id_seq    SEQUENCE OWNED BY     /   ALTER SEQUENCE users_id_seq OWNED BY users.id;
            public       postgres    false    209            �            1259    24753    view_components    VIEW     �  CREATE VIEW view_components AS
 SELECT com.id,
    com.location_id,
    pr.name AS project_name,
    com.name,
    com.description,
    com.nominal,
    com.nominal_measure,
    mct.name AS type,
    com.po_number,
    com.serial_number,
    mr.name AS role,
    ms.name AS status,
    mc.name AS confirmation,
    com.date_modified
   FROM components com,
    project pr,
    master_status ms,
    master_confirmation mc,
    master_comtype mct,
    master_role mr
  WHERE ((com.location_id = (pr.id)::numeric) AND (ms.id = com.status) AND (mc.id = com.confirmation) AND (mct.id = com.type_id) AND (mr.id = com.role))
  ORDER BY com.date_modified DESC;
 "   DROP VIEW public.view_components;
       public       postgres    false    203    204    207    207    211    211    204    190    190    198    198    198    198    198    198    198    198    198    198    198    198    198    203    3            �            1259    24717    view_contract    VIEW     n  CREATE VIEW view_contract AS
 SELECT ct.id,
    ct.id AS contract_id,
    ((ct.customer_id || '-'::text) || (cs.name)::text) AS customer,
    ct.name,
    ct.group_id,
    ct.product_id,
    ct.service_id,
    ct.origin,
    ct.destination,
    ct.tao,
    ct.connection,
    ct.bw_access,
    ct.bw_cir,
    ct.bw_burst,
    ct.remarks,
    (ct.period || ' months'::text) AS period,
    ct.rfs,
    (ct.rfs + ((ct.period || ' months'::text))::interval) AS contract_end,
    ct.status,
    ct.date_modified
   FROM contract ct,
    customer cs
  WHERE (ct.customer_id = (cs.id)::numeric)
  ORDER BY ct.date_modified DESC;
     DROP VIEW public.view_contract;
       public       postgres    false    188    188    188    186    186    188    188    188    188    188    188    188    188    188    188    188    188    188    188    188    3            �            1259    24684    view_project    VIEW     d  CREATE VIEW view_project AS
 SELECT pj.id AS no,
    ((pj.contract_id || '-'::text) || (ct.name)::text) AS contract,
    pj.name,
    pj.start,
    pj.finish,
    pj.note,
    mps.name AS status
   FROM project pj,
    contract ct,
    master_project_status mps
  WHERE ((pj.contract_id = ct.id) AND (pj.status = mps.id))
  ORDER BY pj.date_modified DESC;
    DROP VIEW public.view_project;
       public       postgres    false    188    188    190    190    190    205    205    190    190    190    190    190    3            K           2604    16434 
   circuit no    DEFAULT     Z   ALTER TABLE ONLY circuit ALTER COLUMN no SET DEFAULT nextval('circuit_no_seq'::regclass);
 9   ALTER TABLE public.circuit ALTER COLUMN no DROP DEFAULT;
       public       postgres    false    192    191    192            N           2604    16461    components id    DEFAULT     `   ALTER TABLE ONLY components ALTER COLUMN id SET DEFAULT nextval('components_id_seq'::regclass);
 <   ALTER TABLE public.components ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    198    197    198            Q           2604    16480    components_req id    DEFAULT     h   ALTER TABLE ONLY components_req ALTER COLUMN id SET DEFAULT nextval('components_req_id_seq'::regclass);
 @   ALTER TABLE public.components_req ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    202    201    202            I           2604    16416    contract id    DEFAULT     \   ALTER TABLE ONLY contract ALTER COLUMN id SET DEFAULT nextval('contract_id_seq'::regclass);
 :   ALTER TABLE public.contract ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    187    188    188            H           2604    16407    customer id    DEFAULT     \   ALTER TABLE ONLY customer ALTER COLUMN id SET DEFAULT nextval('customer_id_seq'::regclass);
 :   ALTER TABLE public.customer ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    186    185    186            P           2604    16470    eventlog id_log    DEFAULT     d   ALTER TABLE ONLY eventlog ALTER COLUMN id_log SET DEFAULT nextval('eventlog_id_log_seq'::regclass);
 >   ALTER TABLE public.eventlog ALTER COLUMN id_log DROP DEFAULT;
       public       postgres    false    199    200    200            M           2604    16452    master_doctype id    DEFAULT     h   ALTER TABLE ONLY master_doctype ALTER COLUMN id SET DEFAULT nextval('master_doctype_id_seq'::regclass);
 @   ALTER TABLE public.master_doctype ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    195    196    196            J           2604    16425 
   project id    DEFAULT     Z   ALTER TABLE ONLY project ALTER COLUMN id SET DEFAULT nextval('project_id_seq'::regclass);
 9   ALTER TABLE public.project ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    189    190    190            L           2604    16443    project_documents id    DEFAULT     n   ALTER TABLE ONLY project_documents ALTER COLUMN id SET DEFAULT nextval('project_documents_id_seq'::regclass);
 C   ALTER TABLE public.project_documents ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    194    193    194            S           2604    24727    users id    DEFAULT     V   ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    209    210    210            �          0    16431    circuit 
   TABLE DATA               8   COPY circuit (no, id, project_id, name, ip) FROM stdin;
    public       postgres    false    192   �z       	           0    0    circuit_no_seq    SEQUENCE SET     6   SELECT pg_catalog.setval('circuit_no_seq', 1, false);
            public       postgres    false    191            �          0    16458 
   components 
   TABLE DATA               �   COPY components (id, location_id, name, description, nominal, nominal_measure, type_id, serial_number, status, confirmation, date_modified, role, po_number) FROM stdin;
    public       postgres    false    198   �z       		           0    0    components_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('components_id_seq', 186, true);
            public       postgres    false    197            �          0    16477    components_req 
   TABLE DATA               F   COPY components_req (id, name, note, nominal, project_id) FROM stdin;
    public       postgres    false    202   �{       
	           0    0    components_req_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('components_req_id_seq', 1, false);
            public       postgres    false    201            �          0    16413    contract 
   TABLE DATA               �   COPY contract (id, customer_id, name, group_id, product_id, service_id, origin, destination, tao, connection, bw_access, bw_cir, bw_burst, remarks, rfs, status, date_modified, period) FROM stdin;
    public       postgres    false    188   �{       	           0    0    contract_id_seq    SEQUENCE SET     8   SELECT pg_catalog.setval('contract_id_seq', 307, true);
            public       postgres    false    187            �          0    16404    customer 
   TABLE DATA               y   COPY customer (id, name, address, npwp, nob, phone, fax, mobile, email, officer, designation, date_modified) FROM stdin;
    public       postgres    false    186   |       	           0    0    customer_id_seq    SEQUENCE SET     8   SELECT pg_catalog.setval('customer_id_seq', 108, true);
            public       postgres    false    185            �          0    16467    eventlog 
   TABLE DATA               M   COPY eventlog (id_log, circuit_id, status, status_int, datetime) FROM stdin;
    public       postgres    false    200   �|       	           0    0    eventlog_id_log_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('eventlog_id_log_seq', 1, false);
            public       postgres    false    199            �          0    24688    master_comtype 
   TABLE DATA               +   COPY master_comtype (id, name) FROM stdin;
    public       postgres    false    207   	}       	           0    0    master_comtype_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('master_comtype_id_seq', 6, true);
            public       postgres    false    212            �          0    24634    master_confirmation 
   TABLE DATA               0   COPY master_confirmation (id, name) FROM stdin;
    public       postgres    false    204   m}       �          0    16449    master_doctype 
   TABLE DATA               +   COPY master_doctype (id, name) FROM stdin;
    public       postgres    false    196   �}       	           0    0    master_doctype_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('master_doctype_id_seq', 1, false);
            public       postgres    false    195            �          0    24670    master_project_status 
   TABLE DATA               2   COPY master_project_status (id, name) FROM stdin;
    public       postgres    false    205   �}       �          0    24733    master_role 
   TABLE DATA               (   COPY master_role (id, name) FROM stdin;
    public       postgres    false    211   �}       �          0    24618    master_status 
   TABLE DATA               *   COPY master_status (id, name) FROM stdin;
    public       postgres    false    203   1~       �          0    16422    project 
   TABLE DATA               ]   COPY project (id, contract_id, name, start, finish, status, note, date_modified) FROM stdin;
    public       postgres    false    190   �~       �          0    16440    project_documents 
   TABLE DATA               P   COPY project_documents (id, project_id, description, link, doctype) FROM stdin;
    public       postgres    false    194   	       	           0    0    project_documents_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('project_documents_id_seq', 1, false);
            public       postgres    false    193            	           0    0    project_id_seq    SEQUENCE SET     7   SELECT pg_catalog.setval('project_id_seq', 203, true);
            public       postgres    false    189            �          0    24724    users 
   TABLE DATA               2   COPY users (id, name, password, auth) FROM stdin;
    public       postgres    false    210   &       	           0    0    users_id_seq    SEQUENCE SET     4   SELECT pg_catalog.setval('users_id_seq', 1, false);
            public       postgres    false    209            [           2606    24695 "   master_comtype master_comtype_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY master_comtype
    ADD CONSTRAINT master_comtype_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.master_comtype DROP CONSTRAINT master_comtype_pkey;
       public         postgres    false    207    207            W           2606    24641 ,   master_confirmation master_confirmation_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY master_confirmation
    ADD CONSTRAINT master_confirmation_pkey PRIMARY KEY (id);
 V   ALTER TABLE ONLY public.master_confirmation DROP CONSTRAINT master_confirmation_pkey;
       public         postgres    false    204    204            Y           2606    24677 0   master_project_status master_project_status_pkey 
   CONSTRAINT     g   ALTER TABLE ONLY master_project_status
    ADD CONSTRAINT master_project_status_pkey PRIMARY KEY (id);
 Z   ALTER TABLE ONLY public.master_project_status DROP CONSTRAINT master_project_status_pkey;
       public         postgres    false    205    205            U           2606    24625     master_status master_status_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY master_status
    ADD CONSTRAINT master_status_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.master_status DROP CONSTRAINT master_status_pkey;
       public         postgres    false    203    203            ]           2606    24732    users users_pkey 
   CONSTRAINT     G   ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public         postgres    false    210    210            a           2620    16486    components isi_date_otomatis    TRIGGER     g   CREATE TRIGGER isi_date_otomatis AFTER UPDATE ON components FOR EACH ROW EXECUTE PROCEDURE isi_date();
 5   DROP TRIGGER isi_date_otomatis ON public.components;
       public       postgres    false    217    198            ^           2620    24613    customer isi_date_otomatis    TRIGGER     n   CREATE TRIGGER isi_date_otomatis AFTER UPDATE ON customer FOR EACH ROW EXECUTE PROCEDURE isi_date_customer();
 3   DROP TRIGGER isi_date_otomatis ON public.customer;
       public       postgres    false    186    218            _           2620    24615    contract isi_date_otomatis    TRIGGER     n   CREATE TRIGGER isi_date_otomatis AFTER UPDATE ON contract FOR EACH ROW EXECUTE PROCEDURE isi_date_customer();
 3   DROP TRIGGER isi_date_otomatis ON public.contract;
       public       postgres    false    218    188            `           2620    24617    project isi_date_otomatis    TRIGGER     l   CREATE TRIGGER isi_date_otomatis AFTER UPDATE ON project FOR EACH ROW EXECUTE PROCEDURE isi_date_project();
 2   DROP TRIGGER isi_date_otomatis ON public.project;
       public       postgres    false    220    190            �      x������ � �      �   �   x����
�0E盯���^��g7����"dȤf(R+%���ե��8��=��'��iMO�G!������Tw����%n�y��y餩ıj[p��/�0݊����aƐ���h�Y��H�����D�y�{��Xc�]e2�      �      x������ � �      �   W   x�360�44���J,��KO�S��+I-�K-QH��,I,��"(?+1;��$$��"#Cs]S]#S+0��s��qqq �%�      �   �   x�=�Kn�0D��)|�ؒ��l�"A�d��2!Yd��e��[r�ͳ&�'�i������U�=o+
�:����[^ז�P-$`�ջ�-�C�΃C4�xףּl�����|G�r{���+�_8R��p;5֌p��������2
Pp߅8N�Y�ʤɭp�j0!jR��4��:8p�$[}��vM���H>      �      x������ � �      �   T   x�3�-�����2��/-I-�2�����,�/�2�RRs�8��rR��8�R�B*R��s��R�J��8�S�ʀ�b���� �En      �      x�3��K��K�,�MM�2�t��c���� ��	A      �      x������ � �      �   0   x�3���/Q(.I,*IM�2���SH���K�2�t���,� ���qqq ��      �   (   x�3�(��JM.�2�t*MKK-�2�.H,J����� �k�      �   C   x�3�t,K�I�L�I�2�t*��N��2�J-,M-.IM�2���+.I���M8]2�s�J��c���� aQ�      �   u   x�M�A
1 ��+��]��R�D�z�Kİƕ��_��s��!��pa����l�D2U8���lA����p}jg�D�T��Q�����'�5�4,�^ضk�mW[Nc>P�=N#"~Q�%�      �      x������ � �      �      x������ � �     