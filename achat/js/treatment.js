$(function () {

    var content_articles = $('#articles');
    $('.link_articles').on('click', function (e) {
        e.preventDefault();
        var content = $(this).attr('data');
        var tab = content.split('&');
        eval(tab[0]);
        if (articles === '')
            return;

        $.ajax({
            url: 'php/check.php',
            method: 'GET',
            data: {
                articles_click: articles
            },
            dataType: 'text',
            beforeSend: function () {
                $('.loader_blog').show();
            },
            success: function (data) {
                console.log('successss');
                //content_articles.html(data);
                $('.loader_blog').hide();
            },
            error: function () {

                console.log('Erreur de Chargement des Articles');

            },

            complete: function () {
                console.log('complete');
                $('.loader_blog').hide();

                load_comments();

            }

        });


    });


    function load_comments() {
        $.ajax({
            url: 'php/check.php',
            method: 'GET',
            data: {
                get_articles: 1
            },
            dataType: 'text',
            beforeSend: function () {
                $('.loader_blog').show();
            },
            success: function (data) {
                content_articles.html(data);
                $('.loader_blog').hide();
            },
            error: function () {
                console.log('Erreur est survenue');
            },

            complete: function () {
                console.log('complete');
                alert("article ajouté avec succès")
                $('.loader_blog').hide();
            }

        });
    }

});