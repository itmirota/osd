<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;

class Pdf {
    public function generate($html, $filename = '', $paper = 'A4', $orientation = 'portrait') {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        

        // (Opsional) Mengatur ukuran kertas dan orientasi
        $dompdf->setPaper($paper, $orientation);

        // Render HTML ke PDF
        $dompdf->render();

        // Output ke browser (0 = preview, 1 = langsung download)
        $dompdf->stream($filename . ".pdf", array("Attachment" => 0));
    }
}