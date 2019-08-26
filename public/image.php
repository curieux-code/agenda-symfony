<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="/js/jquery.min.js"></script>

    <style>
        * {
        box-sizing: border-box;
        }


        .card {
        width: 28%;
        margin: 2%;
        height: 200px;
        display:inline-block;
        vertical-align:top;
        /*
        padding: 20px;

        */

        background: white;
        
        }

        .img-contain {
        width: 100%;
        height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 2px black solid;
        overflow:hidden;
        }

        .card img {
        /*width: auto;*/
        height: 90%;
        }
    </style>


</head>
<body>

    <div>
        Largeur de l'image: <input type="text" id="width" /><br />
        Largeur du bloc: <input type="text" id="height" />
    </div>

    <div class="card">
    <div class="img-contain">
        <img src="http://fillmurray.com/120/75" alt="bill">
    </div>
    <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum voluptates, omnis tenetur quos quae commodi expedita modi veniam debitis nihil distinctio exercitationem cum sequi eos. Neque et minus nostrum beatae.</h5>
    </div>

    <div class="card">
    <div class="img-contain">
        <img src="http://fillmurray.com/100/100" alt="bill">
    </div>
    <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia eaque aperiam, quaerat eos officia itaque rerum vitae aliquid facilis provident!</h5>
    </div>

    <div class="card">
    <div class="img-contain">
        <img src="http://fillmurray.com/750/1200" alt="bill">
    </div>
    <h5>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consectetur, earum?</h5>
    </div>


    <script type="text/javascript">

        function sizing() {
            $('.card img').each(function() {

                var $current =  $(this),
                    width = $current.width(),
                    max_w = $('.img-contain').width();
                    
                if (width <= max_w) {
                    $current.css({ 'height':'90%','width': 'initial'});
                }
                else {
                    $current.css({ 'height':'initial','width': '90%'});
                }

            });
            
            $("#width").val($('.card img').width());
            $("#height").val($('.img-contain').width());
            /**/
        }

        window.onload=function(){
            sizing()
        }
        $(window).resize(sizing);
        

    </script>

</body>
</html>