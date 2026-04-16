<!-- Register PopUp Animation -->
<script type="text/javascript">
    /* YOU DONT NEED THESE, these are just for the popup you see */
function closeTreactPopup(){ 
  document.querySelector(".treact-popup").classList.add("hidden");
}
function openTreactPopup(){ 
  document.querySelector(".treact-popup").classList.remove("hidden");
}
    const closeButton = document.querySelector(".close-treact-popup");
    if (closeButton) {
        closeButton.addEventListener("click", closeTreactPopup);
    }
    setTimeout(openTreactPopup, 3000)
</script>
<!-- Register PopUp Animation -->