<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainctrl extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
    {
        parent::__construct();
    }
	public function index() 
	{
		echo "";
		//$this->load->view('pages/home');
	}
	public function view($page = 'home'){
		if ( ! file_exists(APPPATH.'views/pages/frontend/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('templates/frontend/header', $data);
        $this->load->view('pages/frontend/'.$page, $data);
        $this->load->view('templates/frontend/footer', $data);
	}

	public function superadmin($page = 'home') {

        if (!file_exists(APPPATH . 'views/pages/superadmin/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
            exit;
        }
        
        $data['page'] = $page;
        //$data['title'] = ucfirst($page); // Capitalize the first letter
        $this->load->view('templates/header', $data);
        $this->load->view('pages/superadmin/' . $page, $data);
        $this->load->view('templates/footer', $data);
    }

    public function customer($page = 'home') {

        if (!file_exists(APPPATH . 'views/pages/customer/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
            exit;
        }
        
        $data['page'] = $page;
        //$data['title'] = ucfirst($page); // Capitalize the first letter
        $this->load->view('templates/header', $data);
        $this->load->view('pages/customer/' . $page, $data);
        $this->load->view('templates/footer', $data);
    }

    public function subadmin($page = 'home') {

        if (!file_exists(APPPATH . 'views/pages/subadmin/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
            exit;
        }
        
        $data['page'] = $page;
        //$data['title'] = ucfirst($page); // Capitalize the first letter
        $this->load->view('templates/header', $data);
        $this->load->view('pages/subadmin/' . $page, $data);
        $this->load->view('templates/footer', $data);
    }

    public function pdf(){


    
    $this->load->library('Pdf');
        // create new PDF document
    $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);    
  
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    /*$pdf->SetAuthor('Muhammad Saqlain Arif');
    $pdf->SetTitle('Saket Suraj');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');   */
  
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
    $pdf->setFooterData(array(0,64,0), array(0,64,128)); 
  
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
  
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 
  
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);    
  
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
  
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  
  
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }   
  
    // ---------------------------------------------------------    
  
    // set default font subsetting mode
    $pdf->setFontSubsetting(true);   
  
    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('helvetica', '', 9.5, '', true);   
  
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage(); 
  
    // set text shadow effect
    //$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));    
  
    // Set some content to print
    $html = '<p style="text-align:center;"><u>Invoice</u></p>
    <table>
       <tbody>
            <tr>
                <td>Kedar Brahme<br>ABC Colony, HSR Layout, <br />Hosapalya, Bangalore - 560032</td>
                <td>Invoice No. : BC/2017/04/4169<br>Order No. : ISP/03042017/46033651/1<br>Circuit ID : 46033651</td>
                <td>Invoice Date - 01/04/2017<br>Due Date - 10/04/2017</td>
            </tr>
       </tbody>
    </table>
    <p></p>
    <table border="1" cellpadding="5">
        <tbody>
            <tr>
                <th style="font-size:8.5px;padding:5px;text-align:center;">Prev. Balance(Rs.)</th>
                <th style="font-size:8.5px;padding:5px;text-align:center;">Payment Received(Rs.)</th>
                <th style="font-size:8.5px;padding:5px;text-align:center;">Adjustments(Rs.)</th>
                <th style="font-size:8.5px;padding:5px;text-align:center;">Opening Balance(Rs.)</th>
                <th style="font-size:8.5px;padding:5px;text-align:center;">Total Current Charges(Rs.)</th>
                <th style="font-size:8.5px;padding:5px;text-align:center;">Amount Payable(Rs.)</th>
            </tr>
            <tr>
                <td style="font-size:8.5px;padding:5px;text-align:center;">14,950.00</td>
                <td style="font-size:8.5px;padding:5px;text-align:center;">14,883.00</td>
                <td style="font-size:8.5px;padding:5px;text-align:center;">0.00</td>
                <td style="font-size:8.5px;padding:5px;text-align:center;">67.00</td>
                <td style="font-size:8.5px;padding:5px;text-align:center;">7,475.00</td>
                <td style="font-size:8.5px;padding:5px;text-align:center;">7,542.00</td>
            </tr>
        </tbody>
    </table>
    <p></p>
    <table border="1" cellpadding="5">
        <tbody>
            <tr>
                <th style="font-size:9.5px;">Serial No</th>
                <th style="font-size:9.5px;">Description of goods</th>
                <th style="font-size:9.5px;">Amount(Rs.)</th>
            </tr>
            <tr>
                <td style="font-size:9.5px;">1</td>
                <td style="font-size:9.5px;">Bandwidth Services<br>01/04/2017 to 30/04/2017</td>
                <td style="font-size:9.5px;text-align:right;">6500.00</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size:9.5px;text-align:right;">Service Tax(14%)</td>
                <td style="font-size:9.5px;text-align:right;">910.0</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size:9.5px;text-align:right;">SBC(0.5%)</td>
                <td style="font-size:9.5px;text-align:right;">32.50</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size:9.5px;text-align:right;">KKC(0.5%)</td>
                <td style="font-size:9.5px;text-align:right;">32.50</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size:9.5px;text-align:right;">Current months charges</td>
                <td style="font-size:9.5px;text-align:right;">7,475.00</td>
            </tr>
        </tbody>
    </table>
    <p>Amount payable in words<br><b>Rupees Seven Thousand Five Hundred And Forty Two Only</b></p>
    <p>Please draw Cheque/Demand Draft in favour of "AuthorStream Pvt. Ltd." and mail to<br><b>Author Stream Pvt. Ltd.,C-153, Okhla Phase - 1, New Delhi - 110020<br>Tel:91-11-43792000 Fax:91-11-43792090, Email ID:billing@authorstream.in </b></p>
    <p>Service Tax No : AAACW2726NST001</p>
    <p>PAN No : AAACW2726N</p>
    <p>CIN : U74899DL2000PTC104421</p>
    <table>
        <tbody>
            <tr>
                <td></td>
                <td style="text-align:right;">For AuthorStream Pvt. Ltd.</td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align:right;"><img style="width:100px;height:100px;" src="'.base_url().'assets/images/sign.JPG" /><br>Authorised Signatory</td>
            </tr>
        </tbody>
    </table>
    <p>Conditions:</p>
    <p>1. All disputes are subject to Delhi Jurisdiction.<br><br>2.Interest @ 18% p.a will be charged if the payment is not made within the due date.<br><br>3.If the customer does not notify any discrepancies within 15 days from the date of invoice, it will be taken as
he/she found the statement correct.</p>
    <br>
    <br>
    <p style="font-size:9px;text-align:center;"><b>AuthorStream Services Pvt. Ltd. C-153, Okhla Phase - 1 New Delhi - 110020 Tel:91-11-43792000 Fax:91-11-43792090</b></p>
    ';
  
    // Print text using writeHTMLCell()
    //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);   

    $pdf->writeHTML($html, true, 0, true, 0);
  
    // ---------------------------------------------------------    
  
    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    ob_end_clean();
    $pdf->Output('Invoice.pdf', 'D');    
  
    //============================================================+
    // END OF FILE
    //============================================================+
    
    }


    public function customerpdf(){


    $this->load->library('Pdf');
        // create new PDF document
    $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);    
  
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    /*$pdf->SetAuthor('Muhammad Saqlain Arif');
    $pdf->SetTitle('Saket Suraj');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');   */
  
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
    $pdf->setFooterData(array(0,64,0), array(0,64,128)); 
  
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
  
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 
  
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);    
  
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
  
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  
  
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }   
  
    // ---------------------------------------------------------    
  
    // set default font subsetting mode
    $pdf->setFontSubsetting(true);   
  
    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('helvetica', '', 9.5, '', true);   
  
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage(); 
  
    // set text shadow effect
    //$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));    
  
    // Set some content to print
    $customerDetails = $this->customer->getCustomerById($_GET['id']);
    $html = '<p style="text-align:center;"><u>Customer Details</u></p>
    
    <table border="1" cellpadding="5">
        <tbody>
            <tr>
                <td style="padding:5px;">Customer Name</td>
                <td style="padding:5px;">'.$customerDetails->first_name.' '.$customerDetails->last_name.'</td>
            </tr>
            <tr>
                <td style="padding:5px;">Address</td>
                <td style="padding:5px;">'.$customerDetails->address.'</td>
            </tr>
            <tr>
                <td style="padding:5px;">City</td>
                <td style="padding:5px;">'.$customerDetails->city.'</td>
            </tr>
            <tr>
                <td style="padding:5px;">State</td>
                <td style="padding:5px;">'.$customerDetails->state.'</td>
            </tr>
            <tr>
                <td style="padding:5px;">Pincode</td>
                <td style="padding:5px;">'.$customerDetails->pincode.'</td>
            </tr>
            <tr>
                <td style="padding:5px;">Email ID</td>
                <td style="padding:5px;">'.$customerDetails->email.'</td>
            </tr>
            <tr>
                <td style="padding:5px;">Contact No</td>
                <td style="padding:5px;">'.$customerDetails->phone.'</td>
            </tr>
            <tr>
                <td style="padding:5px;">Data Plan</td>
                <td style="padding:5px;">'.$customerDetails->data_plan.'</td>
            </tr>
        </tbody>
    </table>
    ';
  
    // Print text using writeHTMLCell()
    //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);   

    $pdf->writeHTML($html, true, 0, true, 0);
  
    // ---------------------------------------------------------    
  
    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    ob_end_clean();
    $pdf->Output($customerDetails->first_name.'_'.$customerDetails->last_name.'_'.$_GET['id'].'.pdf', 'D');    
  
    //============================================================+
    // END OF FILE
    //============================================================+
    
    }
}
