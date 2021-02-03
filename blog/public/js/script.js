$(document).ready(function() {
    $('#postCreate').submit(function(e) {
        e.preventDefault();
        let nazov = $('#nazov').val();
        let uvod = $('#uvod').val();
        let text = $('#text').val();
        let obrazok = $('#obrazok').prop('files')[0];
        let kategoria = $('#kategoria').val();
        let formData = new FormData();
        let token = $('meta[name="csrf-token"]').attr('content');
        console.log(obrazok);
        formData.append('_token', token);
        formData.append('nazov', nazov);
        formData.append('uvod', uvod);
        formData.append('text', text);
        formData.append('obrazok', obrazok);
        formData.append('kategoria', kategoria);

        axios({
            method: 'post',
            url: '/posts',
            data: formData,
            headers: {'Content-Type' : 'multipart/form-data'}
        })
            .then(result => {
                alert(result.data);
                window.location.href = "/user/posts";
            })
            .catch(err => {
                let errors = err.response.data.errors;
                printError(errors.nazov, "#nazovvError");
                printError(errors.uvod, "#uvodError");
                printError(errors.text, "#textError");
                printError(errors.obrazok, "#obrazokError");
                printError(errors.kategoria, "#kategoriaError");
            });

    });

     function printError(error, id) {
        if(error) {
            $(id).html(error);
        } else {
            $(id).empty();
        }
    }

    $('#postUpdate').submit(function(e) {
        e.preventDefault();
        let nazov2 = $('#nazov').val();
        let uvod2 = $('#uvod').val();
        let text2 = $('#text').val();
        let obrazok2 = $('#obrazok').prop('files')[0];
        let kategoria2 = $('#kategoria').val();
        let post_id2 = $('#post_id').val();

        let token2 = $('meta[name="csrf-token"]').attr('content');
        let formData2 = new FormData();
        console.log(obrazok2);
        formData2.append('_token', token2);
        formData2.append('_method', 'PATCH');
        formData2.append('nazov', nazov2);
        formData2.append('uvod', uvod2);
        formData2.append('text', text2);
        if(obrazok2) {
            formData2.append('obrazok', obrazok2);
        }

        formData2.append('kategoria', kategoria2);


        axios({
            method: 'post',
            url: '/posts/' + post_id2,
            data: formData2,
            headers: {'Content-Type' : 'multipart/form-data'}
        }).then(result => {
                alert(result.data);
                window.location.href = "/user/posts";
            })
            .catch(err => {
                let errors = err.response.data.errors;
                printError(errors.nazov, "#nazovvError");
                printError(errors.uvod, "#uvodError");
                printError(errors.text, "#textError");
                printError(errors.obrazok, "#obrazokError");
                printError(errors.kategoria, "#kategoriaError");
            });
    });

    $('#postDelete').submit(function(e) {
        e.preventDefault();
        let post_id = $('#post_id_delete').val();

        let token = $('meta[name="csrf-token"]').attr('content');
        let formData = new FormData();

        formData.append('_token', token);
        formData.append('_method', 'DELETE');
        formData.append('post_id', post_id);


        axios({
            method: 'post',
            url: '/posts/' + post_id,
            data: formData,
        })
            .then(result => {
                alert(result.data);
                window.location.href = "/user/posts";
            })
            .catch(err => {
                console.log(err);
            });
    })
});
