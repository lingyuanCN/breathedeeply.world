//1. chart function
//1.1 line chart
function lineChart(arrayDate,arrayValue,charttype){
  var ChartData = {
   labels: arrayDate,
     datasets: [
      {
        //曲线的填充颜色
        fillColor : "rgba(220,220,220,0.5)",
        //填充块的边框线的颜色
        strokeColor : "rgba(220,220,220,1)",
        //表示数据的圆圈的颜色
        pointColor : "rgba(220,220,220,1)",
        //表示数据的圆圈的边的颜色
        pointStrokeColor : "#fff",
        data: arrayValue
      }
    ]
  };
  var options = {
    scaleOverride :false, //是否显示折线图的线条
    scaleShowLabels :true,//是否显示纵轴
    scaleShowGridLines :true,//是否显示坐标轴的标尺
    bezierCurve :true,//是否显示圆滑的效果
    pointDot :true,//是否显示折线图的顶点
    pointDotRadius :3,//折线图定点大小
    pointDotStrokeWidth:1,//折线图定点外围大小
    animation :true,//是否显示动画效果
    animationSteps :60,//图形显示的速度
  };
  var ctx = document.getElementById(charttype).getContext("2d");
  var myChart = new Chart(ctx).Line(ChartData, options);
}

// 1.2 bar chart
function barChart(arrayDate,arrayValue,charttype){
  var ChartData = {
    labels: arrayDate,
    datasets: [
      {
        //曲线的填充颜色
        fillColor : "rgba(220,220,220,0.5)",
        //填充块的边框线的颜色
        strokeColor : "rgba(220,220,220,1)",
        //表示数据的圆圈的颜色
        pointColor : "rgba(220,220,220,1)",
        //表示数据的圆圈的边的颜色
        pointStrokeColor : "#fff",
        data: arrayValue
      }
    ]
  };
  var options = {
    scaleOverride :false, //是否显示折线图的线条
    //  scaleLabel :"<%=value%>",
    scaleShowLabels :true,//是否显示纵轴
    scaleShowGridLines :true,//是否显示坐标轴的标尺
    bezierCurve :true,//是否显示圆滑的效果
    pointDot :true,//是否显示折线图的顶点
    pointDotRadius :3,//折线图定点大小
    pointDotStrokeWidth:1,//折线图定点外围大小
    animation :true,//是否显示动画效果
    animationSteps :60,//图形显示的速度
  };
  var ctx = document.getElementById(charttype).getContext("2d");
  var myChart = new Chart(ctx).Bar(ChartData, options);
  for(var i=0;i<23;i++){
    if(0<=arrayValue[i]&&arrayValue[i]<=50){
      myChart.datasets[0].bars[i].fillColor='rgb(0,153,102)'
    }
    if(51<=arrayValue[i]&&arrayValue[i]<=100){
      myChart.datasets[0].bars[i].fillColor='#FFDE33'
    }
    if(101<=arrayValue[i]&&arrayValue[i]<=150){
      myChart.datasets[0].bars[i].fillColor='#F93'
    }
    if(151<=arrayValue[i]&&arrayValue[i]<=200){
      myChart.datasets[0].bars[i].fillColor='#C03'
    }
    if(201<=arrayValue[i]&&arrayValue[i]<=300){
      myChart.datasets[0].bars[i].fillColor='#609'
    }
    if(301<=arrayValue[i]){
      myChart.datasets[0].bars[i].fillColor='#7E0023'
    }
  }
  myChart.update();

}

// function parameterLineChart(resultnum,results,parameter,canvasnum){
//   var j=23;
//   var arrayDate=new Array();
//   var arrayValue=new Array();
//   for (var i = 0; i < resultnum; i++) {
//     if (results[i].parameter==parameter&&j>=0){
//       var temple=results[i].date.local;
//       var tem=temple.substring(5,10)+temple.substring(11,16);
//       arrayDate[j]=tem;
//       arrayValue[j]=results[i].value;
//       j--;
//       var isfound = 1;
//     }
//   }
//   if (isfound) {
//     var canvas=document.getElementsByTagName('canvas')[canvasnum];
//     canvas.width=500;
//     canvas.height=400;
//   }else {
//     var canvas=document.getElementsByTagName('canvas')[canvasnum];
//     canvas.width=0;
//     canvas.height=0;
//   }
//   lineChart(arrayDate,arrayValue,parameter);
// }


function aqiTrendBarChartLocation(parameter,resultnum,results,period){
  $(".parameterName").remove();
  $("#aqiTrend").remove();
  $('#barChartParent').append('<canvas id="aqiTrend"></canvas>');
  var arrayDate=new Array();
  var arrayValue=new Array();
  if(parameter=='no found'){
    var canvas=document.getElementsByTagName('canvas')[0];
    canvas.width=0;
    canvas.height=0;
    $(".parameterName-control").after("<div class='parameterName'>"+"This  location has no trend of AQI"+"</div>")
  }else {
    var canvas=document.getElementsByTagName('canvas')[0];
    canvas.width=700;
    canvas.height=400;
    var j=23;
    for (var i = 0; i < resultnum; i++) {
      if (results[i].parameter==parameter&&j>=0){
        var temple=results[i].date.local;
        var tem=temple.substring(5,10)+temple.substring(11,16);
        arrayDate[j]=tem;
        arrayValue[j]=aqi(parameter,results[i].value,period);

        j--;
      }
    }
    $(".parameterName-control").after("<div class='parameterName'>"+parameter+":"+"</div>")
    barChart(arrayDate,arrayValue,'aqiTrend')
  }
}


function aqiTrendBarChartState(resultnum,results,today,hour){
  $(".parameterName").remove();
  $("#aqiTrend").remove();
  $('#barChartParent').append('<canvas id="aqiTrend"></canvas>');
  $("#pm25").remove();
  $('#pm25Parent').append('<canvas id="pm25"></canvas>');
  $("#pm10").remove();
  $('#pm10Parent').append('<canvas id="pm10"></canvas>');
  $("#no2").remove();
  $('#no2Parent').append('<canvas id="no2"></canvas>');
  $("#so2").remove();
  $('#so2Parent').append('<canvas id="so2"></canvas>');
  $("#co").remove();
  $('#coParent').append('<canvas id="co"></canvas>');
  $("#o3").remove();
  $('#o3Parent').append('<canvas id="o3"></canvas>');
  var maxaqi=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
  var date=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
  var arrayDate=new Array();
  var arrayDate2=new Array();
  var arrayValue=new Array();
  var todayhour=hour;
  var yesterdayhour=hour;
  for (var i = todayhour; i >=0 ; i--) {
    arrayDate[i+24-todayhour-1]=i;
    arrayDate2[i+24-todayhour-1]=i+':00';
    date[i+24-todayhour-1]=today;
  }
  for (var ii = yesterdayhour+1; ii <= 23; ii++) {
    arrayDate[ii-todayhour-1]=ii;
    arrayDate2[ii-todayhour-1]=ii+':00';
    date[ii-todayhour-1]=today-1;
  }
    for (var i = 0; i < resultnum; i++) {
      var time=results[i].date.local;
      var parametervalue=results[i].value;
      var parametertype=results[i].parameter;
      for (var j = 0; j < 24; j++) {
          if(time.substring(11,13)==arrayDate[j]&&parametervalue!=-9999&&maxaqi[j]<=aqi2(parametertype,parametervalue)&&time.substring(8,10)==date[j]){
            maxaqi[j]=aqi2(parametertype,parametervalue);

          }
      }
    }
  var canvas=document.getElementsByTagName('canvas')[0];
  canvas.width=700;
  canvas.height=400;
  barChart(arrayDate2,maxaqi,'aqiTrend');
  }



//4. initial interface of product
function showState(){
  var beforeToday=getDateBeforeToday(2);
  var state=$("#statelist").val();
  var locationAPI='https://api.openaq.org/v1/measurements?country=AU&city='+state+'&limit=10000&date_from='+beforeToday[0]+'-'+beforeToday[1]+'-'+beforeToday[2]+'&order_by=date&sort=desc';
  var contentJson;
  function getjson(){
      $.ajax({
          url: locationAPI,
          async: false,
          dataType : 'json',
          success: function(data){
              result = data;
          }
      });
      return result;
  }
  contentJson = getjson();
  showStateAqi(contentJson,beforeToday[3],state);
  aqiTrendBarChartState(contentJson.meta.found,contentJson.results,beforeToday[3],beforeToday[4]);
}

function showLocation(){
  showAqi();
  showChart();
}
//5.get the date n before today
function getDateBeforeToday(numberOfDay){
  var time=new Date();
  var day=(time.getDate());
  var month=(time.getMonth())+1;
  var year=(time.getYear())+1900;
  var hours=(time.getHours());
  var beforeToday=new Date(time.getTime()-24*60*60*1000*numberOfDay);
  var beforeTodayDay=beforeToday.getDate();
  var beforeTodayMonth=beforeToday.getMonth()+1;
  var beforeTodayYear=beforeToday.getYear()+1900;
  return [beforeTodayYear,beforeTodayMonth,beforeTodayDay,day,hours];
}

//6. Aqi visualization
//6.1 Aqi QLD
function showStateAqi(content,today,state){
  var maxaqi=[0,0,0,0,0,0];
  var parameter=['pm25','pm10','so2','no2','co','o3'];
  $(".aqivalue").remove();
  $(".aqiinfo").remove();
  $(".updateinfo").remove();
  $(".parameter_list").remove();
  $(".parameter-title").remove();
  $(".updateinfo-control").after("<div class='updateinfo'>"+content.results[0].date.local.substring(0,19).replace(/T/g," ")+"</div>")
  var pm=content.results[0].date.local.substring(11,13);
  for (var i = 0; i < content.meta.found; i++) {
    if(content.results[i].date.local.substring(8,10)==content.results[0].date.local.substring(8,10)&&content.results[i].date.local.substring(11,13)==pm){
      for (var ii = 0; ii < 6; ii++) {
        if(content.results[i].parameter==parameter[ii]&&maxaqi[ii]<=aqi2(content.results[i].parameter,content.results[i].value)){
          maxaqi[ii]=aqi2(content.results[i].parameter,content.results[i].value);
        }
      }
    }
  }
  var totalmax=0;
  var media,mediaparameter;
  for (var i = 0; i < 6; i++) {
    if(totalmax<=maxaqi[i]){
      totalmax=maxaqi[i];
    }
  }
  for (var i = 0; i < 6; i++) {
    for (var j = i+1; j < 6; j++) {
      if(maxaqi[i]<=maxaqi[j]){
        media=maxaqi[i];
        maxaqi[i]=maxaqi[j];
        maxaqi[j]=media;
        mediaparameter=parameter[i];
        parameter[i]=parameter[j];
        parameter[j]=mediaparameter;
      }
    }
  }
  for (var i = 5; i>=0 ; i--) {
    $(".parameter").after("<div class='parameter_list'>"+parameter[i]+"(AQI):"+""+maxaqi[i]+"</div>");
  }
  range(totalmax);
      $(".parameter-control").after("<div class='parameter-title'>"+state+"</div>");
}

//6.2 Aqi not QLD

function showLocationAqi(contentJson,location){
  var max=-1;
  var maxParameter;
  var maxParameterPeriod;
  for (var i = 0; i < contentJson.meta.found; i++) {
    // if(contentJson.results[i].location==locationName) {
      $(".updateinfo-control").after("<div class='updateinfo'>"+contentJson.results[i].measurements[0].lastUpdated.substring(0,19).replace(/T/g," ")+"</div>")
      for (var j = 0; j < contentJson.results[i].measurements.length; j++){
        if(max<=aqi(contentJson.results[i].measurements[j].parameter,contentJson.results[i].measurements[j].value,contentJson.results[i].measurements[j].averagingPeriod.value)){
          max=aqi(contentJson.results[i].measurements[j].parameter,contentJson.results[i].measurements[j].value,contentJson.results[i].measurements[j].averagingPeriod.value);
          maxParameter = contentJson.results[i].measurements[j].parameter;
          maxParameterPeriod = contentJson.results[i].measurements[j].averagingPeriod.value
        }
        if(isNaN(aqi(contentJson.results[i].measurements[j].parameter,contentJson.results[i].measurements[j].value,contentJson.results[i].measurements[j].averagingPeriod.value))){
        $(".parameter").after("<div class='parameter_list'>"+contentJson.results[i].measurements[j].parameter+"(AQI):"+"-"+"</div>");
        }
        if(!isNaN(aqi(contentJson.results[i].measurements[j].parameter,contentJson.results[i].measurements[j].value,contentJson.results[i].measurements[j].averagingPeriod.value))){
        $(".parameter").after("<div class='parameter_list'>"+contentJson.results[i].measurements[j].parameter+"(AQI):"+""+aqi(contentJson.results[i].measurements[j].parameter,contentJson.results[i].measurements[j].value,contentJson.results[i].measurements[j].averagingPeriod.value)+"</div>");
        }
      }
  }
  if (max==-1){
    maxParameter = 'no found';
    maxParameterPeriod = 'no found';
  }
  range(max);
  $(".parameter-control").after("<div class='parameter-title'>"+location.replace(/\+/g," ")+" AQI"+"</div>");
  return [maxParameter,maxParameterPeriod];
}

function showAqi(){
  $(".aqivalue").remove();
  $(".aqiinfo").remove();
  $(".updateinfo").remove();
  $(".parameter_list").remove();
  $(".parameter-title").remove();
  var state=$("#statelist").val();
  var location=$("#locationlist").val();
  var locationAPI='https://api.openaq.org/v1/latest?country=AU&city='+state+'&location='+location;
  //同步
  // console.log(locationAPI);
  var contentJson;
  function getjson(){
    $.ajax({
      url: locationAPI,
      async: false,
      dataType : 'json',
      success: function(data){
          result = data;
      }
    });
    return result;
  }
  contentJson = getjson();
  return showLocationAqi(contentJson,location);
  //console.log(showLocationAqi(contentJson,location));


}
// show AQI trend
function showChart(){
  var state=$("#statelist").val();
  var location=$("#locationlist").val();
  var chartAPI='https://api.openaq.org/v1/measurements?country=AU&city='+state+'&order_by=date&limit=1000&sort=desc&location='+location;
                  //同步
  var chartJson;
  function getjson(){
    $.ajax({
      url: chartAPI,
      async: false,
      dataType : 'json',
      success: function(data){
          result = data;
      }
    });
    return result;
  }
  chartJson = getjson();
  var info = showAqi();
  aqiTrendBarChartLocation(info[0],chartJson.meta.limit,chartJson.results,info[1]);
  // parameterLineChart(chartJson.meta.limit,chartJson.results,'pm25',1);
  // parameterLineChart(chartJson.meta.limit,chartJson.results,'pm10',2);
  // parameterLineChart(chartJson.meta.limit,chartJson.results,'no2',3);
  // parameterLineChart(chartJson.meta.limit,chartJson.results,'so2',4);
  // parameterLineChart(chartJson.meta.limit,chartJson.results,'co',5);
  // parameterLineChart(chartJson.meta.limit,chartJson.results,'o3',6);

}

function showLocationList(){
  var stateName = $("#statelist").val();
  var chartAPI='https://api.openaq.org/v1/latest?country=AU&city='+stateName;
  var chartJson;
  function getjson(){
    $.ajax({
      url: chartAPI,
      async: false,
      dataType : 'json',
      success: function(data){
          result = data;
      }
    });
    return result;
  }
  chartJson = getjson();
  var obj = new Object();
  obj.location = [];
  obj.aqi = [];
  var trHTML = "<tr><td></td><td></td><td></td></tr>";
  for (i=0; i < chartJson.results.length; i++){
    $('#location-list').append(trHTML);
    var tb = document.getElementById('location-list');
    tb.rows[i].cells[0].innerHTML = chartJson.results[i].location;
      max = -1;
      for (var j = 0; j < chartJson.results[i].measurements.length; j++){
        if(max<=aqi(chartJson.results[i].measurements[j].parameter,chartJson.results[i].measurements[j].value,chartJson.results[i].measurements[j].averagingPeriod.value)){
          max=aqi(chartJson.results[i].measurements[j].parameter,chartJson.results[i].measurements[j].value,chartJson.results[i].measurements[j].averagingPeriod.value);
          maxParameter = chartJson.results[i].measurements[j].parameter;
          maxParameterPeriod = chartJson.results[i].measurements[j].averagingPeriod.value
        }
      }
      obj.location[i] = chartJson.results[i].location;
      obj.aqi[i] = max;
      if (max==-1){
        max = 'This location has no AQI';
      }
      tb.rows[i].cells[1].innerHTML = max;
  }
  return (obj);
}
