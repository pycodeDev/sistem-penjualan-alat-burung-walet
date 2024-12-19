<!DOCTYPE html>
<html lang="en">
<head>
  <?php echo $this->include('Admin/Layout/Header'); ?>
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Main Sidebar Container -->
  <?php echo $this->include('Admin/Layout/Sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?= $this->renderSection('content') ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php echo $this->include('Admin/Layout/Footer'); ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
  <?php echo $this->include('Admin/Layout/Js'); ?>
  <?php echo $this->include('Admin/Layout/Toast'); ?>
  <?php echo $this->include('Admin/Layout/Chart'); ?>
  <script>
    // Dapatkan URL saat ini
    const currentURL = window.location.pathname;
    // Pisahkan URL berdasarkan '/'
    const parts = currentURL.split('/');
    const t = parts[2] || null; 
    let section = ""
    let subsection = ""

    if (t == null) {
      section = null; 
      subsection = parts[1];  
    }else{
      section = parts[1]; 
      subsection = parts[2]; 
    }

    if (section == "payment") {
      section = null 
      subsection = "payment"
    }
    
    if (section == "user") {
      section = null 
      subsection = "user"
    }
    if (section == "admin") {
      section = null 
      subsection = "admin"
    }
    
    setActiveMenu(subsection, section);
</script>
</body>
</html>
