<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Bootstrap 4 with Twitter Typeahead and Material design</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.1/css/mdb.min.css">
    <link rel="stylesheet" type="text/css" href="https://github.com/bassjobsen/typeahead.js-bootstrap4-css/blob/master/typeaheadjs.css">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://twitter.github.com/typeahead.js/releases/latest/typeahead.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>

  <style id="compiled-css" type="text/css">
      /***
	TYPEAHEAD for MDB
	by djibe
***/

.typeahead {
    z-index: 1051;
}


/*If using icon span before input, like <i class="fa fa-asterisk prefix"></i>*/

span.twitter-typeahead {
    width: calc(100% - 3rem);
    margin-left: 3rem;
}


/* Aspect of the dropdown of results*/

.typeahead.dropdown-menu,
span.twitter-typeahead .tt-menu {
    min-width: 100%;
	background: white;
    /*as large as input*/
    border: none;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);
    border-radius: 0;
    font-size: 1.2rem;
}


/*Aspect of results, done*/

span.twitter-typeahead .tt-suggestion {
    color: #4285F4;
    cursor: pointer;
    padding: 1rem;
    text-transform: capitalize;
    font-weight: 400;
}


/*Hover a result, done*/

span.twitter-typeahead .active.tt-suggestion,
span.twitter-typeahead .tt-suggestion.tt-cursor,
span.twitter-typeahead .active.tt-suggestion:focus,
span.twitter-typeahead .tt-suggestion.tt-cursor:focus,
span.twitter-typeahead .active.tt-suggestion:hover,
span.twitter-typeahead .tt-suggestion.tt-cursor:hover {
    background-color: #EEEEEE;
    color: #4285F4;
}

label.active {
    color: #4285F4 !important;
}

  </style>


  <!-- TODO: Missing CoffeeScript 2 -->

  <script type="text/javascript">


    var VanillaRunOnDomReady = function() {
      
// Bootstrap 4 + MDB + typeahead label fix
//Add class typeahead to your text input invoking typeahead
$('.typeahead').on('focus', function() {
    $(this).parent().siblings().addClass('active');
}).on('blur', function() {
    if (!$(this).val()) {
        $(this).parent().siblings().removeClass('active');
    }
});

var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
    'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
    'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
    'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
    'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
    'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
    'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
    'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
    'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
];

//bloodhound demo
//documentation : https://github.com/corejavascript/typeahead.js/blob/master/doc/bloodhound.md
var states = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    // `states` is an array of state names defined in "The Basics"
    local: states
});

//Documentation : https://github.com/corejavascript/typeahead.js/blob/master/doc/jquery_typeahead.md
$('#the-basics .typeahead').typeahead({
    highlight: true,
    hint: true,
    minLength: 3
}, {
    name: 'states',
    source: states,
    limit: 10
});


    }

var alreadyrunflag = 0;

if (document.addEventListener)
    document.addEventListener("DOMContentLoaded", function(){
        alreadyrunflag=1; 
        VanillaRunOnDomReady();
    }, false);
else if (document.all && !window.opera) {
    document.write('<script type="text/javascript" id="contentloadtag" defer="defer" src="javascript:void(0)"><\/script>');
    var contentloadtag = document.getElementById("contentloadtag")
    contentloadtag.onreadystatechange=function(){
        if (this.readyState=="complete"){
            alreadyrunflag=1;
            VanillaRunOnDomReady();
        }
    }
}

window.onload = function(){
  setTimeout("if (!alreadyrunflag){VanillaRunOnDomReady}", 0);
}

</script>

</head>
<body>
    <div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="jumbotron">
                <h1>Bootstrap 4 with Material Design Bootstrap (MDB) and Twitter Typeahead
</h1>
                <p class="lead">by djibe (and Bassjobsen CSS).
                    <br>Complete doc here : <a href="https://github.com/twitter/typeahead.js" target="_blank">Github page of Twitter Typeahead</a>.</p>
                <div class="md-form mt-4" id="the-basics">
                    <i class="fa fa-asterisk prefix"></i>
                    <input type="text" class="form-control typeahead" id="medicament">
                    <label for="medicament" id="medicament-label">Médicament (DCI, nom) ...</label>
                </div>
                <div class="md-form mt-4" id="the-basics">
                    <i class="fas fa-times-circle prefix"></i>
                    <input type="text" class="form-control typeahead" id="clock">
                    <label for="clock" id="clock-label">Horaire ...</label>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
