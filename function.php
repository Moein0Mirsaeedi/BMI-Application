<?php 

session_start();

const BASE_URL = "http://localhost:8000/";

function asset($file){
    // access to asset files
    return BASE_URL . "assets/" . $file;
}

function dd($data){
    // stop program and print log
    die('<pre>' . var_export($data, true) . '</pre>');
}

function get_data($filename){
    // Get data from json files
    $file_adress = "../database/" . $filename . ".json";
    $file = fopen($file_adress, "r+");
    if(filesize($file_adress)){
        $database = fread($file, filesize($file_adress));
    }
    fclose($file);

    return json_decode($database, true);
}

function setData($dataFile, $newData){
    $newData = json_encode($newData);
    
    $file_adress = '../database/' . $dataFile . '.json';
    $file = fopen($file_adress, "w+");
    $database = fwrite($file, $newData);
    fclose($file);

    return true;
}

function deletePost($posts, $id){
    $post = array_filter($posts, function($post) use($id){
        if($post['id'] != $id){
            return true;
        }else{
            deleteImage($post['image']);
            return false;
        }
    });

    $post = array_values($post);
    setData('post', $post);
    return true;
}

function createPost($posts, $title, $category, $content, $author, $image){
    $lastPost = getLastPost($posts);
    $id = $lastPost['id'] + 1;
    $image_name = uploadImage($image);
    $newPost = [
        'id' => $id,
        'title' => $title,
        'author' => $author,
        'date_published' => date('Y-m-d H:i:s'),
        'content' => $content,
        'tags' => $category,
        'view' => 0,
        'image' => "$image_name"
    ];

    $posts[] = $newPost;
    setData('post', $posts);
    return true;
}

function editPost($posts, $id, $title, $content, $category, $image){
    $posts = array_map(function($post) use($id, $title, $content, $category, $image){
        if($post['id'] == $id){
            $post['title'] = $title;
            $post['content'] = $content;
            $post['tags'] = $category;
            
            if(!empty($image['name'])){
                deleteImage($post['image']);
                $post['image'] = uploadImage($image);
            }
        }

        return $post;
    }, $posts);

    setData('post', $posts);
    return true;
}

function validateEditPost($title, $category, $content, $image){
    $errors = [];

    if(empty($title)){
        $errors[] = "Title is required";
    }else if(strlen($title) < 3){
        $errors[] = "Please enter title bigger than 3 chars.";
    }

    if(empty($category)){
        $errors[] = "Please select one category";
    }else if(!in_array($category, ['Politics','Sport','Tech','Travel','Sport','Entertainment'])){
        $errors[] = "Selected category is invalid";
    }

    if(empty($content)){
        $errors[] = "content is required";
    }else if(strlen($content) < 10){
        $errors[] = "Please enter title content than 10 chars.";
    }

    if(!empty($image['name'])){
        if(!is_array($image)){
            $errors[] = 'Selected image is invalid';
        }else if($image['size'] > 2000000){
            $errors[] = 'Please upload image with smaller size (size should be smaller than 5MB)';
        }else if(! in_array($image['type'], ['image/jpeg', 'image/png', 'image/gif'])){
            $errors[] = 'Please upload image with images type (jpeg, png, gif or...)';
        }else if($image['error'] == '1'){
            $errors[] = 'Image is invalid (very big size or wrong format/type)';
        }
    }

    return $errors;
}

function validatePost($title, $category, $content, $image){
    $errors = [];

    if(empty($title)){
        $errors[] = "Title is required";
    }else if(strlen($title) < 3){
        $errors[] = "Please enter title bigger than 3 chars.";
    }

    if(empty($category)){
        $errors[] = "Please select one category";
    }else if(!in_array($category, ['Politics','sport','social','Travel','Sport',])){
        $errors[] = "Selected category is invalid";
    }

    if(empty($content)){
        $errors[] = "content is required";
    }else if(strlen($content) < 10){
        $errors[] = "Please enter title content than 10 chars.";
    }

    if(!is_array($image)){
        $errors[] = 'Selected image is invalid';
    }else if(empty($image['name'])){
        $errors[] = 'Please upload a picture with name';
    }else if($image['size'] > 2000000){
        $errors[] = 'Please upload image with smaller size (size should be smaller than 5MB)';
    }else if(! in_array($image['type'], ['image/jpeg', 'image/png', 'image/gif'])){
        $errors[] = 'Please upload image with images type (jpeg, png, gif or...)';
    }else if($image['error'] == '1'){
        $errors[] = 'Image is invalid (very big size or wrong format/type)';
    }

    return $errors;
}

function redirect($path){
    header("location: $path");
    exit();
}

function orderPostsByViews($posts) {
    // Sort the posts by views in descending order
    usort($posts, function($a, $b) {
        return $b['view'] - $a['view'];
    });

    // Return the sorted posts
    $posts = array_values($posts);
    return count($posts)? $posts : null;
}

function getLastPost($posts){
    uasort($posts, function($first, $secound){
        if($first['id'] > $secound['id']){
            return -1;
        }else{
            return 1;
        }
    });

    $posts = array_values($posts);
    return $posts[0];
}

function orderPostByDate($posts){
    // Sort the posts by date in descending order
    usort($posts, function($a,$b){
        return strtotime($b['date_published']) - strtotime($a['date_published']);
    });

    $posts = array_values($posts);
    return count($posts)? $posts : null;
}

function getPostById($posts, $id){
    $post = array_filter($posts, function($post) use($id){
        if($post['id'] == $id){
            return true;
        }else{
            return false;
        };
    });

    $post = array_values($post);
    return (count($post)) ? $post[0] : null;
}

function getPostByWord($posts, $search){
    $search = trim($search);
    if($search != ""){
        $posts = array_filter($posts, function($post) use($search){
            if(strpos($post['title'],$search) !== false
            or strpos($post['content'],$search) !== false
            or strpos($post['author'],$search) !== false){
                return true;
            }else{
                return false;
            }
        });
        $posts = array_values($posts);
        return count($posts)? $posts : null;
    }else{
        return null;
    }

}

function getPostByCategory($posts, $category) {
    $posts = array_filter($posts, function($post) use($category){
        foreach($post['tags'] as $tag){
            if($tag == $category)
                return true;
        };
    });
    $posts = array_values($posts);
    return count($posts)? $posts : null;
}

function getCountCategory($posts, $category){
    $i = 0;
    foreach($posts as $post){
            if($post['tags'] == $category)
                $i++;
    }
    return $i;
}

function login($users, $email, $password){
    $user = array_filter($users, function($user) use($email, $password){
        if($user['email'] == $email && $user['password'] == $password){
            return true;
        }else{
            return false;
        }
    });

    $user = array_values($user);
    return count($user)? $user[0] : null;
}

function logout(){
    unset($_SESSION['user']);
    redirect('login.php');
}

function validateLogin($email, $password){
    $errors = [];

    if(empty($email)){
        $errors[] = 'Email is required';
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Email is invalid';
    }

    if(empty($password)){
        $errors[] = 'Password is required';
    }

    return $errors;
}

function authenticated(){
    if(isset($_SESSION['user'])){
        return true;
    }else{
        return false;
    }
}

function getUserData(){
    if(isset($_SESSION['user'])){
        return $_SESSION['user'];
    }else{
        return null;
    }
}

function uploadImage($file){
    $dir = 'assets/images/';
    $name = $file['name'];
    $extension = pathinfo($name, PATHINFO_EXTENSION);
    $new_name = time() . '.' . $extension;
    $tmp = $file['tmp_name'];

    if(move_uploaded_file($tmp, $dir . $new_name)){
        return "$new_name";
    }else{
        return '';
    }
}

function deleteImage($image){
    if (file_exists('assets/images/' . $image)){
        unlink('assets/images/' . $image);
        return true;
    }else{
        return false;
    }
}



?>