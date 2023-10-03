<?Php
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['category']) && isset($_FILES['image'])) {

        $stmt = $db->prepare("INSERT INTO post (title, content, createdat, category, imagepath) VALUES (?, ?, CURRENT_TIMESTAMP, ?, ?)");
        $stmt->bind_param("ssss", $title, $content, $category, $inamepath);

        $title = $_POST['title'];
        $content = $_POST['content'];
        $category = $_POST['category'];

        $targetDirectory = "../images/";
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $inamepath = $targetFile;

                if ($stmt->execute()) {
                    echo '<script>alert("Post Added Successfully...!");</script>';
                } else {
                    echo "Error: " . $stmt->error;
                }
            } else {
                echo '<script>alert("Sorry, there was an error uploading your file.");</script>';
            }
        }

        $stmt->close();
        $db->close();
    } else {
        echo '<script>alert("Please fill in all the required fields.");</script>';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../dist/output.css">
    <link rel="stylesheet" href="../dist/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

    <style>
       .buttonhover{
        transition: 0.3s ease-in-out;
      }
      .buttonhover:hover{
        transform: scale(1.07);
      }
    </style>

</head>

<body class="bg-[#000000]">

<div class="py-[4%] px-[10%] md:px[2%] md:py[1%]">
<h1 class="text-4xl text-white font-bold text-center uppercase mb-2">add post</h1>
<div class="flex flex-col rounded bg-[#0a0a0a] shadow-xl overflow-hidden">
            <div class="p-5 lg:p-6 grow w-full">
              <div class="sm:p-5 lg:px-10 lg:py-8">
                <form action="" method="post" enctype="multipart/form-data" class="space-y-6">

              
                  <div class="left_come space-y-1">
                    <label for="title" class="font-lg text-white capitalize">Post title</label>
                    <input class="block text-white font-light border-b-2 border-[#808080] w-full p-3 bg-[#0a0a0a] outline-none focus:border-blue-600 focus:outline-none focus:ring-0" type="text" id="title" name="title" required placeholder="Enter title">
                  </div>
                  
                  <div class="right_come space-y-1">
                    <label for="category" class="font-lg text-white capitalize">post category</label>
                    <input class="block text-white font-light border-b-2 border-[#808080] w-full p-3 bg-[#0a0a0a] outline-none focus:border-blue-600 focus:outline-none focus:ring-0" type="text" id="category" name="category" required placeholder="Enter category">
                  </div>

                 
                  <div class="left_come space-y-1">
                    <label for="content" class="font-lg text-white capitalize">Post Content</label>
                    <textarea id="content" name="content" rows="5" required class="peer block w-full appearance-none border-0 border-b border-[#292929] bg-transparent py-2.5 px-0 text-sm text-white focus:border-blue-600 focus:outline-none focus:ring-0"></textarea>
                       <script>
                          CKEDITOR.replace( 'content' );
                        </script>
                  </div>
               
                  <div class="right_come space-y-1">
                    <label for="image" class="font-lg text-white capitalize">upload image</label>
                    <input class="block focus:border-blue-600 focus:outline-none focus:ring-0 text-white font-light border-b-2 border-[#808080] w-full p-3 bg-[#0a0a0a] outline-none" type="file" id="image" name="image" autocomplete="off"  required >
                  </div>

             
                  <div>
                    <button type="submit" class="buttonhover outline-none border-none mt-9 left_come inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-full px-4 py-3 leading-6 rounded  text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl">
                      Add Post
                    </button>
                  </div>
                </form>  
              </div>
            </div>  
          </div>
          <!-- END add post-->
    
</div>
        </body>
</html>