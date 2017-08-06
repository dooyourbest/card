
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Login Page | Amaze UI Example</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="alternate icon" type="image/png" href="assets/i/favicon.png">
    <link rel="stylesheet" href="assets/css/amazeui.min.css"/>
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript">
        var $app='{{ $app }}';
    </script>
    <style>
        @media only screen and (min-width: 1200px) {
            .blog-g-fixed {
                max-width: 1200px;
            }
        }

        @media only screen and (min-width: 641px) {
            .blog-sidebar {
                font-size: 1.4rem;
            }
        }

        .blog-main {
            padding: 20px 0;
        }

        .blog-title {
            margin: 10px 0 20px 0;
        }

        .blog-meta {
            font-size: 14px;
            margin: 10px 0 20px 0;
            color: #222;
        }

        .blog-meta a {
            color: #27ae60;
        }

        .blog-pagination a {
            font-size: 1.4rem;
        }

        .blog-team li {
            padding: 4px;
        }

        .blog-team img {
            margin-bottom: 0;
        }

        .blog-content img,
        .blog-team img {
            max-width: 100%;
            height: auto;
        }

        .blog-footer {
            padding: 10px 0;
            text-align: center;
        }
        .header {
            text-align: center;
        }
        .header h1 {
            font-size: 200%;
            color: #333;
            margin-top: 30px;
        }
        .header p {
            font-size: 14px;
        }
    </style>
</head>
<body>
<header class="am-topbar">
    <h1 class="am-topbar-brand">
        <a href="#">打卡小程序</a>
    </h1>
</header>

<div class="header">
    <div class="am-g">
        <h1>打打打卡卡卡卡</h1>
        <p>记录你的打卡人生<br/>change your life</p>
    </div>
    <hr />
</div>
<div class="am-g">
        <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered"style="text-align: center" >
            <button type="button" class="am-btn  am-active  am-btn-primary login_bu" >登陆</button>
            <button type="button" class="am-btn  am-active reg_bu">注冊</button>
        </div>
        <br>
    <div >
        <img style='margin: 0 auto' src="img/login.gif" class="am-img-responsive" alt=""/>
    </div>
        <br>

        <form method="post" class="am-form login" >
            <div class="am-input-group">
                <span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i></span>
                <input type="text" class="am-form-field login_name"placeholder="Username">
            </div>

            <div class="am-input-group">
                <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
                <input type="text" class="am-form-field login_pwd" placeholder="Password">
            </div>

            <br />
            <div style="text-align: center" >
                <button  type="button"  class="am-btn am-btn-primary am-active login_sub">大召唤术~</button>
            </div>
            <div style="text-align:center;">
                <input  name="" value="忘记密码 ^_^? " class="am-btn am-btn-default am-btn-sm am-fr">
            </div>

        </form>
        <form method="post" class="am-form reg"s style="display: none" >
            <div class="am-input-group">
                <span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i></span>
                <input type="text" class="am-form-field reg_name" placeholder="Username">
            </div>

            <div class="am-input-group">
                <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
                <input type="text" class="am-form-field reg_pwd" placeholder="Password">
            </div>
            <div class="am-input-group">
                <span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i></span>
                <input type="text" class="am-form-field reg_email" placeholder="e-mail">
            </div>

            <div class="am-input-group">
                <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
                <input type="text" class="am-form-field reg_mobile" placeholder="mobile">
            </div>

            <br />
            <div style="text-align: center" >
                <button  type="button"  class="am-btn am-btn-primary am-active reg_sub">咒文生成~~</button>
            </div>
        </form>
        <hr>
        <p>© nice to meet you</p>
    </div>
</div>
</body>
<script>
    $(function(){
        function ajax(url,data,type,success,error){
            url=$app+'/'+url;
            $.ajax({
                url:url,
                data:data,
                type:type,
                success:function(ret){
                    if(success){
                        success(ret);
                    }
                },error:function(ret){
                    if(error){
                        error(ret)
                    }
                }
            })
        }
        $('.reg_bu').click(function(e){
            e.preventDefault();
            $('.reg').show();
            $('.login').hide();
            $(this).addClass('am-btn-primary');
            $('.login_bu').removeClass('am-btn-primary');
        })
        $('.login_bu').click(function(e){
            e.preventDefault();
            $('.reg').hide();
            $('.login').show();
            $(this).addClass('am-btn-primary');
            $('.reg_bu').removeClass('am-btn-primary');
        })
        $('.reg_sub').click(function(e){
            var name='';
            var pwd='';
            var email='';
            var mobile='';
            name=$('.reg_name').val();
            pwd=$('.reg_pwd').val();
            email=$('.reg_email').val();
            mobile=$('.reg_mobile').val();
            var data={
                name:name,
                pwd:pwd,
                email:email,
                mobile:mobile,
            }
            ajax('api/register',data,'post',function(){alert(1)});
        })

        $('.login_sub').click(function(e){
            var name='';
            var pwd='';
            name=$('.login_name').val();
            pwd=$('.login_pwd').val();
            var data={
                name:name,
                pwd:pwd,
            }
            ajax('api/login',data,'post',function(){alert(1)});
        })
    })
</script>
</html>
