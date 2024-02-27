<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Vui lòng chờ</title>
    <meta name="description">
    <meta name="author">
    <style>
    /* http://stackoverflow.com/a/18490463/2110294 */
    .fullscreenLoader {
        max-width: 100%;
        max-height: 100%;
        bottom: 0;
        left: 0;
        margin: auto;
        overflow: auto;
        position: fixed;
        right: 0;
        top: 0;
    }

    /* http://stackoverflow.com/a/27614179/2110294 */
    .fullscreenDiv {
        position: fixed;
        /* or absolute */
        top: 60%;
        left: 50%;
        /* bring your own prefixes */
        transform: translate(-50%, -50%);
        /* not required for centering div */
        text-align: center;
    }
    </style>
</head>

<body>
    <div id="myPage">
        <!-- LOADER -->
        <img src="./assets/images/loading.gif" class="fullscreenLoader" v-show="loading" />
        <!-- CONTENT -->
        <div v-show="!loading" class="fullscreenDiv" style="display: flex;">
            <h1>Vui lòng chờ trong giây lát</h1>
        </div>
    </div>
    <!-- SCRIPTS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.3/vue.js"></script> -->
</body>

</html>