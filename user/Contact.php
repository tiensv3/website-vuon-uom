<?php
session_start();
include("../connect.php");
?>

<?php
include("../user/TemplateUS/HeaderUS.php");
include("../user/TemplateUS/NavbarUS.php");
?>
<!--================Contact Area =================-->
<section class="contact_area section_gap_bottom">
    <div class="container">
        <div id="mapBox" class="mapBox" data-lat="40.701083" data-lon="-74.1522848" data-zoom="13"
            data-info="Số 126, Đường Nguyễn Thiện Thành, Phường 5, Tp, Trà Vinh, Tỉnh Trà Vinh" data-mlat="40.701083"
            data-mlon="-74.1522848">
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="contact_info">
                    <div class="info_item">
                        <i class="lnr lnr-home"></i>
                        <h6>Vườn ươm doanh nghiệp</h6>
                        <p>Số 126, Đường Nguyễn Thiện Thành, Phường 5, Tp, Trà Vinh, Tỉnh Trà Vinh</p>
                    </div>
                    <div class="info_item">
                        <i class="lnr lnr-phone-handset"></i>
                        <h6><a href="#">02943 855 246 (306) </a></h6>
                        <p>Thứ hai đến thứ 7 : 7h30 -17h00</p>
                    </div>
                    <div class="info_item">
                        <i class="lnr lnr-envelope"></i>
                        <div><a href="#" style="color: #000;">vuonuomdoanhnghiep@tvu.edu.vn</a></div>
                        <p>Gửi cho chúng tôi tư vấn của bạn bất cứ lúc nào!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <!-- handle contact -->
                <?php
                if (isset($_POST['submit'])) {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $subject = $_POST['subject'];
                    $message = $_POST['message'];
                    $status = 1;

                    $sql_send_contact = "INSERT INTO contact (fullname,email,subject,message,status) VALUES (?,?,?,?,?)";
                    $stmt = $conn->prepare($sql_send_contact);
                    $stmt->bind_param("ssssi", $name, $email, $subject, $message, $status);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($stmt->affected_rows > 0) {
                        // Câu lệnh đã thực thi thành công, chuyển hướng trang
                        echo "<script language='JavaScript'> 
                            alert('Chúng tôi sẽ liên hệ với bạn sớm nhất!');
                            </script>";
                        echo "<script language='JavaScript'> 
                            window.location.href = './Contact.php';
                            </script>";
                    } else {
                        // Câu lệnh không thực thi thành công, in ra lỗi
                        echo "Lỗi: " . $stmt->error;
                    }
                }
                ?>
                <form class="row contact_form" action="./Contact.php?action=lienhe" method="post" id="contactForm"
                    novalidate="novalidate">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nhập tên (doanh nghiệp) của bạn" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Enter your name'">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Nhập địa chỉ email của bạn" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Enter email address'">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="subject" name="subject"
                                placeholder="Nhập tên tiêu đề" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Enter Subject'">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control" name="message" id="message" rows="1"
                                placeholder="Nhập nội dung cần liên hệ" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Enter Message'"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <button type="submit" value="submit" name="submit" class="primary-btn">Gửi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--================Contact Area =================-->


<!--================Contact Success and Error message Area =================-->
<div id="success" class="modal modal-message fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </button>
                <h2>Thank you</h2>
                <p>Your message is successfully sent...</p>
            </div>
        </div>
    </div>
</div>

<!-- Modals error -->

<div id="error" class="modal modal-message fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </button>
                <h2>Sorry !</h2>
                <p> Something went wrong </p>
            </div>
        </div>
    </div>
</div>
<!--================End Contact Success and Error message Area =================-->

<!-- End Header Area -->
<?php
include("../user/TemplateUS/FooterUS.php");
?>