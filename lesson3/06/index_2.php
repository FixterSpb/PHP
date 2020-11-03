<?php
    $page = "home";

    function getMainMenu($page){
        function getColumn($column){
            $result = "";
            foreach ($column as $item){
                if (isset($item['title'])){
                    $result .= '<h3 class="drop_title">' . $item["title"] . '</h3>';
                    $result .= '<ul class="drop_menu">';
                    foreach ($item['submenu'] as $menuItem){
                        $result .= '<li class="drop_list">';
                        $result .= '<a href="' . $menuItem['url'] . '" class="drop_link link_hover">' . $menuItem['text'];
                        $result .= '</a></li>';
                    }
                    $result .= '</ul>';
                }elseif($item["img"]){
                    $result .= '<div class="drop_img_box">';
                    $result .= '<img src="' . $item["img"] . '" alt="' . $item["alt"] . '">';
                    $result .= '<div class="drop_img_text">' . $item["text"];
                    $result .= '</div></div>';
                }
            }
            return $result;
        }

        $mainMenu = [
            [
                "text" => "home",
                "url" => "/",
            ],
            [
                "text" => "man",
                "url" => "#",
                "menu" => [
                    [
                        [
                            "title" => "women",
                            "submenu" => [
                                [
                                    "text" => "Dresses",
                                    "url" => "#"
                                ],
                                [
                                    "text" => "Tops",
                                    "url" => "#"
                                ],
                                [
                                    "text" => "Sweaters/Knits",
                                    "url" => "#"
                                ],
                                [
                                    "text" => "Jackets/Coats",
                                    "url" => "#"
                                ],
                                [
                                    "text" => "Blazers",
                                    "url" => "#"
                                ],
                                [
                                    "text" => "Denim",
                                    "url" => "#"
                                ],
                                [
                                    "text" => "Leggings/Pants",
                                    "url" => "#"
                                ],
                                [
                                    "text" => "Skirts/Shorts",
                                    "url" => "#"
                                ],
                                [
                                    "text" => "Accessories",
                                    "url" => "#"
                                ],
                            ]
                        ]

                    ],
                    [
                        [
                            "title" => "women",
                            "submenu" => [
                                [
                                    "text" => "Dresses",
                                    "url" => "#"
                                ],
                                [
                                    "text" => "Tops",
                                    "url" => "#"
                                ],
                                [
                                    "text" => "Sweaters/Knits",
                                    "url" => "#"
                                ],
                                [
                                    "text" => "Jackets/Coats",
                                    "url" => "#"
                                ]
                            ]
                        ],
                        [
                            "title" => "women",
                            "submenu" => [
                                [
                                    "text" => "Dresses",
                                    "url" => "#"
                                ],
                                [
                                    "text" => "Tops",
                                    "url" => "#"
                                ],
                                [
                                    "text" => "Sweaters/Knits",
                                    "url" => "#"
                                ]
                            ]
                        ]
                    ],
                    [
                        [
                            "title" => "women",
                            "submenu" => [
                                [
                                    "text" => "Dresses",
                                    "url" => "#"
                                ],
                                [
                                    "text" => "Tops",
                                    "url" => "#"
                                ],
                                [
                                    "text" => "Sweaters/Knits",
                                    "url" => "#"
                                ],
                                [
                                    "text" => "Jackets/Coats",
                                    "url" => "#"
                                ]
                            ]
                        ],
                        [
                            "img" => "img/drop_img.png",
                            "alt" => "super sale",
                            "text" => "Super sale!"
                        ]
                    ]
                ]
            ],
            [
                "text" => "women",
                "url" => "#",
            ],
            [
                "text" => "kids",
                "url" => "#",
            ],
            [
                "text" => "Accoseriese",
                "url" => "#",
            ],
            [
                "text" => "Featured",
                "url" => "#",
            ],
            [
                "text" => "Hot",
                "url" => "#",
            ],
            [
                "text" => "Deals",
                "url" => "#",
            ],
        ];
        $result = "";
        foreach ($mainMenu as $item){
            $result .= '<li class="menu_list">';
            $result .= '<a href=' . $item['url'] . '" class="menu_link ';
            $result .= $item['text'] === $page ? 'menu_link_active' : "";
            $result .= '">' . $item["text"] . "</a>";
            if (isset($item['menu'])){
                $result .= '<div class="drop">';
                foreach ($item['menu'] as $column){
                    $result .= '<div class="drop_flex">';
                    $result .= getColumn($column);
                    $result .= '</div>';
                }

                $result .= '</div>';
            }
            $result .= "</li>";
        }
        return $result;
    }

    function getDropMenu(){
        $dropMenu = [
            "Women" => [
                [
                    "text" => "Dresses",
                    "url" => "#"
                ],
                [
                    "text" => "Tops",
                    "url" => "#"
                ],
                [
                    "text" => "Sweaters/Knits",
                    "url" => "#"
                ],
                [
                    "text" => "Jackets/Coats",
                    "url" => "#"
                ],
                [
                    "text" => "Blazers",
                    "url" => "#"
                ],
                [
                    "text" => "Denim",
                    "url" => "#"
                ],
                [
                    "text" => "Leggings/Pants",
                    "url" => "#"
                ],
                [
                    "text" => "Skirts/Shorts",
                    "url" => "#"
                ],
                [
                    "text" => "Accessories",
                    "url" => "#"
                ]
            ],
            "Man" => [
                [
                    "text" => "Tees/Tank tops",
                    "url" => "#"
                ],
                [
                    "text" => "Shirts/Polos",
                    "url" => "#"
                ],
                [
                    "text" => "Sweaters",
                    "url" => "#"
                ],
                [
                    "text" => "Sweatshirts/Hoodies",
                    "url" => "#"
                ],
                [
                    "text" => "Blazers",
                    "url" => "#"
                ],
                [
                    "text" => "Jackets/vests",
                    "url" => "#"
                ]
            ]
        ];
        $result = "";
        foreach ($dropMenu as $key => $items) {
            $result .= '<h3 class="drop_title">' . $key . '</h3>';
            $result .= '<ul class="drop_menu">';
            foreach ($items as $item){
                $result .= '<li class="drop_list">';
                $result .= '<a href="' . $item['url'] . '" class="drop_link link_hover">' . $item['text'];
                $result .= '</a></li>';
            }
            $result .= '</ul>';
        }
        return $result;
    }

    $mainMenu = getMainMenu($page);
    $dropMenu = getDropMenu();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="style.css?ver=1.0">
    <title>Document</title>
</head>

<body>

    <div class="wrapper">
        <div class="top">
            <header class="center">
                <div class="header_left">
                    <div class="logo">
                        <a href="#" class="logo_link">
                            <img src="img/logo.png" alt="logo" class="logo_img">
                            bran<span class="text_pink">d</span>
                        </a>
                    </div>
                    <ul class="menu">
                        <li class="menu_list">
                            <a href="#" class="browse_link">Browse <i class="fa fa-caret-down"></i></a>
                            <div class="drop pos_top36">
                                <div class="triangle">

                                </div>
                                <div class="drop_flex">
                                    <?= $dropMenu ?>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <input type="text" class="browse_input" placeholder="Search for Item...">
                    <a href="#" class="search_link"><img src="img/search.png" alt="search" class="search_img"></a>
                </div>
                <ul class="menu header_right">
                    <li class="menu_list">
                        <a href="#" class="cart_link"><img src="img/cart.png" alt="cart" class="cart_img"></a>
                        <div class="column_box drop">
                            <div class="drop_box">
                                <img src="img/product_mini_1.png" alt="product">
                                <div class="product_cart_desc">
                                    <h6 class="product_cart_name">Rebox Zane</h6>
                                    <p class="stars"><i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i></p>
                                    <p class="cart_count">1 X &dollar;250</p>
                                </div>
                                <a href="#" class="cart_delete"><i class="fa fa-times-circle"></i></a>
                            </div>

                            <div class="drop_box">
                                <img src="img/product_mini_2.png" alt="product">
                                <div class="product_cart_desc">
                                    <h6 class="product_cart_name">Rebox Zane</h6>
                                    <p class="stars"><i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i></p>
                                    <p class="cart_count">1 X &dollar;250</p>
                                </div>
                                <a href="#" class="cart_delete"><i class="fa fa-times-circle"></i></a>
                            </div>

                            <div class="cart_total_box">
                                <h3 class="cart_total">
                                    TOTAL
                                </h3>
                                <h3 class="cart_total">
                                    $500.00
                                </h3>
                            </div>

                            <a href="#" class="button_drop_cart">Checkout</a>
                            <a href="#" class="button_drop_cart">Go to cart</a>
                        </div>

                    </li>
                    <li class="menu_list"><a href="#" class="button">My Account <i
                                class="fa fa-caret-down left8"></i></a>
                    </li>
                </ul>
            </header>
            <nav class="center">
                <ul class="menu">
                    <?= $mainMenu ?>
                </ul>
            </nav>
            <div class="promo">
                <div class="promo_content center">
                    <div class="promo_text">
                        <h1>THE BRANd</h1>
                        <h2>OF LUXERIOUs <span class="text_pink">FASHIOn</span></h2>
                    </div>
                </div>
            </div>
            <div class="exclusive center">
                <div class="exclusive_left">
                    <div class="exclusive_1">
                        <div class="exclusive_text">
                            <h4>hot deal</h4>
                            <h3 class="text_pink">for men</h3>
                        </div>
                    </div>
                    <div class="exclusive_2">
                        <div class="exclusive_text">
                            <h4>LUXIROUS & trendy</h4>
                            <h3 class="text_pink">ACCESORIES</h3>
                        </div>
                    </div>
                </div>
                <div class="exclusive_right">
                    <div class="exclusive_3">
                        <div class="exclusive_text">
                            <h4>30% offer</h4>
                            <h3 class="text_pink">women</h3>
                        </div>
                    </div>
                    <div class="exclusive_4">
                        <div class="exclusive_text">
                            <h4>new arrivals</h4>
                            <h3 class="text_pink">FOR kids</h3>
                        </div>
                    </div>
                </div>
            </div>

            <section class="products center">
                <div class="products_head">
                    <h3 class="products_title">
                        Fetured Items
                    </h3>
                    <p class="products_text">
                        Shop for items based on what we featured in this week
                    </p>
                </div>
                <div class="product_box">
                    <div class="product">
                        <a href="#" class="product_link">
                            <img src="img/product_middle_1.png" alt="photo" class="product_middle_img">
                        </a>
                        <div class="product_content">
                            <a href="#" class="product_name_link">Mango People T-shirt</a>
                            <p class="product_price">&dollar;52.00</p>
                        </div>
                        <a href="#" class="product_add"><img src="img/cart_white.png" class="product_add_img"
                                alt="Add to cart"> Add to Cart</a>
                    </div>
                    <div class="product">
                        <a href="#" class="product_link">
                            <img src="img/product_middle_2.png" alt="photo" class="product_middle_img">
                        </a>
                        <div class="product_content">
                            <a href="#" class="product_name_link">Mango People T-shirt</a>
                            <p class="product_price">&dollar;52.00</p>
                        </div>
                        <a href="#" class="product_add"><img src="img/cart_white.png" class="product_add_img"
                                alt="Add to cart"> Add to Cart</a>
                    </div>
                    <div class="product">
                        <a href="#" class="product_link">
                            <img src="img/product_middle_3.png" alt="photo" class="product_middle_img">
                        </a>
                        <div class="product_content">
                            <a href="#" class="product_name_link">Mango People T-shirt</a>
                            <p class="product_price">&dollar;52.00</p>
                        </div>
                        <a href="#" class="product_add"><img src="img/cart_white.png" class="product_add_img"
                                alt="Add to cart"> Add to Cart</a>
                    </div>
                    <div class="product">
                        <a href="#" class="product_link">
                            <img src="img/product_middle_4.png" alt="photo" class="product_middle_img">
                        </a>
                        <div class="product_content">
                            <a href="#" class="product_name_link">Mango People T-shirt</a>
                            <p class="product_price">&dollar;52.00</p>
                        </div>
                        <a href="#" class="product_add"><img src="img/cart_white.png" class="product_add_img"
                                alt="Add to cart"> Add to Cart</a>
                    </div>
                    <div class="product">
                        <a href="#" class="product_link">
                            <img src="img/product_middle_5.png" alt="photo" class="product_middle_img">
                        </a>
                        <div class="product_content">
                            <a href="#" class="product_name_link">Mango People T-shirt</a>
                            <p class="product_price">&dollar;52.00</p>
                        </div>
                        <a href="#" class="product_add"><img src="img/cart_white.png" class="product_add_img"
                                alt="Add to cart"> Add to Cart</a>
                    </div>
                    <div class="product">
                        <a href="#" class="product_link">
                            <img src="img/product_middle_6.png" alt="photo" class="product_middle_img">
                        </a>
                        <div class="product_content">
                            <a href="#" class="product_name_link">Mango People T-shirt</a>
                            <p class="product_price">&dollar;52.00</p>
                        </div>
                        <a href="#" class="product_add"><img src="img/cart_white.png" class="product_add_img"
                                alt="Add to cart"> Add to Cart</a>
                    </div>
                    <div class="product">
                        <a href="#" class="product_link">
                            <img src="img/product_middle_7.png" alt="photo" class="product_middle_img">
                        </a>
                        <div class="product_content">
                            <a href="#" class="product_name_link">Mango People T-shirt</a>
                            <p class="product_price">&dollar;52.00</p>
                        </div>
                        <a href="#" class="product_add"><img src="img/cart_white.png" class="product_add_img"
                                alt="Add to cart"> Add to Cart</a>
                    </div>
                    <div class="product">
                        <a href="#" class="product_link">
                            <img src="img/product_middle_8.png" alt="photo" class="product_middle_img">
                        </a>
                        <div class="product_content">
                            <a href="#" class="product_name_link">Mango People T-shirt</a>
                            <p class="product_price">&dollar;52.00</p>
                        </div>
                        <a href="#" class="product_add"><img src="img/cart_white.png" class="product_add_img"
                                alt="Add to cart"> Add to Cart</a>
                    </div>
                    <div class="column_box">

                    </div>
                </div>
                <a href="#" class="button top50">Browse All Product <i class="fa fa-long-arrow-right left8"></i></a>
            </section>

            <div class="sales center">
                <div class="banner_box">
                    <div class="banner">
                        <div class="banner_text">
                            <h1 class="banner_title">30&percnt; <span class="text_pink">OFFER</span></h1>
                            <p class="banner_title">for women</p>
                        </div>
                    </div>
                    <div class="sales_container">
                        <div class="sales_box">
                            <div class="sales_box_icon">
                                <img src="img/icon_1.png" alt="icon 1" class="sales_box_icon_img">
                            </div>
                            <div class="sales_text">
                                <h4 class="sales_text">Free Delivery</h4>
                                <p class="sales_text">Worldwide delivery on all. Authorit tively morph next-generation
                                    innov tion with extensive models.</p>
                            </div>
                        </div>
                        <div class="sales_box">
                            <div class="sales_box_icon">
                                <img src="img/icon_2.png" alt="icon 2" class="sales_box_icon_img">
                            </div>
                            <div class="sales_text">
                                <h4 class="sales_text">Sales & discounts</h4>
                                <p class="sales_text">Worldwide delivery on all. Authorit tively morph next-generation
                                    innov tion with extensive models.</p>
                            </div>
                        </div>
                        <div class="sales_box">
                            <div class="sales_box_icon">
                                <img src="img/icon_3.png" alt="icon 3" class="sales_box_icon_img">
                            </div>
                            <div class="sales_text">
                                <h4 class="sales_text">Quality assurance</h4>
                                <p class="sales_text">Worldwide delivery on all. Authorit tively morph next-generation
                                    innov tion with extensive models.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="subscribe center top100">
                <div class="subscribe_slider">
                    <div class="subscribe_slider_content">
                        <img src="img/photo_83.png" alt="photo_83" class="photo_83">
                        <div class="suscribe_text_box">
                            <p class="subscribe_text">“Vestibulum quis porttitor dui! Quisque viverra nunc mi, a
                                pulvinar purus condimentum a. Aliquam condimentum mattis neque sed pretium”</p>
                            <p class="subscribe_name">Bin Burhan</p>
                            <p class="dnaka">Dnaka, Bd</p>
                        </div>
                    </div>
                    <div class="pagination">
                        <a href="#" class="pagination_link"></a>
                        <a href="#" class="pagination_link pagination_link_active"></a>
                        <a href="#" class="pagination_link"></a>
                    </div>
                </div>

                <div class="subscribe_email_box">
                    <h4 class="subscribe_title">Subscribe</h4>
                    <p class="subscribe_email_text">FOR OUR NEWLETTER AND PROMOTION</p>
                    <form action="#" class="email_form">
                        <input type="text" name="email" id="email" class="input_email" placeholder="Enter Your Email">
                        <a href="#" class="button button_subscribe">Subscribe</a>
                    </form>
                </div>
            </div>
        </div>

        <footer class="top100">
            <div class="footer_content center">
                <div class="footer_box">
                    <div class="logo">
                        <a href="#" class="logo_link">
                            <img src="img/logo.png" alt="logo" class="logo_img">
                            bran<span class="text_pink">d</span>
                        </a>
                    </div>
                    <p class="footer_text">Objectively transition extensive data rather than cross functional solutions.
                        Monotonectally syndicate multidisciplinary materials before go forward benefits. Intrinsicly
                        syndicate an expanded array of processes and cross-unit partnerships.</p>
                    <p class="footer_text">Efficiently plagiarize 24/365 action items and focused infomediaries.
                        Distinctively seize superior initiatives for wireless technologies. Dynamically optimize. </p>
                </div>
                <div class="footer_box">
                    <h4 class="footer_title">company</h4>
                    <a href="#" class="footer_link link_hover">Home</a>
                    <a href="#" class="footer_link link_hover">Shop</a>
                    <a href="#" class="footer_link link_hover">About</a>
                    <a href="#" class="footer_link link_hover">How It Works</a>
                    <a href="#" class="footer_link link_hover">Contact</a>

                </div>
                <div class="footer_box">
                    <h4 class="footer_title">information</h4>
                    <a href="#" class="footer_link link_hover">Tearms & Condition</a>
                    <a href="#" class="footer_link link_hover">Privacy Policy</a>
                    <a href="#" class="footer_link link_hover">How to Buy</a>
                    <a href="#" class="footer_link link_hover">How to Sell</a>
                    <a href="#" class="footer_link link_hover">Promotion</a>
                </div>
                <div class="footer_box">
                    <h4 class="footer_title">shop category</h4>
                    <a href="#" class="footer_link link_hover">Men</a>
                    <a href="#" class="footer_link link_hover">Women</a>
                    <a href="#" class="footer_link link_hover">Child</a>
                    <a href="#" class="footer_link link_hover">Apparel</a>
                    <a href="#" class="footer_link link_hover">Brows All</a>
                </div>
            </div>
            <div class="footer_bottom center">
                <p class="copiright">&copy; 2017 Brand All Rights Reserved.</p>
                <div class="social">
                    <a href="#" class="fa fa-facebook social_link"></a>
                    <a href="#" class="fa fa-twitter social_link"></a>
                    <a href="#" class="fa fa-linkedin social_link"></a>
                    <a href="#" class="fa fa-pinterest-p social_link"></a>
                    <a href="#" class="fa fa-google-plus social_link"></a>
                </div>
            </div>
        </footer>
    </div>

</body>

</html>