<?php

include 'inc/functions.php';
session_start();
?><link rel="stylesheet" href="inc/css/core.css"><?php
?><script src="inc/js/ckeditor/ckeditor.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<?php

include 'header.php';

if (!loggedIn()) {
    header ('Location: index.php');
    exit();
}

echo '<div class="container">';

if (isset($_GET['post'])) {
    $postID = $_GET['post'];

    $postsInfo = mysqli_query($conn, "SELECT * FROM posts WHERE id='$postID' ORDER BY created DESC");
    if (mysqli_num_rows($postsInfo) > 0) {
        while($postsData = mysqli_fetch_assoc($postsInfo)) { 
            $pID = $postsData['id'];
            $puID = $postsData['userID']; 
            $title = htmlspecialchars_decode($postsData['title']);
            $body = htmlspecialchars_decode($postsData['body']);
            $metatitle = htmlspecialchars_decode($postsData['metatitle']);
            $urlslug = $postsData['urlslug'];


            if (isset($_SESSION['userID'])) {
                $sessionUserID = $_SESSION['userID'];
                if ($puID == $sessionUserID) {

                    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
                        $ntitle = htmlspecialchars($_POST['title']);
                        $nbody = htmlspecialchars($_POST['body']);
                        $t=time();
                        $curTime = date("Y-m-d",$t);
                        $nmetatitle = htmlspecialchars($_POST['metatitle']);
                        $nurlslug = $_POST['urlslug'];

                        if (empty($ntitle) || empty($nbody)) {
                            echo 'Must fill out all feilds.';
                        } else {
                            echo "pass";
                            $sql = "UPDATE `posts` SET title='$ntitle', body='$nbody', updated='$curTime', metatitle='$nmetatitle', urlslug='$nurlslug' WHERE id='$pID'";
                            if (mysqli_query($conn, $sql)) {
                                echo "Post Updated.";
                                header('Location: index.php?Post=Updated');
                                exit();
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            }
                        }
                    }
                    ?>

                    <form action="editPost.php?post=<?php echo $pID;?>" method="post">
                        <input type="text" name="title" value="<?php echo $title;?>" placeholder="Title" class="first">
                        <input type="text" name="metatitle" value="<?php echo $metatitle;?>" placeholder="Meta Title Or Description"><br>
                        URL Slug:<input type="text" name="urlslug"value="<?php echo $urlslug;?>" placeholder="URL_slug" class="second">
                        <textarea name="body" id="body" cols="30" rows="10"><?php echo $body;?></textarea>
                        <input type="submit" name=submit value="Update Post">
                    </form>
                    <?php
                    
                } else {
                    header ('Location: index.phps');
                    exit();
                }
            }
        }

    } else {
        echo 'post not found';
        header ('Location: index.php');
        exit();
    }

} else {
    echo 'post not found';
    header ('Location: index.php');
    exit();
}

echo '</div>';

?>

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