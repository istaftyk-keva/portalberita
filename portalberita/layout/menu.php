<?php
 if(isset($_GET['menu'])){
    $menu=$_GET['menu'];
 }
 else{
    $menu="";
 }
 if($menu=="artikel"){
    include"artikel.php";
 }
else if($menu=="admin"){
    include"admin.php";
}
else if($menu=="edit_admin"){
    include"edit_admin.php";
}
else if($menu=="tambah_admin"){
    include"tambah_admin.php";
}
else if($menu=="artikel"){
    include"artikel.php";
}
else if($menu=="edit_artikel"){
    include"edit_artikel.php";
}
else if($menu=="tambah_artikel"){
    include"tambah_artikel.php";
}
else if($menu=="kategori"){
    include"kategori.php";
}
else if($menu=="tambah_kategori"){
    include"tambah_kategori.php";
}
else if($menu=="edit_kategori"){
    include"edit_kategori.php";
}
else{
    include"home.php";
}
?>