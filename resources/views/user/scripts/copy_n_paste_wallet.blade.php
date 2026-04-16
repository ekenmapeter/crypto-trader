<script>
    const copyBtns = document.querySelectorAll('.copy-btn');
    copyBtns.forEach(copyBtn => {
        copyBtn.addEventListener('click', e => {
            const input = document.createElement('input');
            input.value = copyBtn.dataset.text;
            document.body.appendChild(input);
            input.select();
            if(document.execCommand('copy')) {
                const alertContainer = document.createElement('div');
                alertContainer.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50';

                const alertContent = document.createElement('div');
                alertContent.className = 'bg-white rounded-lg p-4 shadow-lg';
                alertContent.innerText = 'Wallet Address Copied';

                alertContainer.appendChild(alertContent);
                document.body.appendChild(alertContainer);

                setTimeout(() => {
                    document.body.removeChild(alertContainer);
                }, 1000);

                document.body.removeChild(input);
            }
        });
    });
</script>