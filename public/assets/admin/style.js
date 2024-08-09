// Fungsi untuk menambahkan kelas aktif dan menu-open
function setActiveMenu(subsection, section = null) {
    // Jika section diatur, cari elemen utama menu berdasarkan data-section
    if (section) {
      const mainMenu = document.querySelector(`.nav-item[data-section="${section}"]`);
      if (mainMenu) {
        // Tambahkan kelas menu-open ke elemen utama
        mainMenu.classList.add('menu-open');
        
        // Aktifkan sub menu berdasarkan subsection
        const subMenu = mainMenu.querySelector(`.nav-link[data-subsection="${subsection}"]`);
        if (subMenu) {
          subMenu.classList.add('active');
        }
      }
    } else {
      // Jika section tidak diatur, cari langsung sub menu berdasarkan subsection
      const subMenu = document.querySelector(`.nav-link[data-subsection="${subsection}"]`);
      if (subMenu) {
        subMenu.classList.add('active');
      }
    }
}