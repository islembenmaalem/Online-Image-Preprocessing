<?php 
session_start();

//$command = escapeshellcmd('test.py');
//$output = shell_exec($command);
//print_r($output);


//$output=shell_exec("python test.py "  .$data);
$data = $_SESSION['data'];
$filename=$_SESSION['filename'] ;
 $filetmpname=$_SESSION['filetmpname'] ;

//echo $output;
?>


<?php

$conn = mysqli_connect("localhost", "root", "root", "users");
//if($conn) {
//echo "connected";
//}

if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
   }
//if button with the name uploadfilesub has been clicked

$sql = "SELECT * FROM uploadedimage";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$e=false;
$v=explode (",", $row['v']);
$u=explode (",", $row['u']);
$v_seuil=explode (",", $row['v_seuil']);
$cumsum=explode (",", $row['cummule']);
$x_cumsum=explode (",", $row['x_cumsum']);
$red=explode (",", $row['red']);
$green=explode (",", $row['green']);
$blue=explode (",", $row['blue']);
$He=explode (",", $row["He"]);
$th= (float)$row['th_Otsu'];
$sql = "SELECT * FROM uploadedimage";
$result = $conn->query($sql);
$ch=substr($filename, 0, -4);
$im=$ch.'_grey.jpg';
while($row = $result->fetch_assoc()) {
    if ($filename==$row['imagename']) 
    {
       // echo "<br>";
        $e=true;
     //   echo "exist";
     //   echo "<br>";
        $ch=substr($filename, 0, -4);
$im=$ch.'_grey.jpg';
      //  echo "v = ".$row['v'];
        $v=explode (",", $row['v']);
        $u=explode (",", $row['u']);
        $cumsum=explode (",", $row['cummule']);
        $x_cumsum=explode (",", $row['x_cumsum']);
        $red=explode (",", $row['red']);
        $green=explode (",", $row['green']);
        $blue=explode (",", $row['blue']);
        $v_seuil=explode (",", $row['v_seuil']);
        $p1=$v_seuil[0];
        $p2=$v_seuil[255];
        $p1=$p1/($p1+$p2);
        $p2=$p2/($v_seuil[0]+$v_seuil[255]);
        $p2=round($p2, 2);
        $p1=round($p1, 2);
        
        $th= (float) $row['th_Otsu'];
        $He=explode (",", $row['He']);
     //   foreach($v_seuil as $val){
     //       echo     $val;
        
     //   }
     //   echo "<br>".$th;

       // echo "<br>";
       // echo "count u : ".count($u);
      //  echo "count v : ".count($v);
        $s=$row['imagename'];
      //  echo $im;
      //  echo '<img src="images/'.$s.'" alt="HTML5 Icon" style="width:128px;height:128px">';
      //  echo '<img src="images/'.$im.'" alt="HTML5 Icon" style="width:128px;height:128px">';
      //  echo $im;
        break;

    }
}
$sql = "SELECT * FROM uploadedimage";
$result = $conn->query($sql);
if ($e==false){
 //   echo "<br>";

    //    echo "not exist";
        $data = $_FILES['uploadfile']['name']; 
        $output=shell_exec("python test.py "  .$data);
      //  echo $output;
     //   sleep(5);
        $sql = "SELECT * FROM uploadedimage";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            if ($filename==$row['imagename']) 
            {
           //     echo "after add";
         //       echo "v = ".$row['v'];
                $v=explode (",", $row['v']);
                $u=explode (",", $row['u']);
                $cumsum=explode (",", $row['cummule']);
                $x_cumsum=explode (",", $row['x_cumsum']);
                $red=explode (",", $row['red']);
                $green=explode (",", $row['green']);
                $blue=explode (",", $row['blue']);
                $th=(float) $row['th_Otsu'];
                $v_seuil=explode (",", $row['v_seuil']);
                $p1=$v_seuil[0];
                $p2=$v_seuil[255];
                $p1=$p1/($p1+$p2);
                $p2=$p2/($v_seuil[0]+$v_seuil[255]);
                $p2=round($p2, 2);
                $p1=round($p1, 2);
        
                $He=explode (",", $row['He']);
             //   foreach($v_seuil as $val){
              //      echo     $val;
             
              //  }
                $ch=substr($filename, 0, -4);
             //   echo "<br>".$th;
                $im=$ch.'_grey.jpg';
            //    echo "count u : ".count($u);
              //  echo "count v : ".count($v);
                $s=$row['imagename'];
             //   echo $im;
            //    echo '<img src="images/'.$s.'" alt="HTML5 Icon" style="width:128px;height:128px">';
               // echo '<img src="images/'.$im.'" alt="HTML5 Icon" style="width:128px;height:128px">';
                $e=true;
               // echo $im;

                break;
            }
        }
        
    
}




$ch=substr($filename, 0, -4);
$im="images/new_img/".$ch.'_grey.jpg';
$im_resized="images/new_img/".$ch.'_resized.jpg';
$im_binaire="images/new_img/".$ch.'_binaire.jpg';
$im_etiree="images/new_img/".$ch.'_etiree.jpg';
$im_rouge="images/new_img/".$ch.'_rouge.jpg';
$im_blue="images/new_img/".$ch.'_bleu.jpg';
$im_vert="images/new_img/".$ch.'_vert.jpg';
$im_grey_inv="images/new_img/".$ch.'_Gray_Inv.jpg';
$im_hsv="images/new_img/".$ch.'_hsv.jpg';
$im_canal_h="images/new_img/".$ch.'_canal_h.jpg';
$im_canal_s="images/new_img/".$ch.'_canal_s.jpg';
$im_canal_v="images/new_img/".$ch.'_canal_v.jpg';
?>


<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Graph</title> 
        <style>
      * {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        
      }
      @import 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet';
      .chartMenu {
        width: 100vw;
        height: 40px;
        background: #1A1A1A;
        color: rgba(255, 26, 104, 1);
      }
      .chartMenu p {
        padding: 10px;
        font-size: 20px;
      }
      .chartCard {
        width: 50vw;
        height: calc(90vh - 90px);
        background: rgba(255, 26, 104, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .chartBox {
        width: 700px;
        padding: 20px;
        border-radius: 20px;
        border: solid 3px rgba(255, 26, 104, 1);
        background: white;


      }
        #chartjs_bar3{
            background-color:#313348;

        }
        header {
    background: linear-gradient(90deg, rgba(10,2,147,1) 0%, rgba(18,18,174,0.7794468129048494) 35%, rgba(0,212,255,1) 100%);
color: white;
height: 90px;
width: 100%;
text-align: center;}
.footer{
  background: linear-gradient(90deg, rgba(10,2,147,1) 0%, rgba(18,18,174,0.7794468129048494) 35%, rgba(0,212,255,1) 100%);
color: white;
left: 0;
   bottom: 0;
height: 50px;
width: 100%;
text-align: center;
padding-top: 20px;
}
header>h1{padding-top: 25px;
    font-size: 1.5rem;
    transition: all 0.25s linear;
    position: relative;
}
    header>h1:before {
        content: "";
        display: block;
        width: 10%;
        height: 3px;
        background-color: #61a3ff;
        position: absolute;
        left: 0;
        bottom: -3px; /* this is to match where the border is */
        transform-origin: left; 
        transform: scale(0);
        transition: 0.25s linear;
      /*   will-change: transform; */
      }
      
      header>h1:hover:before {
        transform: scale(1);
      }
nav li {list-style:none;
float: left;
display: flex;
margin: 20px;
font-size: 20px;
}
nav{display: flex;
    background-color: rgba(0, 0, 0, 0.062);
    justify-content: space-around ;}
nav li a:hover{
    color :lightseagreen;
}
nav li a{color:rgb(31, 92, 204);
text-decoration: none;}

.imgR{
  display: block;
  margin-left: auto;
  margin-right: auto;
    text-align: center;
    transition: width 2s, height 2s, background-color 2s, transform 2s;

}
.imgR:hover {
  -webkit-transform: scaleX(-1);
  transform: scaleX(-1);
}
@media only screen and (max-width: 620px) {

    
        header h1{font-size: 2rem;
    }
  

}

* {
  box-sizing: border-box;
}

.column {
  float: left;
  width: 33.33%;
  padding: 5px;
}
.column2 {
  float: left;
  width: 49.99%;
  padding: 7px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}

/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media screen and (max-width: 500px) {
  .column {
    width: 100%;
    

    
  }
  .column2{
    width:100%;
  

  }
 
}

 .bloc{
   
    text-align: center;
    transition: width 2s, height 2s, background-color 2s, transform 2s;


 }
 .center {
  margin: auto;
  width: 100%;
  padding: 20px;
  text-align: center;

}
.imgR{
 
    transition: width 2s, height 2s, background-color 2s, transform 2s;

}
.imgR:hover {
  -webkit-transform: scaleX(-1);
  transform: scaleX(-1);
}
.row{
  width:  90%;
    height: 90%;
    overflow: auto;
    margin: auto;
    position: relative;

}
body {background:#F6F8FA;}

</style>
    </head>
        <link rel="stylesheet" href="styles.css">

</head>
    <body>
    <header><h1>Welcome to my Website!</h1></header>
    <nav><ul>
        <li><a href="asasa.php">Home</a></li>
        <li><a href="charts.php">Charts</a></li>
        <li><a href="#">About</a></li>
        <li><a href="index.html">back</a></li>
      </ul>
    </nav>
</br>
<div class ="bloc">
 <h2> l'image est :</h2></br>
</div>
<div  class="imgR" style="width=50%" >
<?php  echo '<img src="images/'.$s.'"  alt="HTML5 Icon" style="width:350px;height:350px">';?>
</div>

<div class="curved-ctn bloc">
</br>
<h1> Voici quelques analyses :</h1></br>

                        </div>
 


                        </br>


    <div class="row">
          <div class="column2" >
            <div  style=" font-size: 20px; color:#9CA3AF;background-color:white">
          <h3 class="fs-6 mb-3" style=" color:#9CA3AF; ">l'histogramme de l'image <?php echo $ch ?> :</h3></br>
          <canvas style=" background-color:#313348"   id="myChart"></canvas></br>
          </div>
          </div>

          <div class="column2" >
          <div style="font-size: 20px; color:#9CA3AF;background-color:white ">

          <h3 class="fs-6 mb-3" >l'histogramme cumulé</h3></br>
            <canvas  style=" background-color:#313348"   id="chartjs_bar2"></canvas>
            </br>
           </div>
           </div>


         
    </div>
    </br>

    <div class="row">
          

       
          <div style="font-size: 20px; color:#9CA3AF;background-color:white ">

          <h3 class="fs-6 mb-3" >l'histogramme à seuiller</h3></br>
          <p style="align:center;"><canvas  id="chartjs_bar4" width="100" height="40"></canvas></p>


            </br>
           
           </div>


         
    </div>
    </br>
    <div class="row">
          <div class="column2" >
            <div  style=" font-size: 20px; color:#9CA3AF;background-color:white">
          <div id="chartContainer" style="background-color:#313348;width: 100%;height: 370px;"></div>

          </div>
          </div>

          <div class="column2" >
          <div style="font-size: 20px; color:#9CA3AF;background-color:white ">

          <h3 class="fs-6 mb-3" >l'histogramme du seuillage</h3></br>
            <p style="background-color:#313348 "><canvas  id="seuillage"></canvas></p>

            </br>
           </div>
           </div>


         
    </div>
    </br>

    <div class="row">
          

       
          <div style="font-size: 20px; color:#9CA3AF;background-color:white ">

          <h3 class="fs-6 mb-3" >l'histogramme des couleurs</h3></br>
          <p style="align:center;"><canvas style="background-color:#313348;width: 100%;height: 10%px;"  id="chartjs_bar3"></canvas></p>


            </br>
           
           </div>


         
    </div>
    </br></br>
    <div class="row">
          

       
          <div style="font-size: 20px; color:#9CA3AF;background-color:white ">

          <h3 class="fs-6 mb-3" >l'histogramme de l'etirement</h3></br>
          <p style="align:center;"><canvas  id="chartjs_bar4" width="100" height="40"></canvas></p>
          <p style="align:center;"><canvas  id="etirement"></canvas></p>


            </br>
           
           </div>


         
    </div>
    </br>
    </br>
    </body>
    <script src="js/jquery.js"></script>
  <script src="js/Chart.min.js"></script>
<script>
//etirement  
var ctx = document.getElementById("etirement").getContext('2d');
var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels:<?php echo json_encode($u); ?>,
                  datasets: [{
                    backgroundColor: 'pink',
                 //   borderWidth: 1,

                      data:<?php echo json_encode($He); ?>,
                  
                  }]
              },
              options: {
         
                     legend: {
           
      
                  display: true,
                  position: 'bottom',

                  labels: {
                      fontColor: '#71748d',
                      fontFamily: 'Circular Std Book',
                      fontSize: 14,
                  }

              },
              scales: {
          y: {
            beginAtZero: true
          }
         
        },
        scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false
        },
        
      }],
      xAxes: [{
        gridLines: {
          display: false,
          //type: 'linear',
          
        },
        ticks:{
            callback: function(value, index, values) {
      return  parseInt(value).toFixed(0);
    },
    autoSkip: true,
    maxTicksLimit: 10,
    stepSize: .2
            
        }
      }]
    }
        
        
        
              

         }
          });

//end etirement
</script>

<script type="text/javascript">

var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels:<?php echo json_encode($u); ?>,
                  datasets: [{
                    backgroundColor: 'pink',
                 //   borderWidth: 1,

                      data:<?php echo json_encode($v); ?>,
                  
                  }]
              },
              options: {
         
                     legend: {
           
      
                  display: true,
                  position: 'bottom',

                  labels: {
                      fontColor: '#71748d',
                      fontFamily: 'Circular Std Book',
                      fontSize: 14,
                  }

              },
              scales: {
          y: {
            beginAtZero: true
          }
          
         
        },
        scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false
        },
        
      }],
      xAxes: [{
        gridLines: {
          display: false,
          //type: 'linear',
          
        },
        ticks:{
            callback: function(value, index, values) {
      return  parseInt(value).toFixed(0);
    },
    autoSkip: true,
    maxTicksLimit: 10,
    stepSize: .2
            
        }
      }]
    }
        
        
              

         }
          });

var ctx = document.getElementById("chartjs_bar2").getContext('2d');
var myChart = new Chart(ctx, {
            type: 'bar',
              data: {
                  labels:<?php echo json_encode($x_cumsum); ?>,
                  datasets: [{
                    backgroundColor: 'pink',
                      data:<?php echo json_encode($cumsum); ?>,
                  }]
              },
              options: {
                     legend: {
                  display: true,
                  position: 'bottom',

                  labels: {
                      fontColor: '#71748d',
                      fontFamily: 'Circular Std Book',
                      fontSize: 14,
                  }
              },
              scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false
        },
        
      }],
      xAxes: [{
        gridLines: {
          display: false,
          //type: 'linear',
          
        },
        ticks:{
            callback: function(value, index, values) {
      return  parseInt(value).toFixed(0);
    },
    autoSkip: true,
    maxTicksLimit: 14,
    stepSize: .5
            
        }
      }]
    }

         }
         
          });


var ctx = document.getElementById("chartjs_bar3").getContext('2d');
var myChart = new Chart(ctx, {
            type: 'line',
              data: {
                  labels:<?php echo json_encode($u); ?>,
                  datasets: [{
                    label: "histogramme du rouge",
                    backgroundColor: 'transparent',
      borderColor: '#dc3545',
      pointRadius: 0,
      lineTension: .4,
      borderWidth: 1.5,
                      data:<?php echo json_encode($red); ?>,
                  },
                  {
                    label: "histogramme du vert",

                    backgroundColor: 'transparent',
      borderColor: '#17b36d',
      lineTension: .4,
      borderWidth: 1.5,
      pointRadius: 0,

                          data:<?php echo json_encode($green); ?>,
                  },
                  {
                    label: "histogramme du blue",

                  //  lineTension: 0,
  //  fill: false,
   // borderColor: 'blue',
   backgroundColor: 'transparent',
      borderColor: '#0d6efd',
      lineTension: .4,
      borderWidth: 1.5,
      pointRadius: 0,

                          data:<?php echo json_encode($blue); ?>,
                  }]
              },
              options: {
                     legend: {
                  display: true,
                  position: 'top',

                  labels: {
                      fontColor: 'black',
                      fontFamily: 'Circular Std Book',
                      fontSize: 14,
                      boxWidth: 80,

                  }
              },
              scales: {
                
      yAxes: [{
        gridLines: {
          drawBorder: false
        },
        ticks: {
          stepSize: 100,
        }
      }],
      xAxes: [{
        gridLines: {
          display: false,
          //type: 'linear',
          
        },
        ticks:{
            callback: function(value, index, values) {
      return  parseInt(value).toFixed(0);
    },
    autoSkip: true,
    maxTicksLimit: 10,
    stepSize: .2
            
        }
      }]
    },
    scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false
        },
        
      }],
      xAxes: [{
        gridLines: {
          display: false,
          //type: 'linear',
          
        },
        ticks:{
            callback: function(value, index, values) {
      return  parseInt(value).toFixed(0);
    },
    autoSkip: true,
    maxTicksLimit: 10,
    stepSize: .2
            
        }
      }]
    }
    

         }
          });


//seuillage

var ctx = document.getElementById("seuillage").getContext('2d');
var myChart = new Chart(ctx, {
  animationEnabled: true,

            type: 'line',
              data: {
                  labels:<?php echo json_encode($u); ?>,
                  datasets: [{
                    label: "histogramme du rouge",
                    backgroundColor: 'transparent',
      borderColor: '#ABE9CD',
      pointRadius: 0,
      lineTension: .4,
      borderWidth: 3.5,
                      data:<?php echo json_encode($v_seuil); ?>,
                  },
                 
                ]
              },
              options: {
                     legend: {
                  display: true,
                  position: 'top',

                  labels: {
                      fontColor: 'black',
                      fontFamily: 'Circular Std Book',
                      fontSize: 14,
                      boxWidth: 80,

                  }
              },
              scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false
        },
        
      }],
      xAxes: [{
        gridLines: {
          display: false,
          //type: 'linear',
          
        },
        ticks:{
            callback: function(value, index, values) {
      return  parseInt(value).toFixed(0);
    },
    autoSkip: true,
    maxTicksLimit: 10,
    stepSize: .2
            
        }
      }]
    }

         }
          });
//end seuillage

</script>
<script src=" https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>

<script>
    
const arbitraryLine = {
      id: 'arbitraryLine',
      beforeDraw(chart, args, options) {
        const {
          ctx,
          chartArea: { top, right, bottom, left, width, height },
          scales: { x, y },
        } = chart
        ctx.save()
        ctx.strokeStyle = options.lineColor
        ctx.fillStyle = 'rgba(255, 0, 255, 1)';
        ctx.fillText("seuil par otsu : "+<?php echo $th ?>, x.getPixelForValue(options.xPosition)+2, height-300 );
        ctx.strokeRect(x.getPixelForValue(options.xPosition), top, 1, height)
        ctx.restore()
      },
    }
 var ctx = document.getElementById("chartjs_bar4").getContext('2d');
var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels: <?php echo json_encode($u); ?>,
                  datasets: [{
                 //   borderWidth: 1,
                      data:<?php echo json_encode($v); ?>,
                      borderWidth: 1,
                  }]
              },
             
        
              options: {
        scales: {
          y: {
            beginAtZero: true,
          },
        },
        
        plugins: {
          arbitraryLine: {
            lineColor: 'blue',
            xPosition: <?php echo $th ?>,
            
          },
       
        },
      },
      plugins: [arbitraryLine],
          });
        </script>
        </html>

        <?php
 
 $dataPoints = array( 
   array("label"=>"%white", "y"=>$p2),
   array("label"=>"%noire", "y"=>$p1)
 )
  
 ?>
 <!DOCTYPE HTML>
 <html>
 <head>
 <script>
 window.onload = function() {
  
  
 var chart = new CanvasJS.Chart("chartContainer", {
   animationEnabled: true,
   title: {
     text: "persentage des couleurs de l'image "
   },
   subtitles: [{
     text: "apres seuillage"
   }],
   data: [{
     type: "pie",
     yValueFormatString: "#,##0.00\"%\"",
     indexLabel: "{label} ({y})",
     dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
   }]
 });
 chart.render();
  
 }
 </script>
 </head>
 <body>
   <!--start Footer area -->
<div class="footer">
  <p>Islem Ben Maalem</p>
</div>



      <!--End Footer area -->
 <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
 </body>
 </html>  

