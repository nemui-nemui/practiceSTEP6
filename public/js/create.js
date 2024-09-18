document.getElementById('companySelect').addEventListener('change', function() {
    var newCompanyInput = document.getElementById('newCompanyInput');
    if (this.value === 'new') {
        newCompanyInput.classList.remove('d-none'); // 新規メーカー入力欄を表示
    } else {
        newCompanyInput.classList.add('d-none'); // 新規メーカー入力欄を隠す
    }
});

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