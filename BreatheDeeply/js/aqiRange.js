function range(max){
  if(max==-1){
    $(".aqivalue-control").after("<div class='aqivalue'>"+"This location doesn't have AQI"+"</div>");
  }
  if(max!=-1){
    $(".aqivalue-control").after("<div class='aqivalue'>"+max+"</div>");
  }
  if(0<=max&&max<=50){
    $(".aqiinfo-control").after("<div class='aqiinfo'>"+"Good"+"</div>");
    $('.aqivalue')
      .css({
        'text-align': 'center',
        'font-size': '70px',
        'background-color': 'rgb(0,153,102)',
        color: 'rgb(0, 0, 0)',
        'text-shadow': '1px 0px 1px rgb(255,255,255)',
        'border-radius': '3px',
        height: '90px'
           }
        );
    $('.aqiinfo')
      .css({
        'font-size': '42px',
        'text-shadow': '1px 0px 1px rgb(0, 0, 0)',
        color: 'rgb(0,153,102)'
            }
          );
  }
  if(51<=max&&max<=100){
    $(".aqiinfo-control").after("<div class='aqiinfo'>"+"Moderate"+"</div>");
    $('.aqivalue')
      .css({
        'text-align': 'center',
        'font-size': '70px',
        'background-color': '#FFDE33',
        color: 'rgb(0, 0, 0)',
        'text-shadow': '1px 0px 1px rgb(255,255,255)',
        'border-radius': '3px',
        height: '90px'
           }
        );
    $('.aqiinfo')
      .css({
        'font-size': '42px',
        'text-shadow': '1px 0px 1px rgb(0, 0, 0)',
        color: '#FFDE33'
            }
          );
  }
  if(101<=max&&max<=150){
    $(".aqiinfo-control").after("<div class='aqiinfo'>"+"Unhealthy for Sensitive Groups"+"</div>");
    $('.aqivalue')
      .css({
        'text-align': 'center',
        'font-size': '70px',
        'background-color': '#F93',
        color: 'rgb(0, 0, 0)',
        'text-shadow': '1px 0px 1px rgb(255,255,255)',
        'border-radius': '3px',
        height: '90px'
           }
        );
    $('.aqiinfo')
      .css({
        'font-size': '42px',
        'text-shadow': '1px 0px 1px rgb(0, 0, 0)',
        color: '#F93'
            }
          );
  }
  if(151<=max&&max<=200){
    $(".aqiinfo-control").after("<div class='aqiinfo'>"+"Unhealthy"+"</div>");
    $('.aqivalue')
      .css({
        'text-align': 'center',
        'font-size': '70px',
        'background-color': '#C03',
        color: 'rgb(0, 0, 0)',
        'text-shadow': '1px 0px 1px rgb(255,255,255)',
        'border-radius': '3px',
        height: '90px'
           }
        );
    $('.aqiinfo')
      .css({
        'font-size': '42px',
        'text-shadow': '1px 0px 1px rgb(0, 0, 0)',
        color: '#C03'
            }
          );
  }
  if(201<=max&&max<=300){
    $(".aqiinfo-control").after("<div class='aqiinfo'>"+"Very Unhealthy"+"</div>");
    $('.aqivalue')
      .css({
        'text-align': 'center',
        'font-size': '70px',
        'background-color': '#609',
        color: 'rgb(0, 0, 0)',
        'text-shadow': '1px 0px 1px rgb(255,255,255)',
        'border-radius': '3px',
        height: '90px'
           }
        );
    $('.aqiinfo')
      .css({
        'font-size': '42px',
        'text-shadow': '1px 0px 1px rgb(0, 0, 0)',
        color: '#609'
            }
          );
  }
  if(301<=max){
    $(".aqiinfo-control").after("<div class='aqiinfo'>"+"Hazardous"+"</div>");
    $('.aqivalue')
      .css({
        'text-align': 'center',
        'font-size': '70px',
        'background-color': '#7E0023',
        color: 'rgb(0, 0, 0)',
        'text-shadow': '1px 0px 1px rgb(255,255,255)',
        'border-radius': '3px',
        height: '90px'
           }
        );
    $('.aqiinfo')
      .css({
        'font-size': '42px',
        'text-shadow': '1px 0px 1px rgb(0, 0, 0)',
        color: '#7E0023'
            }
          );
  }
}
