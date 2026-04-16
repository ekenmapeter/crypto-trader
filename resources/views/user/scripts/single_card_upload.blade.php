<!-- add before </body> -->

<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>


        <script>
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[name="singlecard_upload"]');
    

    // Create a FilePond instance
    const pond = FilePond.create(inputElement);
 


FilePond.setOptions({
    
    server: {
        url: '/single-card-upload',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }
});
</script>