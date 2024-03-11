<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//required files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


function generateConfirmationCode()
{
    return md5(uniqid(rand(), true));
}

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'liaosunihon@gmail.com';                     //SMTP username
    $mail->Password   = 'dvqydafiwldqtmuq';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    $receive = $_POST['email'];
    $random_byte = random_bytes(16);
    $token = bin2hex($random_byte);

    include("./connect.php");
    $sql = "UPDATE users set token = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $token, $receive);
    $stmt->execute();
    //Recipients
    $mail->setFrom('liaosunihon@gmail.com', mb_encode_mimeheader('Vườn ươm doanh nghiệp', 'UTF-8'));
    $mail->addAddress($receive, 'Test mail');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('./upload/icon.jpg', 'img');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = mb_encode_mimeheader('Bạn quên mật khẩu?', 'UTF-8');
    $html_content = file_get_contents('emailRepassword.php');
    $html_content = str_replace('{{codetoken}}', $token, $html_content);
    $mail->Body = $html_content;


    // $mail->Body    = 'Đây là mail kích hoạt tài khoản';
    // $mail->AltBody = 'Đây là nội dung';

    $mail->send();


    echo '<script src="./user/assets/js/sweetalert.min.js"></script>';
    echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "ĐÃ GỬI YÊU CẦU",
                    text: "Vui lòng kiểm tra email của bạn để lấy lại mật khẩu!",
                    icon: "success",
                    button: "Đồng ý"
                }).then(() => {
                    window.location.href = "./login.php";
                });
            });
          </script>';

    // echo "<script  language=javascript>
    //     alert('Vui lòng xác nhận tài khoản qua hộp thư!');
    //     window.location.replace('./login.php');
    //     </script>";
} catch (Exception $e) {
    echo "<script  language=javascript>
            window.location = './404.html';
        </script>";
}
