
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Menu Online Grocery Store</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

</head>

    <body>
        <!-- Header START -->
        <header class="header">
            <a href="index.php" class="logo"> <i class="fas fa-shopping-basket"></i> Menu Online </a> 
            
            <nav class="navbar">
                <a href="#home">Trang chủ</a>
                <a href="#features"> Đặc sản </a>
                <a href="#products">Sản phẩm</a>
                <a href="#categories">Khuyến mãi</a>
                <a href="#review">Đánh giá</a>
                <a href="#blog">Bài viết</a>
            </nav>

            <div class="icons">
                <div class="fas fa-bars" id="menu-btn"></div>
                <div class="fas fa-search" id="search-btn"></div>
                <div class="fas fa-shopping-cart" id="cart-btn"></div>
                <div class="fas fa-user" id="login-btn"></div>
            </div>

            <form action="" class="search-form">
                <input type="search" id="search-box" placeholder="search here...">
                <label for="search-box" class="fas fa-search"></label>
            </form>
           
            <div class="shopping-cart">
                <div class="box">
                    <i class="fas fa-trash"></i>
                    <img src="/images/Fruit/thumb/apples.jpg" alt="">
                    <div class="content">
                        <h3>apple</h3>
                        <span class="price">$4.99/</span>
                        <span class="quantily">qty : 1</span>
                    </div>
                </div>
                <div class="box">
                    <i class="fas fa-trash"></i>
                    <img src="images/Fruit/thumb/banana.jpg" alt="">
                    <div class="content">
                        <h3>banana</h3>
                        <span class="price">$5.99/</span>
                        <span class="quantily">qty : 1</span>
                    </div>
                </div>
                <div class="box">
                    <i class="fas fa-trash"></i>
                    <img src="images/Fruit/thumb/dragon-fruit.jpg" alt="">
                    <div class="content">
                        <h3>dragon-fruit</h3>
                        <span class="price">$1.99/</span>
                        <span class="quantily">qty : 1</span>
                    </div>
                </div>
                <div class="total">total : $12.97</div>
                <a href="#" class="btn">check-out</a>
            </div>

            <form action="" class="login-form">
                <h3>login now</h3>
                <input type="email" placeholder="your email" class="box" id="email">
                <input type="password" placeholder="your password" class="box" id="password">
                <p>Quên password? <a href="#">Nhấn ở đây</a></p>
                <p>Chưa có tài khoản? <a href="#">Tạo mới</a></p>
                <!-- <button class="btn btn-primary" id="loginBtn">Đăng nhập</button> -->
                <input type="submit" value="login now" class="btn" id="loginBtn">  

                <script>
                    $(document).ready(function () {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $("#loginBtn").click(function (e) { 
                            e.preventDefault();
                            var username=$("#email").val().trim();
                            var password=$("#password").val().trim();
                            if(email==''||password==''){
                                alert("Thiếu email hoặc mật khẩu")
                            }else{
                                $.ajax({
                                    type: "POST",
                                    url: "/checkLogin",
                                    data: {
                                        username:email,
                                        password:password,
                                    },
                                    dataType: "JSON",
                                    success: function (res) {
                                        console.log(res);
                                    }
                                });
                            }
                        });
                    });
                </script>

            </form>

            

        </header>
        <!-- Header END-->

        <!--Trang chủ START -->
        <section class="home"  id="home">
            <div class="content">
                <h3>Tươi và  <span>Ngon</span> dành cho bạn</h3>
                <p>Sản phẩm sạch từ nông trại Xanh</p>
                <a href="#" class="btn">mua ngay</a>    
            </div>
        </section>
        <!--Trang chủ END -->

        <!--Đặc sản START-->
        <section class="features" id="features">
            <h1 class="heading"><span>Đặc Sản</span> MỚI </h1>
            <div class="box-container">
                    <div class="box">
                        <img src="/images/Fruit/strawberry.png" alt="">
                        <h3>dâu tây</h3>
                        <p>trái cây tươi được trồng tự nhiên tại vườn</p>
                        <a href="#" class="btn">Xem thêm</a>
                    </div>

                    <div class="box">
                        <img src="/images/Fruit/peaches.png" alt="">
                        <h3>Đào tiên</h3>
                        <p>trái cây tươi được trồng tự nhiên tại vườn</p>
                        <a href="#" class="btn">Xem thêm</a>
                    </div>

                    <div class="box">
                        <img src="/images/Fruit/dragon-fruit.png" alt="">
                        <h3>thanh long</h3>
                        <p>trái cây tươi được trồng tự nhiên tại vườn</p>
                        <a href="#" class="btn">Xem thêm</a>
                    </div>

            </div>
        </section>
        <!--Đặc sản END-->

       <!-- Sản phẩm START-->
        <section class="products" id="products">
            <h1 class="heading"><span> Sản phẩm </span>Tự nhiên</h1>
            <div class="swiper products-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide box">
                        <img src="/images/Fruit/apples.png" alt="">
                        <h3>Táo nhập khẩu</h3>
                        <div class="price">59.000/</div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <a href="#" class="btn">mua hàng</a>
                    </div>

                    <div class="swiper-slide box">
                        <img src="/images/Fruit/dragon-fruit.png" alt="">
                        <h3>Thanh long</h3>
                        <div class="price">39.000/</div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <a href="#" class="btn">mua hàng</a>
                    </div>

                    <div class="swiper-slide box">
                        <img src="/images/Fruit/peaches.png" alt="">
                        <h3>Đào tiên</h3>
                        <div class="price">49.000/</div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <a href="#" class="btn">mua hàng</a>
                    </div>

                    <div class="swiper-slide box">
                        <img src="/images/Fruit/banana.png" alt="">
                        <h3>Chuối già</h3>
                        <div class="price">29.000/</div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <a href="#" class="btn">mua hàng</a>
                    </div>
                </div>
            </div>

            
            <div class="swiper products-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide box">
                        <img src="/images/Fruit/kiwi.png" alt="">
                        <h3>Kiwi Úc</h3>
                        <div class="price">59.000/</div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <a href="#" class="btn">mua hàng</a>
                    </div>

                    <div class="swiper-slide box">
                        <img src="/images/Fruit/melon.png" alt="">
                        <h3>Dưa lưới</h3>
                        <div class="price">39.000/</div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <a href="#" class="btn">mua hàng</a>
                    </div>

                    <div class="swiper-slide box">
                        <img src="/images/Fruit/nutrition-exotic.png" alt="">
                        <h3>Sầu riêng</h3>
                        <div class="price">49.000/</div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <a href="#" class="btn">mua hàng</a>
                    </div>

                    <div class="swiper-slide box">
                        <img src="/images/Fruit/oranges.png" alt="">
                        <h3>Cam</h3>
                        <div class="price">29.000/</div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <a href="#" class="btn">mua hàng</a>
                    </div>
                </div>
            </div>
 


        </section>
        <!-- Sản phẩm START-->

        <!--Chủng Loại START-->
        <section class="categories" id="categories">
            <h1 class="heading"> Sản phẩm <span>KHUYẾN MÃI</span></h1>
            <div class="box-container">
                <div class="box">
                    <img src="/images/Fruit/nutrition-exotic.png" alt="">
                    <h3> Sầu riêng</h3>
                    <p>Giảm đến 49%</p>
                    <a href="#" class="btn"> Xem chi tiết</a>
                </div>

                <div class="box">
                    <img src="/images/Fruit/kiwi.png" alt="">
                    <h3> Kiwi</h3>
                    <p>Giảm đến 49%</p>
                    <a href="#" class="btn"> Xem chi tiết</a>
                </div>

                <div class="box">
                    <img src="/images/Fruit/banana.png" alt="">
                    <h3>chuối</h3>
                    <p>Giảm đến 49%</p>
                    <a href="#" class="btn"> Xem chi tiết</a>
                </div>

                <div class="box">
                    <img src="/images/Fruit/dragon-fruit.png" alt="">
                    <h3>thanh long</h3>
                    <p>Giảm đến 45%</p>
                    <a href="#" class="btn"> Xem chi tiết</a>
                </div>

                </div>
            </div>
        </section>
          <!--Chủng Loại END-->

          <!--ĐÁNH GIÁ Start-->
        <section class="review" id="review">
            <h1 class="heading"> Khách hàng <span>ĐÁNH GIÁ</span></h1>
            <div class="swiper review-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide box">
                        <img src="/images/talent/women-1.jpg" alt="">
                        <p>" Món thực vật ngon nhất tôi từng dùng ở Việt Nam. Không gian đẹp và món dùng thậm chí còn đẹp hơn."</p>
                        <h3>chị Hoa</h3>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>

                    <div class="swiper-slide box">
                        <img src="/images/talent/women-2.jpg" alt="">
                        <p>" Món dùng, dịch vụ thật tuyệt vời và phi thường! Đây là món thực vật ngon nhất tôi từng dùng qua!"</p>
                        <h3>chị Mai</h3>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>

                    <div class="swiper-slide box">
                        <img src="/images/talent/man.jpg" alt="">
                        <p>"Một số món dùng ngon nhất chúng tôi đã dùng tại Việt Nam! Hoàn toàn tuyệt vời, các loại rau củ, nhất định phải thử!"</p>
                        <h3>Anh Hoàng</h3>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>

                    <div class="swiper-slide box">
                        <img src="/images/talent/women-3.jpg" alt="">
                        <p>" Chúng tôi yêu thích bữa trưa thuần thực vật cùng rất nhiều sự chăm chút tỉ mỉ ở đây. Một phần thưởng xứng đáng cho mọi."</p>
                        <h3>chị Bông</h3>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>

                </div>

            </div>


        </section>
            <!--ĐÁNH GIÁ End-->

            <!--BÀI VIẾT Start-->
        <section class="blogs" id="blogs">
            <h1 class="heading"> our <span> blogs </span></h1>
            <div class="box-container">
                <div class="box">
                    <img src="/images/talent/bloger-girl-1.jpg" alt="">
                    <div class="content">
                        <div class="icon">
                            <a href="#"> <i class="fas fa-user"></i> by user</a>
                            <a href="#"> <i class="fas fa-calendar"></i> 11 jun 2023</a>
                        </div>
                        <h3>những sản phẩm nổi bậc của nông trại Xanh </h3>
                        <p>Tôi rất muốn giới thiệu nhà hàng Hum cho bất kỳ ai đang tìm kiếm những món ăn ngon,
                             thuần túy ẩm thực Việt Nam trong một thiết kế ấm cúng và hiếu khách.
                              Sự kết hợp giữa lối ẩm thực khác biệt, dịch vụ thân thiện và bầu không khí cuốn hút
                               khiến nơi đây trở thành điểm đến không thể bỏ qua cho bất kỳ tín đồ ẩm thực nào du lịch đến Tp.HCM.</p>
                        <a href="#" class="btn">Xem thêm</a>
                    </div>
                </div>

                <div class="box">
                    <img src="/images/talent/bloger-girl-2.jpg" alt="">
                    <div class="content">
                        <div class="icon">
                            <a href="#"> <i class="fas fa-user"></i> by user</a>
                            <a href="#"> <i class="fas fa-calendar"></i> 11 jun 2023</a>
                        </div>
                        <h3>cách sinh tồn nơi hoang dã</h3>
                        <p>Tôi rất muốn giới thiệu nhà hàng Hum cho bất kỳ ai đang tìm kiếm những món ăn ngon,
                             thuần túy ẩm thực Việt Nam trong một thiết kế ấm cúng và hiếu khách.
                              Sự kết hợp giữa lối ẩm thực khác biệt, dịch vụ thân thiện và bầu không khí cuốn hút
                               khiến nơi đây trở thành điểm đến không thể bỏ qua cho bất kỳ tín đồ ẩm thực nào du lịch đến Tp.HCM.</p>
                        <a href="#" class="btn">Xem thêm</a>
                    </div>
                </div>

                <div class="box">
                    <img src="/images/talent/bloger-girl-3.jpg" alt="">
                    <div class="content">
                        <div class="icon">
                            <a href="#"> <i class="fas fa-user"></i> by user</a>
                            <a href="#"> <i class="fas fa-calendar"></i> 11 jun 2023</a>
                        </div>
                        <h3>Một ngày nơi miền quê thanh bình </h3>
                        <p>Tôi rất muốn giới thiệu nhà hàng Hum cho bất kỳ ai đang tìm kiếm những món ăn ngon,
                             thuần túy ẩm thực Việt Nam trong một thiết kế ấm cúng và hiếu khách.
                              Sự kết hợp giữa lối ẩm thực khác biệt, dịch vụ thân thiện và bầu không khí cuốn hút
                               khiến nơi đây trở thành điểm đến không thể bỏ qua cho bất kỳ tín đồ ẩm thực nào du lịch đến Tp.HCM.</p>
                        <a href="#" class="btn">Xem thêm</a>
                    </div>
                </div>

                <div class="box">
                    <img src="/images/talent/bloger-girl-4.jpg" alt="">
                    <div class="content">
                        <div class="icon">
                            <a href="#"> <i class="fas fa-user"></i> by user</a>
                            <a href="#"> <i class="fas fa-calendar"></i> 11 jun 2023</a>
                        </div>
                        <h3>Trải nghiệm đáng nhớ ở Xanh farm</h3>
                        <p>Tôi rất muốn giới thiệu nhà hàng Hum cho bất kỳ ai đang tìm kiếm những món ăn ngon,
                             thuần túy ẩm thực Việt Nam trong một thiết kế ấm cúng và hiếu khách.
                              Sự kết hợp giữa lối ẩm thực khác biệt, dịch vụ thân thiện và bầu không khí cuốn hút
                               khiến nơi đây trở thành điểm đến không thể bỏ qua cho bất kỳ tín đồ ẩm thực nào du lịch đến Tp.HCM.</p>
                        <a href="#" class="btn">Xem thêm</a>
                    </div>
                </div>
            </div>

        </section>
            <!--BÀI VIẾT End-->

           <!--FOOTER Start-->
        <section class="footer">
            <div class="box-container">
                <div class="box">
                    <h3>Menu Online <i class="fas fa-shopping-basket"></i></h3>
                    <p>Hoàn toàn tuyệt vời, các loại rau củ, nhất định phải thử!</p>
                    <div class="share">
                        <a href="#" class="fab fa-facebook"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                </div>

                <div class="box">
                    <h3>Thông tin liên hệ</h3>
                        <a href="#" class="links"> <i class="fas fa-phone"></i>0909 688 990</a>
                        <a href="#" class="links"> <i class="fas fa-envelope"></i>menudep@gmail.com</a>
                        <a href="#" class="links"> <i class="fas fa-map-marker-alt"></i>Saigon- Vietnam</a>
                </div>

                 <div class="box">
                    <h3>Thông tin liên hệ</h3>
                        <a href="#" class="links"> <i class="fas fa-arrow-right"></i>trang chủ</a>
                        <a href="#" class="links"> <i class="fas fa-arrow-right"></i>Đặc sản</a>
                        <a href="#" class="links"> <i class="fas fa-arrow-right"></i>Sản phẩm</a>
                        <a href="#" class="links"> <i class="fas fa-arrow-right"></i>Khuyến mãi</a>
                        <a href="#" class="links"> <i class="fas fa-arrow-right"></i>Đánh giá</a>
                        <a href="#" class="links"> <i class="fas fa-arrow-right"></i>Bài viết</a>
                </div>

                <div class="box">
                    <h3>Kết nối nhanh</h3>
                    <p>để nhận thông tin mới nhất</p>
                    <input type="email" placeholder="Email của bạn" class="email">
                    <input type="submit" value="subscribe" class="btn">
                    <img src="/images/visa.png" class="patment-img" alt="">
                </div>
            </div>


        </section>



         <!--FOOTER Start-->

        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<!-- custom js file link -->
<script src="/js/script.js"> </script>
    </body>
</html>





