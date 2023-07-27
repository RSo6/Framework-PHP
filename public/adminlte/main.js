$(function () {

    $('.delete').click(function () {
        let res = confirm('Confirm action');
        if (!res) return false;

    });

     $(".is-download").select2({
            placeholder: "Начните вводить наименование файла",
            minimumInputLength: 1,
            cache: true,
            ajax: {
                url: ADMIN + "/product/get-download",
                delay: 250,
                dataType: 'json',
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.items,
                    };
                },
            },
        });

});