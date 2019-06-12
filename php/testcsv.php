<?php

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=file.csv");

include_once("./tools.php");

$csv = '"id";"geom";"nombre";"area_m2";"cod_presa";"cod_unsubclase";"plano";"fuente";"fecha";"margen";"volumen_m3";"cod_est";"id_og";"cod_estudio";"cod_esia";"cod_temp";"cod_ob";"fec_bbdd";"gid"

"10";"0103000020E61000000100000007000000C02C25C7CA8951C0BB2B04AB1B1949C0E7C147AF358951C0370DE7F8CE1849C0109F47F5958851C06232B5C57C1849C0A0F2CA438F8851C0DC990138791849C0A395BA518E8851C086308FCA6D1949C099EFAF0FBF8951C0662B1285F61949C0C02C25C7CA8951C0BB2B04AB1B1949C0";"Cantera - Futuro Botadero";"1076830.047";"LB";"001002";"JC-C.TP-PL.GE-(OB-00-00)-P002-0A.dwg";"UTE - Ingeniería";"2017-10-16";"derecho   ";"";"";"021";"47";"1710";"";"34";"Marzo 2019";"10"';

echo $csv;


?>
