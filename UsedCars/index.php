<?php include 'func2.inc.php'; ?>
<html>
<head>

<script type="text/javascript">
function ChgbgColor(x){
x.style.backgroundColor="#f5f5dc";
x.style.border="1px solid gray";
}

function NormalColor(x){
x.style.backgroundColor="#F5F5F5";
x.style.border="1px solid whitesmoke";
}

</script>

<style>

.input-text
{

        width:600;
        height:30;
        position:fixed;
        top:350px;
        right:370px;


 }

button#rule1{                   // For Google Button

        background-color:whitesmoke ;
        border-style:solid;
        border-color:#F5F5;
        width:150;
        height:32;
        position:fixed;
        top:400px;
        right:700px;

      }
button#rule2{                      // For Harry Button

        background-color:whitesmoke ;
        border-style:solid;
        border-color:#F5F5;
        width:150;
        height:32;
        position:fixed;
        top:400px;
        right:500px;

      }


</style>
</head>
<body>
  <form action="" method= "POST">
   <input type="text"  class="input-text" name="keywords" id="email" value="" />

   <button type="submit"  id="rule1" onmouseover="ChgbgColor(this)" onmouseout="NormalColor(this)" ><b>Google</b></button>
 
   <button type="button" id="rule2" onmouseover="this.style.backgroundColor='#E1EAFE'"><b>Harry</b></button>
  </form>

<?php

   if(isset($_POST['keywords']))  {
    $keywords=  htmlentities(trim($_POST['keywords']));

   }
   $errors= array();
   if(empty($keywords)) {
    $errors[]= 'Please enter a search term';
   }
   else if(strlen($keywords)<3) {
    $errors[]= 'Your search terms must be 3 or more characters'; }
   else if(search_results($keywords)===false){              //(search_results()==false){             // search_results() function defined in another file
    $errors[]= 'Your search for '.$keywords.' returned no results';
   }

   if(empty($errors)) {

        //echo '<pre>', print_r(search_results($keywords)), '</pre>';         // search_results function will return results in multi-dimensional array
        $results= search_results($keywords);
        $results_num= count($results);
       echo "<p>Your search for <strong>  $keywords </strong> yield <strong> $results_num </strong> results. </p>";
        // $results is now a Two-dimensional array containing results
        foreach($results as $result) {

           echo '<p><strong>', $result['title'], '</strong> <br>', $result['description'], '<br><a href= "',$result['url'],'" target= "_blank">',$result['url'],'</a></p>';


        } // foreach loop ends here

    }
   else {
      foreach($errors as $error) {
       echo $error, '</br>';
      }
    }

?>


</body>
</html>

