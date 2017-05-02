PGDMP         ;    	            u            ajn_osc    9.6.2    9.6.2 ?    �           0    0    ENCODING    ENCODING     #   SET client_encoding = 'SQL_ASCII';
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
       public       postgres    false    1    3            �            1259    16431    circuit    TABLE     �   CREATE TABLE circuit (
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
            public       postgres    false    191            �            1259    16458 
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
    date_modified timestamp without time zone DEFAULT '2017-04-19 12:25:28.6136'::timestamp without time zone
);
    DROP TABLE public.components;
       public         postgres    false    3            �            1259    16456    components_id_seq    SEQUENCE     s   CREATE SEQUENCE components_id_seq
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
       public       postgres    false    3    202            �           0    0    components_req_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE components_req_id_seq OWNED BY components_req.id;
            public       postgres    false    201            �            1259    16413    contract    TABLE     �  CREATE TABLE contract (
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
    period interval,
    rfs timestamp without time zone,
    status character varying
);
    DROP TABLE public.contract;
       public         postgres    false    3            �            1259    16411    contract_id_seq    SEQUENCE     q   CREATE SEQUENCE contract_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.contract_id_seq;
       public       postgres    false    3    188            �           0    0    contract_id_seq    SEQUENCE OWNED BY     5   ALTER SEQUENCE contract_id_seq OWNED BY contract.id;
            public       postgres    false    187            �            1259    16404    customer    TABLE     Z  CREATE TABLE customer (
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
    designation character varying
);
    DROP TABLE public.customer;
       public         postgres    false    3            �            1259    16402    customer_id_seq    SEQUENCE     q   CREATE SEQUENCE customer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.customer_id_seq;
       public       postgres    false    3    186            �           0    0    customer_id_seq    SEQUENCE OWNED BY     5   ALTER SEQUENCE customer_id_seq OWNED BY customer.id;
            public       postgres    false    185            �            1259    16467    eventlog    TABLE     �   CREATE TABLE eventlog (
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
       public       postgres    false    3    200            �           0    0    eventlog_id_log_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE eventlog_id_log_seq OWNED BY eventlog.id_log;
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
       public       postgres    false    3    196            �           0    0    master_doctype_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE master_doctype_id_seq OWNED BY master_doctype.id;
            public       postgres    false    195            �            1259    16422    project    TABLE     �   CREATE TABLE project (
    id integer NOT NULL,
    contract_id integer,
    name character varying,
    start timestamp without time zone,
    finish timestamp without time zone,
    status character varying,
    note character varying
);
    DROP TABLE public.project;
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
       public       postgres    false    194    3            �           0    0    project_documents_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE project_documents_id_seq OWNED BY project_documents.id;
            public       postgres    false    193            �            1259    16420    project_id_seq    SEQUENCE     p   CREATE SEQUENCE project_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.project_id_seq;
       public       postgres    false    3    190            �           0    0    project_id_seq    SEQUENCE OWNED BY     3   ALTER SEQUENCE project_id_seq OWNED BY project.id;
            public       postgres    false    189                       2604    16434 
   circuit no    DEFAULT     Z   ALTER TABLE ONLY circuit ALTER COLUMN no SET DEFAULT nextval('circuit_no_seq'::regclass);
 9   ALTER TABLE public.circuit ALTER COLUMN no DROP DEFAULT;
       public       postgres    false    191    192    192                       2604    16461    components id    DEFAULT     `   ALTER TABLE ONLY components ALTER COLUMN id SET DEFAULT nextval('components_id_seq'::regclass);
 <   ALTER TABLE public.components ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    197    198    198                       2604    16480    components_req id    DEFAULT     h   ALTER TABLE ONLY components_req ALTER COLUMN id SET DEFAULT nextval('components_req_id_seq'::regclass);
 @   ALTER TABLE public.components_req ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    201    202    202                       2604    16416    contract id    DEFAULT     \   ALTER TABLE ONLY contract ALTER COLUMN id SET DEFAULT nextval('contract_id_seq'::regclass);
 :   ALTER TABLE public.contract ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    187    188    188                       2604    16407    customer id    DEFAULT     \   ALTER TABLE ONLY customer ALTER COLUMN id SET DEFAULT nextval('customer_id_seq'::regclass);
 :   ALTER TABLE public.customer ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    185    186    186                       2604    16470    eventlog id_log    DEFAULT     d   ALTER TABLE ONLY eventlog ALTER COLUMN id_log SET DEFAULT nextval('eventlog_id_log_seq'::regclass);
 >   ALTER TABLE public.eventlog ALTER COLUMN id_log DROP DEFAULT;
       public       postgres    false    200    199    200                       2604    16452    master_doctype id    DEFAULT     h   ALTER TABLE ONLY master_doctype ALTER COLUMN id SET DEFAULT nextval('master_doctype_id_seq'::regclass);
 @   ALTER TABLE public.master_doctype ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    195    196    196                       2604    16425 
   project id    DEFAULT     Z   ALTER TABLE ONLY project ALTER COLUMN id SET DEFAULT nextval('project_id_seq'::regclass);
 9   ALTER TABLE public.project ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    190    189    190                       2604    16443    project_documents id    DEFAULT     n   ALTER TABLE ONLY project_documents ALTER COLUMN id SET DEFAULT nextval('project_documents_id_seq'::regclass);
 C   ALTER TABLE public.project_documents ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    194    193    194            �          0    16431    circuit 
   TABLE DATA               8   COPY circuit (no, id, project_id, name, ip) FROM stdin;
    public       postgres    false    192   =C       �           0    0    circuit_no_seq    SEQUENCE SET     6   SELECT pg_catalog.setval('circuit_no_seq', 1, false);
            public       postgres    false    191            �          0    16458 
   components 
   TABLE DATA               �   COPY components (id, location_id, name, description, nominal, nominal_measure, type_id, serial_number, status, confirmation, date_modified) FROM stdin;
    public       postgres    false    198   ZC       �           0    0    components_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('components_id_seq', 182, true);
            public       postgres    false    197            �          0    16477    components_req 
   TABLE DATA               F   COPY components_req (id, name, note, nominal, project_id) FROM stdin;
    public       postgres    false    202   �D       �           0    0    components_req_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('components_req_id_seq', 1, false);
            public       postgres    false    201            �          0    16413    contract 
   TABLE DATA               �   COPY contract (id, customer_id, name, group_id, product_id, service_id, origin, destination, tao, connection, bw_access, bw_cir, bw_burst, remarks, period, rfs, status) FROM stdin;
    public       postgres    false    188   �D       �           0    0    contract_id_seq    SEQUENCE SET     8   SELECT pg_catalog.setval('contract_id_seq', 301, true);
            public       postgres    false    187            �          0    16404    customer 
   TABLE DATA               j   COPY customer (id, name, address, npwp, nob, phone, fax, mobile, email, officer, designation) FROM stdin;
    public       postgres    false    186   =I       �           0    0    customer_id_seq    SEQUENCE SET     8   SELECT pg_catalog.setval('customer_id_seq', 104, true);
            public       postgres    false    185            �          0    16467    eventlog 
   TABLE DATA               M   COPY eventlog (id_log, circuit_id, status, status_int, datetime) FROM stdin;
    public       postgres    false    200   YR       �           0    0    eventlog_id_log_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('eventlog_id_log_seq', 1, false);
            public       postgres    false    199            �          0    16449    master_doctype 
   TABLE DATA               +   COPY master_doctype (id, name) FROM stdin;
    public       postgres    false    196   vR       �           0    0    master_doctype_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('master_doctype_id_seq', 1, false);
            public       postgres    false    195            �          0    16422    project 
   TABLE DATA               N   COPY project (id, contract_id, name, start, finish, status, note) FROM stdin;
    public       postgres    false    190   �R       �          0    16440    project_documents 
   TABLE DATA               P   COPY project_documents (id, project_id, description, link, doctype) FROM stdin;
    public       postgres    false    194   eT       �           0    0    project_documents_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('project_documents_id_seq', 1, false);
            public       postgres    false    193            �           0    0    project_id_seq    SEQUENCE SET     7   SELECT pg_catalog.setval('project_id_seq', 200, true);
            public       postgres    false    189                       2620    16486    components isi_date_otomatis    TRIGGER     g   CREATE TRIGGER isi_date_otomatis AFTER UPDATE ON components FOR EACH ROW EXECUTE PROCEDURE isi_date();
 5   DROP TRIGGER isi_date_otomatis ON public.components;
       public       postgres    false    203    198            �      x������ � �      �   ?  x���=n�0�Y>�/C�)��{��:4�޿r'�6�
Ȑ ·�'R �8�=������k�p~����w��0��"�PW���c�F��>[����l��m�
�iZ0�A��\l�T!�M�iB*A-��D���4��ȮL�˙8#ا�K��h��D�H��ȳ/���i�N�u�t�j>��pj�)l:���3�@=p��! =�~"���@�� �=p�! @��=0@�y����8\� �V2�[Rf�
�S �SP�\(�k͌��@��pr���0o�Fd�0OjD(��:9�K�-���Ҙ�      �      x������ � �      �   g  x���Mn�;��>��@I��qg�9+褃���(H�{B�q��1�����q��N>J�T�������ow�>����ݯ��o�TR�7����.��2�[�G����v)�Q�En�����;����6x�2�r���B�xx��/��T,�R�������qY���&��yO��}Xr��]h$@�è���	Ο7�$W����⒋ty%7jx��*y�1d�\�,�0�}r3� ��8�P���
���Я:#�Dc,r	X�5$gj���~2�P��
��ad&Ř
F�ukv%����ܨB.�KV#w�%���"�s@A?ϋ<� �F@A��%%+)�00洁9"�7���B?���b�.$P�0�UH�m�r�@7d�T\I`�pd��u�8�_�i����I"�f+	H����[�A�pJ���J����Mm OE^Ozۑ$�j�٨��-p��T��l�@�M�����H��@$�p�A5׀�~2�0��N�!t�9y^a�g�@���s��&5 ��v.F���z*`�+���2Z@@o�Ar��Q蓫�1];�"yN@(�0лp#�n��0�{Ր܌<wP��vxDr�c>�A%w#u��pE����!d��y8�7$���
i���X�%���y�˶��~��ȼ�����JZ]?��fUo��C(�gc�����GXlNq����n=yl7�p0�n3�t]lv�tb���~̋<Q ��v�y	�r�×$�v������.�H��1����m�f	(��]lrK��YN�9�^�v��|��DG6Q��aJ}e��qX�g(FV*Р%�OW�H۾1�_c�:���1����ȅ*~�9]F���T������@�����Q�#<Ր����q�!�����BfC�7�qz#�jd���8�.򬹜�u豆lo^b~�h�Gm�N)��F����\�]W��gO�q��� n�K�4���5R��	4tC^�i!�[X���j�x����.P�����<o�%�]�����7ؕUh�z�=�k���s����,*�����l��X����Y��z����/O��Qj/?/o/��o�EV      �   	  x�U�K� �еx
���d&�ɥ�kx��`iɆu|����F�:bU����w�ϯ����_��~��O���/_~��뻟~��Ͽ����o?��ן�|���_���ǯ��_����ǿ��o��~�����RrY��s���ٹ�svnt���݉�<v��<��|v��<����:Ow"%�N�N˧��i�i���N�N�N�d}�Ի���z��g��ԫԻ)Y���Ko>����J�g�E��ۥH�R��.}��}��*}����J_�"%k�4�4�q|�F��gi�4�4�)Yg��|K?�����/�G����~�]����aY6���>�vP(�)��^Y�����z�z�zE���ò��En��� n%����-�cXր�(o����Է�߂�E�����ÕWK\��h�aѡq��*Y+A.�\Ir����*.a�2���͕8W�\��a�!t��*m+�.(]�t����RV��r���ו`W�] �h�aѡV�V��Z�ZM��jj�jj�j��i�U��T��V�V��aѡV�V��Z�ZM��jj�jj�j��i�U��T��V�V��aѡV�V��Z�ZM��jj�jj�j��i�U��T��V�V��a�C�R�<M�
��j��*�*�2,{�U�Ղ��V�VS��Z�Z�Z�e�J�Z�4�*�j��V�P�T˰�V�V��Z�ZM��jj�j�=�n��o���;��V��vS-ò��M����T��v���j7�n�eX�P��v��j7��T�[��M�˞_���_��q�_��y�����_��=�n��o���;��V��vS-ò��M����T��v���j7�n�eX�P��v��j7��T�[��M��j7�S�ڝjw��P���a9C���]�v��P�S�n�j7�2,g��T��N�jw�ݭvC��Z����jO�;��@�I����=T˰���P�)x'��=������j�3��=���'՞V{��P-�r��C����T{�����j��eX�\���)���:��i�O�@��X�vX�P{����jԞT{Z��C����jO�;��@�I����=T˰�P{����jԞT{Z��C����jO�;��@�I����=T˰�P{����jԞT{Z��C���F�V�,��Z��VkPkT˰�PkTk�R�A��Zk��F���F�V�,��Z��VkPkT˰�PkTk�R�A��Zk��F���F�V�,��Z��VkPkT˰��[�K�'����_�&�0���c��PkTk�R�A��Zk��F���F�V�,��Z��VkPkT˰�PkTk�R�A��Zk��F���F�V�,��Z��VkPkT˰�P�T��S�C��Zo��N���N�^�<�:�z��V�P�T˰�e-7|�0͵��r��\6TJ|�:G��?x�:�=�����r���(p�/͞��1
<G��(p��(`X|��(���9
��sx��(p����(p�/͞��1
<G��(p��(`X��p;��<�=��t�]gn;����x��1
���K��(p��Q�=
��9
�;F�sxi��Q�9
�G�c8G�r�(p�/͞��1
<G��(p��(`X�����曣�b��G��(����r��|s\������(����a�C���[�n��P{S�m�j/�2,w��T{�M�jo����B��Z����jo����B�M���^��T˰ܡ�R�-x7�^��������j�7�^�����7��V{��R-����81��O���Q��بύ��Q����jo����B�M���^��T˰���R�-x7�^��������j�7�>�}���/վV���Q-���G���T������j�>�eX�P�����jԾT�Z��G��jվ��R�ڗj_�}P���ayC���W�^�}P�R�k�j�2,o�}T�
�K�j_�}��A��Z�%��G���T������j�>�eXb�}T�
�K�j_�}��A��Z�%��8���m����o���ط�}��o�%��G���T������j�>�eXb�����6�6Rm�ڀڠZ�%�ڠ�(x�jj#�F���eXb�����6�6Rm�ڀڠZ�%�ڠ�(x�jj#�F���eXb�����6�6Rm�ڀڠZ�%�ڠ�(x�jj#�F���eX��`d%/�m�m$�h��A��n�n��E���t�6�6��o�nn��H���p����2��^��6p��m�ō����}wc\�������1/p�%\��\��8x�c��`���"�?����      �      x������ � �      �      x������ � �      �   �  x�e�=nTA ���)|�Mw�_���N,��"��0��і�=A�$_;��ӯ�o������x��o�������p��y����.����3s�P���E-�N���:T'u�.�R��}_�yD;U��[��ak�5lM����ְ5��&[��dkؚl�-dl![`�[��B�����-��l�-dl![bK�[ʖ�R�Ė�%��-��l�-eKl)[bK�[�V�J��V������l��d+l%[a+�
[�V�J��V�ul]����ֱu�:�.[��e�غl[��c�ul]����6���!��6d؆lېm`�lC��m�6���!��6e�ئl۔mb��MlS��m�6�M�&�)��6e�ئlےma[�-lK��mɶ�-��%�¶d[ؖlےma[�ml[��m˶�m�6�-�ƶe�ضlۖmc۲ml[��m���<�<�mϏ���/�&�      �      x������ � �     