var files;

$('#receipts_input').on('change', () => {
    files = $('#receipts_input')[0].files;
});

$('#form_receipts').on('submit', (e) => {
    e.preventDefault();
    var date_receipt = $('input[name=date_receipt]').val();

    if (typeof files === 'undefined' || !date_receipt || files.length === 0) {
        alert('Не вся информация заполнена');
        return false;
    }

    $('#files').html('');

    $.each(files, function (index, value) {
        var file_html = `
            <div class="file-name">` + value.name + `</div>
            <div class="file-status" file-status="` + index + `">Ожидает загрузки...</div>
`;
        var object_to_add = document.createElement('div');
        object_to_add.setAttribute('class', 'upload-file dark');
        object_to_add.setAttribute('file-index', index);
        object_to_add.innerHTML = file_html;
        document.getElementById('files').appendChild(object_to_add);
    });

    uploadFiles(files, 0);
    return false;
});

function uploadFiles(files, index = 0) {
    var formData = new FormData();
    var date_receipt = $('input[name=date_receipt]').val();

    formData.append('receipt', files[index]);
    formData.append('date_receipt', date_receipt);

    $('div[file-index=' + index + ']').attr('class', 'upload-file primary');
    $('div[file-status=' + index + ']').html('загружается...');

    $.ajax({
        url: '/admin/receipts/multiple-store',
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
    }).done((html) => {
        if (html.result === 'success') {
            $('div[file-index=' + index + ']').attr('class', 'upload-file success');
            $('div[file-status=' + index + ']').html('Загружено');
        } else {
            $('div[file-index=' + index + ']').attr('class', 'upload-file warning');
            $('div[file-status=' + index + ']').html('Участок не найден');
        }
    }).fail((response) => {
        $('div[file-index=' + index + ']').attr('class', 'upload-file error');
        $('div[file-status=' + index + ']').html('Неизвестная ошибка');
    }).always(() => {
        if (index + 1 < files.length) {
            uploadFiles(files, index + 1)
        } else {
            $('#form_receipts')[0].reset();
        }
    });
}