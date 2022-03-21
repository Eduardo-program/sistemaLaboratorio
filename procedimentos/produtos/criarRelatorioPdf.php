<?php
// Carregar dompdf
require_once '../../lib/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$id=$_GET['idordem'];



 $html=file_get_contents("http://localhost:8080/estoque/view/ordens/comprovanteOrdemPdf.php?idordem=".$id);


 
// Instanciamos um objeto da classe DOMPDF.
$pdf = new DOMPDF();
 
// Definimos o tamanho do papel e orientação.
$pdf->set_paper(array(0,0,125,200));
 
// Carregar o conteúdo html.
$pdf->load_html(utf8_decode($html));
 
// Renderizar PDF.
$pdf->render();
 
// Enviamos pdf para navegador.
$pdf->stream('tickeOrdem.pdf');

