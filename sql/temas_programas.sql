PGDMP     -    2                x            ahrsc    9.2.24    11.2     )           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            )           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            )           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            )           1262    19793    ahrsc    DATABASE     w   CREATE DATABASE ahrsc WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'es_AR.UTF-8' LC_CTYPE = 'es_AR.UTF-8';
    DROP DATABASE ahrsc;
             postgres    false            �           1259    565965    temas_programas    TABLE     l   CREATE TABLE mod_catalogo.temas_programas (
    programa_id bigint NOT NULL,
    tema_id bigint NOT NULL
);
 )   DROP TABLE mod_catalogo.temas_programas;
       mod_catalogo         postgres    false            )          0    565965    temas_programas 
   TABLE DATA               E   COPY mod_catalogo.temas_programas (programa_id, tema_id) FROM stdin;
    mod_catalogo       postgres    false    2045   �       E&           2606    565975 $   temas_programas temas_programas_pkey 
   CONSTRAINT     z   ALTER TABLE ONLY mod_catalogo.temas_programas
    ADD CONSTRAINT temas_programas_pkey PRIMARY KEY (programa_id, tema_id);
 T   ALTER TABLE ONLY mod_catalogo.temas_programas DROP CONSTRAINT temas_programas_pkey;
       mod_catalogo         postgres    false    2045    2045            )   �   x�%���E!�3�% ����Xfޥ�,GPKu1�@uŮ&�B�@��`�5ʌؕ��Rj����&��.����ț�Cm{�7[��1Fc�O�F]�Q�A/MZ�Ѧs��i�)���1��}f��5g�L��� 便J�K��=��<���w�����⡝⦽[�q���9��q�R�t��aj��9�����߲ѣ��}�u�Ҥ���G:8Yp�@����ֿ?U��1Y�     