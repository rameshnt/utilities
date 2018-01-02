<html>
<!--
Utility for checking the access count for all the pages on Drupal 7
-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
        <style type="text/css">
            tr.header
            {
                font-weight:bold;
            }
            tr.alt
            {
                background-color: #777777;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function(){
               $('.striped tr:even').addClass('alt');
            });
        </script>
        <title></title>
    </head>
    <body>

<style type="text/css">
            dummydeclaration { padding-left: 4em; } /* Firefox ignores first declaration for some reason */
            tab1 { padding-right: 4em; }
            tab2 { padding-right: 8em; }            
        </style>

        <?php            
			$con=mysqli_connect("server","user","password","database");
            /*$sql = "Select node.title, count(node.nid), node.nid from nodeviewcount JOIN node ON nodeviewcount.nid=node.nid group by nodeviewcount.nid";*/
			$sql ="Select nid, count(nodeviewcount.nid), alias FROM url_alias join nodeviewcount on nodeviewcount.nid where url_alias.source like concat('node/',nodeviewcount.nid) group by nodeviewcount.nid order by count(nodeviewcount.nid) DESC";

			$result = mysqli_query($con, $sql);

        ?>
        <table class="">
            <tr class="header">
                <td><tab1>Node ID</td>
                <td><tab1>Count</td>
                <td>URL</td>
            </tr>
            <?php
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {               
                   echo "<tr>";
                   echo "<td>".$row["nid"]."</td>";
                   echo "<td>".$row["count(nodeviewcount.nid)"]."</td>";
                   echo "<td>".$row["alias"]."</td>";
                   echo "</tr>";
               }
		}

            ?>
        </table>
    </body>
</html>
