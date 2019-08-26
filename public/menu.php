<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Bootstrap 4 sidebar - responsive design</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <script
    type="text/javascript"
    src="/js/lib/dummy.js"
    
  ></script>

    <link rel="stylesheet" type="text/css" href="/css/result-light.css">

      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
      <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"></script>

  <style id="compiled-css" type="text/css">
      /*!
 * Start Bootstrap - Simple Sidebar HTML Template (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */


/* Toggle Styles */

.container {
  padding-top: 15px;
}

#wrapper {
  padding-left: 0;
  -webkit-transition: all 0.5s ease;
  -moz-transition: all 0.5s ease;
  -o-transition: all 0.5s ease;
  transition: all 0.5s ease;
}

#wrapper.toggled {
  padding-left: 250px;
}

#sidebar-wrapper {
  z-index: 1000;
  position: fixed;
  left: 250px;
  width: 0;
  height: 100%;
  margin-left: -250px;
  overflow-y: auto;
  background: #34495e;
  -webkit-transition: all 0.5s ease;
  -moz-transition: all 0.5s ease;
  -o-transition: all 0.5s ease;
  transition: all 0.5s ease;
}

#wrapper.toggled #sidebar-wrapper {
  width: 250px;
}

#page-content-wrapper {
  width: 100%;
  position: absolute;
}

#wrapper.toggled #page-content-wrapper {
  position: absolute;
  margin-right: -250px;
}


/* Sidebar Styles */

.sidebar-nav {
  position: absolute;
  top: 0;
  width: 250px;
  margin: 0;
  padding: 0;
  list-style: none;
}

.sidebar-nav li {
  text-indent: 20px;
  line-height: 40px;
}

.sidebar-nav li a {
  display: block;
  text-decoration: none;
  color: #ecf0f1;
}

.sidebar-nav li a:hover {
  text-decoration: none;
  color: #fff;
  background: #2c3e50;
}

.sidebar-nav li a:active,
.sidebar-nav li a:focus {
  text-decoration: none;
}

.sidebar-nav > .sidebar-brand {
  height: 65px;
  font-size: 18px;
  line-height: 60px;
}

.sidebar-nav > .sidebar-brand a {
  color: #999999;
}

.sidebar-nav > .sidebar-brand a:hover {
  color: #fff;
  background: none;
}

@media(min-width:768px) {
  #wrapper {
    padding-left: 250px;
  }
  #wrapper.toggled {
    padding-left: 0;
  }
  #sidebar-wrapper {
    width: 250px;
  }
  #wrapper.toggled #sidebar-wrapper {
    width: 0;
  }
  #page-content-wrapper {
    position: relative;
  }
  #wrapper.toggled #page-content-wrapper {
    position: relative;
    margin-right: 0;
  }
}

.img-fuid {
  background-repeat: no-repeat;
  background-position: center center;
  height: 500px;
  background-size: cover;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
}

  </style>


  <!-- TODO: Missing CoffeeScript 2 -->

  <script type="text/javascript">


    window.onload=function(){
      


    }

</script>

</head>
<body>
    <div id="wrapper">
  <div id="sidebar-wrapper">
    <ul class="sidebar-nav">
      <li class="sidebar-brand">
        <a href="#">
                        Start Bootstrap
                    </a>
      </li>
      <li>
        <a href="#">Dashboard</a>
      </li>
      <li>
        <a href="#">Shortcuts</a>
      </li>
      <li>
        <a href="#">Overview</a>
      </li>
      <li>
        <a href="#">Events</a>
      </li>
      <li>
        <a href="#">About</a>
      </li>
      <li>
        <a href="#">Services</a>
      </li>
      <li>
        <a href="#">Contact</a>
      </li>
    </ul>
  </div>

  <div id="page-content-wrapper">
    <nav class="navbar navbar-light bg-faded">
      <a class="navbar-brand" href="#">Navbar</a>
      <ul class="nav navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
      </ul>
      <form class="form-inline pull-xs-right">
        <input class="form-control" type="text" placeholder="Search">
        <button class="btn btn-success-outline" type="submit">Search</button>
      </form>
    </nav>

    <br><br>
    <div class="container">
      <div class="row">
        <div class="col-xl-offset-2 col-xl-8">
          <form>
            <div class="form-group row">
              <label for="inputEmail3" class="col-lg-3 form-control-label">Email</label>
              <div class="col-lg-9">
                <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-lg-3 form-control-label">Password</label>
              <div class="col-lg-9">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3">Radios</label>
              <div class="col-lg-9">
                <div class="radio">
                  <label>
                    <input type="radio" name="gridRadios" id="gridRadios1" value="option1" checked> Option one is this and that&mdash;be sure to include why it's great
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="gridRadios" id="gridRadios2" value="option2"> Option two can be something else and selecting it will deselect option one
                  </label>
                </div>
                <div class="radio disabled">
                  <label>
                    <input type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled> Option three is disabled
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3">Checkbox</label>
              <div class="col-lg-9">
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> Check me out
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-lg-offset-3 col-lg-9">
                <button type="submit" class="btn btn-secondary">Sign in</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


  
  <script>
    // tell the embed parent frame the height of the content
    if (window.parent && window.parent.parent){
      window.parent.parent.postMessage(["resultsFrame", {
        height: document.body.getBoundingClientRect().height,
        slug: "tcjq8kb4"
      }], "*")
    }

    // always overwrite window.name, in case users try to set it manually
    window.name = "result"
  </script>
</body>
</html>
