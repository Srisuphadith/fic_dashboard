<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Navbar container */
.navbarTop {
    overflow: hidden;
    background-color: #698F3F;
    font-family: Arial;
    padding: 0px 0px 8x 0px;
}


  /* Links inside the navbar */
.navbarTop a {
    float: left;
    font-size: 16px;
    color: #FBFAF8;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.navbarTop p {
    float: left;
    font-size: 16px;
    color: #FBFAF8;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    margin: 0px;
}

  /* The dropdown container */
.dropdownTop {
    float: right;
    overflow: hidden;
    padding-right: 0px;
}

  /* Dropdown button */
.dropdownTop .dropbtnTop {
    font-size: 16px;
    border: none;
    outline: none;
    color: #FBFAF8;
    padding: 14px 16px ;
    /* border: solid red; */
    background-color: inherit;
    font-family: inherit; /* Important for vertical align on mobile phones */
    margin: 0; /* Important for vertical align on mobile phones */
}

  /* Add a red background color to navbar links on hover */
.navbarTop a:hover, .dropdownTop:hover .dropbtnTop {
    background-color: #0A122A;
}

  /* Dropdown content (hidden by default) */
.dropdown-contentTop {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: fit-content;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

  /* Links inside the dropdown */
.dropdown-contentTop a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

  /* Add a grey background color to dropdown links on hover */
.dropdown-contentTop a:hover {
    background-color: #ddd;
}

  /* Show the dropdown menu on hover */
.dropdownTop:hover .dropdown-contentTop {
    display: block;
}

.dropdown-contentTop {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: fit-content;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        right: 0; /* Aligning dropdown to the right */
    }

    .navPages{
        margin: 0;
    }
    </style>

</head>


<body class="navPages">

<div class="navbarTop">
    <p id="greetingTop" class="greetingTop"></p>
    <div class="dropdownTop">
        <button class="dropbtnTop">
            <i class="fas fa-bars"></i>
        </button>
        <div class="dropdown-contentTop">
            <a href="account.php">Account Details</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</div>

<script>
    // Get the current hour
    const currentHour = new Date().getHours();

    // Define the greeting based on the time of day
    let greeting = "";
    if (currentHour >= 5 && currentHour < 12) {
        greeting = "Good morning";
    } else if (currentHour >= 12 && currentHour < 18) {
        greeting = "Good afternoon";
    } else {
        greeting = "Good evening";
    }

    // Update the greeting text
    document.getElementById("greetingTop").textContent = `Hello <?php echo $_SESSION['name']; ?> ${greeting}`;
</script>

</body>
</html>
