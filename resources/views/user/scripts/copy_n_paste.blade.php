<script>
    const copyBtn = document.querySelector('#copyBtn');
    copyBtn.addEventListener('click', e => {
        const input = document.createElement('input');
        input.value = copyBtn.dataset.text;
        document.body.appendChild(input);
        input.select();
        if(document.execCommand('copy')) {
            //alert('Text Copied');
            Swal.fire(
              'Good job!',
              'Account Number Copied',
              'success'
            )
            document.body.removeChild(input);
        }
    });
</script>