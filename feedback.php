<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
    <body>
        <div id="feedback_form">
            <h1>Leave Feedback</h1>
            Name</br>
            <input id="fname" type="text" name="name"/></br>
            Email</br>
            <input id="femail" type="email" name="email"/></br>
            Comments</br>
            <textarea id="fcomments" rows="10" cols="30" name="comments"></textarea></br>
            <input  id="fsubmit" type="image" src="images/button_submit.png"/>
        </div>
            <script>
            //Posts form data to feedback_submit.php with variables fname, femail, and fcomments.
            $("#fsubmit").click(function(){
                $.post("feedback_submit.php", {name: $("#fname").val(), email: $("#femail").val(), comments: $("#fcomments").val()}, function(){
                    $("#feedback_form").replaceWith('<div><h1>Thank You!</h1></div>')
                });
            });
            </script>
    </body>
</html>