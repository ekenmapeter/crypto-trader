<footer class="hidden md:block bg-indigo-600 dark:bg-gray-900 text-center mt-12 inset-x-0 bottom-0">

    </div>
</footer>
@include('user.components.price-converter')
@include('user.components.single-card-upload')

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
<script src="//code.jivosite.com/widget/kM6yqqHPcU" async></script>
</body>
</html>
