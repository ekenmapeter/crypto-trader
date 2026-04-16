@include('popup.error_popup')

 

<!-- Initialize Animation -->
    <script>
  AOS.init();
</script>
<!-- Initialize Animation -->

<!-- SweetAlert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>
        @include('sweetalert::alert')
    </script>
<!-- SweetAlert -->


@include('popup.register_notice_popup')

<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>


<!-- dashboard script -->
<script>
    const setup = () => {
  return {
    isSidebarOpen: false,
    currentSidebarTab: null,
    isSettingsPanelOpen: false,
    isSubHeaderOpen: false,
    watchScreen() {
      if (window.innerWidth <= 1024) {
        this.isSidebarOpen = false
      }
    },
  }
}
    
</script>
</body>
</html>
