PGDMP         3                x            ahrsc    9.2.24    11.2     )           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            )           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            )           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            )           1262    19793    ahrsc    DATABASE     w   CREATE DATABASE ahrsc WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'es_AR.UTF-8' LC_CTYPE = 'es_AR.UTF-8';
    DROP DATABASE ahrsc;
             postgres    false            �           1259    565932    programas_subprogramas    TABLE     �  CREATE TABLE mod_catalogo.programas_subprogramas (
    programa_id integer NOT NULL,
    programa_id_parent integer,
    idunic integer,
    id1 integer,
    id2 integer,
    etapa character varying,
    id character varying,
    programa character varying,
    rubro character varying,
    categoria character varying,
    cod_unsubclase character varying,
    cod_ob character varying,
    cod_estudio integer,
    cod_esia integer,
    cod_temp character varying,
    cod_territorio integer,
    temas text,
    id_responsable integer,
    instituciones_interv text,
    responsable text,
    descripcion text,
    tipo text,
    convenios text,
    layer_id integer
);
 0   DROP TABLE mod_catalogo.programas_subprogramas;
       mod_catalogo         postgres    false            )          0    565932    programas_subprogramas 
   TABLE DATA               ;  COPY mod_catalogo.programas_subprogramas (programa_id, programa_id_parent, idunic, id1, id2, etapa, id, programa, rubro, categoria, cod_unsubclase, cod_ob, cod_estudio, cod_esia, cod_temp, cod_territorio, temas, id_responsable, instituciones_interv, responsable, descripcion, tipo, convenios, layer_id) FROM stdin;
    mod_catalogo       postgres    false    2041   �	       E&           2606    565940 2   programas_subprogramas programas_subprogramas_pkey 
   CONSTRAINT        ALTER TABLE ONLY mod_catalogo.programas_subprogramas
    ADD CONSTRAINT programas_subprogramas_pkey PRIMARY KEY (programa_id);
 b   ALTER TABLE ONLY mod_catalogo.programas_subprogramas DROP CONSTRAINT programas_subprogramas_pkey;
       mod_catalogo         postgres    false    2041            )      x��\�r��r^SO1��\%� I��EѶnI�J��J�lF���	���u�U� Y�	������U�&y�|���ꇒ��-�����t��@�����?�".e�n F�+W���ZG��y�B9�b��i�8G�ǥ��s�D�V�,GE�u���ֻ���u��w^0[}�B��+ʮ��ڝA��it&�_�Z��h4j������t/�S��?S��B��[1���+#�a�}�~���KF��I�|��JO����{��ߘ����2�Z|I��d��e�^1^݇��J�! 82���k�"U[�cT�eP�i^�շ�!g	���+���2����Z�V�JO�3�����܊ȍ���ilw�&�6����QW�3��d�$�v�$y���w[�o3�2�x�L�4��ǅ
a�{?�T�����k��S�Y��vz$^����J�}��L&�����p��}%#%2�b@��Y.u���9�qB���ʄ����ܓ�l�r����8�	�~x�8���O�k��%N��ɦ�����cT_���<�E"���'���q�ܽ��+A�E�����I���?�K�f�Ncq�?�o}hf�������NOjZ����1j�`��T�$ܙ^��$��bb�-๪�#�kXE�f����(��U���JF��0+|#�-��,F!BR��R�͉���F�{o."�/�ww�'����[��e����SC�����LxH��Q3Cs�^dQ��K�.���X�Nš�H�o���a��%���CR9r��h%��nn\&O���.��(v�$���,z��r�����_��s�(
��0Q>T0r�e?[7�2T~�M��f��N3]j?B��]K"e��*v��Aϙ��X��*��
���6̢�:r)�ta��FN��ߚ�-bԇYw&�x�p�'�,��t������rB�K&&��a�d"���	~�`{��wH�|�(�tC����h�1���[�&��e#�Cu#��/?��X�Sbrt�B68^
�u��c'v�k��ƀ{��"��0[A�����ݛ�1V��;�91���g��w���8�\�ِ#=�~�#{��`%Y4u΋��p��J�l}����'�I#F}���%O��+��k>g�p�@��Ý�������'�N'�ӚD��I��O�"[��qN�Y����I�ld��az���g�nt�J"F��9>o�����K
��5�G�� ������x�5ɭ�/~c���a�QfD&*IR�^\v'�b:I�\Q��� ��?���3p�%8
xM7���xG�8�+H���O��G������T1o�Mٔ��]b���Y$F}���I��9"���� $�7l2�l�*'�@��J���aԇ9k����JVߵmQl���,c���}�k�|�D�t������3�2q��׺���hK󔐕��E�s�#ږ�����T f3�������GG�c񶌝~>Hщ�a�;�ގ�3uVz��7r/�������-~�d#'a�_TCv�q��,�9/28Y N���XBD�&����ttQc��)�'�,����Gs�{7��H/}�^�k���� �6��0+�D���C�)�o����U����1&��ܫ�t�"����ߘ��ggXƗP�6�=S8��0횁�!g�j��v�-x���*>W����=�����A����ꡫ�`6$Z�<��6BY���T@��W�6'���Im��%�p�	���8np���Ŝ�>��2qB���2�=Y}�E�������x�Z�șar�j�=ZiVe%�'�c̾9ݨ}�Z3B��ɴ^�=����fa P�"�7�}a����U�K������̾�oZ�71�ì[s�Ҡ���8�>%bn��^��$��	)<%�W�V
�'���$$%��>�Q5�P1�ì�js���]_��~�.a�9
�8K�P�7���/���m��:9]�i.F}��R��Ŝ)�͎�PG�Th�)�_>��`%��(@�L�1�ì�*E6*�fGb
{����(?��L�Wҋ
���k%�L�1��\+�R�N��)g��_lDB��w@�����\�}�Wm���Q����L���0k��9����"� ���a��Z;6�e��0K[�ː$G���1�ԲZ<}�=65Iy\�¬:�aЫo��+�D���r�F��<E�>��l���vz�5P&�?�Mj���+�x(�Nյ�!�R��[[�v;�_��W�?<���$-�܊`Q���f�W��o���1�ì�2?b��ד\y���l	�d���_�^��0�����+��op�P�pa�f�Qf|��8�/<w��5�}6 c� 0=Ũ3���&�!��s�t�>�P�s���J=�U��9"F}���9�8�/�0�BoK�ޡ���ݤy&_;ii&wm�q9�_;EJ��݈��>H2�8sp,b~�[b<�����BY$u��O�;�A|�����3n��|�� ��9�
{|��0v��t��V�h5c�'*��k
S��Q|q=���X�2�]2n|7vho��QN��Nӛ�|���<^<S�nGA}9L~�؂���L'������OƑ�]�`IEc��Q�k�ӺL��.�,	9$~qi���矙�8�V��W�ą{w�%f
�d�����V��!��2�о�qõ�s�}�Y��P�'�"�)�f�I�t�^���
�Jn�������"�S	0>�i����w������mH{�=a����)`< �
�^���䮯�{��#��?�`*�q ���f�R�)z��F(5Z݃��B@��W`��Dgr��wL�>��҆-��e<_�S��g����������Ur2�=qAJ���Wa)@��3��;m�qU�7]��LF*�x����Bj����i��4:��Ľ�G����j���jH]M�:����g#L���*���R�{��7�̣[4|��ǜc�j02S��ld�	�N#����=�т~=��0=�6Ԯ�S� �w;y�J�ò�ݠ���X�M�X|���jDvP7���Z�lǾI~{-�d2\y��8���/-ڀI�Ŏ_�#ɩ1�Idk�ǹ���S㥦v ��s� ��)*폭�ݞ�1^n�z!�
�L)0R�O��U:�LBSa�[!cz6�[�{ܕS#t��'_rg�I@���ɦF�:��	����5��g���Z�Y������.���G���*]�yn�<���R(��q�m����=N
`���S��*뵍�i&>�|륚)�(?����=6��!	��➴�lu߿����8׽7J[��z��l�d�mѲh�Ա�â�̘���ө�yɠ��}��F���u9���U�����'gM�սŞ��U�|���-��ե5^�!v��d-���|����"/Ǜ�*�ύ͐m�ۨ�)@ޔh�xljlz���1vc��'���޾]��1��z*�HU0�=�T^��·`�=/��O9�L!0R�D��U���m|��N|�}Rش��z;��uJ�/d�ղt�:/����o�}� _��|�A3ר���\M��gor%$Fj�3Ȇ��)/u���3�GE*�0�uٱ�%2������P�ުSц��i!$�_�<��.�`�R��s�䕊o ��wҕ��$�'�9���N�=��6�6��I�v�MV��GW������D��1p����ʈR���$���4�NWpX����y֞xx�}p@0�C����	��&���x�?uSP�����g�����s���PƮ�
��Y�;�N�1�*텲<9>z�>]}�G�V�J���~�`ye^H���LS��>� �R97�+~�5�:���i�xj�����X>�ڭp�TMhc����MŹ�=h���ܤRy�&�n���vrv�_s�=Ǩg6:"��M)�#���se��O��c|�DQ�8w�΀'n�"���+���|(�vO.ն��4���R�/�Gk�bMYTk�k�����#��lWm��{����kee�v���牺�Rv�θ$Gu��h�E   ��n�`�.���SkM�~!����_{�P̖(;���*��z��*�Z�
�ȻD�KNV��:�7LʶV������=@*C����X}�W�jUv-�}٭�$K�L��apF�~�~�P�@e�rK�҅���զ���=̾-̟d1@#�e"��4�<�‹aد���&�e�o�Ր����V��\�W�����d�� ���a�$ri�[�+��^�����)�!׹,��P(�wf��R���-c�K��&1le�nS֐oI��y]��bڬ�*b�:���9t7��&xl������:�T���|�Ijp�㍚&������3��J��&�������r�yV�9�Wh�DP�;+�ӷE����VMz9���7 �^�WN�^J/��PR~�T���4����������Ty���d���̥��	�E���`�$�w�:��fzǫ��;K{�|��8M�>+�=��y8�Y�!�H�u�ې���,��H�"}���Qanה��	���&.�-V{��nX��o���-����[M�Y`C����[O������H�j�z �_���r^�N�}��vg�{�
��/{e���N[�����ݫ��H�,S�b��U���=M��d����O�G;�j�v���O��0ߏ�7�5L�ct؀��v������O�O[�*�=M��C�
|���NZ��2�׫kZ��/KڜL�s��@��S�a����,��8�����9F�)c^y�P�
� RoK Ɖ��!����D�Z��xuOoF{�)�h���[��MZ�o,�	 Fۢ����Q�H��Ef�H�~�z��݌�@�q�揩�3��7���5��~�Ӫw5�n^����85���J��ŗ��Cw�F���tJ�k�0ګ�ދML�����������!�w���F=tw�	c��M�;|��/І'��uޣ�ff|+�������u����&xmn��!l�k��5/���[��g|@�[�J7�W�SaB��b�t�N���l��LA\$W�F��_}e��.k�K�b�ޒ6��{A�i������jr�^�m��d���;���ǎ���G�a��,6�w�����u�C�_~n�uu��ܺ���;;;��҇�     