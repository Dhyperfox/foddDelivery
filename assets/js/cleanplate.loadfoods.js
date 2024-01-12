function loadfood(category) {
    window.location.replace("foods.php?cat="+category);
}
function selectedfood(cat,fid){
    window.location.replace("foods.php?cat="+cat+"&fid="+fid)
}


function backToCat() {
    window.location.replace("foods.php");
}
