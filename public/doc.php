
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Bootstrap Docs Sidebar</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <script
    type="text/javascript"
    src="//code.jquery.com/jquery-2.0.2.js"
    
  ></script>

    <link rel="stylesheet" type="text/css" href="/css/result-light.css">

      <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
      <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">

  <style id="compiled-css" type="text/css">
      .group {
    background: yellow;
    width: 200px;
    height: 500px;
}
.group .subgroup {
    background: orange;
    width: 150px;
    height: 200px;
}
.fixed {
    position: fixed;
}

/* sidebar */
.bs-docs-sidebar {
    padding-left: 20px;
    margin-top: 20px;
    margin-bottom: 20px;
}

/* all links */
.bs-docs-sidebar .nav>li>a {
    color: #999;
    border-left: 2px solid transparent;
    padding: 4px 20px;
    font-size: 13px;
    font-weight: 400;
}

/* nested links */
.bs-docs-sidebar .nav .nav>li>a {
    padding-top: 1px;
    padding-bottom: 1px;
    padding-left: 30px;
    font-size: 12px;
}

/* active & hover links */
.bs-docs-sidebar .nav>.active>a, 
.bs-docs-sidebar .nav>li>a:hover, 
.bs-docs-sidebar .nav>li>a:focus {
    color: #563d7c;                 
    text-decoration: none;          
    background-color: transparent;  
    border-left-color: #563d7c; 
}
/* all active links */
.bs-docs-sidebar .nav>.active>a, 
.bs-docs-sidebar .nav>.active:hover>a,
.bs-docs-sidebar .nav>.active:focus>a {
    font-weight: 700;
}
/* nested active links */
.bs-docs-sidebar .nav .nav>.active>a, 
.bs-docs-sidebar .nav .nav>.active:hover>a,
.bs-docs-sidebar .nav .nav>.active:focus>a {
    font-weight: 500;
}

/* hide inactive nested list */
.bs-docs-sidebar .nav ul.nav {
    display: none;           
}
/* show active nested list */
.bs-docs-sidebar .nav>.active>ul.nav {
    display: block;           
}
  </style>


  <!-- TODO: Missing CoffeeScript 2 -->

  <script type="text/javascript">


    $(window).load(function(){
      
$('body').scrollspy({
    target: '.bs-docs-sidebar',
    offset: 40
});


    });

</script>

</head>
<body>
    <div class="row">
    <!--Nav Bar -->
    <nav class="col-xs-3 bs-docs-sidebar">
        <ul id="sidebar" class="nav nav-stacked fixed">
            <li>
                <a href="#GroupA">Group A</a>
                <ul class="nav nav-stacked">
                    <li><a href="#GroupASub1">Sub-Group 1</a></li>
                    <li><a href="#GroupASub2">Sub-Group 2</a></li>
                </ul>
            </li>
            <li>
                <a href="#GroupB">Group B</a>
                <ul class="nav nav-stacked">
                    <li><a href="#GroupBSub1">Sub-Group 1</a></li>
                    <li><a href="#GroupBSub2">Sub-Group 2</a></li>
                </ul>
            </li>
            <li>
                <a href="#GroupC">Group C</a>
                <ul class="nav nav-stacked">
                    <li><a href="#GroupCSub1">Sub-Group 1</a></li>
                    <li><a href="#GroupCSub2">Sub-Group 2</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <!--Main Content -->
    <div class="col-xs-9">
        <section id="GroupA" class="group">
            <h3>Group A</h3>
            <div id="GroupASub1" class="subgroup">
                <h4>Group A Sub 1</h4>
            </div>
            <div id="GroupASub2" class="subgroup">
                <h4>Group A Sub 2</h4>
            </div>
        </section>
        <section id="GroupB" class="group">
            <h3>Group B</h3>
            <div id="GroupBSub1" class="subgroup">
                <h4>Group B Sub 1</h4>
            </div>
            <div id="GroupBSub2" class="subgroup">
                <h4>Group B Sub 2</h4>
            </div>
        </section>
        <section id="GroupC" class="group">
            <h3>Group C</h3>
            <div id="GroupCSub1" class="subgroup">
                <h4>Group C Sub 1</h4>
            </div>
            <div id="GroupCSub2" class="subgroup">
                <h4>Group C Sub 2</h4>
            </div>
        </section>    
    </div>
</div>

    // always overwrite window.name, in case users try to set it manually
    window.name = "result"
  </script>
</body>
</html>