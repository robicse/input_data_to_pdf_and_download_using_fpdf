<?php 

	date_default_timezone_set('UTC');
	require('fpdf/fpdf.php');
	
	
	$conect = mysql_connect("localhost", "root", "");
	mysql_select_db("form_pdf_info", $conect);
	
	// personal information
	$sql = "INSERT INTO personal_information (name, email, address, city, country) VALUES ('".$_POST["name"]."', '".$_POST["email"]."', '".$_POST["address"]."', '".$_POST["city"]."', '".$_POST["country"]."');";
	mysql_query($sql); 
	
	// result information
	$a=$_POST['marks'];
	$cnt=sizeof($a);
	//var_dump($a);exit;
	for ($i = 0; $i < $cnt; $i++) {
		$subjects=$_POST['subjects'];
		$marks=$_POST['marks'];
		//var_dump($a);
		$subjects[$i];
		$marks[$i];
		
		mysql_query("INSERT INTO result (subjects, marks) VALUES ('$subjects[$i]','$marks[$i]')");
	}
	
	class PDF_result extends FPDF {
		function __construct ($orientation = 'P', $unit = 'pt', $format = 'Letter', $margin = 40) {
			$this->FPDF($orientation, $unit, $format);
			$this->SetTopMargin($margin);
			$this->SetLeftMargin($margin);
			$this->SetRightMargin($margin);
			
			$this->SetAutoPageBreak(true, $margin);
		}
		
		function Header () {
			 $this->Image('logo1.png',100,15,250);

			//$this->SetFont('Arial', 'B', 20);
			//$this->SetFillColor(36, 96, 84);
			//$this->SetTextColor(225);
			//$this->Cell(0, 30, "YouHack MCQ Results", 0, 1, 'C', true);
		}
		
		function Footer()
		{
			//Position at 1.5 cm from bottom
			$this->SetY(-15);
			//Arial italic 8
			$this->SetFont('Arial','I',8);
			//Page number
			$this->Cell(0,10,'Generated at Robi.me',0,0,'C');
		}

			
		function Generate_Table($subjects, $marks) {
			$this->SetFont('Arial', 'B', 12);
			$this->SetTextColor(0);
			//$this->SetFillColor(94, 188, z);
			$this->SetFillColor(94, 188, 225);
			$this->SetLineWidth(1);
			$this->Cell(427, 25, "Subjects", 'LTR', 0, 'C', true);
			$this->Cell(100, 25, "Marks", 'LTR', 1, 'C', true);
			 
			$this->SetFont('Arial', '');
			$this->SetFillColor(238);
			$this->SetLineWidth(0.2);
			$fill = false;
			
			for ($i = 0; $i < count($subjects); $i++) {
				$this->Cell(427, 20, $subjects[$i], 1, 0, 'L', $fill);
				$this->Cell(100, 20,  $marks[$i], 1, 1, 'R', $fill);
				$fill = !$fill;
			}
			$this->SetX(367);
			//$this->Cell(100, 20, "Total", 1);
			//$this->Cell(100, 20,  array_sum($marks), 1, 1, 'R');
		}
	
	}

	$pdf = new PDF_result();
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetY(100);

	$pdf->Cell(100, 13, "Student Details");
	$pdf->SetFont('Arial', '');

	$pdf->Cell(250, 13, $_POST['name']);

	$pdf->SetFont('Arial', 'B');
	$pdf->Cell(50, 13, "Date:");
	$pdf->SetFont('Arial', '');
	$pdf->Cell(100, 13, date('F j, Y'), 0, 1);

	$pdf->SetFont('Arial', 'I');
	$pdf->SetX(140);
	$pdf->Cell(200, 15, $_POST['email'], 0, 2);
	$pdf->Cell(200, 15, $_POST['address'] . ',' . $_POST['city'] , 0, 2);
	$pdf->Cell(200, 15, $_POST['country'], 0, 2);

	$pdf->Ln(100);

	$pdf->Generate_Table($_POST['subjects'], $_POST['marks']);

	$pdf->Ln(50);

	$message = "Congratulation , you have successfully passed your exams .For More Information Contact us at : ";

	$pdf->MultiCell(0, 15, $message);

	$pdf->SetFont('Arial', 'U', 12);
	$pdf->SetTextColor(1, 162, 232);

	$pdf->Write(13, "admin@robi.me", "mailto:robicse8@gmail.com");

	$pdf->Output('result.pdf', 'F');


	
	// send mail
	include("smtp/PHPMailerAutoload.php");
	$mail = new PHPMailer();

	//SMTP using
	date_default_timezone_set('Asia/Dhaka');
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Host = "smtp.gmail.com";
	$mail->SMTPSecure = 'tls';                            
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->Username = "robicse8@gmail.com"; // from mail send
	$mail->Password = "robi)cse*9";
	$mail->setFrom('robicse8@gmail.com', 'RobiWeb'); // address of company 
	$mail->addReplyTo('robeulcse8@gmail.com', 'Robeul Islam'); // reply to specific person

	$mail->addAddress("robeul@windmillbd.net"); // to mail send
	$mail->Subject = 'Test mail sent';
	$mail->msgHTML("Your Result Information.");
	$mail->addAttachment('result.pdf');
	$mail->send(); 
	
?>
