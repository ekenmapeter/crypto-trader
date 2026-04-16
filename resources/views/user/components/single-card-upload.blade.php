<!-- add before </body> -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<script>
    // Register the plugin
    FilePond.registerPlugin(FilePondPluginImagePreview);

    // ... FilePond initialisation code here
</script>
<script>
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[name="id_card"]');
    

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
