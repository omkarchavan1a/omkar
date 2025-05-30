<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    body {
        display: flex;
        padding: 0 10px;
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .menu {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: space-around;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    ul {
        list-style: none;
        display: flex;
        margin: 0;
        padding: 0;
    }

    ul li {
        margin-left: 30px;
        font-size: 16px;
    }

    ul li a {
        text-decoration: none;
        color: #ffffff;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
    }

    ul li a:after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -5px;
        left: 0;
        background-color: #fff;
        transition: width 0.3s ease;
    }

    ul li a:hover:after {
        width: 100%;
    }

    ::selection {
        color: #fff;
        background: #764ba2;
    }

    .wrapper {
        width: 715px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
        transition: transform 0.3s ease;
    }

    .wrapper:hover {
        transform: translateY(-5px);
    }

    .wrapper header {
        font-size: 28px;
        font-weight: 600;
        padding: 30px 30px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        color: #1a1a1a;
        text-align: center;
    }

    .wrapper form {
        margin: 35px 30px;
    }

    .wrapper form.disabled {
        pointer-events: none;
        opacity: 0.7;
    }

    form .dbl-field {
        display: flex;
        margin-bottom: 25px;
        justify-content: space-between;
    }

    .dbl-field .field {
        height: 50px;
        display: flex;
        position: relative;
        width: calc(50% - 13px);
    }

    .wrapper form i {
        position: absolute;
        top: 50%;
        left: 18px;
        color: #764ba2;
        font-size: 17px;
        pointer-events: none;
        transform: translateY(-50%);
        transition: all 0.3s ease;
    }

    form .field input,
    form .message textarea {
        width: 100%;
        height: 100%;
        outline: none;
        padding: 0 18px 0 48px;
        font-size: 16px;
        border-radius: 10px;
        border: 2px solid #e6e6e6;
        transition: all 0.3s ease;
    }

    .field input::placeholder,
    .message textarea::placeholder {
        color: #999;
    }

    .field input:focus,
    .message textarea:focus {
        border-color: #764ba2;
        box-shadow: 0 0 10px rgba(118, 75, 162, 0.2);
    }

    .field input:focus ~ i,
    .message textarea:focus ~ i {
        color: #764ba2;
    }

    form .message {
        position: relative;
    }

    form .message i {
        top: 30px;
        font-size: 20px;
    }

    form .message textarea {
        min-height: 130px;
        max-height: 230px;
        max-width: 90%;
        min-width: 95%;
        padding: 15px 20px;
        border-radius: 10px;
    }

    form .message textarea::-webkit-scrollbar {
        width: 5px;
        background: #f1f1f1;
    }

    form .message textarea::-webkit-scrollbar-thumb {
        background: #764ba2;
        border-radius: 5px;
    }

    .button-area {
        margin: 25px 0;
        display: flex;
        align-items: center;
    }

    .button-area button {
        color: #fff;
        border: none;
        outline: none;
        font-size: 18px;
        cursor: pointer;
        border-radius: 10px;
        padding: 13px 25px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transition: all 0.3s ease;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    .button-area button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(118, 75, 162, 0.4);
    }

    .button-area span {
        font-size: 17px;
        margin-left: 30px;
        display: none;
    }

    @media (max-width: 600px) {
        .wrapper {
            width: 100%;
            margin: 20px;
        }

        .wrapper header {
            font-size: 24px;
            padding: 20px;
        }

        .wrapper form {
            margin: 20px;
        }

        form .dbl-field {
            flex-direction: column;
            margin-bottom: 0px;
        }

        form .dbl-field .field {
            width: 100%;
            height: 45px;
            margin-bottom: 20px;
        }

        form .message textarea {
            resize: none;
        }

        form .button-area {
            margin-top: 20px;
            flex-direction: column;
        }

        .button-area button {
            width: 100%;
            padding: 11px 0;
            font-size: 16px;
        }

        .button-area span {
            margin: 20px 0 0;
            text-align: center;
        }
    }
    </style>
</head>
<body>
  <div class="wrapper">
    <header>Send us a Message</header>
    <form method="post" action="sent.php">
      <div class="dbl-field">
        <div class="field">
          <input type="text" name="name" placeholder="Enter your name">
          <i class='fas fa-user'></i>
        </div>
        <div class="field">
          <input type="text" name="email" placeholder="Enter your email">
          <i class='fas fa-envelope'></i>
        </div>
      </div>
      <div class="dbl-field">
        <div class="field">
          <input type="text" name="phone" placeholder="Enter your phone">
          <i class='fas fa-phone-alt'></i>
        </div>
        <div class="field">
          <input type="text" name="website" placeholder="Enter your website">
          <i class='fas fa-globe'></i>
        </div>
      </div>
      <div class="message">
        <textarea placeholder="Write your message" name="message"></textarea>
        <i class="material-icons"></i>
      </div>
      <div class="button-area">
        <button type="submit">Send Message</button>
        <span></span>
      </div>
    </form>
  </div>
</body>
</html>