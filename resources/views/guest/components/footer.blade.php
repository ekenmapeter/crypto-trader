<footer class="bg-indigo-600 dark:bg-gray-900 text-center mt-36 inset-x-0 bottom-0">
  
</footer>

@include('user.components.price-converter')
@include('popup.error_popup')

  <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        effect: "cards",
        grabCursor: true,
      });
    </script>
<!-- Initialize Swiper -->

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


<!--End of Tawk.to Script-->
</body>
</html>
