<?php
require_once __DIR__ . '/../Model/VentaModel.php';
require_once __DIR__ . '/../Config/Database.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;

class ReporteController {

    public function reporteSemanal() {

        // Crear conexión correctamente
        $database = new Database();
        $conn = $database->getConnection();

        // Pasar conexión al modelo
        $ventaModel = new VentaModel($conn);

        $ventas = $ventaModel->obtenerVentasUltimos7Dias();

        ob_start();
        include __DIR__ . '/../Views/ventas/reportes.php';
        $html = ob_get_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("reporte_semanal.pdf", ["Attachment" => false]);
    }
}