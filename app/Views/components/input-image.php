<div class="form-group text-center mb-3">
    <span class="form-label fw-bold">Image</span>

    <div class="card mx-auto d-block border-0 my-0 py-0" id="input-image">
        <img src="<?= base_url('assets/images/default.jpg') ?>" class="card-img border previewImage" id="previewImage"
            alt="Default Image">

        <div class="card-img-overlay align-self-end text-center form-group my-0">

            <label for="file_upload">
                <span class="btn btn-sm btn-outline-light rounded">Select Image</span>
            </label>

            <input type="file" name="file_upload" id="file_upload" class="form-control d-none"
                accept=".jpg, .jpeg, .png" value="<?= base_url('assets/images/default.jpg') ?>"
                aria-describedby="file_uploadHelp">

        </div>
    </div>

    <div id="imageHelp" class="form-text">Max size: 1MB</div>
    <p id="fileName" class="my-0 py-0"></p>
</div>


<script>
document.getElementById('file_upload').addEventListener('change', function(event) {
    let preview = document.getElementById('previewImage');
    let fileNameDisplay = document.getElementById('fileName');
    let file = event.target.files[0];
    let reader = new FileReader();

    reader.onloadend = function() {
        preview.src = reader.result;
    }

    if (file) {
        if (file.size > 1024 * 1024) {
            alert("Image file size must be less than 1MB.");
            return;
        }
        reader.readAsDataURL(file);
        fileNameDisplay.textContent = 'File: ' + file.name;
    } else {
        preview.src = "<?= base_url('assets/images/default.jpg') ?>";
        fileNameDisplay.textContent = '';
    }
});
</script>