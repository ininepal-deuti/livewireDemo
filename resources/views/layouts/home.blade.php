<!DOCTYPE html>
<html>
<head>
    <title>W3.CSS Template</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=be__VFAPfGeJTEbYR9OMF6M0qS5tqtmsvjy6Na3jKiAgKc0MFRCEAnhh78ALVNrs1ItdAcsJ-VG2CuyxPxSrvx9z66p2JXxPudHFPMSUn5ZVh6JvPUbtn45FhpEpA86g" charset="UTF-8"></script><style>
        body,h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
        .w3-bar-block .w3-bar-item {padding:20px}
    </style>
</head>
<body>

<!-- Sidebar (hidden by default) -->
<x-nav-menu />

<!-- Top menu -->
<x-header/>

<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">

    <!-- First Photo Grid-->
    <div class="w3-row-padding w3-padding-16 w3-center" id="food">
        @foreach($all_post->take(4) as $post)
            <?php
                $title = $post->title;
                $details = $post->body;
                $image = $post->photo;
            ?>
            <x-item-box :title="$title" :details="$details" :image="$image"/>
        @endforeach
    </div>

    <!-- Second Photo Grid-->
    <div class="w3-row-padding w3-padding-16 w3-center">
        @foreach($all_post->random(4) as $post)
                <?php
                $title = $post->title;
                $details = $post->body;
                $image = $post->photo;
                ?>
            <x-item-box :title="$title" :details="$details" :image="$image"/>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="w3-center w3-padding-32">
        <div class="w3-bar">
            <a href="#" class="w3-bar-item w3-button w3-hover-black">&laquo;</a>
            <a href="#" class="w3-bar-item w3-black w3-button">1</a>
            <a href="#" class="w3-bar-item w3-button w3-hover-black">2</a>
            <a href="#" class="w3-bar-item w3-button w3-hover-black">3</a>
            <a href="#" class="w3-bar-item w3-button w3-hover-black">4</a>
            <a href="#" class="w3-bar-item w3-button w3-hover-black">&raquo;</a>
        </div>
    </div>

    <hr id="about">

    <!-- About Section -->
    <div class="w3-container w3-padding-32 w3-center">
        <h3>About Me, The Food Man</h3><br>
        <img src="{{ asset('images/chef.jpg') }}" alt="Me" class="w3-image" style="display:block;margin:auto" width="800" height="533">
        <div class="w3-padding-32">
            <h4><b>I am Who I Am!</b></h4>
            <h6><i>With Passion For Real, Good Food</i></h6>
            <p>Just me, myself and I, exploring the universe of unknownment. I have a heart of love and an interest of lorem ipsum and mauris neque quam blog. I want to share my world with you. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
        </div>
    </div>
    <hr>

    <!-- Footer -->
    <x-footer/>
    <!-- End page content -->
</div>

<script>
    // Script to open and close sidebar
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
    }
</script>

</body>
</html>
