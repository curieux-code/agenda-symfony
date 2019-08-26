$('#add-borough').click(function(){
    // Je récupère le numéro des champs que je vais créer
    const index = +$('#widgets-counter').val();

    // Je récupère le prototype des entrées
    const tmpl = $('#reduction_boroughs').data('prototype').replace(/__name__/g, index);

    // J'injecte ce code dans la div
    $('#reduction_boroughs').append(tmpl);

    $('#widgets-counter').val(index + 1);

    // Je gère le bouton de suppression
    handleDeleteButtons();

    console.log(tmpl);
});

function handleDeleteButtons() {
    $('button[data-action="delete"]').click(function(){
        const target = this.dataset.target;
        //console.log(target);
        $(target).remove();
    });
}



function updateCounter() {
    const count = +$('#reduction_boroughs div.form-group').length;

    $('#widgets-counter').val(count);
}

// J'appele les fonctions au chargement
updateCounter();
handleDeleteButtons();