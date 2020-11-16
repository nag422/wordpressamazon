<?php

/**
 * 
 * Template Name: Custom videos Page
 */
?>
<?php wp_head(); ?>
<h1>admin-ajax.php Example</h1>

<form id="contact-form" action="/wp-admin/admin-ajax.php">

  <input type="text" name="filename" placeholder="filename Here" />

  <input type="text" name="tablename" placeholder="tablename Here" />
  
  <input type="hidden" name="action" value="importcsvtovideos" />
  

  <button type="submit">Submit</button>

</form>

<?php wp_footer(); ?>
<!-- <script>
const contactForm = document.getElementById('contact-form');
const excelfile = document.getElementById('excel');

if (contactForm) {

  contactForm.addEventListener('submit', (e) => {
    e.preventDefault();
        $this = $(this);
        file_data = e.target.files;
        form_data = new FormData();
        form_data.append('excel', excelfile);
        form_data.append('action', 'send_contact_form');
 
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {
                $this.val('');
                console.log(response.data)
                alert('File uploaded successfully.');
            }
        });

  });

}
</script> -->