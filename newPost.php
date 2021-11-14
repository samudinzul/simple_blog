<?php
include 'inc/functions.php';
include 'inc/config.php';

?>
<script src="inc/js/ckeditor/ckeditor.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<?php

session_start();

if (!loggedIn()) {
    header ('Location: index.php');
    exit();
}

?><link rel="stylesheet" href="inc/css/core.css"><?php
include 'header.php';

echo '<div class="container">';

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $title = htmlspecialchars($_POST['title']);
    $body = htmlspecialchars($_POST['body']);
    $user = $_SESSION['userID'];
    $t=time();
    $curTime = date("Y-m-d",$t);
    $metatitle=htmlspecialchars($_POST['metatitle']);
    $urlslug=($_POST['urlslug']);

    if (empty($title) || empty($body)) {
        echo 'Must fill out all feilds.';
    } else {
        $sql = "INSERT INTO `posts` (`id`, `userID`, `title`, `body`, `created`, `updated`, `metatitle` ,`urlslug`) VALUES (NULL, '$user', '$title', '$body', '$curTime', NULL,'$metatitle', '$urlslug' )";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
            header('Location: index.php?Post=Created');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

}

?>

<form action="newPost.php" method="post">
    <input type="text" name="title" placeholder="Title" class="first">
    <input type="text" name="meta-title" placeholder="Meta Title Or Description"><br>
    URL Slug:<input type="text" name="urlslug" placeholder="URL slug" class="second">
    <textarea name="body" placeholder="Post Content" id="body" cols="30" rows="10"  ></textarea>
    <input type="submit" name=submit value="Create Post">

</form>
</div>
<script>
	CKEDITOR.replace('body');
	
    function strtolower(str) {
			return (str + '').toLowerCase();
		}
		
		// phpjs.org/functions/str_ireplace/
		
		function str_ireplace(search, replace, subject) {
			var i, k = '';
			var searchl = 0;
			var reg;

			var escapeRegex = function(s) {
				return s.replace(/([\\\^\$*+\[\]?{}.=!:(|)])/g, '\\$1');
			};

			search += '';
			searchl = search.length;
			if (Object.prototype.toString.call(replace) !== '[object Array]') {
				replace = [replace];
				if (Object.prototype.toString.call(search) === '[object Array]') {
					while (searchl > replace.length) {
						replace[replace.length] = replace[0];
					}
				}
			}

			if (Object.prototype.toString.call(search) !== '[object Array]') {
				search = [search];
			}
			while (search.length > replace.length) {
				replace[replace.length] = '';
			}

			if (Object.prototype.toString.call(subject) === '[object Array]') {
				for (k in subject) {
					if (subject.hasOwnProperty(k)) {
						subject[k] = str_ireplace(search, replace, subject[k]);
					}
				}
				return subject;
			}

			searchl = search.length;
			for (i = 0; i < searchl; i++) {
				reg = new RegExp(escapeRegex(search[i]), 'gi');
				subject = subject.replace(reg, replace[i]);
			}

			return subject;
		}

		$(document).ready(function(){
			$("input.first").on("keyup change", function(){
				var value = strtolower($(this).val());
				var value = str_ireplace(" ", "_", value);
				var value = str_ireplace(".", "_", value);
				var value = str_ireplace("!", "_", value);
				var value = str_ireplace("$", "_", value);
				var value = str_ireplace("+", "", value);
				var value = str_ireplace("-", "", value);
				var value = str_ireplace("(", "", value);
				var value = str_ireplace(")", "", value);

				$("input.second").val( value );
			});
		});


 </script>
