

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
    <script src="assets/js/echarts.min.js"></script>
    <script>var $app='{{ $app }}';</script>
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

    <div id="chart" style="width:100%;height:400px;">

    </div>
    <div id="b_chart" style="width:100%;height:400px;">

    </div>
<footer class="blog-footer">
    <p>不是在撩，就是在撩的路上<br/>
        <small>乐观点！</small>
    </p>
</footer>

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
    ajax('api/monthdata',{ca_ctid:1},'get',function(res){
        var data=[];
        for(var i=0;i<res['info'].length;i++){
            var time_m=res['info'][i]['ca_time']*1000;
            var day=new Date(time_m);
            data.push({
                name:day.toString(),
                value:[
                    [day.getFullYear(), day.getMonth() + 1, day.getDate()].join('/'),
                    day.getHours()
                ]
            })
        }
        var chart=echarts.init(document.getElementById('chart'));
        console.log(data);
            option = {
                title: {
                    text: '打卡时间走势'
                },
                tooltip: {
                    trigger: 'axis',
                    formatter: function (params) {
                        params = params[0];
                        var date = new Date(params.name);
                        return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear() + ' : ' + params.value[1];
                    },
                    axisPointer: {
                        animation: false
                    }
                },
                xAxis: {
                    type: 'time',
                    splitLine: {
                        show: true
                    }
                },
                yAxis: {
                    type: 'value',
                    boundaryGap: [0, '100%'],
                    splitLine: {
                        show: true
                    },
                    max:24,
                },
                series: [{
                    name: '模拟数据',
                    type: 'line',
                    showSymbol: false,
                    hoverAnimation: false,
                    data: data
                }]
            };
            chart.setOption(option);
    })

    ajax('api/counthour',{ca_ctid:1},'get',function(res){
        var b_chart=echarts.init(document.getElementById('b_chart'));
            b_data=[];
         for(var i=0;i<res.info.length;i++){
             b_data.push({value:res.info[i]['num'],name:'打卡时间'+res.info[i]['ca_hour']+'时'});
         }
        option = {
            backgroundColor: '#2c343c',

            title: {
                text: 'Customized Pie',
                left: 'center',
                top: 20,
                textStyle: {
                    color: '#ccc'
                }
            },

            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },

            visualMap: {
                show: false,
                min: 80,
                max: 600,
                inRange: {
                    colorLightness: [0.4,1]
                }
            },
            series : [
                {
                    name:'访问来源',
                    type:'pie',
                    radius : '55%',
                    center: ['50%', '50%'],
                    data:b_data.sort(function (a, b) { return a.value - b.value; }),
                    roseType: 'radius',
                    label: {
                        normal: {
                            textStyle: {
                                color: 'rgba(255, 255, 255, 0.3)'
                            }
                        }
                    },
                    labelLine: {
                        normal: {
                            lineStyle: {
                                color: 'rgba(255, 255, 255, 0.3)'
                            },
                            smooth: 0.2,
                            length: 10,
                            length2: 20
                        }
                    },
                    itemStyle: {
                        normal: {
                            color: '#c23531',
                            shadowBlur: 200,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    },

                    animationType: 'scale',
                    animationEasing: 'elasticOut',
                    animationDelay: function (idx) {
                        return Math.random() * 200;
                    }
                }
            ]
        };
        b_chart.setOption(option);
    })



</script>
</html>
