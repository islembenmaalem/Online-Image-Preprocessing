<?php 

//$command = escapeshellcmd('test.py');
//$output = shell_exec($command);
//print_r($output);
$filename="" ;
session_start();
$filename=$_SESSION['filename'] ;
 $filetmpname=$_SESSION['filetmpname'] ;
if ($filename==""){
  $data = $_FILES['uploadfile']['name']; 
  $data = $_FILES['uploadfile']['name']; 


}
else{
  $data = $_SESSION['data'];
  $filename=$_SESSION['filename'] ;
 $filetmpname=$_SESSION['filetmpname'] ;
}
//$output=shell_exec("python test.py "  .$data);
$_SESSION['data'] = $data;

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
if(isset($_POST['uploadfilesub'])) {
//declaring variables
$filename = $_FILES['uploadfile']['name'];
$_SESSION['filename'] = $filename;

$filetmpname = $_FILES['uploadfile']['tmp_name'];
$_SESSION['filetmpname'] = $filetmpname;

//folder where images will be uploaded
//function for saving the uploaded images in a specific folder
//inserting image details (ie image name) in the database
//$sql = "INSERT INTO `uploadedimage` (`imagename`,`v`,`u`)  VALUES ('$filename','1,2,3,4','2,1,3,2')";
//$qry = mysqli_query($conn,  $sql);
/*if( $qry) {
echo "</br>image uploaded"; 
}
}
*/
}
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
$s="";
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

$im_canny="images/new_img/".$ch.'_canny.jpg';
$im_sobelx="images/new_img/".$ch.'_sobelx.jpg';
$im_sobely="images/new_img/".$ch.'_sobely.jpg';
$im_sobel="images/new_img/".$ch.'_sobel.jpg';
$im_prewittx="images/new_img/".$ch.'_prewittx.jpg';
$im_prewitty="images/new_img/".$ch.'_prewitty.jpg';
$im_Prewitt="images/new_img/".$ch.'_Prewitt.jpg';
$im_segmented="images/new_img/".$ch.'_segmented.jpg';
$im_masked="images/new_img/".$ch.'_masked.jpg';
$im_rgb="images/new_img/".$ch.'_rgb.jpg';
$im_otus="images/new_img/".$ch.'_otus.jpg';

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
article{
background: linear-gradient(90deg, rgba(10,2,147,1) 0%, rgba(18,18,174,0.7794468129048494) 35%, rgba(0,212,255,1) 100%);
   color: white;
   width: 350px;
   display: block;
  margin-left: auto;
  margin-right: auto;
    text-align: center;

    box-shadow: 4px  4px 6px rgba(0, 0, 0, 0.336);
}
section{
    margin-top: 10px;
    display: flex;
    justify-content: space-around ;
}
section>article>img{
    width: 300px;

}
section>article>h1{
    text-align:center;
}
article:hover{ transform: scale(1.3) ;}
@media only screen and (max-width: 620px) {
    
        header h1{font-size: 2rem;
    }
    section{
        flex-direction: column;
        width: 100%;
    }
    article{
        margin-top: 20px;
        
    }
section>article>img{
        flex-direction: column;
        width: 100%;
    
    }
    article:hover{ transform: scale(1) ;}
    .imgR{
      width: 100%;
      height: 100%;

    }

}
details>p{
    text-align: center;
}
details>summary{
    padding-left: 10px;
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

  
</style>
    </head>
        <link rel="stylesheet" href="styles.css">

</head>
    <body>
    <header><h1>Welcome to my Website!</h1></header>
    <nav><ul>
        <li><a href="#">Home</a></li>
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
   <section>
       <article>
           <img src=<?php echo $im ?> alt="image" style="width:350px;height:350px"></br>

           <h1>Image Grise</h1>
           <details>
            <summary>description 1</summary>    <p>image au niveau de gris</p>
            </details>
       </article>
       <article>
       <img src=<?php echo $im_binaire?> alt="img binaire" style="width:350px;height:350px"></br>
        <h1>Image binaire</h1>
        <details>
            <summary>description 2</summary>
            <p>img bi</p>
                </details>
    </article>
    <article>
    <img src=<?php echo $im_etiree?> alt="img etiree" style="width:350px;height:350px"></br>
        <h1>Image etirée</h1>
            <details>
        <summary>description 3</summary>    <p>Image etirée</p></details>
    </article>
   </section>

   </br>
   
   <!-- <div  id ="bloc" class="row bloc">


          <div class="column ">
          <div class="curved-ctn">

              <h2>Image gris</h2>
              </div>
              <img src=<?php echo $im ?> alt="image" style="width:100%"></br>
           </div>

          <div class="column">
                <div class="curved-ctn">
                     <h2>Image binaire</h2>
                </div>
               <img src=<?php echo $im_binaire?> alt="img binaire" style="width:100%"></br>
           </div>

          <div class="column">
             <div class="curved-ctn">
            
                   <h2>image etiree</h2>
               </div>

               <img src=<?php echo $im_etiree?> alt="img etiree" style="width:100%"></br>
         </div>
    </div>-->
    </br>
    <section>
       <article>
       <img src=<?php echo $im_rouge?> alt="img red" style="width:350px;height:350px"></br>

           <h1>Image Rouge</h1>
           <details>
            <summary>description 1</summary>    <p>image au rouge</p>
            </details>
       </article>
       <article>
       <img src=<?php echo $im_blue?> alt="img blue" style="width:350px;height:350px"></br>
        <h1>Image Bleu</h1>
        <details>
            <summary>description 2</summary>
            <p>img blue</p>
                </details>
    </article>
    <article>
    <img src=<?php echo $im_vert?> alt="img green" style="width:350px;height:350px"></br>
        <h1>Image Vert</h1>
            <details>
        <summary>description 3</summary>    <p>Image Vert</p></details>
    </article>
   </section>

   </br>

     <!--   <div class="row bloc">
            <div class="column">
            <div class="curved-ctn">
            
            <h2>Image rouge</h2>
            </div>
               <img src=<?php echo $im_rouge?> alt="img red" style="width:100%"></br>
             </div>
           <div class="column">
           <div class="curved-ctn">
            
            <h2>Image blue</h2>
            </div>
              <img src=<?php echo $im_blue?> alt="img blue" style="width:100%"></br>
           </div>
           <div class="column">
           <div class="curved-ctn">
            
            <h2>Image vert</h2>
            </div>
             <img src=<?php echo $im_vert?> alt="img green" style="width:100%"></br>
           </div>
        </div>-->


</br>
<section>
       <article>
       <img src=<?php echo $im_canal_h?> alt="canal h" style="width:350px;height:350px"></br>

           <h1>Canal H</h1>
           <details>
            <summary>description 1</summary>    <p>image canal h</p>
            </details>
       </article>
       <article>
       <img src=<?php echo $im_canal_s?> alt="canal s" style="width:350px;height:350px"></br>
        <h1>Canal S</h1>
        <details>
            <summary>description 2</summary>
            <p>img canal s</p>
                </details>
    </article>
    <article>
    <img src=<?php echo $im_canal_v?> alt="canal v" style="width:350px;height:350px"></br>
        <h1>Canal V</h1>
            <details>
        <summary>description 3</summary>    <p>Image canal v</p></details>
    </article>
   </section>
   </br>
   <!--     <div class="row bloc">
          <div class="column">
              <div class="curved-ctn">
                  <h2>Canal H</h2>
              </div>
              <img src=<?php echo $im_canal_h?> alt="canal h" style="width:100%"></br>
           </div>
          <div class="column">
              <div class="curved-ctn">
                  <h2>Canal S</h2>
               </div>
               <img src=<?php echo $im_canal_s?> alt="canal s" style="width:100%"></br>
           </div>
           <div class="column">
                <div class="curved-ctn">
                    <h2>Canal V</h2>
                </div>
                 <img src=<?php echo $im_canal_v?> alt="canal v" style="width:100%"></br>
             </div>
         </div>-->



        </br>
        <section>
       <article>
       <img src=<?php echo $im_resized?> alt="img resized" style="width:350px;height:350px"></br>

           <h1>Image resized</h1>
           <details>
            <summary>description 1</summary>    <p>image resized</p>
            </details>
       </article>
       <article>
       <img src=<?php echo $im ?> alt="image" style="width:350px;height:350px"></br>
        <h1>Image grise</h1>
        <details>
            <summary>description 2</summary>
            <p>img grise</p>
                </details>
    </article>
    <article>
    <img src=<?php echo $im_grey_inv?> alt="img gris inv" style="width:350px;height:350px"></br>
        <h1>Image Inversée</h1>
            <details>
        <summary>description 3</summary>    <p>Image Inversée</p></details>
    </article>
   </section>

   </br>
   </br>
           <section>
           <article>
       <img src=<?php echo $im_hsv?> alt="image hsv" style="width:350px;height:350px"></br>

           <h1>Image HSV</h1>
           <details>
            <summary>description 1</summary>    <p>image HSV</p>
            </details>
       </article>
       <article>
       <img src=<?php echo $im_rgb?> alt="img RGB" style="width:350px;height:350px"></br>

           <h1>Image RGB</h1>
           <details>
            <summary>description 1</summary>    <p>image RGB</p>
            </details>
       </article>
    <article>
    <img src=<?php echo $im_otus?> alt="Otus's binary threshold" style="width:350px;height:350px"></br>
        <h1>Otus's binary threshold</h1>
            <details>
        <summary>description 3</summary>    <p>Otus's binary threshold</p></details>
    </article>
   </section>
   </br>

      <!--  <div class="row bloc">
            <div class="column">
                   <div class="curved-ctn"> 
                          <h2>Image hsv</h2>
                     </div>
                    <img src=<?php echo $im_hsv?> alt="image hsv" style="width:220px;height:220px"></br>
            </div>
            <div class="column">
                <div class="curved-ctn">
                     <h2>Image resized</h2>
                 </div>
                <img src=<?php echo $im_resized?> alt="img resized" style="width:220px;height:220px"></br>
            </div>
            <div class="column">
               <div class="curved-ctn">
                   <h2>Image inversée</h2>
                </div>
                <img src=<?php echo $im_grey_inv?> alt="img gris inv" style="width:220px;height:220px"></br>
             </div>
         </div>-->
  
         
         
         </br>
           <section>
           <article>
       <img src=<?php echo $im_canny?> alt="image canny" style="width:350px;height:350px"></br>

           <h1>Image Canny</h1>
           <details>
            <summary>description 1</summary>    <p>image canny</p>
            </details>
       </article>
       <article>
       <img src=<?php echo $im_sobelx?> alt="img sobel x" style="width:350px;height:350px"></br>

           <h1>Image Sobel X</h1>
           <details>
            <summary>description 1</summary>    <p>image Sobel X</p>
            </details>
       </article>
    <article>
    <img src=<?php echo $im_sobely?> alt="img sobel y" style="width:350px;height:350px"></br>
        <h1>Image Sobel Y</h1>
            <details>
        <summary>description 3</summary>    <p>Image Sobel Y</p></details>
    </article>
   </section>
   </br>
   </br>
           <section>
           <article>
       <img src=<?php echo $im_sobel?> alt="image sobel" style="width:350px;height:350px"></br>

           <h1>Image Sobel</h1>
           <details>
            <summary>description 1</summary>    <p>image Sobel</p>
            </details>
       </article>
       <article>
       <img src=<?php echo $im_prewittx?> alt="img prewittx" style="width:350px;height:350px"></br>

           <h1>Image Prewitt X</h1>
           <details>
            <summary>description 1</summary>    <p>image Prewitt X</p>
            </details>
       </article>
    <article>
    <img src=<?php echo $im_prewitty?> alt="img  Prewitt Y" style="width:350px;height:350px"></br>
        <h1>Image  Prewitt Y</h1>
            <details>
        <summary>description 3</summary>    <p>Image Prewitt X</p></details>
    </article>
   </section>
   </br>
   </br>
           <section>
           <article>
       <img src=<?php echo $im_Prewitt?> alt="image Prewitt" style="width:350px;height:350px"></br>

           <h1>Image Prewitt</h1>
           <details>
            <summary>description 1</summary>    <p>image Prewitt</p>
            </details>
       </article>
       <article>
       <img src=<?php echo $im_segmented?> alt="img Segmented" style="width:350px;height:350px"></br>

           <h1>Image Segmented</h1>
           <details>
            <summary>description 1</summary>    <p>image Segmented</p>
            </details>
       </article>
    <article>
    <img src=<?php echo $im_masked?> alt="img masked" style="width:350px;height:350px"></br>
        <h1>Image Masked</h1>
            <details>
        <summary>description 3</summary>    <p>Image masked</p></details>
    </article>
   </section>
   </br>

 
  

<!--start Footer area -->
<div class="footer">
  <p>Islem Ben Maalem</p>
</div>



      <!--End Footer area -->
    </body>
    <script src="js/jquery.js"></script>
  <script src="js/Chart.min.js"></script>
<script>
    
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
         
        }
        
        
              

         }
          });
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
    }

         }
          });


//seuillage

var ctx = document.getElementById("seuillage").getContext('2d');
var myChart = new Chart(ctx, {
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
//etirement

//end etirement
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



