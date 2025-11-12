<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --text-color: #333;
            --background-color: #ecf0f1;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        h1, h2 {
            color: var(--primary-color);
            margin-bottom: 30px;
            text-align: center;
            position: relative;
        }

        h1::after, h2::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background-color: var(--secondary-color);
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        p {
            margin-bottom: 25px;
            font-size: 1.1em;
            color: #555;
            text-align: justify;
        }

        .container {
            width: 85%;
            max-width: 1200px;
            margin: 40px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        h2 {
            margin-top: 40px;
            font-size: 1.8em;
        }

        h1 {
            font-size: 2.5em;
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 20px;
                margin: 20px auto;
            }

            h1 {
                font-size: 2em;
            }

            h2 {
                font-size: 1.5em;
            }

            p {
                font-size: 1em;
            }
        }

        @media (max-width: 480px) {
            .container {
                width: 100%;
                border-radius: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>About Us</h1>
        <p>Our mission is to provide a wide range of vehicles to our customers at competitive prices, ensuring a hassle-free rental experience. 
        We strive to build long-term relationships with our customers by offering personalized services and ensuring their satisfaction.</p>
        <p>Over the years, we have expanded our fleet to cater to diverse customer needs, from economy to luxury vehicles. 
        Our team is dedicated to maintaining the highest standards of quality, ensuring that every vehicle is thoroughly inspected and serviced before each rental.</p>
        <p>We believe in making car rental easy, convenient, and affordable for everyone. Whether you're looking for a car for a day or a week,
         we have the perfect vehicle for you. Explore our fleet and experience the difference with us.</p>
        <h2>About the Owner - Omkar Chavan</h2>
        <p>Our company was founded by Omkar, a passionate entrepreneur with a vision to revolutionize the car rental industry. 
        With a strong background in business management and a keen eye for innovation, Omkar has been instrumental in shaping the company's growth and success.</p>
        <p>Under Omkar's leadership, our company has experienced rapid growth, expanding its fleet to cater to a diverse range of customers. 
        His commitment to quality and customer satisfaction has earned us a reputation as one of the most reliable car rental services in the region.</p>
        <h2>Company Growth</h2>
        <p>Since our inception, we have experienced steady growth, driven by our commitment to excellence and customer satisfaction. Our fleet has grown to include a wide range of vehicles,
         from economy to luxury cars, ensuring that we have something for every customer.</p>
        <p>We have also expanded our services to cater to a broader customer base, offering personalized solutions for individuals, families, and corporate clients. 
        Our team has grown to include experienced professionals dedicated to ensuring a seamless rental experience.</p>
        <p>As we continue to grow, we remain committed to our core values of quality, customer satisfaction, and innovation.
             We look forward to serving you and helping you experience the best in car rental services.</p>
    </div>
</body>
</html>