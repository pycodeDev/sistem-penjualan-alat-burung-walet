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
<script>
$(document).ready(function() {
   $("#reset-btn").click(function() {
        location.reload(); // Me-refresh halaman
    });
    
    $("#search-form").click(function(e) {
        e.preventDefault(); // Mencegah reload

        let trx_id = $("#trx_id").val().trim();
        
        if (trx_id === "") {
            // Jika input kosong, tampilkan kembali data PHP dan sembunyikan data AJAX
            $("#php-data").show();
            $("#ajax-data").hide();
            return;
        }

        $.ajax({
            url: "<?= base_url('trx/search') ?>",
            method: "POST",
            data: { trx_id: trx_id },
            dataType: "json",
            success: function(response) {
                if (response.data.length > 0) {
                    let tableBody = "";
                    response.data.forEach((trx, index) => {
                        let badgeClass = "";
                        switch (trx.status) {
                            case "PENDING": badgeClass = "badge-warning"; break;
                            case "CONFIRM": badgeClass = "badge-info"; break;
                            case "SHIPPING": badgeClass = "badge-primary"; break;
                            case "SUCCESS": badgeClass = "badge-success"; break;
                            default: badgeClass = "badge-danger";
                        }

                        tableBody += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${trx.trx_id}</td>
                                <td>${trx.nama_user}</td>
                                <td>${trx.total}</td>
                                <td>${trx.price}</td>
                                <td><span class="badge ${badgeClass} text-white">${trx.status}</span></td>
                                <td>${new Date(trx.created).toLocaleDateString()}</td>
                                <td><a href="<?= base_url(); ?>trx/data-trx/${trx.trx_id}" class="btn btn-sm btn-info"><i class="fa fa-eye text-white"></i></a></td>
                            </tr>
                        `;
                    });

                    $("#ajax-data tbody").html(tableBody);
                    $("#php-data").hide();
                    $("#ajax-data").show();
                } else {
                    alert("Data tidak ditemukan!");
                }
            },
            error: function() {
                alert("Terjadi kesalahan saat mengambil data.");
            }
        });
    });
});
</script>
</body>
</html>
