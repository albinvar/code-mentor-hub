window.addEventListener("app:mounted",(function(){var t={colors:["#a855f7"],series:[{name:"Sales",data:[200,100,300,200,400,300,500]}],chart:{height:268,type:"line",parentHeightOffset:0,toolbar:{show:!1},dropShadow:{enabled:!0,color:"#1E202C",top:18,left:6,blur:8,opacity:.1}},stroke:{width:5,curve:"smooth"},xaxis:{type:"datetime",categories:["1/11/2000","2/11/2000","3/11/2000","4/11/2000","5/11/2000","6/11/2000","7/11/2000"],tickAmount:10,labels:{formatter:function(t,e,a){return a.dateFormatter(new Date(e),"dd MMM")}}},yaxis:{labels:{offsetX:-12,offsetY:0}},fill:{type:"gradient",gradient:{shade:"dark",gradientToColors:["#86efac"],shadeIntensity:1,type:"horizontal",opacityFrom:1,opacityTo:.95,stops:[0,100,0,100]}},grid:{padding:{left:0,right:0}}},e=document.querySelector("#acivity-chart");setTimeout((function(){e._chart=new ApexCharts(e,t),e._chart.render()}))}),{once:!0});