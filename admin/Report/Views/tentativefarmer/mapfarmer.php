<div class="block" id="tentative_map">
    <div class="block-header block-header-default">
        <h3 class="block-title">Tentative Mapwise Farmer</h3>
    </div>
    <div class="block-content block-content-full tentative_map_content">
        <div class="map-section">
            <img id="imgSvg" xmlns="http://www.w3.org/2000/svg" version="1.1" class="svg" src="uploads/files/ommodishamap.svg"/>
        </div>
        <div class="legends">
            <p class=" mb-1 mt-0">Based on No. of beds</p>
            <ul class="">
                <li><span class="bg-scale0"></span> 0 </li>
                <li><span class="bg-scale1"></span> 1 - 3 </li>
                <li><span class="bg-scale2"></span> 3 - 4 </li>
                <li><span class="bg-scale3"></span> 4 - 5 </li>
                <li><span class="bg-scale4"></span> 5+ </li>
            </ul>
        </div>
    </div>
</div>
<style>
    .tentative_map_content {
        position: relative;
    }
    #tentative_map .legends {
        position: absolute;
        bottom: 0px;
        right: 0;
        top: auto;
        left: auto;
        margin: 0;
        transform: translateY(0%);

    }
    #tentative_map .legends p {
        transform: rotate(0deg);
        position: relative;
        left: 0;
        width: auto;
        text-align: center;
    }
    #tentative_map .legends ul {
        flex-flow: row;
    }
    .legends ul {
        margin-bottom: 0;
        display: flex;
        flex-flow: column;
    }
    #tentative_map .legends ul li {
        flex-flow: column;
        margin: 0 5px;
    }
    .legends ul li {
        display: flex;
        margin-bottom: 0px;
        align-items: center;
        color: #888888;
        flex-flow: row;
        font-size: 0.7rem;
        font-weight: 600;
        margin-right: 15px;
    }
    #tentative_map .legends ul li span {
        height: 8px;
        width: 50px;
    }
    .legends ul li span {
        height: 70px;
        width: 16px;
        display: block;
        margin-right: 6px;
        border-radius: 0px;
    }
    .bg-scale0 {
        fill: #EFEFEF !important;
        background: #EFEFEF !important;
    }
    .bg-scale1 {
        fill: #FEE86C !important;
        background: #FEE86C !important;
    }
    .bg-scale2 {
        fill: #FABC5B !important;
        background: #FABC5B !important;
    }
    .bg-scale3 {
        fill: #F7AD5D !important;
        background: #F7AD5D !important;
    }
    .bg-scale4 {
        fill: #F1A777 !important;
        background: #F1A777 !important;
    }
</style>
<?php js_start() ?>
<script type="text/javascript"><!--
        $(function(){
            $('img.svg').inlineSvg();
        });

    function changeColor(color)
    {
        //obj Father
        $("#imgSvg").css("fill", color);
        //objs children
        $('#imgSvg').children().css('fill', color);
    }
</script>
<?php js_end() ?>
