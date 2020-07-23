export default (formSelector, action) => {
  const $form = $(formSelector);
  $form.on('submit', function (e) {
    e.preventDefault();
    const dataArray = $(this).serializeArray();
    const formData = new FormData();
    dataArray.map((item) => {
      formData.append(item.name, item.value);
    })

    if (!dataArray['action']) {
      formData.append('action', action);
    }

    $.ajax({
      url: window.wordpress.ajaxUrl,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      success(data) {
        clrClassMess();
        if (data.status == 'error') {
          $('.custom-from__mess').addClass('text-warning')
        } else {
          $('.custom-from__mess').addClass('text-success')
        }
        $('.custom-from__mess').html(data.message)
      },
      error(data) {
        clrClassMess();
        $('.custom-from__mess').addClass('text-danger')
        $('.custom-from__mess').html(data.message)
      },
    });

    function clrClassMess() {
      $('.custom-from__mess').removeClass('text-warning');
      $('.custom-from__mess').removeClass('text-success');
      $('.custom-from__mess').removeClass('text-danger');
    }
  });
};
