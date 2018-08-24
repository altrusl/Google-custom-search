<html>
    <head>
    <meta charset="utf-8">
        <title>Custom Google Search</title>
    <style type="text/css">
    body {
      font-family: arial,sans-serif;
      max-width: 800px;
      margin-top: 30px;
    }
    p {
      margin: 0;
      padding: 0;
    }
    h2 {
        text-align: center;
      margin-bottom: 30px;
      color: #444;
    }
    .item {
      margin: 0 30px 30px ;
      // display: flex;
    }
    .item a {
      text-decoration: none;
      color: #609;
      font-size: 1.2em;
    }
    .item a:hover {
      text-decoration: underline;
    }
    .item a:visited {
      color: #1a0dab;
    }
    .item .link {
      color: #006621;
      font-size: 0.8em;
      margin-bottom: 5px;
    }
    .item .desc {
      color: #444;
      font-size: 0.9em;
    }
    
    .cont {
      width: 100%;
      height: 100%;
      position: fixed;
      top: 0;
      left: 0;
      display: flex;
      align-items: center;
      align-content: center; 
      justify-content: center; 
      overflow: auto;   
    }

    .results input {
      font-size: 1em;
    }
    .results {
      text-align:center;
    }
    input {
      background-color: #fff;
      width: 500px;
      font-size: 1.4em;
      padding: 2px 10px;
      height: 2em;
      vertical-align: top;
      border: none;
      border-radius: 2px;
      box-shadow: 0 2px 2px 0 rgba(0,0,0,0.26), 0 0 0 2px rgba(0,0,0,0.08);
      transition: box-shadow 200ms cubic-bezier(0.4, 0.0, 0.2, 1);
    }
    input.button {
      margin-left: 3px;
      width: initial;
      cursor: pointer;      
    }
    input.button:hover {
      box-shadow: 0 2px 2px 0 rgba(0,0,0,0.36), 0 0 0 2px rgba(0,0,0,0.20);
    }
    </style>
    </head>
    <body>

<?php
if(!isset($_GET["q"])) {
?>

    <div class="cont">
      <div class="search">
        <form action="index.php">
          <input type="text" name="q" autofocus>
          <input class="button" type="submit" value="&#128270;">
        </form>
      </div>
    </div>
  </body>
</html>

<?php
exit;
}

$json = file_get_contents("https://www.googleapis.com/customsearch/v1?key=AIzaSyDB2ISX0WhMFSmN5jBGc&cx=001997956626253:oi9ssr7ci6e&q=" . $_GET["q"]);
$data = json_decode($json, true);

$title = $data["queries"]["request"][0]["title"];
$total = $data["queries"]["request"][0]["totalResults"];

?>

<div class="search results">
  <form action="index.php">
    <input type="text" name="q" autofocus>
    <input class="button" type="submit" value="&#128270;">
  </form>
</div>

<h2>
<?php echo $title ?>
</h2>

<?php
foreach ($data["items"] as $item) {

?>  
  <div class="item">    
    <p class="title">
      <a target="_blank" href="<?php echo $item["link"] ?>">
        <?php echo $item["title"] ?>  
      </a>
    </p>
    <p class="link"><?php echo $item["displayLink"] ?></p>  
    <p class="desc"><?php echo $item["snippet"] ?></p>  
  </div>

<?php  
}
?>
  
  </body>
</html>
