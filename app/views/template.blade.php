<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Server Monitor</title>

    <!-- Bootstrap -->
    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="http://bootswatch.com/simplex/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-default navbar-inverse navbar-fixed" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Server Monitor</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">Home</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
    <div class="container">
        <h1>Servers</h1>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td>Server Name</td>
                        <td>Server IP</td>
                        <td>Provider</td>
                        <td>Uptime</td>
                        <td width="15%">Load</td>
                        <td width="15%">Memory</td>
                        <td width="15%">Disk</td>
                    </tr>
                </thead>
                
                <tbody>
                    <tr class="success">
                        <td>Server One</td>
                        <td>127.0.0.1</td>
                        <td>Digital Ocean</td>
                        <td>1d 4h</td>
                        <td>0.01, 0.01, 0.01</td>
                        <td>
                            <div class="progress progress-striped active">
                              <div class="progress-bar progress-bar-danger"  role="progressbar" style="width: 65%">
                                65%
                              </div>
                            </div>
                        </td>
                        <td>
                            <div class="progress progress-striped active">
                              <div class="progress-bar progress-bar"  role="progressbar" style="width: 85%">
                                85%
                              </div>
                            </div>
                        </td>
                    </tr>
                    
                    <tr class="success">
                        <td>Server Two</td>
                        <td>192.168.0.1</td>
                        <td>OVH</td>
                        <td>165d, 5h</td>
                        <td><p class="text-danger">8.96, 5.67, 2.45</p></td>
                        <td>
                            <div class="progress progress-striped active">
                              <div class="progress-bar progress-bar"  role="progressbar" style="width: 87%">
                                87%
                              </div>
                            </div>
                        </td>
                        <td>
                            <div class="progress progress-striped active">
                              <div class="progress-bar progress-bar-success"  role="progressbar" style="width: 12%">
                                12%
                              </div>
                            </div>
                        </td>
                    </tr>
                    
                    <tr class="danger">
                        <td>Server Three</td>
                        <td>192.168.0.183</td>
                        <td>Local</td>
                        <td>Down</td>
                        <td>Down</td>
                        <td>
                            <div class="progress progress-striped active">
                              <div class="progress-bar progress-bar"  role="progressbar" style="width: 100%">
                                Down
                              </div>
                            </div>
                        </td>
                        <td>
                            <div class="progress progress-striped active">
                              <div class="progress-bar progress-bar"  role="progressbar" style="width: 100%">
                                Down
                              </div>
                            </div>
                        </td>
                    </tr>
                    
                    <tr class="success">
                        <td>Server Four</td>
                        <td>192.168.0.192</td>
                        <td>Digital Ocean</td>
                        <td>1y, 321d, 22h</td>
                        <td>2.00, 1.96, 1.93</td>
                        <td>
                            <div class="progress progress-striped active">
                              <div class="progress-bar progress-bar-success"  role="progressbar" style="width: 30%">
                                30%
                              </div>
                            </div>
                        </td>
                        <td>
                            <div class="progress progress-striped active">
                              <div class="progress-bar progress-bar"  role="progressbar" style="width: 45%">
                                45%
                              </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
  </body>
</html>
