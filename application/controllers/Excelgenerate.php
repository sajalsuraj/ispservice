<?php


class ExcelGenerate extends CI_Controller{

  public function __construct(){

    parent::__construct();

  }

  public function getCustomerExcel(){

        date_default_timezone_set('Indian/Christmas');

        $this->load->library('excel');

        $this->excel->setActiveSheetIndex(0);

        $this->excel->getActiveSheet()->setTitle('Users list');

        $users = $this->customer->getListforExcel();

        $this->excel->getActiveSheet()->fromArray($users);

        $filename='users.xls';

        header('Content-Type: application/vnd.ms-excel');

        header('Content-Disposition: attachment;filename="'.$filename.'"');

        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        
        $objWriter->save('php://output');

  }

}
