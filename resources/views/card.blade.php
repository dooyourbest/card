

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Blog | Amaze UI Example</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="alternate icon" type="image/png" href="assets/i/favicon.png">
    <link rel="stylesheet" href="assets/css/amazeui.min.css"/>
    <script src="http://cdn.bootcss.com/jquery/2.0.3/jquery.js"></script>
    <script src="https://unpkg.com/vue"></script>
    <script>
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
    </style>
</head>
<body>
<div id="app">

    <header class="am-topbar">
        <h1 class="am-topbar-brand">
            <a href="#">打卡小程序</a>
        </h1>

        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

        <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
            <ul class="am-nav am-nav-pills am-topbar-nav">
                <li class="am-active"><a href="#">我的记录</a></li>
                <li><a href="#">我要打卡</a></li>
                <li><a href="#">撩一个</a></li>
            </ul>

        </div>
    </header>
    <ul class="am-nav am-nav-pills am-nav-justify">
        <li ><a href="#">首页</a></li>
        <li class="am-active"><a href="#">打卡</a></li>
        <li><a href="#">个人中心</a></li>
    </ul>

    <hr/>

    <div id="animation-group" style="text-align: center">
        <p  v-for="(todo,index) in list"><button @click='card(index)' type="button" class="am-btn am-btn-primary am-animation-delay-1"> [[todo.name]]</button></p>

    </div>



    <footer class="blog-footer">
        <p>不是在撩，就是在撩的路上<br/>
            <small>乐观点！</small>
        </p>
    </footer>

</div>


<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="assets/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="assets/js/amazeui.min.js"></script>

</body>
<script>
    $(function() {
        var $btns = $('#animation-group').find('.am-btn');
        var dfds = [];
        var animating = false;
        var animation = 'am-animation-scale-up';
        $(document).ready(function(){
            if (!animating) {
                animating = true;
                $btns.each(function() {
                    var dfd = new $.Deferred();
                    dfds.push(dfd);
                    var $this = $(this);
                    if ($.AMUI.support.animation) {
                        $this.addClass(animation).one($.AMUI.support.animation.end, function() {
                            $this.removeClass(animation);
                            dfd.resolve();
                        });
                    }
                });

                $.when.apply(null, dfds).done(function() {
                    animating = false;
                    console.log('[AMUI] - 所有动画执行完成');
                    dfds = [];
                });
            }
        })

    });
</script>
<script>
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
    var vue=new Vue({
        el: '#app',
        delimiters: ['[[', ']]'],
        data: {
            list:[
            ]
        },
        methods: {
            ready:function(){
                var this_obj=this;
                ajax('api/list/cardType',[],'get',function(res){
                    for(var i= 0;i<res['info'].length;i++){
                        this_obj.list.push({name:res.info[i]['ct_show_word'],ct_id:res.info[i]['ct_id']})
                    }
                })
            },
            card:function(index){
                var this_obj=this;
                var ct_id=this_obj.list[index].ct_id;
                ajax('aip/card',{ct_id:ct_id},'post',function(){alert(1)})
            }
        }
    })
    vue.ready();
</script>
</html>
