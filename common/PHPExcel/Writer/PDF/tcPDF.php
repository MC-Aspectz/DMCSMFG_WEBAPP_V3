<?php

/**  Require tcPDF library */
$pdfRendererClassFile = PHPExcel_Settings::getPdfRendererPath() . '/tcpdf.php';
if (file_exists($pdfRendererClassFile)) {
    $k_path_url = PHPExcel_Settings::getPdfRendererPath();
    require_once $pdfRendererClassFile;
} else {
    throw new PHPExcel_Writer_Exception('Unable to load PDF Rendering library');
}

/**
 *  PHPExcel_Writer_PDF_tcPDF
 *
 *  Copyright (c) 2006 - 2015 PHPExcel
 *
 *  This library is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU Lesser General Public
 *  License as published by the Free Software Foundation; either
 *  version 2.1 of the License, or (at your option) any later version.
 *
 *  This library is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 *  Lesser General Public License for more details.
 *
 *  You should have received a copy of the GNU Lesser General Public
 *  License along with this library; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 *  @category    PHPExcel
 *  @package     PHPExcel_Writer_PDF
 *  @copyright   Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 *  @license     http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 *  @version     ##VERSION##, ##DATE##
 */
class PHPExcel_Writer_PDF_tcPDF extends PHPExcel_Writer_PDF_Core implements PHPExcel_Writer_IWriter
{
    /**
     *  Create a new PHPExcel_Writer_PDF
     *
     *  @param  PHPExcel  $phpExcel  PHPExcel object
     */
    public function __construct(PHPExcel $phpExcel)
    {
        parent::__construct($phpExcel);
    }

    /**
     *  Save PHPExcel to file
     *
     *  @param     string     $pFilename   Name of the file to save as
     *  @throws    PHPExcel_Writer_Exception
     */
    public function save($pFilename = null)
    {
        $fileHandle = parent::prepareForSave($pFilename);

        //  Default PDF paper size
        $paperSize = 'A4'; //    LETTER  (8.5 in. by 11 in.)

        //  Check for paper size and page orientation
        if (is_null($this->getSheetIndex())) {
            $orientation = ($this->phpExcel->getSheet(0)->getPageSetup()->getOrientation()
                == PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE) ? 'L' : 'P';
            $printPaperSize = $this->phpExcel->getSheet(0)->getPageSetup()->getPaperSize();
            $printMargins = $this->phpExcel->getSheet(0)->getPageMargins();
        } else {
            $orientation = ($this->phpExcel->getSheet($this->getSheetIndex())->getPageSetup()->getOrientation()
                == PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE) ? 'L' : 'P';
            $printPaperSize = $this->phpExcel->getSheet($this->getSheetIndex())->getPageSetup()->getPaperSize();
            $printMargins = $this->phpExcel->getSheet($this->getSheetIndex())->getPageMargins();
        }

        //  Override Page Orientation
        if (!is_null($this->getOrientation())) {
            $orientation = ($this->getOrientation() == PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE) ? 'L': 'P';
        }
        //  Override Paper Size
        if (!is_null($this->getPaperSize())) {
            $printPaperSize = $this->getPaperSize();
        }

        if (isset(self::$paperSizes[$printPaperSize])) {
            $paperSize = self::$paperSizes[$printPaperSize];
        }

        // Define Call Font download
        if (!defined('TH_SARABUN')) { define('TH_SARABUN', TCPDF_FONTS::addTTFfont(dirname(__FILE__, 3).'/tcpdf/fonts/thsarabun/THSarabun.ttf', 'TrueTypeUnicode')); }
        if (!defined('PRIDI_REGULAR')) { define('PRIDI_REGULAR', TCPDF_FONTS::addTTFfont(dirname(__FILE__, 3).'/tcpdf/fonts/pridi/Pridi-Regular.ttf', 'TrueTypeUnicode')); }
        if (!defined('PROMPT_REGULAR')) { define('PROMPT_REGULAR', TCPDF_FONTS::addTTFfont(dirname(__FILE__, 3).'/tcpdf/fonts/prompt/Prompt-Regular.ttf', 'TrueTypeUnicode')); }
        if (!defined('TAVIRAJ_REGULAR')) { define('TAVIRAJ_REGULAR', TCPDF_FONTS::addTTFfont(dirname(__FILE__, 3).'/tcpdf/fonts/taviraj/Taviraj-Regular.ttf', 'TrueTypeUnicode')); }

        // create new PDF document
        // $pdf = new TCPDF($orientation, 'pt', $paperSize);
        $pdf = new TCPDF($orientation, 'pt', $paperSize, true, 'UTF-8', false);

        //  Document info
        $pdf->SetTitle($this->phpExcel->getProperties()->getTitle());
        $pdf->SetAuthor($this->phpExcel->getProperties()->getCreator());
        $pdf->SetSubject($this->phpExcel->getProperties()->getSubject());
        $pdf->SetKeywords($this->phpExcel->getProperties()->getKeywords());
        $pdf->SetCreator($this->phpExcel->getProperties()->getCreator());

        // set header and footer line
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set header and footer fonts
        $pdf->setHeaderFont(array(TH_SARABUN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(TH_SARABUN, '', PDF_FONT_SIZE_DATA));
        
        // Set margins, converting inches to points (using 72 dpi)
        $pdf->SetMargins($printMargins->getLeft() * 72, $printMargins->getTop() * 72, $printMargins->getRight() * 72); 
        // $pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT, true);
        // $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        // $pdf->SetAutoPageBreak(true, $printMargins->getBottom() * 72); // $pdf->SetAutoPageBreak(true, 0);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // set font family
        $pdf->SetFont(TH_SARABUN, '', 10);
        // $pdf->SetFont($this->getFont());

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(TH_SARABUN);

        $pdf->AddPage();

        $pdf->writeHTML($this->generateHTMLHeader(false) . $this->generateSheetData() . $this->generateHTMLFooter());

        //  Write to file
        fwrite($fileHandle, $pdf->output($pFilename, 'S'));

        parent::restoreStateAfterSave($fileHandle);
    }
}
