<!DOCTYPE html>
<html>
<head>

<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>lazy load</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script type="text/javascript" src="//code.jquery.com/jquery-git.js"></script>
<script type="text/javascript" src="https://unpkg.com/stickybits@1.5.3/dist/jquery.stickybits.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/8.0.1/lazyload.min.js"></script>

<style type="text/css">

    .zone img {
    display: block;
    margin-bottom: 200px;
    }

    .sticky {
    position: sticky;
    top: 10px;
    background: #fff;
    }

    .js-is-sticky {
    background-color: red;
    }

    .js-is-stuck {
    background-color: blue;
    }

</style>


<script type="text/javascript">

$().ready(function(){
    var myLazyLoad = new LazyLoad();
    $('.sticky').stickybits({
    useStickyClasses: true
})
})

</script>

</head>
<body>
    <div class="zone">
  <h1 class="sticky">Title 1</h1>
  <img src="http://farm8.staticflickr.com/7060/6969705425_0905bf6bba_o.jpg">
  <h1 class="sticky">Title 2</h1>
  <img src="http://farm8.staticflickr.com/7203/6969484613_0ee3af0144_o.jpg">
  <h1 class="sticky">Title 3</h1>
  <img src="http://farm8.staticflickr.com/7207/6821596428_cdae70e306_o.jpg">
  <h1 class="sticky">Title 4</h1>
  <img src="http://farm8.staticflickr.com/7037/6965140403_9fbb5e7f96_o.jpg">
</div>

</body>
</html>