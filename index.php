<!DOCTYPE html>
<html lang="en">
<head>
    <title>CAPP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <h1 class="jumbotron " style="text-align: center">COMPUTER AIDED PROCESS PLANNING</h1>
<div class="container">
    <form class="row" name="form" method="POST" action="retrievalEngine.php" >
        <div class="form-group col-xs-8 pull-right">
            <label  class="col-sm-2 col-form-label col-form-label-lg" >CODE:</label>
            <div class="col-sm-2">
                <input  id="code" name="code" type="text" class="form-control form-control-lg"  placeholder="code" required autofocus>
            </div>
        </div>
        <div class="form-group col-xs-8 pull-right">
            <label class="col-sm-2 col-form-label col-form-label-sm" >Maximum no. to retrive :</label>
            <div class="col-sm-2">
                <input  id="no" name="no" type="text" class="form-control form-control-lg" placeholder="" required>
            </div>
        </div>
        <div class="form-group col-xs-6 pull-right">
            <button type="submit" onclick="validate()" class="btn btn-primary">Search</button>
        </div>
    </form>
</div>
  <div id="responsecontainer" class="container"  style="width:800px;align-items: center">
  </div>
  <script>

            $("document").ready(function () {
                  $("form").submit(function () {
                      var code = $("#code").val();
                      var no = $("#no").val();

                      $.ajax({
                          url: "retrievalEngine.php",
                          type: "POST",
                          data: {code: code, no: no},
                          success: function (response) {
                              $("#responsecontainer").html(response);
                              console.log(response);
                          }
                      });
                      return false;
                  });
              });

  </script>


</body>

</html>

