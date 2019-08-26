<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Patternfly Vertical Nav</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <script
    type="text/javascript"
    src="//code.jquery.com/jquery-2.2.4.js"
    
  ></script>

      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/patternfly/3.15.1/css/patternfly-additions.css">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/patternfly/3.15.1/css/patternfly.css">
      <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/patternfly/3.15.1/js/patternfly.min.js"></script>

  <style id="compiled-css" type="text/css">
      .nav-pf-vertical .fixed-bottom {
  position: fixed;
  left: 0;
  bottom: 0;
  background: #292e34;
  border-top: 1px solid #030303;
  border-bottom: 0;
}
  </style>


  <!-- TODO: Missing CoffeeScript 2 -->

  <script type="text/javascript">
//<![CDATA[

    window.onload=function(){
      
$(document).ready(function() {
  $('html').addClass('layout-pf layout-pf-fixed');

  // Initialize the vertical navigation
  $().setupVerticalNavigation(true);

  // fix scrollbar positioning
  $('.nav-pf-vertical').css('margin-bottom', $('.fixed-bottom').children().outerHeight());

  setTimeout(function() {
    $('.alert').hide();
  }, 1000);
});


    }

//]]></script>

</head>
<body>
    <nav class="navbar navbar-pf-vertical">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a href="#" class="navbar-brand">
      Test
    </a>
  </div>
</nav><!--/.navbar-->

<div class="nav-pf-vertical nav-pf-vertical-with-sub-menus">
  <ul class="list-group">
    <li class="list-group-item">
      <a>
        <span class="fa fa-dashboard" data-toggle="tooltip" title="Dashboard"></span>
        <span class="list-group-item-value">Dashboard</span>
      </a>
    </li>
    <li class="list-group-item">
      <a>
        <span class="fa fa-shield" data-toggle="tooltip" title="Dolor"></span>
        <span class="list-group-item-value">Dolor</span>

      </a>
    </li>
    <li class="list-group-item active secondary-nav-item-pf" data-target="#ipsum-secondary">
      <a>
        <span class="fa fa-space-shuttle" data-toggle="tooltip" title="Ipsum"></span>
        <span class="list-group-item-value">Ipsum</span>
      </a>
      <div id="-secondary" class="nav-pf-secondary-nav">
        <div class="nav-item-pf-header">
          <a class="secondary-collapse-toggle-pf" data-toggle="collapse-secondary-nav"></a>
          <span>Ipsum</span>
        </div>
        <ul class="list-group">
          <li class="list-group-item active " data-target="#ipsum-intellegam-tertiary">
            <a>
              <span class="list-group-item-value">Intellegam</span>
            </a>
          </li>
          <li class="list-group-item " data-target="#ipsum-copiosae-tertiary">
            <a>
              <span class="list-group-item-value">Copiosae</span>
            </a>
          </li>
          <li class="list-group-item " data-target="#ipsum-patrioque-tertiary">
            <a>
              <span class="list-group-item-value">Patrioque</span>
            </a>
          </li>
        </ul>
      </div>
    </li>
    <li class="list-group-item secondary-nav-item-pf" data-target="#amet-secondary">
      <a>
        <span class="fa fa-paper-plane" data-toggle="tooltip" title="Amet"></span>
        <span class="list-group-item-value">Amet</span>
      </a>

      <div id="amet-secondary" class="nav-pf-secondary-nav">
        <div class="nav-item-pf-header">
          <a class="secondary-collapse-toggle-pf" data-toggle="collapse-secondary-nav"></a>
          <span>Amet</span>
        </div>
        <ul class="list-group">
          <li class="list-group-item " data-target="#amet-detracto-tertiary">
            <a>
              <span class="list-group-item-value">Detracto Suscipiantur</span>
            </a>
          </li>
          <li class="list-group-item " data-target="#amet-mediocrem-tertiary">
            <a>
              <span class="list-group-item-value">Mediocrem</span>
            </a>
          </li>
          <li class="list-group-item " data-target="#amet-corrumpit-tertiary">
            <a>
              <span class="list-group-item-value">Corrumpit Cupidatat Proident Deserunt</span>
            </a>
          </li>
        </ul>
      </div>
    </li>
    <li class="list-group-item">
      <a>
        <span class="fa fa-graduation-cap" data-toggle="tooltip" title="Adipscing"></span>
        <span class="list-group-item-value">Adipscing</span>
      </a>
    </li>
    <li class="list-group-item">
      <a>
        <span class="fa fa-gamepad" data-toggle="tooltip" title="Lorem"></span>
        <span class="list-group-item-value">Lorem</span>
      </a>
    </li>
  </ul>
  <ul class="list-group fixed-bottom">
    <li class="list-group-item">
      <a>
        <span class="fa fa-cogs" data-toggle="tooltip" title="Lorem"></span>
        <span class="list-group-item-value">Options</span>
      </a>
    </li>
  </ul>
</div>

<div class="container-fluid container-pf-nav-pf-vertical">
  <h2>Content</h2>
  <p class="alert alert-info">
    <i class="pficon spinner spinner-sm"></i> Loading...
  </p>
</div>


</body>
</html>
