<!-- alert แจ้งเตือนเมื่อเราสู่ระบบสำเร็จ -->
<?php
if (@$_SESSION['status'] == 1) {
  echo "<script>
        Swal.fire({
            title: 'เข้าสู่ระบบสำเร็จ!',
            icon: 'success',
            confirmButtonText: 'ตกลง',
            confirmButtonColor: '#3085d6',
          })
        </script>";
  $_SESSION['status'] = 0;
}
?>
<!-- แจ้งแตือนเมื่อหยิบสินค้าลงตะกร้า -->
<?php
if (@$_SESSION['cart'] == 1) {
  echo "<script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'หยิบลงตะกร้าเรียบร้อย',
            showConfirmButton: false,
            timer: 1000
          })
        </script>";
  $_SESSION['cart'] = 0;
}
?>
<!-- แจ้งแตือนเมื่อยืนยันการสั่งซื้อ -->
<?php
if (@$_SESSION['oder'] == 1) {
  echo "<script>
        Swal.fire({
            title: 'สั่งซื้อสำเร็จ',
            icon: 'success',
            confirmButtonText: 'ตกลง',
            confirmButtonColor: '#3085d6',
          })
        </script>";
  $_SESSION['oder'] = 0;
}
?>
<?php
if (@$_SESSION['edit_type'] == 1) {
  echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'แก้ไขประเภทสินค้าสำเร็จ',
          showConfirmButton: false,
          timer: 1700
          })
        </script>";
  $_SESSION['edit_type'] = 0;
}
?>
<?php
if (@$_SESSION['add_type'] == 1) {
  echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'เพิ่มประเภทสินค้าสำเร็จ',
          showConfirmButton: false,
          timer: 1700
          })
        </script>";
  $_SESSION['add_type'] = 0;
}
?>


<?php
if (@$_SESSION['Status_Product'] == 1) {
  echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'ปรับปรุงสถานะสำเร็จ',
          showConfirmButton: false,
          timer: 1700
          })
        </script>";
  $_SESSION['Status_Product'] = 0;
}
?>

<?php
if (@$_SESSION['edit_product'] == 1) {
  echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'แก้ไขสินค้าสำเร็จ',
          showConfirmButton: false,
          timer: 1700
          })
        </script>";
  $_SESSION['edit_product'] = 0;
}
?>
<?php
if (@$_SESSION['edit_member'] == 1) {
  echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'แก้ไขข้อมูลสำเร็จ',
          showConfirmButton: false,
          timer: 1700
          })
        </script>";
  $_SESSION['edit_member'] = 0;
}
?>
<?php
if (@$_SESSION['admin_cancel_oder'] == 1) {
  echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'ยกเลิกรายการสำเร็จ',
          showConfirmButton: false,
          timer: 1700
          })
        </script>";
  $_SESSION['admin_cancel_oder'] = 0;
}
?>
<?php
if (@$_SESSION['cancel_oder'] == 1) {
  echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'ยกเลิกรายการสำเร็จ',
          showConfirmButton: false,
          timer: 1700
          })
        </script>";
  $_SESSION['cancel_oder'] = 0;
}
?>

<?php
if (@$_SESSION['login_fall'] == 1) {
  echo "<script>
        Swal.fire({
          icon: 'error',
          title: 'เข้าสู่ระบบไม่สำเร็จ กรุณาตรวจสอบ  Username หรือ Password',
          showConfirmButton: false,
          timer: 2000
          })
        </script>";
  $_SESSION['login_fall'] = 0;
}
?>
<?php
if (@$_SESSION['over_stock'] == 1) {
  echo "<script>
        Swal.fire({
          icon: 'error',
          title: 'ขออภัยเนื้องจากสินค้าเกินกำหนด',
          showConfirmButton: true,
          confirmButtonColor: '#188752',
          
          })
        </script>";
  $_SESSION['over_stock'] = 0;
}
?>
<?php
if (@$_SESSION['over_stock_promotion'] == 1) {
  echo "<script>
        Swal.fire({
          icon: 'error',
          title: 'ขออภัยแต้มสะสมไม่เพียงพอ',
          showConfirmButton: true,
          confirmButtonColor: '#188752',
          
          })
        </script>";
  $_SESSION['over_stock_promotion'] = 0;
}
?>
<?php
if (@$_SESSION['scan_false'] == 1) {
  echo "<script>
        Swal.fire({
          icon: 'error',
          title: 'รหัสสินค้าไม่ถูกต้อง',
          timer: 1500,
          showConfirmButton: false,
          })
        </script>";
  $_SESSION['scan_false'] = 0;
}
?>