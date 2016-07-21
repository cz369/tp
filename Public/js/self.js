function mainFunction()
{
    w3IncludeHTML();
    startClock();
    addBaiduMap();
    updateTreeView();
    addDeviceTabListener();
    addSetting();
}

function addBaiduMap()
{
    var map = new BMap.Map("baidu-device-map");

    var geolocation = new BMap.Geolocation();
    geolocation.getCurrentPosition(function(r){
        if(this.getStatus() == BMAP_STATUS_SUCCESS){
            var mk = new BMap.Marker(r.point);
            map.addOverlay(mk);
            map.centerAndZoom(r.point,12);
        } else {
            alert('failed'+this.getStatus());
        }        
    },{enableHighAccuracy: true})
}

function startClock() 
{
    var today=new Date();
    var  y=today.getFullYear();
    var  mon=today.getMonth()+1;
    mon=changnum(mon);
    var  d=today.getDay();
    d=changnum(d);
    var  h=today.getHours();
    var  m=today.getMinutes();
    m=changnum(m);
    var  s=today.getSeconds();
    s=changnum(s);
    document.getElementById("timeid").innerHTML=y+"年"+mon+"月"+d+"日"+h+":"+m+":"+s;
    t=setTimeout(function(){
        startClock();
    },500);
}

function changnum(i){      //月、日、秒如果小于10数字前加0
    if(i<10){
        return "0"+i;
    }
    return i;
}

function addDeviceTabListener() 
{
    $("li#device-map").click(function(){
        $(this).attr("class", "active");
        $("li#device-status").attr("class", "");
        $("li#device-info").attr("class", "");

        $("div#baidu-device-map").show();
        $("div#device-status").hide()
        $("div#device-info").hide();
    });

    $("li#device-status").click(function(){
        $(this).attr("class", "active");
        $("li#device-map").attr("class", "");
        $("li#device-info").attr("class", "");

        $("div#baidu-device-map").hide();
        $("div#device-status").show()
        $("div#device-info").hide();
    });

    $("li#device-info").click(function(){
        $(this).attr("class", "active");
        $("li#device-map").attr("class", "");
        $("li#device-status").attr("class", "");

        $("div#baidu-device-map").hide();
        $("div#device-status").hide()
        $("div#device-info").show();
    });
}

function updateTreeView()
{
    $.get("group",function(data,status){
        $('#tree').treeview({
            data: data,
        color: "#428bca",

        onNodeSelected: function(event, node) {
            // 事件代码...
            //alert(node.text);

            $.get("device_info",{device_id: node.text}, function(data,status){
                //alert(data[0].device_photo_size);
                $("#device_id").val(data[0].device_id);
                $("#device_photo_size").val(data[0].device_photo_size);
                $("#device_photo_quality").val(data[0].device_photo_quality);
                $("#device_photo_starttime").val(data[0].device_photo_starttime);
                $("#device_photo_endtime").val(data[0].device_photo_endtime);
                $("#device_frequency").val(data[0].device_frequency);
                // alert(data[0].device_photo_auto);
                if (data[0].device_photo_auto == "1") {
                    $("#device_photo_auto").attr("checked", true);
                } else {
                    $("#device_photo_auto").attr("checked", false);
                }

                var point = new BMap.Point(data[0].longitude, data[0].latitude)

                var map = new BMap.Map("baidu-device-map");    // 创建Map实例
            map.centerAndZoom(point, 11);  // 初始化地图,设置中心点坐标和地图级别
            map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
            map.setCurrentCity("济南");          // 设置地图显示的城市 此项是必须设置的
            map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
            var mk = new BMap.Marker(point);
            map.addOverlay(mk);

            });
        }
        });
    });

}

function addSetting()
{
    var dialog = document.querySelector('dialog');
    var showDialogButton = document.querySelector('#device-setting-dialog');
    if (! dialog.showModal) {
        dialogPolyfill.registerDialog(dialog);
    }
    showDialogButton.addEventListener('click', function() {

        dialog.showModal();
        alert($("#device_id").val());
        var device_id = $("#device_id").val();

        $.post("__URL__/need_photo", {device_id:device_id},function(data,status){



        });
    });
    dialog.querySelector('.mdl-button').addEventListener('click', function() {
        dialog.close();
        //$("#mdl-spinner").remove();
    });
}

$(document).ready(mainFunction);
