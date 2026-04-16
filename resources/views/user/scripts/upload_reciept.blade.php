


<!-- add before </body> -->
<script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script>

<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script>

<script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js"></script>

<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>


<script>

FilePond.registerPlugin(

    FilePondPluginPdfPreview,

    // encodes the file as base64 data
  FilePondPluginFileEncode,

    // validates the size of the file
    FilePondPluginFileValidateSize,

    // corrects mobile image orientation
    FilePondPluginImageExifOrientation,

    // previews dropped images
  FilePondPluginImagePreview
);

// Select the file input and use create() to turn it into a pond
FilePond.create(
    document.querySelector("input[name='receipt_upload']")
);

FilePond.create(
    document.querySelector("input[name='receipt_upload']")
);

FilePond.create(
    document.querySelector("input[name='receipt_upload']")
);

FilePond.create(
    document.querySelector("input[name='receipt_upload']")
);

FilePond.create(
    document.querySelector("input[name='receipt_upload']")
);

FilePond.create(
    document.querySelector("input[name='receipt_upload']")
);

FilePond.create(
    document.querySelector("input[name='receipt_upload']")
);

FilePond.create(
    document.querySelector("input[name='receipt_upload']")
);

FilePond.create(
    document.querySelector("input[name='receipt_upload']")
);

FilePond.create(
    document.querySelector("input[name='receipt_upload']")
);

FilePond.create(
    document.querySelector("input[name='receipt_upload']")
);

FilePond.create(
    document.querySelector("input[name='receipt_upload']")
);


FilePond.setOptions({
    
    server: {
        url: '/trade-crypto-upload',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            
        }
    }
});
</script>