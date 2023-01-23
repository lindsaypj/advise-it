<?php
// Requires the following variables be declared in F3
// @token: unique identifier for a student and their plan
// @lastUpdated: String representing the time the plan was last saved
// @formSubmitted: Boolean indicating whether the user submitted the form
// @saveSuccess: Boolean indicating whether the data was successfully stored in the database

// Display data (if found)
// @fall, @winter, @spring, @summer, @advisor
?>

<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Styles -->
    <link rel="stylesheet" href="/485/advise-it/styles/plan.css">

    <title>Advise-IT {{ @token }} Plan</title>
</head>
<body>
    <!-- Token -->
    <h1 class="text-center mt-3">Token: {{ @token }}</h1>

    <!-- Unique URL with token -->
    <div class="d-block align-middle text-center rounded token-url">
        <div class="input-group mb-3 shadow-sm rounded">
            <input
                type="text"
                class="form-control bg-white border-none"
                aria-label="Current plan link"
                aria-describedby="copy-url"
                value="https://plindsay.greenriverdev.com/485/advise-it/view-plan/{{ @token }}"
                disabled
                aria-disabled="true"
            >

            <button class="btn btn-light border-none" type="button" id="copy-url">
                <svg fill="#000000" height="16" width="16" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     viewBox="0 0 330 330" xml:space="preserve">
                    <g>
                        <path d="M35,270h45v45c0,8.284,6.716,15,15,15h200c8.284,0,15-6.716,15-15V75c0-8.284-6.716-15-15-15h-45V15
                            c0-8.284-6.716-15-15-15H35c-8.284,0-15,6.716-15,15v240C20,263.284,26.716,270,35,270z M280,300H110V90h170V300z M50,30h170v30H95
                            c-8.284,0-15,6.716-15,15v165H50V30z"/>
                        <path d="M155,120c-8.284,0-15,6.716-15,15s6.716,15,15,15h80c8.284,0,15-6.716,15-15s-6.716-15-15-15H155z"/>
                        <path d="M235,180h-80c-8.284,0-15,6.716-15,15s6.716,15,15,15h80c8.284,0,15-6.716,15-15S243.284,180,235,180z"/>
                        <path d="M235,240h-80c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h80c8.284,0,15-6.716,15-15C250,246.716,243.284,240,235,240z
                            "/>
                    </g>
                </svg>
            </button>
        </div>
    </div> <!-- Token URL -->


        <!-- Advisor -->
        <div class="row pb-4">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center mx-auto">
                <div class="form-floating">
                    <input
                        type="text"
                        class="form-control border-none shadow-sm"
                        value="{{ @advisor }}"
                        name="advisor"
                        id="advisorInput"
                        placeholder="Advisor"
                    >
                    <label for="advisorInput">Advisor:</label>
                </div>
            </div>
        </div>

    <!-- Plan -->
    <div class="row">
        <!-- FALL -->
        <div class="col-md-6 col-12 pb-4">
            <div class="form-floating">
                <textarea
                    class="form-control quarter-area shadow-sm border-none"
                    placeholder="Leave a comment here"
                    name="fall"
                    id="fall"
                >{{ @fall }}</textarea>

                <label for="fall">Fall:</label>
            </div>
        </div>

        <!-- WINTER -->
        <div class="col-md-6 col-12 pb-4">
            <div class="form-floating">
                <textarea
                    class="form-control quarter-area shadow-sm border-none"
                    placeholder="Leave a comment here"
                    name="winter"
                    id="winter"
                >{{ @winter }}</textarea>
                <label for="winter">Winter:</label>
            </div>
        </div>

        <!-- SPRING -->
        <div class="col-md-6 col-12 pb-4">
            <div class="form-floating">
                <textarea
                    class="form-control quarter-area shadow-sm border-none"
                    placeholder="Leave a comment here"
                    name="spring"
                    id="spring"
                >{{ @spring }}</textarea>
                <label for="spring">Spring:</label>
            </div>
        </div>

        <!-- SUMMER -->
        <div class="col-md-6 col-12 pb-4">
            <div class="form-floating">
                <textarea
                    class="form-control quarter-area shadow-sm border-none"
                    placeholder="Leave a comment here"
                    name="summer"
                    id="summer"
                >{{ @summer }}</textarea>
                <label for="summer">Summer:</label>
            </div>
        </div>

        <!-- Last Updated -->
        <div class="col-12">
            <h4 class="text-center mb-3">
                <check if="{{ @lastUpdated != null }}">
                    Last Updated: {{ @lastUpdated }}
                </check>
            </h4>
        </div>
    </div> <!-- Plan Row -->

    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

</body>
</html>
