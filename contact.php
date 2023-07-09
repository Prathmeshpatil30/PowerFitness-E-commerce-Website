<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1">
    <title>Contact Form</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <style>
        html,
        body,
        div,
        input,
        span,
        a,
        select,
        textarea,
        option,
        h1,
        h2,
        h3,
        h4,
        main,
        aside,
        article,
        section,
        header,
        p,
        footer,
        nav,
        pre {
            box-sizing: border-box;
            font-family: Tahoma, Geneva, sans-serif;
        }

        html {
            background-color: #F8F9F9;
            padding: 30px;
        }

        input,
        textarea,
        p {
            outline: 0;
        }

        h1 {
            margin: 0;
            padding: 20px;
            font-size: 22px;
            text-align: center;
            border-bottom: 1px solid #eceff2;
            color: #6a737f;
            font-weight: 600;
        }

        .contact {
            background-color: #fff;
            width: 500px;
            margin: 0 auto;
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, .2);
        }

        .contact .fields {
            position: relative;
            padding: 15px;
        }

        .contact input[type="text"],
        .contact input[type="email"] {
            display: block;
            margin-top: 15px;
            padding: 15px;
            border: 1px solid #dfe0e0;
            width: 100%;
        }

        .contact input[type="text"]:focus,
        .contact input[type="email"]:focus {
            border: 1px solid #c6c7c7;
        }

        .contact input[type="text"]::placeholder,
        .contact input[type="email"]::placeholder,
        .contact textarea::placeholder {
            color: #858688;
        }

        .contact textarea {
            resize: none;
            margin-top: 15px;
            padding: 15px;
            border: 1px solid #dfe0e0;
            width: 100%;
            height: 150px;
        }

        .contact textarea:focus {
            border: 1px solid #c6c7c7;
        }

        .contact input[type="submit"] {
            display: block;
            margin-top: 15px;
            padding: 15px;
            border: 0;
            background-color: #518acb;
            font-weight: bold;
            color: #fff;
            cursor: pointer;
            width: 100%;
        }

        .contact input[type="submit"]:hover {
            background-color: #3670b3;
        }

        .contact input[name="email"] {
            position: relative;
            display: block;
        }

        .contact label {
            position: relative;

        }

        .contact label i {
            position: absolute;
            color: #dfe2e5;
            top: 31px;
            left: 15px;
            z-index: 10;
        }

        .contact label i~input {
            padding-left: 45px !important;
        }

        .contact .responses {
            padding: 15px;
            margin: 0;
        }
    </style>
</head>

<body>
    <form class="contact" method="post" action="contact_db.php">
        <h1>Contact Form</h1>
        <div class="fields">
            <label for="email">
                <i class="fas fa-envelope"></i>
                <input id="email" type="email" name="email" placeholder="Your Email" required>
            </label>
            <label for="name">
                <i class="fas fa-user"></i>
                <input type="text" name="name" placeholder="Your Name" required>
                <label>
                    <input type="text" name="subject" placeholder="Subject" required>
                    <textarea name="msg" placeholder="Message" required></textarea>
        </div>
        <input type="submit">
    </form>
</body>

</html>