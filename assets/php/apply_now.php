<?php
$postData = $uploadedFile = $statusMsg = '';
$msgClass = 'errordiv';
$job_id = $_POST['job_id'];
$email = $_POST['email'];
$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$phone = $_POST['phone'];
$message = $_POST['comments'];
$job_name = $_POST['job_title'];
$job_location = $_POST['job_location'];
$jd = $_POST['jd'];
if(!empty($email) && !empty($fname)){
  if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
    $statusMsg = 'Please enter your valid email.';
  }else{
    $uploadStatus = 1;
    // Upload attachment file
    if(!empty($_FILES["resume"]["name"])){
      // File path config
      $targetDir = "uploads/";
      $fileName = basename($_FILES["resume"]["name"]);
      $targetFilePath = $targetDir . $fileName;
      $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

      // Allow certain file formats
      $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg');
      if(in_array($fileType, $allowTypes)){
        // Upload file to the server
        if(move_uploaded_file($_FILES["resume"]["tmp_name"], $targetFilePath)){
          $uploadedFile = $targetFilePath;
        }else{
          $uploadStatus = 0;
          $statusMsg = "Sorry, there was an error uploading your file.";
        }
      }else{
        $uploadStatus = 0;
        $statusMsg = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.';
      }
    }
    if($uploadStatus == 1){
      if (empty($phone)){
        $phone = "N/A";
      }
      if (empty($message)){
        $message = "N/A";
      }
      // Recipient
      $toEmail = 'resumes@evolversgroup.com';
      // Sender
      $from = $email;
      $fromName = $fname.' '.$lname;

      // Subject
      $emailSubject = 'Application for '.$job_name .' at ' .$job_location;

      // Message
      $htmlContent = '<p>The following candidate has applied to:'.$job_name.'</p>
      <p><b>Name:</b> '.$fname.' '.$lname.'</p>
      <p><b>Email:</b> '.$email.'</p>
      <p><b>Phone:</b> '.$phone.'</p>
      <p><b>Additional Information:</b><br/>'.$message.'</p>
      <p><b>Job Description:</b><br/>'.$jd.'</p>';


      // Header for sender info
      $headers = "From: $fromName"." <".$from.">\n";

      if(!empty($uploadedFile) && file_exists($uploadedFile)){
        $headers .= "Cc:".$email;
        // Boundary
        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

        // Headers for attachment
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

        // Multipart boundary
        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
        "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";

        // Preparing attachment
        if(is_file($uploadedFile)){
          $message .= "--{$mime_boundary}\n";
          $fp =    @fopen($uploadedFile,"rb");
          $data =  @fread($fp,filesize($uploadedFile));
          @fclose($fp);
          $data = chunk_split(base64_encode($data));
          $message .= "Content-Type: application/octet-stream; name=\"".basename($uploadedFile)."\"\n" .
          "Content-Description: ".basename($uploadedFile)."\n" .
          "Content-Disposition: attachment;\n" . " filename=\"".basename($uploadedFile)."\"; size=".filesize($uploadedFile).";\n" .
          "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
        }

        $message .= "--{$mime_boundary}--";
        $returnpath = "-f" . $email;

        // Send email
        $mail = mail($toEmail, $emailSubject, $message, $headers, $returnpath);

        // Delete attachment file from the server
        @unlink($uploadedFile);
      }else{
        // Set content-type header for sending HTML email
        $headers .= "\r\n". "MIME-Version: 1.0";
        $headers .= "\r\n". "Content-type:text/html;charset=UTF-8";

        // Send email
        $mail = mail($toEmail, $emailSubject, $htmlContent, $headers);
      }

      // If mail sent
      if($mail){
        $statusMsg = 'Your application has been submitted successfully !';
        $msgClass = 'succdiv';

        $postData = '';
      }else{
        $statusMsg = 'Your application submission failed, please try again.';
      }
      session_start();
      $_SESSION['success_message'] = $statusMsg ;
      header('Location: ../../jobs.php?id='.$job_id);
      exit();
    }
  }
}
?>
