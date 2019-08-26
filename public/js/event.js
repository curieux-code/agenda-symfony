$('#add-image').click(function(){
    // Je récupère le numéro des champs que je vais créer
    const index = +$('#widgets-counter').val();

    // Je récupère le prototype des entrées
    const tmpl = $('#event_images').data('prototype').replace(/__name__/g, index);

    // J'injecte ce code dans la div
    $('#event_images').append(tmpl);

    $('#widgets-counter').val(index + 1);

    // Je gère le bouton de suppression
    handleDeleteButtons();


    //console.log(tmpl);
});

function handleDeleteButtons() {
    $('button[data-action="delete"]').click(function(){
        const target = this.dataset.target;
        //console.log(target);
        $(target).remove();
    });
}



function updateCounter() {
    const count = +$('#event_images div.form-group').length;

    $('#widgets-counter').val(count);
}

// J'appele les fonctions au chargement
updateCounter();
handleDeleteButtons();







// Copier-coller pour les vidéos

$('#add-video').click(function(){
    // Je récupère le numéro des champs que je vais créer
    const index = +$('#widgets-counter').val();

    // Je récupère le prototype des entrées
    const tmpl = $('#event_videos').data('prototype').replace(/__name__/g, index);

    // J'injecte ce code dans la div
    $('#event_videos').append(tmpl);

    $('#widgets-counter').val(index + 1);

    // Je gère le bouton de suppression
    handleDeleteButtonsVideo();


    //console.log(tmpl);
});

function handleDeleteButtonsVideo() {
    $('button[data-action="delete"]').click(function(){
        const target = this.dataset.target;
        //console.log(target);
        $(target).remove();
    });
}



function updateCounterVideo() {
    const count = +$('#event_videos div.form-group').length;

    $('#widgets-counter').val(count);
}

// J'appele les fonctions au chargement
updateCounterVideo();
handleDeleteButtonsVideo();