<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Chat App</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container-fluid ">
        <div class="row no-gutters">

            <div class="col-md-6 left d-flex justify-content-center align-items-center ">

                <div class="card col-8 bg-info border-0 d-flex justify-content-center align-items-center">

                    <div class="text-center mt-3 mb-5">
                        <h1 style="font-family:Uni Sans CAPS;" class="text-dark ">Sign In</h1>
                    </div>

                    <div class="mb-3 col-10">
                        <label style="font-family:Uni Sans CAPS;" class="form-lable text-light">Email</label>
                        <input class="form-control" id="e" type="email">
                    </div>

                    <div class="mb-3 col-10">
                        <label style="font-family:Uni Sans CAPS;" class="form-lable text-light">Password</label>
                        <input class="form-control" id="p" type="password">
                    </div>

                    <div class="mb-3 col-10">
                        <div class="row">
                            <div class="col-12 col-lg-6 d-grid">
                                <button style="font-family:Uni Sans CAPS;" onclick="signIn();" class="btn btn-dark">Sign In</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button style="font-family:Uni Sans CAPS;" class="btn btn-warning" >Signup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-none d-sm-block col-md-6 right d-flex justify-content-center align-items-center">

            </div>
            

        </div>


    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="script.js"></script>
</body>

</html>