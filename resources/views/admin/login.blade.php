<!DOCTYPE html>
  <html lang="es">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Iniciar sesión</title>
      <link href="{{asset('favicon.ico')}}" rel="shortcut icon" type="image/x-icon" />
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css"></script>
      <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
      <style>
      @import url("https://fonts.googleapis.com/css?family=Roboto");
      body
      {
          font-family:"Roboto", sans-serif;
          background: linear-gradient(to right, #667db6, #0082c8, #0082c8, #667db6);
          background-size:cover;
      }
      .main-section
      {
          margin:0 auto;
          margin-top:130px;
          padding:0;
      }
      .modal-content
      {
          background-color:#3b4652;
          opacity:.95;
          padding:0 18px;
          box-shadow:0px 0px 3px #848484;
      }
      .user-img
      {
          margin-top:-50px;
          margin-bottom:35px;
      }
      .user-img img
      {
          height:100px;
          width:100px;
          border-radius:5px;       
      }
      .form-group
      {
          margin-bottom: 25px;
      }
      .form-group input
      {
          height:42px;
          border-radius:5px;
          border:0;
          font-size:18px;
          padding-left:45px;
      }
      .form-group::before
      {
          font-family:"Font Awesome\ 5 Free";
          content:"\f007";
          position:absolute;
          font-size:22px;
          color:#555e60;
          left:28px;
          padding-top:4px;
      }
      .form-group:last-of-type::before
      {
          content:"\f023";
      }
      button
      {
          width:40%;
          margin:5px 0 25px;
      }
      .btn{
          background-color:#27c2a5;
          color:#fff;
          font-size:19px;
          padding:7px 14px;
          border-radius:5px;
          border-bottom:4px solid #219882;
      }
      .btn:hover, .btn:focus
      {
          background-color:#25a890!important;
          border-bottom:4px solid #25a890!important;        
      }
      .svg-inline--fa
      {
          font-size:20px;
          margin-right:7px;
      }
      .forgot
      {
          padding:5px 0 25px;
      }
      .forgot a
      {
          color:#c2fbfe;
      }

      .box-msg{
          width:285px;
          height:70px;
          background:#ffffff;
          border:2px solid #ffffff;
          border-radius: 5px;
          box-shadow:0 0 0 3px rgb(251, 208, 1);
          padding:10px;
          box-sizing: border-box;
          color:#444444;
          display: block;    
          font-family:arial;
          font-weight:bold;
          margin-bottom:20px;
          display:none;
      }

      </style>
      <script>

          function OpenMsg(msg)
          {   
              $("#bMsg").html(msg);   
              $("#bMsg").fadeIn();       
              setTimeout("CloseMsg()",4000);
          }
          function CloseMsg()
          {  
              $("#bMsg").fadeOut(80);     
              $("#bMsg").html("");                      
          }

      </script>
  </head>
  <body>
      

      <div class="modal-dialog text-center">
          <div class="col-sm-8 main-section">
              <div class="modal-content">

                  <div class="col-12 user-img">
                      <img src="{{asset('img/tienda-online.png')}}" width="100" height="100">
                  </div>
                  <h4 class="col-12 text-white mt-n1">Iniciar Sesión</h4><br>
                  <form class="col-12"  method="post" action="{{route('check')}}" enctype="multipart/form-data">
                    @csrf
                      <div class="form-group">
                          <input type="text" name="user" class="form-control" placeholder="Ingresa el Usuario" required>
                      </div>

                      <div class="form-group">
                          <input type="password" name="pass" class="form-control" placeholder="Ingresa tu Contraseña" required>
                      </div>
                      <button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i>Login</button>
                  </form>                  
                  <center><div class="col-12 box-msg" id="bMsg"></div></center>

              </div>
          </div>
      </div>
      {!! $notif_script !!}
  </body>
  </html>