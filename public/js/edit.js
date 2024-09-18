document.getElementById('uploadButton').addEventListener('click', function () {
    document.getElementById('image').click();
});

document.getElementById('image').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        if (file.type.match(/image\/*/)) {
            document.getElementById('fileNameDisplay').textContent = file.name + ' が選択されました';
        } else {
            document.getElementById('fileNameDisplay').textContent = '';
            return false;
        }
    }
});