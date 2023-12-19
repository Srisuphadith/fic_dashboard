<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>


        #footer {
            display: none;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #FBFAF8;
            padding: 16px 0;
            background-color: #0A122A;
            color: #FBFAF8;
            display: flex;
            width: 100%;
            justify-content: space-around;
            position: fixed;
            bottom: 0;
            transition: transform 0.5s ease-in-out;
            transform: translateY(100%);
        }

        .head {
            font-size: 16px;
            color: #FBFAF8;
        }

        .footerContent {
            font-size: 12px;
            color: #FBFAF8;
        }
    </style>
</head>
<body>
    <div id="footer">
        <div class="footerCol">
            <h2 class="head">this is footer1</h2>
            <div class="footerContent">
                footer1
            </div>
        </div>
        <div class="footerCol">
            <h2 class="head">this is footer2</h2>
            <div class="footerContent">
                footer2
            </div>
        </div>
        <div class="footerCol">
            <h2 class="head">this is footer3</h2>
            <div class="footerContent">
                footer3
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('scroll', function() {
            var footer = document.getElementById('footer');
            var scrollY = window.scrollY || window.pageYOffset || document.documentElement.scrollTop;

            if (scrollY > (document.body.scrollHeight - window.innerHeight - 50)) {
                footer.style.transform = 'translateY(0)';
            } else {
                footer.style.transform = 'translateY(100%)';
            }
        });
    </script>
</body>
</html>
