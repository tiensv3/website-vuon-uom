  <!-- page-body-wrapper ends -->
  </div>
  <!-- plugins:js -->
  <script src="../admin/assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../admin/assets/vendors/chart.js/Chart.min.js"></script>
  <script src="../admin/assets/vendors/jquery-circle-progress/js/circle-progress.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../admin/assets/js/off-canvas.js"></script>
  <script src="../admin/assets/js/hoverable-collapse.js"></script>
  <script src="../admin/assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <!-- <script src="../admin/assets/js/dashboard.js"></script> -->
  <!-- End custom js for this page -->

  <script>
    ClassicEditor
      .create(document.querySelector('#description'))
      .then(editor => {
        console.log(editor);
      })
      .catch(error => {
        console.error(error);
      });
  </script>
  <script>
    function confirmDelete() {
      return confirm(
        'Bạn có chắc muốn xóa không? Điều này có thể dẫn đến các dữ liệu con thuộc dữ liệu bạn muốn xóa. Hãy cân nhắc!'
      );
    }
  </script>


  </body>

  </html>