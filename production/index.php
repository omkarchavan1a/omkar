<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <style>
        /* ... existing styles ... */
        .menu-bar {
            background-color: #343a40;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .menu-bar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu-bar .logo {
            margin-right: 20px;
        }

        .menu-bar .logo img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .menu-bar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: nowrap;
            overflow-x: auto;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .menu-bar ul::-webkit-scrollbar {
            display: none;
        }

        .menu-bar ul li {
            white-space: nowrap;
        }

        .menu-bar ul li a {
            color: #fff;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .menu-bar ul li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .user-info {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 8px 12px;
            border-radius: 4px;
            margin-right: 10px;
        }

        .menu-bar .btn-logout {
            background-color: #dc3545;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .menu-bar .btn-logout:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {
            .menu-bar .container {
                flex-direction: column;
                text-align: center;
            }

            .menu-bar .logo {
                margin-bottom: 15px;
            }

            .menu-bar ul {
                flex-direction: column;
            }

            .menu-bar ul li {
                margin: 5px 0;
                width: 100%;
            }

            .menu-bar ul li a {
                display: block;
                padding: 10px;
            }
        }

        .swiper {
            width: 100%;
            height: 300px;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .swiper-button-next, .swiper-button-prev {
            color: #fff;
            background: rgba(0,0,0,0.5);
            padding: 25px;
            border-radius: 50%;
            width: 20px;
            height: 20px;
        }
        
        .swiper-pagination-bullet {
            background: #fff;
            opacity: 0.7;
        }
        
        .swiper-pagination-bullet-active {
            background: #007bff;
            opacity: 1;
        }

        .swiper-slide:hover img {
        transform: scale(1.1);
    }

    /* Modal styles */
    .image-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        cursor: zoom-out;
    }
    .modal-content {
        margin: auto;
        display: block;
        width: 90%;
        max-width: 1200px;
        max-height: 90vh;
        position: relative;
        top: 50%;
        transform: translateY(-50%);
    }

    .modal-content img {
        width: 100%;
        height: auto;
        object-fit: contain;
    }

    .close-modal {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
        z-index: 10000;
    }
     /* Animation for modal */
     @keyframes zoomIn {
        from {transform: scale(0)}
        to {transform: scale(1)}
    }

    .modal-content {
        animation-name: zoomIn;
        animation-duration: 0.6s;
    }

    .close-modal:hover {
        color: #bbb;
    }
        
        .car-card {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 40px 0;
            margin-top: 50px;
        }
        .footer h3 {
            font-size: 20px;
            margin-bottom: 15px;
        }
        .footer p {
            margin-bottom: 8px;
        }
        .footer a {
            color: #007bff;
        }
    </style>
</head>
<body>
<nav class="menu-bar">
    <div class="container">
        <div class="logo">
            <a href="index.php">
                <img src="logo.png" alt="Logo">
            </a>
        </div>
        <ul>
        <?php if(isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]): ?>
                    <li><a href="return.php">Return</a></li>
                    <li><a href="dashboard.php">Dashboard</a></li>
                <?php endif; ?>
            <li><a href="index.php">Home</a></li>
            <li><a href="rent.php">Rent a Car</a></li>
            <?php if(isset($_SESSION["user"])): ?>
                <li><span class="user-info">Welcome, <?php echo $_SESSION["user_name"]; ?></span></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="logout.php" class="btn-logout">Logout</a></li>
            <?php else: ?>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
    <!-- ... navigation ... -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="car-card">
                        <div class="swiper swiperCorolla">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="https://imgd.aeplcdn.com/664x374/cw/ec/26588/Toyota-Corolla-Altis-Exterior-123819.jpg?wm=0&q=80" alt="Toyota Corolla Exterior">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://imgd.aeplcdn.com/664x374/cw/ec/26588/Toyota-Corolla-Altis-Interior-114992.jpg?wm=0&q=80" alt="Toyota Corolla Interior 1">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://imgd.aeplcdn.com/664x374/cw/ec/26588/Toyota-Corolla-Altis-Interior-123821.jpg?wm=0&q=80" alt="Toyota Corolla Interior 2">
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                        <h3>Toyota Corolla</h3>
                        <p>rent at Rs500/day</p>
                        <a href="rent.php?car_id=C001" class="btn btn-primary">Rent</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="car-card">
                        <div class="swiper swiperAccord">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="https://imgd.aeplcdn.com/664x374/cw/ec/21613/Honda-Accord-Right-Front-Three-Quarter-82683.jpg?v=201711021421&q=80" alt="Honda Accord">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://imgd.aeplcdn.com/664x374/cw/ec/21613/Honda-Accord-Interior-64770.jpg?v=201711021421&q=80" alt="Honda Accord Interior 1">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://imgd.aeplcdn.com/370x208/cw/ec/25411/Honda-Accord-Interior-82027.jpg?v=201711021421&wm=1&q=80" alt="Honda Accord Interior 2">
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                        <h3>Honda Accord</h3>
                        <p>rent at Rs600/day</p>
                        <a href="rent.php?car_id=C002" class="btn btn-primary">Rent</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="car-card">
                        <div class="swiper swiperElantra">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/41138/elantra-exterior-right-front-three-quarter-3.jpeg?q=80" alt="Hyundai Elantra">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/41138/elantra-interior-dashboard.jpeg?q=80" alt="Hyundai Elantra Interior">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/41138/elantra-exterior-left-side-view.jpeg?q=80" alt="Hyundai Elantra Side">
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                        <h3>Hyundai Elantra</h3>
                        <p>rent at Rs700/day</p>
                        <a href="rent.php?car_id=C003" class="btn btn-primary">Rent</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="car-card">
                        <div class="swiper swiperCorolla">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/39015/punch-exterior-right-front-three-quarter-55.jpeg?isig=0&q=80" alt="Toyota Corolla Exterior">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/39015/punch-exterior-right-side-view.jpeg?isig=0&q=80" alt="Toyota Corolla Interior 1">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/39015/punch-exterior-right-rear-three-quarter.jpeg?isig=0&q=80" alt="Toyota Corolla Interior 2">
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                        <h3>Tata Punch</h3>
                        <p>rent at Rs800/day</p>
                        <a href="rent.php?car_id=C004" class="btn btn-primary">Rent</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="car-card">
                        <div class="swiper swiperAccord">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/139139/harrier-facelift-exterior-right-front-three-quarter-5.jpeg?isig=0&q=80" alt="Honda Accord">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/139139/harrier-facelift-exterior-right-rear-three-quarter-12.jpeg?isig=0&q=80" alt="Honda Accord Interior 1">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/139139/harrier-facelift-exterior-rear-view-10.jpeg?isig=0&q=80" alt="Honda Accord Interior 2">
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                        <h3>tata Harrier</h3>
                        <p>rent at Rs1000/day</p>
                        <a href="rent.php?car_id=C005" class="btn btn-primary">Rent</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="car-card">
                        <div class="swiper swiperElantra">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/138895/safari-facelift-exterior-right-front-three-quarter-39.jpeg?isig=0&q=80" alt="Hyundai Elantra">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/138895/safari-facelift-exterior-rear-view-7.jpeg?isig=0&q=80" alt="Hyundai Elantra Interior">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://imgd.aeplcdn.com/664x374/n/cw/ec/138895/safari-facelift-exterior-right-front-three-quarter-4.jpeg?isig=0&q=80" alt="Hyundai Elantra Side">
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                        <h3>Tata Safari</h3>
                        <p>rent at Rs1100/day</p>
                        <a href="rent.php?car_id=C006" class="btn btn-primary">Rent</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="imageModal" class="image-modal">
    <span class="close-modal">&times;</span>
    <div class="modal-content">
        <img id="modalImage" src="" alt="Full size image">
    </div>
</div>
<script>
    // Add this after your existing scripts
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        const closeBtn = document.querySelector('.close-modal');
        
        // Get all swiper slide images
        const images = document.querySelectorAll('.swiper-slide img');
        
        images.forEach(img => {
            img.addEventListener('click', function() {
                modal.style.display = "block";
                modalImg.src = this.src;
            });
        });
        
        // Close modal when clicking close button
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }
        
        // Close modal when clicking outside the image
        modal.onclick = function(e) {
            if (e.target === modal) {
                modal.style.display = "none";
            }
        }
        
        // Close modal with escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") {
                modal.style.display = "none";
            }
        });
    });
</script>
    <!-- ... footer ... -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Contact Information</h3>
                    <p>Address: At Post Gondavale BK</p>
                    <p>415540, District Satara, India</p>
                    <p>Phone: 909-651-8451</p>
                    <p>Email: <a href="mailto:omkarchavan1500@gmail.com">omkarchavan1500@gmail.com</a></p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const swiperOptions = {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        };

        new Swiper('.swiperCorolla', swiperOptions);
        new Swiper('.swiperAccord', swiperOptions);
        new Swiper('.swiperElantra', swiperOptions);
    </script>
</body>
</html>