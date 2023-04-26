<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Kln\Pendaftaran\Rawat;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use DB;

class LaporanPendaftaranExport implements FromCollection, WithHeadings, WithEvents, WithCustomStartCell
{
	/**
	 * @return \Illuminate\Support\Collection
	 */

	private $tgawal;
	private $tgakhir;
	private $kat;
	private $judul;
	private $compNama;

	public function __construct($tgawal, $tgakhir, $kat, $judul, $compNama)
	{
		$this->tgawal = $tgawal;
		$this->tgakhir = $tgakhir;
		$this->kat = $kat;
		$this->judul = $judul;
		$this->compNama = $compNama;
	}
	
	public function collection()
	{
		if ($this->kat == 1) {
			$this->kat = 'KESELURUHAN';
			$listdata = Rawat::select(
				'rawatTglDaftar',
				'msPasRm',
				'msPasNama',
				DB::raw('if(rawatPenRajal = 1,rNama,if(rawatPenRajal = 4,"Laboratorium",if(rawatPenRajal = 5,"Radiologi",if(rawatPenRajal = 6,"Fisioterapi","")))) as poli'),
				DB::raw('if(msPasGender = 1,"Laki-laki",if(msPasGender = 2,"Perempuan","")) as jenkel'),
				'msPasUmur',
				'msPasAlamat',
				'rawatJaminanNama',
				'rawatPoli'
			)
				->leftjoin('kln_mspasien', 'msPasId', '=', 'rawatPasId')
				->leftjoin('kln_msruangan', 'rId', '=', 'rawatPoli')
				->where('rawatTglDaftar', '>=', $this->tgawal)
				->where('rawatTglDaftar', '<=', $this->tgakhir)
				->get();
		} elseif ($this->kat == 2) {
			$this->kat = 'RAWAT JALAN';
			$listdata = Rawat::select(
				'rawatTglDaftar',
				'msPasRm',
				'msPasNama',
				DB::raw('if(rawatPenRajal = 1,rNama,if(rawatPenRajal = 4,"Laboratorium",if(rawatPenRajal = 5,"Radiologi",if(rawatPenRajal = 6,"Fisioterapi","")))) as poli'),
				DB::raw('if(msPasGender = 1,"Laki-laki",if(msPasGender = 2,"Perempuan","")) as jenkel'),
				'msPasUmur',
				'msPasAlamat',
				'rawatJaminanNama',
				'rawatPoli'
			)
				->leftjoin('kln_mspasien', 'msPasId', '=', 'rawatPasId')
				->leftjoin('kln_msruangan', 'rId', '=', 'rawatPoli')
				->where('rawatJenisMasuk', '=', 1)
				->where('rawatTglDaftar', '>=', $this->tgawal)
				->where('rawatTglDaftar', '<=', $this->tgakhir)
				->get();
		} elseif ($this->kat == 3) {
			$kat = 'IGD';
			$listdata = Rawat::select(
				'rawatTglDaftar',
				'msPasRm',
				'msPasNama',
				DB::raw('if(rawatPenIgd = 2,"Rawat Inap",if(rawatPenIgd = 3,"IGD","")) as poli'),
				DB::raw('if(msPasGender = 1,"Laki-laki",if(msPasGender = 2,"Perempuan","")) as jenkel'),
				'msPasUmur',
				'msPasAlamat',
				'rawatJaminanNama',
				'rawatPoli'
			)
				->where('rawatJenisMasuk', '=', 2)
				->leftjoin('kln_mspasien', 'msPasId', '=', 'rawatPasId')
				->leftjoin('kln_msruangan', 'rId', '=', 'rawatPoli')
				->where('rawatTglDaftar', '>=', $this->tgawal)
				->where('rawatTglDaftar', '<=', $this->tgakhir)
				->get();
		}else {
			$this->kat = '';
			$listdata = Rawat::select(
				'rawatTglDaftar',
				'msPasRm',
				'msPasNama',
				DB::raw('if(msPasGender = 1,"Laki-laki",if(msPasGender = 2,"Perempuan","")) as jenkel'),
				'msPasUmur',
				'msPasAlamat',
				'rawatJaminanNama',
				DB::raw('if(rawatPenRajal = 1,rNama,if(rawatPenRajal = 4,"Laboratorium",if(rawatPenRajal = 5,"Radiologi",if(rawatPenRajal = 6,"Fisioterapi","")))) as poli'),
			)
				->leftjoin('kln_mspasien', 'msPasId', '=', 'rawatPasId')
				->leftjoin('kln_msruangan', 'rId', '=', 'rawatPoli')
				->where('rawatTglDaftar', '>=', $this->tgawal)
				->where('rawatTglDaftar', '<=', $this->tgakhir)
				->get();
		}

		return $listdata;

	}

	public function headings(): array
	{
		return [
			'TANGGAL DAFTAR',
			'REKAM MEDIS',
			'NAMA PASIEN',
			'GENDER',
			'USIA',
			'ALAMAT',
			'CARA BAYAR',
			'POLI'
		];
	}

	public function startCell(): string
	{
		return 'A5';
	}

	public function registerEvents(): array
	{
		return [
			AfterSheet::class => function (AfterSheet $event) {
				/** @var Sheet $sheet */
				$sheet = $event->sheet;

				// map header data to this cells
				$sheet->mergeCells('A1:H1');
				$sheet->setCellValue('A1', $this->judul);
				$sheet->mergeCells('A2:H2');
				$sheet->setCellValue('A2', 'KLINIK'.' '. strtoupper($this->compNama));
				$sheet->mergeCells('A3:H3');
				$sheet->setCellValue('A3', 'PERIODE' . ' ' . $this->tgawal .' '. 'S/D' .' '. $this->tgakhir);

				$styleArray = [
					'alignment' => [
						'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
					],
				];

				$cellRange1 = 'A1:X1';
				$cellRange2 = 'A2:X2';
				$cellRange3 = 'A3:X3'; 
				$event->sheet->getDelegate()->getStyle($cellRange1)->applyFromArray($styleArray);
				$event->sheet->getDelegate()->getStyle($cellRange2)->applyFromArray($styleArray);
				$event->sheet->getDelegate()->getStyle($cellRange3)->applyFromArray($styleArray);
			},
		];
	}

}
