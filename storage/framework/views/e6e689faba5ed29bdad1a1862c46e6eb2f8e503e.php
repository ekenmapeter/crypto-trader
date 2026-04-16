
<?php echo $__env->make('user.components.price-converter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('user.components.single-card-upload', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('popup.error_popup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

 

<!-- Initialize Animation -->
    <script>
  AOS.init();
</script>
<!-- Initialize Animation -->

<!-- SweetAlert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>
        <?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </script>
<!-- SweetAlert -->


<?php echo $__env->make('popup.register_notice_popup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
<?php /**PATH C:\xampp\htdocs\Coin-trade\resources\views/user/components/auth-footer.blade.php ENDPATH**/ ?>