<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base target="_blank" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link href="/hbgs/Public/css/flexslider.css" rel="stylesheet" type="text/css"  />
    <link href="/hbgs/Public/css/reset-common927.css" rel="stylesheet" />
    <link href="/hbgs/Public/css/sug.css" rel="stylesheet" />
    <link href="/hbgs/Public/css/text_common-content_mouseoverout0927.css" rel="stylesheet" />
    <link href="/hbgs/Public/css/extra.css" rel="stylesheet" />
    <link href="/hbgs/Public/css/index.css" rel="stylesheet">

    <script type="text/javascript" src="/hbgs/Public/js/jquery-2.1.1.min.js"></script>
    <title>明日导航</title>
</head>
<body>
<div class="box-userbar">
    <div class="box">
        <div class="ft-l box-date">
            <span id="localtime"></span>
            <script>
                function showLocale(objD)
                {
                    var str,colorhead,colorfoot;
                    var yy = objD.getYear();
                    if(yy<1900) yy = yy+1900;
                    var MM = objD.getMonth()+1;
                    if(MM<10) MM = '0' + MM;
                    var dd = objD.getDate();
                    if(dd<10) dd = '0' + dd;
                    var hh = objD.getHours();
                    if(hh<10) hh = '0' + hh;
                    var mm = objD.getMinutes();
                    if(mm<10) mm = '0' + mm;
                    var ss = objD.getSeconds();
                    if(ss<10) ss = '0' + ss;
                    var ww = objD.getDay();
                    if  ( ww==0 )  colorhead="<font color=\"#FF0000\">";
                    if  ( ww > 0 && ww < 6 )  colorhead="<font color=\"#666\">";
                    if  ( ww==6 )  colorhead="<font color=\"#008000\">";
                    if  (ww==0)  ww="星期日";
                    if  (ww==1)  ww="星期一";
                    if  (ww==2)  ww="星期二";
                    if  (ww==3)  ww="星期三";
                    if  (ww==4)  ww="星期四";
                    if  (ww==5)  ww="星期五";
                    if  (ww==6)  ww="星期六";
                    colorfoot="</font>";
                    str = colorhead + yy + "年-" + MM + "月-" + dd + "日 " + ww + "  "+ hh + ":" + mm + ":" + ss;
                    return(str);
                }
                function tick()
                {
                    var today;
                    today = new Date();
                    document.getElementById("localtime").innerHTML = showLocale(today);
                    window.setTimeout("tick()", 1000);
                }
                tick();
            </script>
        </div>
        <div class="ft-r span-rows box-userbar_link">
            <span><a href="http://study.mingrisoft.com">联系我们</a></span>
            <b class="space"></b>
            <span><a href="http://study.mingrisoft.com">意见建议</a></span>
        </div>
    </div>
</div>
<div class="box l-header" monkey="header" style="padding-bottom: 20px">
    <div class="ft-l l-header_l">
        <span class="box-logo"><a id="indexLogo" href="<?php echo U('Index/index');?>" title="点击进入首页"><img src="/hbgs/Public/images/logo.png" width="210" height="91"></a></span>
    </div>
    <div class="l-header_m">
        <div class="ft-l box-weather">
            <iframe name="weather_inc" src="http://i.tianqi.com/index.php?c=code&id=2" width="770" height="70" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>
        </div>
    </div>
</div>
<div class="box box-search clearfix">
    <div class="box-search_bg"></div>
    <div class="box-search_l">
        <a href="http://www.sogou.com/index.php?pid=sogou-netb-987797582-20141020" title="首页">
            <img id="searchGroupLogo" src="/hbgs/Public/images/search_logo/web.png" width="97" height="32" alt="首页" />
        </a>
    </div>

    <div class="box-search_r">
        <div class="box-search_notice">
            <span></span>
        </div>
        <div class="box-hotword">
            <a href="javascript:;" target='_blank'>收录的皆为绿色网站，请放心访问！</a>
        </div>
    </div>

    <dl class="box-search_c">
        <dt id="searchGroupTabs" class="box-search_tabs clearfix" monkey="search">
            <a class="cur"     href="javascript:;">网页</a>
            <a data-t="mp3"    href="javascript:;" >MP3</a>
            <a data-t="video"  href="javascript:;" >视频</a>
            <a data-t="image"  href="javascript:;" >图片</a>
            <a data-t="tieba"  href="javascript:;" >贴吧</a>
            <a data-t="zhidao" href="javascript:;" >知道</a>
            <a data-t="news"   href="javascript:;" >新闻</a>
            <a data-t="map"    href="javascript:;" >地图</a>
        </dt>
        <dd>
            <form id="searchGroupForm" action="http://www.sogou.com/sogou">
                <div class="box-search_input">
                    <input id="searchGroupInput" name="query" maxlength="100" type="text" autocomplete="off" />
                </div>
                <span class="corner box-search_btn clearfix"><b class="r"></b><b class="l"></b>
                    <button id="searchGroupBtn" class="m" hidefocus="true" type="submit">搜索一下</button>
                </span>
            </form>
        </dd>
    </dl>
</div>

<div class="box l-article clearfix">
    <div class="l-article_l">
        <div class="box-leftbar" monkey="leftbar">
            <div class="box-leftbar_inner">
                <div monkey="service">
                    <?php if(is_array($left_array)): foreach($left_array as $key=>$vo): ?><dl class="corner box-sidebar">
                            <dt class="m"><span class="box-sidebar_title"><a href="javascript:;"><?php echo ($key); ?></a></span></dt>
                            <dd class="m span-rows box-sidebar_content">
                                <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$left): $mod = ($i % 2 );++$i;?><span><a href="<?php echo U('more',array('middle_id'=>$left['id']));?>"><?php echo ($left["middle_name"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?>
                            </dd>
                        </dl><?php endforeach; endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="l-article_r">
        <!--热门网址-->
        <div class="corner box-hot" monkey="hot">
            <div class="m span-rows box-hot_content">
                <?php if(is_array($hot_array)): foreach($hot_array as $key=>$vo): ?><span><a href="<?php echo ($vo["href"]); ?>" <?php if(($vo["is_recommend"]) == "1"): ?>class="recommend"<?php endif; ?> ><?php echo ($vo["title"]); ?></a></span><?php endforeach; endif; ?>
            </div>
        </div>
        <!--热门网址结束-->

        <!--广告位-->
        <div class="span-rows box-adbar" monkey="ad">
            <?php if(is_array($ad_array)): foreach($ad_array as $key=>$vo): ?><span><a href='<?php echo ($vo["href"]); ?>' target='_blank'><?php echo ($vo["title"]); ?></a></span><?php endforeach; endif; ?>
        </div>
        <!--广告位结束-->

        <!-- 右侧分类 开始 -->
        <div class="box-sort" monkey="cool">
            <ul class="m span-rows box-sort_content">
                <?php if(is_array($right_array)): foreach($right_array as $key=>$vo): ?><li>
                        <span class="box-sort_title"><a href="<?php echo U('more',array('middle_id'=>$key));?>" ><?php echo (get_middle_name_by_id($key)); ?></a></span>
                        <span class="box-sort_more"><a href="<?php echo U('more',array('middle_id'=>$key));?>" >更多&gt;&gt;</a></span>
                        <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><span><a href="<?php echo ($data["href"]); ?>"><?php echo ($data["title"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?>
                    </li><?php endforeach; endif; ?>
                <!--以下数据是为演示界面效果而生成，实际应用中可去掉-->
                <li>
                    <span class="box-sort_title"><a href="news.htm">新 闻</a></span>
                    <span class="box-sort_more"><a href="news.htm">更多&gt;&gt;</a></span>
                    <span><a href="http://news.sina.com.cn/">新浪新闻</a></span>
                    <span><a href="http://news.sohu.com/">搜狐新闻</a></span>
                    <span><a href="http://www.zaobao.com/">联合早报</a></span>
                    <span><a href="http://cn.reuters.com/">路透中文网</a></span>
                    <span><a href="http://www.huanqiu.com/">环球网</a></span>
                    <span><a href="http://news.100daohang.cn/">今日新闻</a></span>
                </li>
                <li><span class="box-sort_title"><a href="stocknew.htm">财 经</a></span>
                    <span class="box-sort_more"><a href="stocknew.htm">更多&gt;&gt;</a></span>
                    <span><a href="http://www.eastmoney.com/">东方财富</a></span>
                    <span><a href="http://finance.sina.com.cn/">新浪财经</a></span>
                    <span><a href="http://www.jrj.com.cn/">金融界</a></span>
                    <span><a href="http://www.1234567.com.cn/">天天基金</a></span>
                    <span><a href="http://www.stockstar.com/">证券之星</a></span>
                    <span><a href="http://business.sohu.com/">搜狐财经</a></span>
                </li>
                <li><span class="box-sort_title"><a href="gouwu.htm">购 物</a></span>
                    <span class="box-sort_more"><a href="gouwu.htm">更多&gt;&gt;</a></span>
                    <span><a href="http://ai.taobao.com">淘宝特卖</a></span>
                    <span><a href="http://www.amazon.cn">亚马逊</a></span>
                    <span><a href="http://p.yiqifa.com" class="tc-green">蘑菇街</a></span>
                    <span><a href="http://p.yiqifa.com">1号店</a></span>
                    <span><a href="http://p.yiqifa.com">当当网</a></span>
                </li>
                <li><span class="box-sort_title"><a href="shequ.htm">社 交</a></span>
                    <span class="box-sort_more"><a href="shequ.htm">更多&gt;&gt;</a></span>
                    <span><a href="http://weibo.com/">新浪微博</a></span>
                    <span><a href="http://t.sohu.com/">搜狐微博</a></span>
                    <span><a href="http://tieba.baidu.com/">百度贴吧</a></span>
                    <span><a href="http://qzone.qq.com/">QQ空间</a></span>
                    <span><a href="http://www.tianya.cn/">天涯社区</a></span>
                    <span><a href="http://www.mop.com/">猫扑</a></span>
                    <span><a href="http://www.renren.com/">人人网</a></span>
                </li>
                <li><span class="box-sort_title"><a href="shequ.htm">社 交</a></span>
                    <span class="box-sort_more"><a href="shequ.htm">更多&gt;&gt;</a></span>
                    <span><a href="http://weibo.com/">新浪微博</a></span>
                    <span><a href="http://t.sohu.com/">搜狐微博</a></span>
                    <span><a href="http://tieba.baidu.com/">百度贴吧</a></span>
                    <span><a href="http://qzone.qq.com/">QQ空间</a></span>
                    <span><a href="http://www.tianya.cn/">天涯社区</a></span>
                    <span><a href="http://www.mop.com/">猫扑</a></span>
                    <span><a href="http://www.renren.com/">人人网</a></span>
                </li>
            </ul>

            <!--图片区-->
            <ul class="m span-rows box-sort_content">
                <h3> <span><a>休闲娱乐</a></span></h3>
                <div class="flexslider carousel">
                    <ul class="slides">
                        <?php if(is_array($pic_array)): foreach($pic_array as $key=>$vo): ?><li>
                                <a href="<?php echo ($vo["href"]); ?>"><img src="<?php echo (get_cover_url($vo["picture"])); ?>"/></a>
                                <span><?php echo ($vo["title"]); ?></span>
                            </li><?php endforeach; endif; ?>
                    </ul>
                </div>
                <!--轮播展示-->
                <script type="text/javascript" src="/hbgs/Public/js/jquery.flexslider-min.js"></script>
                <script type="text/javascript">
                    $(function() {
                        $(".flexslider").flexslider({
                            animation: "slide",
                            animationLoop: false,
                            itemWidth: 210,
                            itemMargin: 5,
                            minItems: 5,
                            maxItems: 4,
                            animationLoop:true,
                            slideshowSpeed:3000,
                            // pausePlay: true
                        });
                    });
                </script>
            </ul>
        </div>
        <!-- 右侧分类 结束 -->

        <!--底部开始-->
        <div class="box box-bottom" monkey="footer">
            <div class="box-tools">
                <ul class="m span-rows box-tools_content">
                    <?php if(is_array($bottom_array)): foreach($bottom_array as $key=>$vo): ?><li>
                            <span class="box-tools_title"><a href="javascript:;"><?php echo ($key); ?></a></span>
                            <span class="box-tools_more"><a href="javascript:;">更多&gt;&gt;</a></span>
                            <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bottom): $mod = ($i % 2 );++$i;?><span><a href="<?php echo ($bottom["href"]); ?>"><?php echo ($bottom["title"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?>
                        </li>
                        <!--以下数据是为演示界面效果而生成，实际应用中可去掉-->
                        <li>
                            <span class="box-tools_title"><a href="javascript:;">软件专区</a></span>
                            <span class="box-tools_more"><a href="javascript:;">更多&gt;&gt;</a></span>
                            <span><a href="qq.htm">腾讯QQ</a></span>
                            <span><a href="http://clk.uunt.com/link/172046/">PPTV</a></span>
                            <span><a href="http://dl.xunlei.com/">迅雷</a></span>
                            <span><a href="http://clk.uunt.com/link/172478/">金山毒霸</a></span>
                            <span><a href="http://clk.uunt.com/link/155738/">搜狐影音</a></span>
                        </li><?php endforeach; endif; ?>
                </ul>
            </div>
        </div>
        <!--底部结束-->
    </div>
</div>
<div class="box l-footer">
    <p class="span-rows box-about">
        <span class="box-about_first"><a href="http://www.mingrisoft.com/">关于明日科技</a></span>
        <b class="space"></b>
        <span><a href="http://www.mingribook.com/">明日图书</a></span>
        <b class="space"></b>
        <span><a href="http://www.mrbccd.com/">编程字典</a></span>
        <b class="space"></b>
        <span><a href="http://study.mingir.com">明日学院</a></span>
    </p>
    <p class="span-rows box-copyright"><span style="margin:0 4px">绿色经典</span>
        <span><a href="http://www.miibeian.gov.cn/"> 吉ICP备10002740号 <i class="i-papers"></i></a></span>
    </p>
</div>
</body>
</html>