function isInArray(arr,value){
    for(var i = 0; i < arr.length; i++){
        if(value == arr[i]){
            return true;
        }
    }
    return false;
}

function showTopPic (aqi,code) {
  // var myDate = new Date();
  // var mytime=myDate.toLocaleTimeString();
  // console.log(mytime);
  var sunny = [32,34,36];
  var cloudy = [0,2,19,20,21,22,23,24,25,26,28,30,44];
  var rainy = [1,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,35,37,38,39,40,41,42,43,45,46,47];
  var night = [27,29,31,33];
  if (aqi==-1){
    $('.topbackground')
      .css({
        background: "url('../Capstone/picture/default.jpg')",
        'background-repeat': 'no-repeat',
        'background-size': '100% 100%'
      });
  }
  else{
    if (code==3200){
      $('.topbackground')
        .css({
          background: "url('../Capstone/picture/good_sunny.jpg')",
          'background-repeat': 'no-repeat',
          'background-size': '100% 100%'
        });
    }
    else{
      if ((0<=aqi<=100)&&(isInArray(sunny,code))){
        $('.topbackground')
          .css({
            background: "url('../Capstone/picture/good_sunny.jpg')",
            'background-repeat': 'no-repeat',
            'background-size': '100% 100%'
          });
      }
      if((0<=aqi<=100)&&(isInArray(cloudy,code))){
        $('.topbackground')
          .css({
            background: "url('../Capstone/picture/good_cloudy.jpg')",
            'background-repeat': 'no-repeat',
            'background-size': '100% 100%'
          });
      }
      if((0<=aqi<=100)&&(isInArray(rainy,code))){
        $('.topbackground')
          .css({
            background: "url('../Capstone/picture/good_rainy.jpg')",
            'background-repeat': 'no-repeat',
            'background-size': '100% 100%'
          });
      }
      if ((101<=aqi)&&(isInArray(sunny,code))){
        $('.topbackground')
          .css({
            background: "url('../Capstone/picture/pollution_sunny.jpg')",
            'background-repeat': 'no-repeat',
            'background-size': '100% 100%'
          });
      }
      if ((101<=aqi)&&(isInArray(cloudy,code))){
        $('.topbackground')
          .css({
            background: "url('../Capstone/picture/pollution_cloudy.jpg')",
            'background-repeat': 'no-repeat',
            'background-size': '100% 100%'
          });
      }
      if ((101<=aqi)&&(isInArray(rainy,code))){
        $('.topbackground')
          .css({
            background: "url('../Capstone/picture/pollution_rainy.jpg')",
            'background-repeat': 'no-repeat',
            'background-size': '100% 100%'
          });
      }
      if(isInArray(night,code)){
        $('.topbackground')
          .css({
            background: "url('../Capstone/picture/night.jpg')",
            'background-repeat': 'no-repeat',
            'background-size': '100% 100%'
          });
      }
    }
  }
}
