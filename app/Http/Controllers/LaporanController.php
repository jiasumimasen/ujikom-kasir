<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use FPDF;

class LaporanController extends Controller
{

    public function index()
    {
        $transaksi = Transaksi::with('kasir')
        ->latest()
        ->get();
        return view('pages.laporan.index', compact('transaksi'));
    }
    public function cetak(Request $request)
    {
        function formatRupiah($angka)
        {
            $number = preg_replace("/[^0-9]/", "", $angka);
            $split = str_split($number);
            $length = count($split);
            $rupiah = '';
            for ($i = 0; $i < $length; $i++) {
                if (($length - $i) % 3 == 0 && $i != 0) {
                    $rupiah .= '.';
                }
                $rupiah .= $split[$i];
            }
            return $rupiah;
        }
        // Mendapatkan tanggal awal dan akhir dari request
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        $no = 1;

        // Menerapkan filter tanggal ke dalam query
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $transaksi = Transaksi::with('kasir')
                            ->whereBetween('created_at', [$tgl_awal, $tgl_akhir])
                            ->latest()
                            ->get();
        } else {
            // Jika salah satu atau kedua tanggal tidak diberikan, ambil semua data transaksi tanpa filter
            $transaksi = Transaksi::with('kasir')
                            ->latest()
                            ->get();
        }

        $pdf = new FPDF('P', 'mm', 'A4'); // 'P' untuk orientasi Potrait, ukuran dalam milimeter (80 mm x 150 mm)
        $pdf->AddPage();

        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(30, 5, "Jenis Laporan", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'R');
        $pdf->Cell(60, 5, "Laporan Transaksi", 0, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(30, 5, "Format", 0, 0, 'L');
        $pdf->Cell(3, 5, ":", 0, 0, 'R');

        // var_dump($format); exit;
        $pdf->Ln(3);
        $pdf->Cell(0, 5, '_________________________________________________________________________________________________________________________', 0, 0); // Koordinat y = 50, x dari 10 ke lebar halaman - 10$pdf->Ln(10); // Menggambar garis horizontal

        // var_dump($sampai,$dari);
        // die;
        $pdf->Ln(10);
        // Gunakan data yang diambil
        $pdf->Cell(8, 6, 'No', 1, 0, 'C');
        $pdf->Cell(55, 6, 'Nama Kasir', 1, 0, 'C');
        $pdf->Cell(55, 6, 'Total', 1, 0, 'C');
        $pdf->Cell(70, 6, 'Tanggal', 1, 0, 'C');
        $pdf->ln();

        foreach ($transaksi as $data) {

            $pdf->Cell(8, 6, $no++, 1, 0, 'C');
            $pdf->Cell(55, 6, $data->kasir->name, 1, 0, 'C');           
            $total = $data['total_harga'];
            $pdf->Cell(55, 6, 'Rp. ' . formatRupiah($total), 1, 0, 'R');
            $tanggal = date('Y/m/d', strtotime($data['created_at']));;
            $pdf->Cell(70, 6, $tanggal, 1, 0, '');
            // $total_semua += $total;
            $pdf->Ln();
        }

        // $data = $result["trans_id"];

        $dari_sampai = '';
        // $data = "ahai";
        $no = 1;
        $total_semua = 0;

        // $pdf->Cell(15, 6, 'Total : ', 1, 0, 'L');
        // $pdf->Cell(175, 6, 'Rp. ' . formatRupiah($total_semua), 1, 0, 'R');





        $pdf->Output();
        // return response()->json($transaksi);
        // return view('pages.laporan.index', compact('transaksi'));
    }
}
