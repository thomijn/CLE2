<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS and Fontawesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link href="./css/all.css" rel="stylesheet">
    <!--load all styles -->
    <script defer src="./css/js/all.js"></script>
    <!--load all styles -->

    <!-- Datedropper -->
    <link href="./css/datedropper.css" rel="stylesheet" type="text/css" />
    <link href="./css/datedropperstyle.css" rel="stylesheet" type="text/css" />
    <script src="./css/jquery.js"></script>
    <script src="./css/datedropper.js"></script>



    <title>Fotografie Gertenbach</title>
</head>

<body>

    <div class="container">
        <section id="intake">

            <aside id="progress">
                <ul>
                    <li>Gegevens <i class="far fa-check fa-2x" style="color: 5AC345"></i> </li>
                    <li class="active">Datum</li>
                </ul>
            </aside>

            <section id="form">
                <h3> Plan hier een gesprek in <br> voor uw bruiloftsfotografie </h3>


                <form>
                    <h5> Kies een datum. </h5>
                    <div class="form-group">
                        <input type="text" data-format="d-m-Y" data-disabled-days="12/11/2018" data-lang="nl"
                            data-large-mode="true" data-modal="true" data-large-default="true" data-theme="datedropperstyle"
                            class="form-control" id="formGroupExampleInput">
                    </div>

                    <p>Jouw gekozen datum is: </p>

                    <button type="submit" class="btn btn-primary"><a href="intake.php">VOLGENDE</a></button>
                    <button type="submit" class="btn btn-secondary"><a href="intake.php">VORIGE</a></button>


                </form>

            </section>
        </section>
    </div>

    <script>
        $('input').dateDropper();
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

</body>




</html>