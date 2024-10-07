<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>联系我</title>
    <!--调用css-->
    <link rel="stylesheet" type="text/css" href="./cssStore/myCss.css" media="screen"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url(Includes/image/bg.jpg) no-repeat center;
            background-size: cover;
        /*//把背景图像扩展至足够大，以使背景图像完全覆盖背景区域。背景图像的某些部分也许无法显示在背景定位区域中。*/
        }

        .contact-page {
            width: 100%;
            max-width: 1400px;
            padding: 25px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        h2 {
            width: 100%;
            margin-bottom: 80px;
            text-transform: uppercase;
            font-size: 40px;
        }

        .contact-info,
        .contact-form {
            flex: 1;
        }

        .item {
            margin-bottom: 40px;
            font-size: 16px;
        }

        .item .icon {
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            background-color: skyblue;
            color: #fff;
            border-radius: 50%;
            margin-right: 5px;
        }

        .contact-form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .textb {
            width: calc(50% - 10px);
            /* 每一个textb盒子的宽度始终保持父盒子宽度一半减去10px */
            height: 40px;
            border: 2px solid black;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            font-size: large;
        }

        textarea {
            width: 100%;
            min-height: 200px;
            max-height: 400px;
            resize: vertical;
            /*//用户可调整元素的高度。*/
            border: 2px solid black;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .btn {
            margin-left: auto;
            width: 120px;
            height: 40px;
            text-transform: uppercase;
            background-color: skyblue;
            border: none;
            border: 2px solid skyblue;
            transition: 0.3s linear;
            cursor: pointer;
        }

        .btn:hover {
            background-color: transparent;
            color: skyblue;
        }

        @media screen and (max-width:800px) {
            .contact-page {
                max-width: 800px;
            }
            h2 {
                font-size: 40px;
                margin-bottom: 40px;
            }
            .contact-info,
            .contact-form {
                flex: 100%
            }
            .textb {
                width: 100%;
            }
        }

    </style>
</head>
<body>
<div id='fatherContainer'>
    <!--导航栏-->
    <?php include("./Includes/header.html"); ?>

    <div class="cell-2 contact-page">
            <h2 style="margin-left: 80px;">联系我</h2>
            <div class="contact-info" style="margin-left:80px;">
                <div class="item">
                    <i class="icon fas fa-home"></i> 李明欣 - Iwan
                </div>
                <div class="item">
                    <i class="icon fas fa-phone"></i> +86 15617503389
                </div>
                <div class="item">
                    <i class="icon fas fa-envelope"></i> 1973608589@qq.com
                </div>
                <div class="item">
                    <i class="icon fas fa-clock"></i> 7:00pm - 9:00pm
                </div>
            </div>
            <form action="" class="contact-form" style="margin-right: 10%;">
                <input type="text" class="textb" placeholder="your name">
                <input type="email" class="textb" placeholder="your email">
                <textarea placeholder="your message"></textarea>
                <input type='submit' value='send' class='btn'>
            </form>
    </div>
    <!--Footer-->
    <?php include("./Includes/footer.html"); ?>
</div>

</body>
</html>