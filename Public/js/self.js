var currentNode;

function mainFunction()
{
    w3IncludeHTML();
    startClock();
    addBaiduMap();
    updateTreeView();
    addDeviceTabListener();
    updateSetting();
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

function getCurActiveDeviceTab()
{
    var result = 0;
    if ($("li#device-map").attr("class") === "active")
        result = 0;
    if ($("li#device-status").attr("class") === "active")
        result = 1;
    if ($("li#device-info").attr("class") === "active")
        result = 2;

    return result;
}

function updateMap(node)
{
    $.get("device_info",{device_id: node.text}, function(data,status){
        var point = new BMap.Point(data[0].longitude, data[0].latitude);
        var map = new BMap.Map("baidu-device-map");    // 创建Map实例

        map.centerAndZoom(point, 15);  // 初始化地图,设置中心点坐标和地图级别

        map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
        map.setCurrentCity("济南");          // 设置地图显示的城市 此项是必须设置的
        map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
        var mk = new BMap.Marker(point);
        map.addOverlay(mk);
    });
}

function updateDeviceStatus(node)
{
    $.get("device_status",{device_id: node.text}, function(data,status){
        //alert(data[0].device_photo_size);
        $("#picture-0").attr("src", data[0].path);
        $("#picture-1").attr("src", data[1].path);
        $("#picture-2").attr("src", data[2].path);
        $("#picture-3").attr("src", data[3].path);
        $("#picture-4").attr("src", data[4].path);

        $("#picture-date0").html(data[0].photo_date);
        $("#picture-date1").html(data[1].photo_date);
        $("#picture-date2").html(data[2].photo_date);
        $("#picture-date3").html(data[3].photo_date);
        $("#picture-date4").html(data[4].photo_date);
    });
}

function updateTreeView()
{
    $.get("group",function(data,status){
        $('#tree').treeview({
            data: data,
        color: "#428bca",

        onNodeSelected: function(event, node) {
            currentNode = node;
            if (getCurActiveDeviceTab() === 0) {
                updateMap(node);
            } else if (getCurActiveDeviceTab() === 1) {
                updateDeviceStatus(node);
            }
        }
        });
    });
}

function updateSetting()
{
    var dialog = document.querySelector('dialog');
    var showDialogButton = document.querySelector('#device-setting-dialog');
    if (! dialog.showModal) {
        dialogPolyfill.registerDialog(dialog);
    }
    showDialogButton.addEventListener('click', function() {
        dialog.showModal();
        var device_id = currentNode.text;

        $.get("device_info", {device_id:device_id},function(data,status){
            $("#device").text(data[0].device_id);
            $("#device-boot").val(data[0].device_boot_time);
            $("#device-off").val(data[0].device_off_time);
            $("#device-start-work").val(data[0].device_photo_starttime)
        });
    });

    dialog.querySelector('#apply-this').addEventListener('click', function() {
        
        var device_id = currentNode.text;
        var device_photo_starttime = $('input#device-start-work').val();
        $.post("device_info_save", {device_id:device_id ,device_photo_starttime:device_photo_starttime},function(data,status){
            
        });
        alert("设置成功");
        var a = $('input#sample11');

        //$("#mdl-spinner").remove();
    });

    dialog.querySelector('#apply-all-line').addEventListener('click', function() {
        alert("设置成功");
        var a = $('input#sample11');

        //$("#mdl-spinner").remove();
    });

    dialog.querySelector('#apply-reboot').addEventListener('click', function() {
        alert("设置成功");
        var a = $('input#sample11');
    });

    dialog.querySelector('#apply-close').addEventListener('click', function() {
        // $.get("device_info", {device_id:device_id},function(data,status){

        // });

        dialog.close();
        //$("#mdl-spinner").remove();
    });
}

$(document).ready(mainFunction);
