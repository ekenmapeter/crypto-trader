<!--  see more upload -->

<script>

const btnbutton = document.getElementById('btnbutton');

btnbutton.addEventListener('click', () => {

  const multi = document.getElementById('multi');

  if (multi.style.display === 'none') {

    multi.style.display = 'block';

  } else {

    multi.style.display = 'none';

  }

});
</script>





<!-- add before </body> -->
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>



<script>
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[name="image_url_1"]');
    

    // Create a FilePond instance
    const pond = FilePond.create(inputElement);
 


FilePond.setOptions({
    
    server: {
        url: '/multiple-card-upload',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            
        }
    }
});
</script>

        <script>
    // Get a reference to the file input element
    const inputElement2 = document.querySelector('input[name="image_url_2"]');
    

    // Create a FilePond instance
    const pond2 = FilePond.create(inputElement2);
    

FilePond.setOptions({
    
    server: {
        url: '/multiple-card-upload',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            
        }
    }
});
</script>

</script>

        <script>
    // Get a reference to the file input element
    const inputElement3 = document.querySelector('input[name="image_url_3"]');
    

    // Create a FilePond instance
    const pond3 = FilePond.create(inputElement3);
    

FilePond.setOptions({
    
    server: {
        url: '/multiple-card-upload',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            
        }
    }
});
</script>


<script>
    // Get a reference to the file input element
    const inputElement4 = document.querySelector('input[name="image_url_4"]');
    

    // Create a FilePond instance
    const pond4 = FilePond.create(inputElement4);
    

FilePond.setOptions({
    
    server: {
        url: '/multiple-card-upload',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            
        }
    }
});
</script>



<script>
    // Get a reference to the file input element
    const inputElement5 = document.querySelector('input[name="image_url_5"]');
    

    // Create a FilePond instance
    const pond5 = FilePond.create(inputElement5);
    

FilePond.setOptions({
    
    server: {
        url: '/multiple-card-upload',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            
        }
    }
});
</script>


<script>
    // Get a reference to the file input element
    const inputElement6 = document.querySelector('input[name="image_url_6"]');
    

    // Create a FilePond instance
    const pond6 = FilePond.create(inputElement6);
    

FilePond.setOptions({
    
    server: {
        url: '/multiple-card-upload',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            
        }
    }
});
</script>


<script>
    // Get a reference to the file input element
    const inputElement7 = document.querySelector('input[name="image_url_7"]');
    

    // Create a FilePond instance
    const pond7 = FilePond.create(inputElement7);
    

FilePond.setOptions({
    
    server: {
        url: '/multiple-card-upload',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            
        }
    }
});
</script>


<script>
    // Get a reference to the file input element
    const inputElement8 = document.querySelector('input[name="image_url_8"]');
    

    // Create a FilePond instance
    const pond8 = FilePond.create(inputElement8);
    

FilePond.setOptions({
    
    server: {
        url: '/multiple-card-upload',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            
        }
    }
});
</script>


<script>
    // Get a reference to the file input element
    const inputElement9 = document.querySelector('input[name="image_url_9"]');
    

    // Create a FilePond instance
    const pond9 = FilePond.create(inputElement9);
    

FilePond.setOptions({
    
    server: {
        url: '/multiple-card-upload',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            
        }
    }
});
</script>


<script>
    // Get a reference to the file input element
    const inputElement10 = document.querySelector('input[name="image_url_10"]');
    

    // Create a FilePond instance
    const pond10 = FilePond.create(inputElement10);
    

FilePond.setOptions({
    
    server: {
        url: '/multiple-card-upload',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            
        }
    }
});
</script>

