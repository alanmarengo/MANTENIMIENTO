PGDMP                         x            ahrsc    9.2.24    10.6     )           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            )           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            )           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            �           1259    565851    temas    TABLE     �   CREATE TABLE mod_catalogo.temas (
    tema_id bigint NOT NULL,
    tema_nombre text,
    tema_desc text,
    tema_ficha_path text,
    geovisor text,
    geovisor_mini text,
    recursos_asociados text,
    tema_id_ui bigint
);
    DROP TABLE mod_catalogo.temas;
       mod_catalogo         postgres    false            )          0    565851    temas 
   TABLE DATA               �   COPY mod_catalogo.temas (tema_id, tema_nombre, tema_desc, tema_ficha_path, geovisor, geovisor_mini, recursos_asociados, tema_id_ui) FROM stdin;
    mod_catalogo       postgres    false    2033   �       E&           2606    565868    temas temas_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY mod_catalogo.temas
    ADD CONSTRAINT temas_pkey PRIMARY KEY (tema_id);
 @   ALTER TABLE ONLY mod_catalogo.temas DROP CONSTRAINT temas_pkey;
       mod_catalogo         postgres    false    2033            )      x��[ˎG�]�_��H Uv�^�Ơ\m��eal̪!��b�&�AGfb��f5_��LC�^�d�dι7"2�d��`VU$3##���s�tr����k�v���?��y[�uuc���-ls�J��o���o�՝񅭋�5����m:W������J�WmW5���+���bΥm;ߘz����o��k\��jn���C�kW�G�o�Q��V]o�j���j�np����������~,:7�L�Ei�������⫅�몱�)�۪4�K͝/�{lW�=��q�+W�\g�l�7��d�+��}㼦=+^�ߪ��j�=�ƶq�s~��M�2���ee.5��SS@s�Y��|���W�^Ͻ)fγ��ʠ�%����l��o����Y�A��B}�쪵����*��M���t�W�j�~����|ȭ)�/�ۏxtLe�i5�Ū�uiD�+o[��&n��p����>Z�l��kW�3aϫn�l~�Ò�m��ȴ�f��$���׶�x�`�����4U�tzU%�Ǔ�貁-�ۺX��=89��]�/�-{ߺ�K��ִ���M���_>}GC>[�op�ºu�:��]�K���S���/�;��n�V�J���Ҽ��r��B[�-���ts�ݓ�n����/�M~G���yzo�]���ڨ,E{����ŇuՔ}S��A�����'ѫy|
ߙYm�aJ���
�Zo��w�Յ-�媶����x�]�uZ�iӦ>��V�0N��6K�asEUD୦xd�V썗��L�B�&m�XB�x��B	��k^y�l�'4��\O��'8�Ȇ�h�����Լ�\'��e�y��[�l�����?����b�i�t���Q�X�������L�����ͼ���3\��.��G�ws��$v���V��?;bŻ��~>�K�ˉr	h�*EN��'��}�#�/g�*{��b����= ���k�*�s�A��\[��뮒ԛ��T+7ހ�|���o?-��m5�����F��~,͎�Xl:n��xqK��a`ۿ;5�v�i��d0��B��-�Ж�����ܹ�O��<6Ѩun� X�^XFY������N][����]�L�Ҝ~��m��~c�p��AFb���@�N9��<"̟?�}0��­�cF';i��G�v��g���Sf����9yK�q��T�	`�$D�� ji�/��o����8[�9���!:� ]�ڋ+��MX�{r�����j���MVP<ge}	��A֞�GM�'��f�y�==�W��:k�[��:�s\݂6�߱��0c���;|�R��*uGݭ-� G6������D:!�F�� �Q.�8��҄"{�
κ6uo��ڴg�a|���ڽUHc[9���ڊ����5����e���,��j�J����d#|�ج��"���iM+�'�,ZNK	�cv�q���|'�e?/O9��#�g�z�ova����:WBG���_��Bõ?,�y�}�
P-*e&vL�1�{���
�Q���\T]f�Uײ{��P5�_�~�x���O����ԡ�@Z���.=��_�R��G�k	j�fr�荜�,H � *$��q�to���t���h�&��x�ZT�|�E�! �k�§�(ș *�$UA�t/��� 6��zM�;8�'1*��Mp�c��j����X �agg��hJdh�A�q)x�: �ϓ��{X������/0Ǩ�7�,�c	���%�5yeZz*9�=���M��,�V�C|X<|c���׏ ��Yջdۯ��x<o��b����V���!G��J�S�Q0 ��38*�	��<T�銦�_�N����h��YŬJS3דM{���T7F����Ħw�Ȩ�I��?�O��^��%�f��
��<�q�d&
}�'j@��rDŻ����ܘ�UqH$�`���K�Ps�j����T�Z
,\L����Z�m �Z5��Z2P�[�o�Cl?����g #ţ�~����Vu��4����=<�fʖ�=�E��w�d�9C[������H�ȞZ����x�٩P|��;1s5��gx�	W�+��cI�=����@5�vA/�M,XmHO��#z�i�h��,n�~]i؄����2������F���l��Ԋ��2��O����e���s��>xD@���$O�����G�=+~%;d�pwXib���@gf�}�������A�A]+r����u+B}�,�!3�jm�+,�{���7Cp�W�*��E�*$�X&q3?�	�� �Z9JV>ډ��0lR|�D3d7�>6�k�����8A��*<ޱH4�I�}�r����l�ٻ���/�)�8?�����p����W���2���`_�Ȭ�� )��6�ps�1ԤNUI�E����D�@r=�jwN�Z�o�� �N��X�^����&�4Џ:������o�p-i����X0hp$�E5��M�F>�Z������.����b&�����^�A��V����ڙ2C'�����A4b�)��I�u$[�6-UB���Ғb,kn
��=��A0�P�u���]��:b����/�q\D���e�cL&z�.�:Ã�M�:yE�`�!8��t��D�ۏ}M'ם^���U]��j��]�N-LS:~k�e�X�`8D���v���Ϧ��A#4����E�u�ϪT<���ph[l(�Q�8eI)�'�a����(�fa]�	a]oZM~��>t�
;�/o?9H:&�K�@<���M�ҳ���4���W BIT�\4���{�C����uw}���D%(xU���2�������ח���rr*>��$V4+⛙9?W���.�Y����*�7�86b�U8jUA��[�!��#������C�*ȲDdu~ȃ~�Йg`y�v%�Ъ%��O�����\_���i~��]2���d���X�i�Hz��_���1�������R�
��T�w�W��tR�Md9����e�R�l6�I�h5mM];<f��uj��iܬ3���uR�!�rݪ��J�����\0���&��\�")�tgH&	<�{�AV�u�.,J{-S����čG��܏�S2�&B��� ������{OZܳw�A���GM�do��Xs(71�sd�v���?ًtr"��.��5�B'�h��}�:�?l���AF�R(Q%r��T�����>�M�zͬG�T��(tJՁ�v��j�?�
���|)�	�f�����d#�KC;�Y�I�$�y�`��F�"��&��Q =7��������xJLY�G�X|uk<o����<E��P-M��!��{m�U]�	E�t�`��Ɯ��H�1�'�hRR�u6�X�p4wṩa�8�*S��E��o��mj���j�kke�H�|1Z���	�Z��������FP�,��ú��0��~7Y+�Oyy��b�͓��{O�ޤ�~l��:|�d�>H݂C�Z�
�A>Ŗ�r�����C�7H��_�T��cJWS�/'�8u�~�|ڴ+�&j�4�T<�n�"M���Z�Bj�����MKX�D\�ͦ�Bw�D�zjyG�H�E��ݻ�.�bM�͑�Z���IUv� �,FW2E6AMp٥��9h�ӧ6�s��83�-F��b���.�01a��9qlOq��AR=̥���}��JM���Y��״C�s���dMO6�Ώu��Ym��ɥ�ׅ�tjN�hop��%f��R�;[Fc���q� 1��<�u�J�[K����z;���L�A�)$5*f�:_'�ǵ:�C�W��/UvA���A�B9F�4��ÂRu�&w�*	(8�c@���2k&>0Bu`�$�B�|���4��!���Y�0S(.w�� }�wFA�iG�FT��;��k�װN�q��%3<�P	[�������0�瞤�@��L�� ��v`�P�p�����Rv����.����m`���\��lĞ��>�&t�o&W�Ii�	�9�xC��f�$�(��l��L�9�a���U<!�)U�os�. �8�N!�^����wfw oM�N%�o�1���d$������m��l���I �  |�+�e�����n(= B�yo/�\��'�|�� ��3ԑ*���zN��.��uJC�hq�/	�X�R��y&,�]B_`���x��������+�ԍd1�h)�a���8	>(�)��cX:�v:X�l���^��_|5yk��'�z��A��Z���fT��Ɗ)��������>���ӞIQ\��8�{KTG�Y߸ߜX�c���'Q�a_*�各�Ҩ���iBg떝��[vD|�Kz�xoB-�}/o8����2�@��P�r�GW��p�噐��@�]��1[�8��8�=n]����[%�q��C�"��mO��@�=�`:{�^ކy�U/���7~�+g�wFv��<n`
��Z�ރ,R�K!Dnx��ъC��i��a��*��o�����߄��|�� �k�).��}��\��%���9���IS�4L�ġ�-�L�!����΢��F~>����Ȓ��b{g����� #�^Ā�G�8����L0=�jZ�q�0�(c9�����q�D'���pv6f"R"YEN#�0����U,v���;xt�����Q�:�T�8�T=�7���ɿ��%��B�^����%���Y���|؉�	����ֆ/	�9���R�K����0ռ��R��D�G�������Zyڽ�}����y�Az�(P��;:0S*��H7�l�Hxe�:�ri9��o�a��x�0�[ꐯz��0p5����K�2:�w+��B�bU�0��^�A����LQ�1�ǃ�7>�`vN�4������Q�f�#?wy�w��G��V8�Sd�t�K����Ua���ҙ�������ű����<�ۤ:�F�NB�N�G�}�U|�/]��v�����ڬ�c�;	���r	�!��`>������69TΫ�G �+v�2 ������!��ԕPT�����3��I;T{�F�G@/|��r�%h��﷒��vUL�)��p�썌�f��0+�C�'�n�BDi���}��xq�������M~1u?��9Ο���a�1��ځD��%mbv��`R��6Uj�Ě����ߑ���y�c��?�n�D2#�N�tt8�wo���^h��h^�
G��FL�@m�:�~��!��	�
�(y'�FI�b�vĹPl���P�"=���ʩ3� 
錧��Z��M�$>3Y!I�^7�7y�*fx�o�)s.�[3��[O���Ou��Z��BNb�p�j��{�k
PP!���`&Y�R����1~sw zY����~�uG��.ml�^Ro�P��}�0��ǹ8�h�8�hU���������0���A�\x�>N|�y`�r�Z֎=����l�+kh[�
nug��N�+%���;Gp�a��SY0'�,��L�u�����Zxr���qa�}פ���4�zW-��:��\���Fс~�#iM�dءC�tXV����L8�ͼc�9�p/��/}��Ҧ���5�$z�~�3���*�64� �Öz��t�����?'���g_|���t*HU     